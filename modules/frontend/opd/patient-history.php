<?php 
    include '../../../includes/header.php';
    GenerateLog("User accessed OPD Patient History Page", ucwords($strModule));
?>
<style>
	.dd{max-width: 100%;}
	.service_data:hover{cursor:pointer;}
</style>

<div class="content-heading">Patient History</div>
<div class="row">
	<div class="col-xs-12">
		<div class=" panel panel-default">
			<div class="panel-body">
				<div class="dd " id="nestable">
					<ol class="dd-list">
						<?php
							$strQuery = "select * from Patients where IsActive = 1 order by PatientId desc";
							$nResult = odbc_exec($conn, $strQuery);
							while ($rstRow = odbc_fetch_array($nResult)){
								?>
								<li class="dd-item no-drag dd-nodrag" data-id="<?php echo $rstRow['PatientId'];?>">
									<div class="dd-handle"><?php echo ucwords($rstRow['Name']);?></div>
									<?php if (RecCount("Admissions", "PatientId = '{$rstRow['PatientId']}'")){?>
									<ol class="dd-list ">
									<?php }?>
										<?php
										$strQuery2 = "select * from Admissions where PatientId = '{$rstRow['PatientId']}' order by AdmissionDate desc";
										$nResult2 = odbc_exec($conn, $strQuery2);
										while ($rstRow2 = odbc_fetch_array($nResult2)){
											$strAdmissionDate = null;
											$strDischargeDate = null;
											$strCompany = GetField("Companies","Name","CompanyId = '{$rstRow2['CompanyId']}'");
											
											if (!empty($rstRow2['AdmissionDate']))
												$strAdmissionDate = date("d M, Y h:i:s a", strtotime($rstRow2['AdmissionDate']));
											if (!empty($rstRow2['DischargedDate']))
												$strDischargeDate = date("d M, Y h:i:s a", strtotime($rstRow2['DischargedDate']));
											?>
											<li class="dd-item service_data" data-id="<?php echo $rstRow2['AdmissionId'];?>">
												<div class="dd-handle">
													<div class="row">
														<div class="col-xs-12 col-sm-2">
															<?php echo GetSourceType($rstRow2['Source']);?>
														</div>
														<div class="col-xs-12 col-sm-3">
															<label>Company:</label>
															<?php echo ucwords($strCompany);?>
														</div>
														<div class="col-xs-12 col-sm-4">
															<label>Admission Date:</label>
															<?php echo $strAdmissionDate;?>
														</div>
														<div class="col-xs-12 col-sm-3">
															<label>Discharge Date:</label>
															<?php echo $strDischargeDate;?>
														</div>
													</div>
												</div>
											</li>
											<?php 
										} 
										?>
									<?php if (RecCount("Admissions", "PatientId = '{$rstRow['PatientId']}'")){?>
									</ol>
									<?php }?>
								</li>
								<?php 
							}
						?>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>
</div>

   <div class="modal fade" id="patient_billing" tabindex="-1" role="dialog" aria-labelledby="patient_billingLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="patient_billingLabel">Patient Billing Information</h4>
            </div>
            <div class="modal-body">
         		<div class="row">
		      		<div class="col-xs-12">
		      			<div class="row">
		      				<div class="col-xs-4 text-right"><label>Company:</label></div>
		      				<div class="col-xs-8" id="Company"></div>
		      			</div>
		      			<div class="row">
		      				<div class="col-xs-4 text-right"><label>Medical Department:</label></div>
		      				<div class="col-xs-8" id="MedicalDepartment"></div>
		      			</div>
		      			<div class="row">
		      				<div class="col-xs-4 text-right"><label>Consultant:</label></div>
		      				<div class="col-xs-8" id="Consultant"></div>
		      			</div>
		      			<div class="row">
		      				<div class="col-xs-4 text-right"><label>Net Amount:</label></div>
		      				<div class="col-xs-8" id="Amount"></div>
		      			</div>
		      			<div class="row">
		      				<div class="col-xs-4 text-right"><label>Remarks:</label></div>
		      				<div class="col-xs-8" id="Remarks"></div>
		      			</div>
		      		</div>
		      	</div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>

<script type="text/javascript">
	$(function(){
	    $('#nestable').nestable({
	    	collapsedClass:'dd-collapsed',
	    	noDragClass:'dd-nodrag',
			maxDepth: 0
	    }).nestable('collapseAll');

	    $(document).on("click",".service_data",function(){
			$("#Company").html('');
			$("#MedicalDepartment").html('');
			$("#Consultant").html('');
			$("#Amount").html('');
			$("#Remarks").html('');

	      $.ajax({
	        type: 'POST',
	        url: "../../backend/opd/json.php",
			cache:false,
	        data: "strAction=getBillingDetail&nAdmissionId=" + $(this).attr("data-id"),
			dataType:"json",
	        success: function(data)
	        { 
				$("#Company").html(data['Company']);
				$("#MedicalDepartment").html(data['MedicalDepartment']);
				$("#Consultant").html(data['Consultant']);
				$("#Amount").html(data['Amount']);
				$("#Remarks").html(data['Remarks']);

	        	$("#patient_billing").modal("show");
	        }
	      });
		});
	});
</script>
<?php include '../../../includes/footer.php';?>
