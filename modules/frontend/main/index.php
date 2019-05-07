<?php 
    include '../../../includes/header.php';
    GenerateLog("User accessed Dashboard", ucwords($strModule));
?>

        <div class="content-heading">
            Hospital Management System
            <small>Statistics Dashboard</small>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <!-- START widget-->
                <div class="panel widget bg-primary-light">
                    <div class="row row-table">
                        <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                            <em class="fa fa-users fa-3x"></em>
                        </div>
                        <div class="col-xs-8 pv-lg">
                            <div class="h2 mt0"><?php echo RecCount("Patients", "1=1");?></div>
                            <div class="text-uppercase">Patients</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <!-- START widget-->
                <div class="panel widget bg-info-light">
                    <div class="row row-table">
                        <div class="col-xs-4 text-center bg-info-dark pv-lg">
                            <em class="icon-logout fa-3x"></em>
                        </div>
                        <div class="col-xs-8 pv-lg">
                            <div class="h2 mt0">
                                <?php echo RecCount("Admissions", "DischargedDate IS NULL");?>
                            </div>
                            <div class="text-uppercase">OPD</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- START widget-->
                <div class="panel widget bg-warning-light">
                    <div class="row row-table">
                        <div class="col-xs-4 text-center bg-warning-dark pv-lg">
                            <em class="fa fa-bed fa-3x"></em>
                        </div>
                        <div class="col-xs-8 pv-lg">
                            <div class="h2 mt0"><?php echo RecCount("Admissions", "DischargedDate IS NOT NULL");?></div>
                            <div class="text-uppercase">IPD</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- START widget-->
                <div class="panel widget bg-danger-light">
                    <div class="row row-table">
                        <div class="col-xs-4 text-center bg-danger-dark pv-lg">
                            <em class="icon-call-in fa-3x"></em>
                        </div>
                        <div class="col-xs-8 pv-lg">
                            <div class="h2 mt0">23</div>
                            <div class="text-uppercase">Direct Service</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END widgets box-->
        <div class="row">
            <!-- START dashboard main content-->
            <div class="col-lg-12">
                <!-- START chart-->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- START widget-->
                        <div class="panel panel-default panel-demo" id="panelChart9">
                            <div class="panel-heading">
                                <a class="pull-right" href="#" data-tool="panel-refresh" data-toggle="tooltip" title="" data-original-title="Refresh Panel">
                                    <em class="fa fa-refresh"></em>
                                </a>
                                <a class="pull-right" href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" data-original-title="Collapse Panel">
                                    <em class="fa fa-minus"></em>
                                </a>
                                <div class="panel-title">Patients Statistics</div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                <div class="panel-body">
                                	<div class="chart-line flot-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
                </div>
                <!-- END chart-->
            </div>
            <!-- END dashboard main content-->
        </div>

<?php include '../../../includes/footer.php';?>
