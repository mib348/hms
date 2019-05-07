<?php 
    include '../../../includes/header.php';
    GenerateLog("User accessed Patient Bill Master Admin Page", ucwords($strModule));
?>
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/custom.css">
<style>
    .table th{text-align:center;}
    .table th:hover{cursor: pointer;}
    #filter_form label{margin-top: 5px;}
    .table td:nth-child(5){width:16%;}
</style>

<form id="param_form">
	<input type="hidden" id="nPage" name="nPage" value="" />
	<input type="hidden" id="strSubModule" name="strSubModule" value="PatientBillMaster" />
	<input type="hidden" id="strOrderColumn" name="strOrderColumn" value="0" />
	<input type="hidden" id="strSortOrder" name="strSortOrder" value="desc" />
</form>

<div class="row search_portion">
    <div class="col-xs-12">
	  	<div class="card">
        	<div class="card-header">
        		<h4 class="card-title">Search From Patient Bill Master</h4>
        		<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-plus4"></i></a></li>
                        <li><a data-action="reload" onClick="$('#filter_form')[0].reset();getList($('#nPage').val(), $('#strOrderColumn').val(), $('#strSortOrder').val())"><i class="icon-reload"></i></a></li>
                    </ul>
                </div>
        	</div>
            <div class="card-body collapse" aria-expanded="false" style="">
            	<div class="card-block">
            		<div class="repeater-default">
                        <div data-repeater-list="companys">
                            <div data-repeater-item="">
                                <form class="form row" id="filter_form">
                                	<div class="form-group mb-1 col-sm-12 col-md-3">
										<label for="strFilterName">Admission</label>
										<br>
										<select id="nFilterAdmissionId" name="nFilterAdmissionId" class="form-control">
        									<option value="">--- Select ---</option>
        									<?php
        									$strQuery = "select * from Admissions
                                                         left outer join Patients on Patients.PatientId = Admissions.PatientId
                                                         order by Patients.Name asc";
        									$nResult = odbc_exec($conn, $strQuery);
        									while($rstRow = odbc_fetch_array($nResult))
        									{
        									    ?>
        									    	<option value="<?php echo $rstRow["AdmissionId"];?>"><?php echo $rstRow['Name'];?></option>
        									    <?php 
        									}
        									?>
										</select>
									</div>
                                    <div class="form-group mb-1 col-sm-12 col-md-3">
										<label for="strFilterApprovedBy">Approved By</label>
										<br>
										<input type="text" class="form-control" name="strFilterApprovedBy" id="strFilterApprovedBy">
									</div>
                                    <div class="form-group mb-1 col-sm-12 col-md-3">
										<label for="strFilterRemarks">Remarks</label>
										<br>
										<input type="text" class="form-control" name="strFilterRemarks" id="strFilterRemarks">
									</div>
                                    <div class="form-group mb-1 col-sm-12 col-md-3">
										<label for="nFilterTotalNetAmount">Total Net Amount</label>
										<br>
										<input type="number" class="form-control" name="nFilterTotalNetAmount" id="nFilterTotalNetAmount">
									</div>
                                </form>
                            </div>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
    </div>
</div>

<div class="row add_portion">
    <div class="col-xs-12">
	  	<div class="card">
        	<div class="card-header">
        		<h4 class="card-title">Add To Patient Bill Master</h4>
        		<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-plus4 expand_icon"></i></a></li>
                    </ul>
                </div>
        	</div>
            <div class="card-body collapse" aria-expanded="false" style="">
            	<div class="card-block">
            		<div class="repeater-default">
                        <div data-repeater-list="companys">
                            <div data-repeater-item="">
                            	<form id="insertion_form" class="form-horizontal form" novalidate>
                            		<input type="hidden" id="nPatientBillMasterId" name="nPatientBillMasterId" value="" />
                                	<div class="row form-group">
                                		<div class="col-xs-3  text-xs-right">
                                			<label class="label">Admission</label>
                                		</div>
                                		<div class="col-xs-9">
                            				<div class="controls">
                								<select id="nAdmissionId" name="nAdmissionId" class="form-control" required>
                									<option value="">--- Select ---</option>
                									<?php
                									$strQuery = "select * from Admissions
                                                                 left outer join Patients on Patients.PatientId = Admissions.PatientId
                                                                 order by Patients.Name asc";
                									$nResult = odbc_exec($conn, $strQuery);
                									while($rstRow = odbc_fetch_array($nResult))
                									{
                									    ?>
                									    	<option value="<?php echo $rstRow["AdmissionId"];?>"><?php echo $rstRow['Name'];?></option>
                									    <?php 
                									}
                									?>
                								</select>
                							</div>
                                		</div>
                                	</div>
                                	<div class="row form-group">
                                		<div class="col-xs-3  text-xs-right">
                                			<label class="label">Approved By</label>
                                		</div>
                                		<div class="col-xs-9">
                            				<div class="controls">
                								<input type="text" class="form-control" name="strApprovedBy" id="strApprovedBy">
                							</div>
                                		</div>
                                	</div>
                                	<div class="row form-group">
                                		<div class="col-xs-3  text-xs-right">
                                			<label class="label">Remarks</label>
                                		</div>
                                		<div class="col-xs-9">
                            				<div class="controls">
                								<input type="text" class="form-control" name="strRemarks" id="strRemarks" maxlength="500">
                							</div>
                                		</div>
                                	</div>
                                	<div class="row form-group">
                                		<div class="col-xs-3  text-xs-right">
                                			<label class="label">Total Net Amount</label>
                                		</div>
                                		<div class="col-xs-9">
                            				<div class="controls">
                								<input type="number" class="form-control" name="nTotalNetAmount" id="nTotalNetAmount" required>
                							</div>
                                		</div>
                                	</div>
                    	            <div class="card-footer text-muted">
                                         <span class="float-xs-left"></span>
                        				<div class="float-xs-right btn-group">
                        					<button type="reset" class="btn btn-warning reset_btn"><i class="icon-cross2"></i> Reset</button>
                        					<button type="submit" class="btn btn-success submit_btn"><i class="icon-check2"></i> Submit</button>
                        				</div> 
                                    </div>
                            	</form>
                            </div>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
        	<div class="card-header">
        		<h4 class="card-title">Patient Bill Master Listing</h4>
        	</div>
            <div class="card-body">
                <div class="card-block">
                	<div class="table-responsive">
                		<table id="company_table" class="table table-bordered table-hover table-condensed table-vcenter">
                			<thead>
                				<tr>
                					<th>ID</th>
                					<th>Admitted - Patient</th>
                					<th>Approved By</th>
                					<th>Total Net Amount</th>
                					<th>Remarks</th>
                					<th>Action</th>
                				</tr>
                			</thead>
                			<tbody id="company_table_tbody">
                			</tbody>
                		</table>
                	</div>
                	<div class="loader-wrapper">
						<div class="loader-container">
							<div class="ball-grid-pulse loader-primary">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../../../includes/scripts.php';?>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/components/forms/checkbox-radio.js" type="text/javascript"></script>
