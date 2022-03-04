       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

           <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
               <div class="sidebar-brand-icon rotate-n-15">
                   <i class="fas fa-laugh-wink"></i>
               </div>
               <div class="sidebar-brand-text mx-3">WISS <sup>2</sup></div>
           </a>

           <!-- Divider -->
           <hr class="sidebar-divider my-0">

{{-- ========================================================================== --}}
{{-- DASHBOARD --}}
{{-- ========================================================================== --}}

           <!-- Nav Item - Dashboard -->
           <li class="nav-item active">
               <a class="nav-link" href="index.html">
                   <i class="fas fa-fw fa-tachometer-alt"></i>
                   <span>Dashboard</span></a>
           </li>

           <!-- Divider -->
           <hr class="sidebar-divider">
{{-- ========================================================================== --}}
{{-- BUSINESS APP --}}
{{-- ========================================================================== --}}
           <!-- Heading -->
           <div class="sidebar-heading">
               Business App Reports
           </div>

           <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-coins"></i>
                   <span>SAP</span>
               </a>
               <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                   <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="interface-sap-po">PO Interface</a>
                        <a class="collapse-item" href="interface-sap-rec">Receive Interface</a>
                        <a class="collapse-item" href="interface-sap-inv">Invoice Interface</a>
                   </div>
               </div>
           </li>
           <!-- Nav Item - Utilities Collapse Menu -->
           <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                   <i class="fas fa-fw fa-wrench"></i>
                   <span>E-MFG</span>
               </a>
               <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                   <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="emfg-shipping-status">Oder Status</a>
                        <a class="collapse-item" href="emfg-shipping-log-ok">OK Log</a>
                        <a class="collapse-item" href="emfg-shipping-log-ng">NG Log</a>
                        <a class="collapse-item" href="emfg-shipping-log-event">Event Log</a>
                   </div>
               </div>
           </li>
           <!-- Nav Item - Utilities Collapse Menu -->
           <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>EPS</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="collapseThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="eps-pr-error">PR Issue Error</a>
                     <a class="collapse-item" href="eps-pr-production-error">PR Production Error</a>
                     <a class="collapse-item" href="eps-pr-po-planner">PR/PO Planner</a>
                     <a class="collapse-item" href="eps-pr-outstanding">PR Outstanding</a>
                     <a class="collapse-item" href="eps-bg-checking">BG Checking</a>
                     <a class="collapse-item" href="eps-cp-approve-pr">CP Approve PR</a>
                </div>
            </div>
        </li>

           <!-- Divider -->
           <hr class="sidebar-divider">
{{-- ========================================================================== --}}
{{-- INFRA --}}
{{-- ========================================================================== --}}
           <!-- Heading -->
           <div class="sidebar-heading">
               Infra Reports
           </div>

           <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInfra" aria-expanded="true" aria-controls="collapseInfra">
                   <i class="fas fa-fw fa-chart-pie"></i>
                   <span>ATGN</span>
               </a>
               <div id="collapseInfra" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="https://zabbix.atgn-monitor.net/zabbix/index.php?request=charts.php%3Fpage%3D1%26groupid%3D541%26hostid%3D12956%26graphid%3D1595%26action%3Dshowgraph">SA</a>
                    <a class="collapse-item" href="https://zabbix.atgn-monitor.net/zabbix/index.php?request=charts.php%3Fpage%3D1%26groupid%3D541%26hostid%3D12956%26graphid%3D1595%26action%3Dshowgraph">ATAC</a>
                    <a class="collapse-item" href="https://zabbix.atgn-monitor.net/zabbix/index.php?request=charts.php%3Fpage%3D1%26groupid%3D541%26hostid%3D12956%26graphid%3D1595%26action%3Dshowgraph">AIAP</a>
                    <a class="collapse-item" href="https://zabbix.atgn-monitor.net/zabbix/index.php?request=charts.php%3Fpage%3D1%26groupid%3D541%26hostid%3D12956%26graphid%3D1595%26action%3Dshowgraph">AISIN Group</a>
               </div>
               </div>
           </li>

           <!-- Nav Item - Tables -->
           <li class="nav-item">
            <a class="nav-link" href="http://10.123.126.12/zabbix/zabbix.php?action=dashboard.list">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Zabbix</span></a>
           </li>


           <!-- Nav Item - Tables -->
           <li class="nav-item">
            <a class="nav-link" href="https://10.122.242.248/Orion/Login.aspx?sessionTimeout=yes">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Solarwinds</span></a>
            </li>

            <!-- Nav Item - Tables -->
           <li class="nav-item">
            <a class="nav-link" href="https://bnmonitor.leapsolutions.co.th/nagiosxi/login.php">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Nagios</span></a>
            </li>

           <!-- Divider -->
           <hr class="sidebar-divider d-none d-md-block">
{{-- ========================================================================== --}}
{{-- Administrator Manual  --}}
{{-- ========================================================================== --}}
        <!-- Heading -->
        <div class="sidebar-heading">
            Administrator Manual
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInfraTemplate" aria-expanded="true" aria-controls="collapseInfraTemplate">
            <i class="fas fa-fw fa-book"></i>
            <span>Infra Admin Manual</span>
        </a>
        <div id="collapseInfraTemplate" class="collapse" aria-labelledby="collapseInfraTemplate" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="theme/infra-admin-manual.pdf" target="_blank">Infra Report Manual</a>
            </div>
        </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBusinessTemplate" aria-expanded="true" aria-controls="collapseBusinessTemplate">
                <i class="fas fa-fw fa-book"></i>
                <span>Business Admin Manual</span>
            </a>
            <div id="collapseBusinessTemplate" class="collapse" aria-labelledby="collapseBusinessTemplate" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="main">Business Report Manual</a>
                </div>
            </div>
            </li>

