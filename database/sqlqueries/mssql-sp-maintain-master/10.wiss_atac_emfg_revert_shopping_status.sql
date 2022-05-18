USE [ATAC_ARISA_P02]
GO
/****** Object:  StoredProcedure [dbo].[wiss_atac_emfg_revert_shopping_status]    Script Date: 18/05/2022 3:44:36 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =========================================================
-- [wiss_atac_emfg_add_model]
-- Created by : Nuttawut
-- Created date : 28-03-2022
-- Updated date : 28-03-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_atac_emfg_revert_shopping_status]
 @picking_list_num as varchar(25) ='',
 @pallet_Number as varchar(25) =''


AS
DECLARE @UPDATEDATE		VARCHAR(8)  =FORMAT(GETDATE(),'yyyyMMdd')
DECLARE	@UPDATETIME		VARCHAR(6)  =FORMAT(GETDATE(),'HHmmss')
DECLARE @USERNAME VARCHAR(255)      ='ADMIN'
--DECLARE @COMPCODE VARCHAR(255)      ='J631'
--DECLARE @PLANTCODE VARCHAR(255)     ='JC'
--DECLARE @STATUS VARCHAR(255)        ='Y'
--DECLARE @ENABLE VARCHAR(255)        ='Y'
--DECLARE @NEWID int =0
DECLARE @MESSAGE VARCHAR(1024)      =''
DECLARE @SPSTATUS VARCHAR(10)       ='false'

BEGIN TRANSACTION
 BEGIN TRY
	BEGIN
	SET NOCOUNT ON;

			--==================  select data =======================
			SELECT PL.LCTTPICKINLRID , PL.PICKINGNUM,PH.STATUS as HSTATUS ,PL.PARTCODE, PL.STATUS as LSTATUS, PL.CUSTQTY , PL.PACKED ,PL.QTYPACK, PL.PACKED * PL.QTYPACK AS QTYSHOP , COUNT(B.GBTTKANBTPLRID) AS KANBANSHOPED
			INTO #SHOPPINGDATA
			FROM LCTTPICKINH AS PH
			JOIN LCTTPICKINL AS PL
			ON PH.PICKINGNUM =PL.PICKINGNUM
			JOIN GBTTKANBTPH AS A
			ON PH.PICKINGNUM =A. PRODPLANNUM
			LEFT JOIN GBTTKANBTPL AS B ON A.GBTTKANBTPHRID = B.GBTTKANBTPHRID AND PL.PARTCODE =B.PARTCODE
			WHERE
			A. KANBANTYPECODE =7   AND PH.STATUS IN ( 'SCOMPLETE') AND  PH.PICKINGNUM =@picking_list_num AND A.COMMENT2 =@pallet_Number
			GROUP BY   PL.PICKINGNUM , PL.CUSTQTY , PL.PACKED ,PL.QTYPACK, PL.LCTTPICKINLRID , PL.PARTCODE,PH.STATUS , PL.STATUS
			ORDER BY PL.PICKINGNUM DESC

			--==================  loop update data =======================
			DECLARE @I INT =0
			SELECT @I =COUNT(*) FROM #SHOPPINGDATA

			IF @I >0
			BEGIN
				  UPDATE LCTTPICKINH  SET STATUS ='PPARTIAL' WHERE  PICKINGNUM =@picking_list_num
				  WHILE( @I >0 )
				  BEGIN
					SELECT TOP(1) * INTO #TEMP FROM  #SHOPPINGDATA
						IF (SELECT COUNT(*) FROM #TEMP WHERE  KANBANSHOPED < QTYSHOP )>0
						    BEGIN
							    UPDATE A SET A.STATUS ='PPARTIAL' ,A.PACKED =cast(B.KANBANSHOPED/B.QTYSHOP  as  int)
								FROM LCTTPICKINL AS A JOIN #TEMP AS B
								ON A.PICKINGNUM =B.PICKINGNUM AND A.PARTCODE = B.PARTCODE

							END
				    DELETE A FROM  #SHOPPINGDATA AS A JOIN #TEMP AS B ON A.LCTTPICKINLRID =B.LCTTPICKINLRID
					SET @I =@I-1
					DROP TABLE #TEMP
				  END
			END

			DROP TABLE #SHOPPINGDATA


			--==================      Return      =======================
			SET @MESSAGE ='REVERT PICKING LIST : '+ @picking_list_num +' SHOPPING STATUS FROM : SCOMPLETE  TO PPARTIAL COMPLETE.'
			SET @SPSTATUS ='true'



			SELECT @SPSTATUS AS status, @MESSAGE AS message; END

COMMIT
 END TRY
 BEGIN CATCH
        ROLLBACK
		SET @SPSTATUS ='false'

	    SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
 END CATCH