<script>
	$("#strPatientBillMaster").focus();
	$(function(){
		getList(1);

		  $('#insertion_form').find('input,select,textarea').not('[type=submit]').jqBootstrapValidation({
		    submitSuccess: function ($form, event) {
		    	$(".submit_btn").attr("disabled", true);
		    	
				if($("#nPatientBillMasterId").val() != "")
					var strAction = "Edit";
				else
					var strAction = "Add";
		    
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: $form.serialize() + "&" + $("#param_form").serialize() + "&strAction=" + strAction,
		        success: function(data)
		        { 
		        	getList(1);
		        }
		      });

		      // will not trigger the default submission in favor of the ajax function
		      event.preventDefault();
		    }

		  });

		$(document).on("click", ".delete_btn", function(){
			$("#nPatientBillMasterId").val($(this).parent().parent().attr("id"));
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: "strAction=Delete" + "&" + $("#param_form").serialize() + "&nPatientBillMasterId=" + $(this).parent().parent().attr("id"),
		        success: function(data)
		        { 
		        	getList(1);
		        }
		      });
		});
		

		$(document).on("click", ".edit_btn", function(){
			$("#nPatientBillMasterId").val($(this).parent().parent().attr("id"));
	      $.ajax({
	        type: 'POST',
	        url: "../../backend/admin/operations.php",
	        data: "strAction=Get" + "&" + $("#param_form").serialize() + "&nPatientBillMasterId=" + $(this).parent().parent().attr("id"),
	        dataType:"json",
	        cache:false,
	        success: function(data)
	        {
	        	$("#nAdmissionId").val(data['rstRow']['AdmissionId']);
	        	$("#strApprovedBy").val(data['rstRow']['ApprovedBy']);
	        	$("#nTotalNetAmount").val(data['rstRow']['TotalNetAmount']);
	        	$("#strRemarks").val(data['rstRow']['Remarks']);

	        	expandArea();
	        }
	      });
		});

		$(document).on("click", ".table th:not(:last-child)", function(){
			getList($("#nPage").val(), $(this).index());
		});

		$(document).on("keyup change", "#filter_form input, #filter_form select", function(){
			getList($("#nPage").val());
		});
	});

	function getList(nPage, strOrderColumn, strSortOrder){
		if(strOrderColumn == undefined)
			strOrderColumn = 0;
		if(strSortOrder == undefined)
			strSortOrder = 'desc';

// 		if($("#strSortOrder").val() != "" && $("#strSortOrder").val() == "desc" && nPage != 1){
// 			strSortOrder = "asc";
// 		}

		if(nPage != 1 || strOrderColumn == $("#strOrderColumn").val()){
			if(strSortOrder == "asc" && $("#strSortOrder").val() == "asc")
				strSortOrder = "desc";
			else if(strSortOrder == "desc" && $("#strSortOrder").val() == "desc")
				strSortOrder = "asc";
		}
		
		$("#nPage").val(nPage);
		$("#strOrderColumn").val(strOrderColumn);
		$("#strSortOrder").val(strSortOrder);
		$("#company_table_tbody").html('');
		$(".loader-wrapper").show();
		
    	$.ajax({
            type: "POST",
            url: "../../backend/admin/json.php",
            cache:false,
            data: "strAction=getPatientBillMaster&nPage=" + nPage + "&" + "&strSortColumnIndex=" + strOrderColumn + "&strSortOrder=" + strSortOrder + "&" + $("#filter_form").serialize(),
            dataType:"json",
            success:function(data){
                if(data != null){
                    $("#company_table_tbody").html(data);
                    $(".loader-wrapper").hide();
                }
                else{
                	$("#company_table_tbody").html('');
                	$(".loader-wrapper").hide();
                }

                $('#insertion_form').find('input,textarea').val('');
                $(".submit_btn").attr("disabled", false);
                if($(".add_portion .card-body").attr("aria-expanded") == "true" && $(".search_portion .card-body").attr("aria-expanded") == "false")
                	$("#strPatientBillMaster").focus();
            }
        });
	}
</script>
<?php include '../../../includes/footer.php';?>