{{-- ========================================================================== --}}
{{-- Administrator  --}}
{{-- ========================================================================== --}}
        <!-- Heading -->
        <div class="sidebar-heading">
            Business App Reports
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminTemplate" aria-expanded="true" aria-controls="collapseAdminTemplate">
            <i class="fas fa-fw fa-cog"></i>
            <span>Admin Template</span>
        </a>
        <div id="collapseAdminTemplate" class="collapse" aria-labelledby="collapseAdminTemplate" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="main">Main - Pare</a>
                <a class="collapse-item" href="basic-report">Basic Report</a>
                <a class="collapse-item" href="basic-report-api">Basic Report API</a>
                <a class="collapse-item" href="emfg-shipping-log-ok">Shipping Log OK (Test)</a>
                <a class="collapse-item" href="emfg-shipping-log-ok-BK">Shipping OBJ</a>
            </div>
        </div>
        </li>

{{-- ========================================================================== --}}
{{-- SAMPLE  --}}
{{-- ========================================================================== --}}
           {{-- <!-- Heading -->
           <div class="sidebar-heading">
               Sample Template
           </div>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="theme/login.html">Login</a>
                    <a class="collapse-item" href="theme/register.html">Register</a>
                    <a class="collapse-item" href="theme/forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="theme/404.html">404 Page</a>
                    <a class="collapse-item" href="theme/blank.html">Blank Page</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="theme/charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item active">
            <a class="nav-link" href="theme/tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li> --}}

{{-- ========================================================================== --}}
{{-- TOGGER --}}
{{-- ========================================================================== --}}
                   <!-- Sidebar Toggler (Sidebar) -->
                   <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

           {{-- <!-- Sidebar Message -->
           <div class="sidebar-card d-none d-lg-flex">
               <img class="sidebar-card-illustration mb-2" src="theme/img/undraw_rocket.svg" alt="...">
               <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
               <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
           </div> --}}

        </ul>
        <!-- End of Sidebar -->

            <!-- Divider -->
            <hr class="sidebar-divider">
