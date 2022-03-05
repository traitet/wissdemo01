USE [SIAM_EPSDB]
GO
/****** Object:  StoredProcedure [dbo].[report_budget_checking]    Script Date: 3/5/2022 4:31:25 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- interface_sap_po
-- Created by : Satit Po
-- Created date : 23-02-2022
-- Updated date : 03-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[report_budget_checking]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@record_count AS INT,
@doc_type AS INT --1:Expense,2:Investment
AS
BEGIN
IF (@doc_type=1)
	BEGIN
	SELECT TOP (@record_count)
		PRF.PRNUM,
		PRFL.EXPENSEID,
		PRFL.INVESTMENTID,
		PRFL.ITEMNO, PRFL.MATID AS PRFMATID, PRFL.MATDESC AS PRFMATDESC,POFL.MACHINEID,POFL.PRODUCTLINEID AS LINE_NO,PRFL.DESCRIPTION AS [BRAND] , PRF.BUDGETTYPE,
        CASE PRF.BUDGETTYPE
			WHEN 'EXPENSE' THEN  CASE WHEN LEN(PRFL.EXPENSEID) > 10 THEN  SUBSTRING (PRFL.EXPENSEID, 8, LEN (PRFL.EXPENSEID) - 7) ELSE PRFL.EXPENSEID END
			WHEN 'INVESTMENT' THEN PRFL.INVESTMENTID END AS PRFACCOUNTID,PRFL.GOODSTYPE, PRF.SECTIONID,
			dbo.fn_set_date_txt(PRFL.REQUIREDDATE) AS REQUIREDDATE,
			dbo.fn_set_date_txt(PRFL.CREATEDDATE) AS CREATEDDATE,
			dbo.fn_set_date_txt(POF.PODATE) AS PODATE ,
		PRFL.QTY AS PRFQTY, PRFL.PRICE AS PRFPRICE, PRFL.AMOUNT AS PRFAMOUNT,
        PRFL.STATUS AS PRFSTATUS, PRFL.CREATEDBY AS PRCREATED, PRIL.VENDORNAME,
        PRIL.BUYER, PRIL.MATID AS PRIMATID,
        CASE PRIL.BUDGETTYPE
			WHEN 'EXPENSE' THEN
				CASE WHEN LEN(PRIL.EXPENSEID) > 10 THEN  SUBSTRING (PRIL.EXPENSEID, 8, LEN (PRIL.EXPENSEID) - 7)
				ELSE PRIL.EXPENSEID END
			WHEN 'INVESTMENT' THEN PRIL.INVESTMENTID END AS PRIACCOUNTID,
		NULLIF(CAST(PRFL.SERVICEDURATION AS INT),0) AS DURATIONTIME,
		dbo.fn_set_date_txt(PRFL.SERVICESTARTDATE) AS STARTSERVICE,
		dbo.fn_set_date_txt(PRIL.REQUIREDDATE) ASREQUIREDDATE ,
		PRIL.QTY AS PRIQTY,
		PRIL.PRICE AS PRIPRICE,
        PRIL.AMOUNT AS PRIAMOUNT, PRIL.VAT, (PRIL.AMOUNT + PRIL.VAT) AS PRILINEAMOUNT,
        PRIL.STATUS AS PRISTATUS, PRIL.BUYERCOMMENT, PRIL.SENIORBUYERCOMMENT,
        CASE PRIL.BUDGETTYPE
			WHEN 'EXPENSE' THEN PRIL.CPACCCOMMENT
			WHEN 'INVESTMENT' THEN PRIL.CPINVCOMMENT
		END AS CPCOMMENT,
		PRIL.COSTCOMMENT, PRIL.PONUM, PRIL.PURCHASETYPE,
        POF.STATUS AS POFSTATUS,
		POF.CURRENTUSER, POF.CURRENTROLE,POFL.POLINE_ROWID,  PRIL.PRITEM_LINE_ROWID
        FROM
			TT_PRFORM PRF
			INNER JOIN TT_PRFORM_LINE PRFL ON PRF.PRNUM = PRFL.PRNUM
			LEFT JOIN TT_PRITEM_LINE PRIL ON PRIL.PRFORM_LINE_ROWID = PRFL.PRFORM_LINE_ROWID
			LEFT JOIN TT_POFORM_LINE POFL ON POFL.PRITEMLINE_ROWID = PRIL.PRITEM_LINE_ROWID
			LEFT JOIN TT_POFORM POF ON POFL.PONUM = POF.PONUM
			INNER JOIN TM_SECTION SEC ON PRF.SECTIONID = SEC.SECTIONID
		WHERE (POFL.STATUS <> 'CANCEL' OR POFL.STATUS IS NULL)
    		AND PRFL.EXPENSEID LIKE '%' + @doc_num  + '%'
			AND PRF.CREATEDDATE >= @start_date
			AND PRF.CREATEDDATE <= @end_date
		ORDER BY
			PRF.PRNUM ASC, PRFL.ITEMNO ASC
	END
ELSE IF (@doc_type=2)
	BEGIN
	SELECT TOP (@record_count)
		PRF.PRNUM,
		PRFL.EXPENSEID,
		PRFL.INVESTMENTID,
		PRFL.ITEMNO, PRFL.MATID AS PRFMATID, PRFL.MATDESC AS PRFMATDESC,POFL.MACHINEID,POFL.PRODUCTLINEID AS LINE_NO,PRFL.DESCRIPTION AS [BRAND] , PRF.BUDGETTYPE,
        CASE PRF.BUDGETTYPE  WHEN 'EXPENSE' THEN  CASE WHEN LEN(PRFL.EXPENSEID) > 10 THEN  SUBSTRING (PRFL.EXPENSEID, 8, LEN (PRFL.EXPENSEID) - 7) ELSE PRFL.EXPENSEID END  WHEN 'INVESTMENT' THEN PRFL.INVESTMENTID
        END AS PRFACCOUNTID,
		PRFL.GOODSTYPE, PRF.SECTIONID,
        dbo.fn_set_date_txt(PRFL.REQUIREDDATE) AS REQUIREDDATE ,
		dbo.fn_set_date_txt(PRFL.CREATEDDATE) AS CREATEDDATE,
		dbo.fn_set_date_txt(POF.PODATE) AS PODATE,
		PRFL.QTY AS PRFQTY, PRFL.PRICE AS PRFPRICE, PRFL.AMOUNT AS PRFAMOUNT,
        PRFL.STATUS AS PRFSTATUS,
		PRFL.CREATEDBY AS PRCREATED, PRIL.VENDORNAME,
        PRIL.BUYER, PRIL.MATID AS PRIMATID,
        CASE PRIL.BUDGETTYPE
		WHEN 'EXPENSE'  THEN  CASE WHEN LEN(PRIL.EXPENSEID) > 10
			THEN  SUBSTRING (PRIL.EXPENSEID, 8, LEN (PRIL.EXPENSEID) - 7)
			ELSE PRIL.EXPENSEID  END
		WHEN 'INVESTMENT' THEN PRIL.INVESTMENTID END AS PRIACCOUNTID,
		NULLIF(CAST(PRFL.SERVICEDURATION AS INT),0) AS DURATIONTIME,
		dbo.fn_set_date_txt(PRFL.SERVICESTARTDATE) AS STARTSERVICE,
		dbo.fn_set_date_txt(PRIL.REQUIREDDATE) AS REQUIREDDATE,
		PRIL.QTY AS PRIQTY, PRIL.PRICE AS PRIPRICE,
        PRIL.AMOUNT AS PRIAMOUNT, PRIL.VAT,
		(PRIL.AMOUNT + PRIL.VAT) AS PRILINEAMOUNT,
        PRIL.STATUS AS PRISTATUS, PRIL.BUYERCOMMENT, PRIL.SENIORBUYERCOMMENT,
        CASE PRIL.BUDGETTYPE
			WHEN 'EXPENSE' THEN PRIL.CPACCCOMMENT
			WHEN 'INVESTMENT' THEN PRIL.CPINVCOMMENT
			END AS CPCOMMENT,
		PRIL.COSTCOMMENT, PRIL.PONUM, PRIL.PURCHASETYPE,
        POF.STATUS AS POFSTATUS, POF.CURRENTUSER, POF.CURRENTROLE,POFL.POLINE_ROWID,  PRIL.PRITEM_LINE_ROWID
        FROM
        TT_PRFORM PRF
			INNER JOIN TT_PRFORM_LINE PRFL ON PRF.PRNUM = PRFL.PRNUM
			LEFT JOIN TT_PRITEM_LINE PRIL ON PRIL.PRFORM_LINE_ROWID = PRFL.PRFORM_LINE_ROWID
			LEFT JOIN TT_POFORM_LINE POFL ON POFL.PRITEMLINE_ROWID = PRIL.PRITEM_LINE_ROWID
			LEFT JOIN TT_POFORM POF ON POFL.PONUM = POF.PONUM
			INNER JOIN TM_SECTION SEC ON PRF.SECTIONID = SEC.SECTIONID
		WHERE
			(POFL.STATUS <> 'CANCEL' OR POFL.STATUS IS NULL)
    		AND PRFL.INVESTMENTID LIKE '%' + @doc_num  + '%'
			AND PRF.CREATEDDATE  >= @start_date
			AND PRF.CREATEDDATE  <= @end_date
    ORDER BY PRF.PRNUM ASC, PRFL.ITEMNO ASC
	END
ELSE
	BEGIN
		SELECT TOP (@record_count)
			PRF.PRNUM,
			PRFL.EXPENSEID,
			PRFL.INVESTMENTID,
			PRFL.ITEMNO, PRFL.MATID AS PRFMATID, PRFL.MATDESC AS PRFMATDESC,POFL.MACHINEID,POFL.PRODUCTLINEID AS LINE_NO,PRFL.DESCRIPTION AS [BRAND] , PRF.BUDGETTYPE,
        CASE PRF.BUDGETTYPE
			WHEN 'EXPENSE' THEN  CASE WHEN LEN(PRFL.EXPENSEID) > 10 THEN  SUBSTRING (PRFL.EXPENSEID, 8, LEN (PRFL.EXPENSEID) - 7) ELSE PRFL.EXPENSEID END
			WHEN 'INVESTMENT' THEN PRFL.INVESTMENTID END AS PRFACCOUNTID,
		PRFL.GOODSTYPE, PRF.SECTIONID,
        dbo.fn_set_date_txt(PRFL.REQUIREDDATE) AS REQUIREDDATE ,
		dbo.fn_set_date_txt(PRFL.CREATEDDATE) AS CREATEDDATE,
		dbo.fn_set_date_txt(POF.PODATE) AS PODATE,
		PRFL.QTY AS PRFQTY, PRFL.PRICE AS PRFPRICE,
		PRFL.AMOUNT AS PRFAMOUNT,
        PRFL.STATUS AS PRFSTATUS,
		PRFL.CREATEDBY AS PRCREATED, PRIL.VENDORNAME,
        PRIL.BUYER, PRIL.MATID AS PRIMATID,
        CASE PRIL.BUDGETTYPE
			WHEN 'EXPENSE'  THEN CASE
				WHEN LEN(PRIL.EXPENSEID) > 10 THEN  SUBSTRING (PRIL.EXPENSEID, 8, LEN (PRIL.EXPENSEID) - 7) ELSE PRIL.EXPENSEID  END
			WHEN 'INVESTMENT' THEN PRIL.INVESTMENTID END AS PRIACCOUNTID,
		NULLIF(CAST(PRFL.SERVICEDURATION AS INT),0) AS DURATIONTIME,dbo.fn_set_date_txt(PRFL.SERVICESTARTDATE) AS STARTSERVICE,
		dbo.fn_set_date_txt(PRIL.REQUIREDDATE) AS REQUIREDDATE ,
		PRIL.QTY AS PRIQTY, PRIL.PRICE AS PRIPRICE,
        PRIL.AMOUNT AS PRIAMOUNT, PRIL.VAT, (PRIL.AMOUNT + PRIL.VAT) AS PRILINEAMOUNT,
        PRIL.STATUS AS PRISTATUS, PRIL.BUYERCOMMENT, PRIL.SENIORBUYERCOMMENT,
        CASE PRIL.BUDGETTYPE
			WHEN 'EXPENSE' THEN PRIL.CPACCCOMMENT
			WHEN 'INVESTMENT' THEN PRIL.CPINVCOMMENT
        END AS CPCOMMENT,
		PRIL.COSTCOMMENT, PRIL.PONUM, PRIL.PURCHASETYPE,
        POF.STATUS AS POFSTATUS, POF.CURRENTUSER, POF.CURRENTROLE,POFL.POLINE_ROWID,  PRIL.PRITEM_LINE_ROWID
	FROM
        TT_PRFORM PRF
			INNER JOIN TT_PRFORM_LINE AS PRFL ON PRF.PRNUM = PRFL.PRNUM
			LEFT JOIN TT_PRITEM_LINE AS PRIL ON PRIL.PRFORM_LINE_ROWID = PRFL.PRFORM_LINE_ROWID
			LEFT JOIN TT_POFORM_LINE AS POFL ON POFL.PRITEMLINE_ROWID = PRIL.PRITEM_LINE_ROWID
			LEFT JOIN TT_POFORM AS POF ON POFL.PONUM = POF.PONUM
			INNER JOIN TM_SECTION AS SEC ON PRF.SECTIONID = SEC.SECTIONID
	WHERE
		(POFL.STATUS <> 'CANCEL' OR POFL.STATUS IS NULL)
       AND PRF.CREATEDDATE  >= @start_date
       AND PRF.CREATEDDATE  <= @end_date
		AND (PRFL.INVESTMENTID LIKE '%' + @doc_num  + '%' OR PRFL.EXPENSEID LIKE '%' + @doc_num  + '%')
    ORDER BY PRF.PRNUM ASC, PRFL.ITEMNO ASC
	END

END

-- @doc_type AS INT --1:Expense,2:Investment
-- EXEC [report_budget_checking] '20210101', '20220101','F400',10, 0
-- EXEC [report_budget_checking] '20210101', '20220101','F400',10, 1
-- EXEC [report_budget_checking] '20210101', '20220101','Y21PE',10, 2
