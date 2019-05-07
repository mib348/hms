<?php
    include_once '../../../includes/header.php';
    GenerateLog("User accessed Admin Dashboard", ucwords($strModule));
?>
<style>
	.panel_links{color:inherit;text-decoration: none;}
	.panel_links:hover{cursor: pointer;text-decoration: none;color:inherit;}
	.labels h4{padding-right: 15px;}
</style>
        <div class="content-heading">
            Admin
        </div>
        <div class="row">
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="consultants.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-info">
		                                 <em class="fa fa-user-md fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Consultants</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="departments.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-inverse">
		                                 <em class="fa fa-building fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Departments</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="sub_departments.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-inverse">
		                                 <em class="fa fa-building-o fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Sub Departments</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="locations.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-inverse">
		                                 <em class="fa fa-map-marker fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Locations</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="main_services.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-warning">
		                                 <em class="fa fa-cogs fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Main Services</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="sub_services.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-warning">
		                                 <em class="fa  fa-cog fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Sub Services</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="services.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-warning">
		                                 <em class="fa fa-stethoscope fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Services</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="service_rates.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-danger">
		                                 <em class="fa fa-money fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Service Rates</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="companies.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-danger">
		                                 <em class="fa fa-building-o fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Companies</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="specialities.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-info">
		                                 <em class="fa fa-cubes fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Specialities</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="wardtypes.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-success">
		                                 <em class="fa fa-h-square fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Ward Types</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="wards.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-success">
		                                 <em class="fa fa-hospital-o fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Wards</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="beds.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-success">
		                                 <em class="fa fa-bed fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Beds</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="medical_departments.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-inverse">
		                                 <em class="fa fa-medkit fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Medical Departments</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="coacodes.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-primary">
		                                 <em class="fa fa-code-fork fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>COA Codes</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="payment_heads.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-primary">
		                                 <em class="fa fa-credit-card fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Payment Heads</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="cities.php" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-info">
		                                 <em class="fa fa-globe fa-2x"></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>Cities</h4>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                     </div>
	        			</div>
        			</a>
        		</div>
        	</div>
        </div>

<?php include '../../../includes/footer.php';?>
