<?php
    include_once '../../../includes/header.php';
    GenerateLog("User accessed Reports Dashboard", ucwords($strModule));
?>
<style>
	.panel_links{color:inherit;text-decoration: none;}
	.panel_links:hover{cursor: pointer;text-decoration: none;color:inherit;}
	.labels h4{padding-right: 15px;}
</style>
        <div class="content-heading">
            Reports
        </div>
        <div class="row">
        	<div class="col-xs-12 col-sm-5 col-md-4	col-lg-3 col-xl-1  fadeInRightBig animated">
        		<div class="panel widget">
        			<a href="../../backend/reports/index.php?strReportType=OPD" class="panel_links">
        				<div class="row">
	        				<div class="row row-table row-flush">
		                        <div class="col-xs-12">
		                           <div class="row row-table row-flush">
		                              <div class="col-xs-3 text-center text-info">
		                                 <em class="icon-logout "></em>
		                              </div>
		                              <div class="col-xs-9">
		                                 <div class="panel-body labels text-right">
		                                    <h4>OPD</h4>
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
