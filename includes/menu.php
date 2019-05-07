    <!-- top navbar-->
    <header class="topnavbar-wrapper">
    <!-- START Top Navbar-->
    <nav class="navbar topnavbar" role="navigation">
        <!-- START navbar header-->
        <div class="navbar-header">
            <a class="navbar-brand" href="../main/index.php">
                <div class="brand-logo">
                    <img class="img-responsive" src="<?php echo $strLibPath;?>/images/hms.png" width="120" height="60" alt="HMS">
                </div>
                <div class="brand-logo-collapsed">
                    <img class="img-responsive" src="<?php echo $strLibPath;?>/images/hms.png" alt="App Logo">
                </div>
            </a>
        </div>
        <!-- END navbar header-->
        <!-- START Nav wrapper-->
        <div class="nav-wrapper">
            <ul id="toggleSidebar" class="nav navbar-nav">
                <li>
                    <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                    <a class="hidden-xs" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
                        <em class="fa fa-navicon"></em>
                    </a>
                    <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                    <a class="visible-xs sidebar-toggle" href="#" data-toggle-state="aside-toggled" data-no-persist="true">
                        <em class="fa fa-navicon"></em>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
            	<?php if ($strModule == "patients" && basename($_SERVER['REQUEST_URI']) == "index.php") {?>
            	<li>
                    <a class="menu_btn" href="../patients/patient-listing.php">
                        <em class="icon-people"></em>
                        &nbsp;Patient Listing
                    </a>
                </li>
                <?php }?>
            	<?php if ($strModule == "opd" && basename($_SERVER['REQUEST_URI']) == "index.php") {?>
            	<li>
                    <a class="menu_btn" href="../opd/patient-history.php">
                        <em class="icon-logout"></em>
                        &nbsp;Patient History
                    </a>
                </li>
                <?php }?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-list">
                    <a href="#" data-toggle="dropdown">
                        <em class="icon-settings"></em>
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li>
                            <div class="list-group">
                                <a class="list-group-item" href="#">
                                    <div class="media-box">
                                        <div class="pull-left">
                                            <em class="fa fa-power-off fa-2x text-success"></em>
                                        </div>
                                        <div class="media-box-body clearfix">
                                            <p id="logout" class="m0">Logout</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
  </header>