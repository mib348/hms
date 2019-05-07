<?php 
    include '../../../includes/header.php';
    GenerateLog("User accessed Locations Admin Page", ucwords($strModule));
?>
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/custom.css">
<style>
    .table th{text-align:center;}
    .table th:hover{cursor: pointer;}
    #filter_form label{margin-top: 5px;}
/*     .table td:nth-child(3){width:22%;} */
/*     .table td:nth-child(4){width:22%;} */
    .table td:nth-child(5){width:16%;}
/*     .table td:nth-child(8){width:42%;} */
/*     .input-group .controls input{width:92.5%;} */
</style>

<form id="param_form">
	<input type="hidden" id="nPage" name="nPage" value="" />
	<input type="hidden" id="strSubModule" name="strSubModule" value="Locations" />
	<input type="hidden" id="strOrderColumn" name="strOrderColumn" value="" />
	<input type="hidden" id="strSortOrder" name="strSortOrder" value="" />
</form>


	<!-- Modal -->
	<div class="modal fade text-xs-left" id="location_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel13" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header bg-blue-grey white">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title" id="myModalLabel13">Edit Location</h4>
		  </div>
		  <div class="modal-body">
		  	<form id="popup_form" novalidate>
		  		<input type="hidden" id="nLocId" name="nLocId" value="" />
		  		<div class="form-group row">
		  			<div class="col-xs-12 controls">
		  				Location
		  				<input type="text" id="strEditLocation" name="strLocation" value="" class="form-control" required/>
		  			</div>
		  		</div>
		  		<div class="form-group row">
		  			<div class="col-xs-12 controls">
		  				Sub-Department
		  				<?php TableComboMsSql("SubDepartments", "Name", "SubDepartmentId", " IsActive = 1 order by Name asc", "nSubDeptId", "", "", "--- Select ---", "", "form-control", "required");?>
		  			</div>
		  		</div>
		  		<div class="form-group row">
		  			<div class="col-xs-12 skin skin-flat">
		  				<label for="isactive_cb">Enabled</label>
                		&nbsp;&nbsp;<input type="checkbox" name="isactive_cb" id="isactive_cb" class="isactive_cb" value="1" >
		  			</div>
		  		</div>
		  	</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-outline-success popup_save_btn" data-dismiss="modal">Save changes</button>
		  </div>
		</div>
	  </div>
	</div>


<div class="row">
    <div class="col-xs-12">
    	<div class="card">
        	<div class="card-header">
        		<h4 class="card-title">Search Location</h4>
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
                        <div data-repeater-list="locations">
                            <div data-repeater-item="">
                                <form class="form row" id="filter_form">
                                    <div class="form-group mb-1 col-sm-12 col-md-3">
										<label for="strFilterName">Sub Department</label>
										<br>
										<?php TableComboMsSql("SubDepartments", "Name", "SubDepartmentId", " IsActive = 1 order by Name asc", "nFilterSubDeptId", "", "", "--- Select ---", "", "form-control");?>
									</div>
                                    <div class="form-group mb-1 col-sm-12 col-md-3">
										<label for="strFilterName">Name</label>
										<br>
										<input type="text" class="form-control" name="strFilterName" id="strFilterName">
									</div>
									<div class="form-group mb-1 col-sm-12 col-md-3">
										<label for="bEnabled">Enabled</label>
										<br>
										<select id="bEnabled" name="bEnabled" class="form-control">
											<option value="">-- Select --</option>
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</div>
                                </form>
                            </div>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
        <div class="card">
        	<div class="card-header">
        		<h4 class="card-title">Locations</h4>
        	</div>
            <div class="card-body">
                <div class="card-block">
                	<form id="insertion_form" class="form-horizontal form" novalidate>
                	<div class="row form-group">
                		<div class="col-xs-12 ">
                			<label class="label">Sub Department</label>
            				<div class="controls">
            					<?php TableComboMsSql("SubDepartments", "Name", "SubDepartmentId", " IsActive = 1 order by Name asc", "nSubDeptId", "", "", "--- Select ---", "", "form-control", "required");?>
							</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-xs-12  form-group">
            				<div class="controls">
            					<div class="input-group"> 
    								<input type="text" class="form-control" id="strLocation" name="strLocation" placeholder="Add Location" aria-describedby="button-addon2" required data-validation-required-message="This field is required" />
									<span class="input-group-btn" id="button-addon2">
        								<button class="btn btn-primary submit_btn" type="submit">Submit</button>
        							</span>
								</div>
							</div>
                		</div>
                	</div>
                	</form>
                	<br>
                	<div class="table-responsive">
                		<table id="location_table" class="table table-bordered table-hover table-condensed table-vcenter">
                			<thead>
                				<tr>
                					<th>ID</th>
                					<th>Name</th>
                					<th>Sub Department</th>
                					<th>Enabled</th>
                					<th>Action</th>
                				</tr>
                			</thead>
                			<tbody id="location_table_tbody">
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
            <!--<div class="card-footer text-muted">
                 <span class="float-xs-left"></span>
				<div class="float-xs-right btn-group">
					<button type="reset" class="btn btn-warning reset_btn"><i class="icon-cross2"></i> Reset</button>
					<button type="submit" class="btn btn-success submit_btn"><i class="icon-check2"></i> Submit</button>
				</div> 
            </div>-->
        </div>
    </div>
</div>
<?php include '../../../includes/scripts.php';?>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/components/forms/checkbox-radio.js" type="text/javascript"></script>
<script>
	$("#strLocation").focus();
	$(function(){
		getList(1);

		  $('#insertion_form').find('input,select,textarea').not('[type=submit]').jqBootstrapValidation({
		    submitSuccess: function ($form, event) {

		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: $form.serialize() + "&" + $("#param_form").serialize() + "&strAction=Add",
		        success: function(data)
		        { 
		        	getList(1);
		        }
		      });

		      // will not trigger the default submission in favor of the ajax function
		      event.preventDefault();
		    }

		  });

		$(document).on("click", ".popup_save_btn", function(){
	      $.ajax({
	        type: 'POST',
	        url: "../../backend/admin/operations.php",
	        data: "strAction=Edit" + "&" + $("#param_form").serialize() + "&" + $("#popup_form").serialize(),
	        success: function(data)
	        {
	        	getList(1);
	        }
	      });
		});

		$(document).on("click", ".delete_btn", function(){
			$("#nLocId").val($(this).parent().parent().attr("id"));
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: "strAction=Delete" + "&" + $("#param_form").serialize() + "&nLocId=" + $(this).parent().parent().attr("id"),
		        success: function(data)
		        { 
		        	getList(1);
		        }
		      });
		});
		

		$(document).on("click", ".edit_btn", function(){
			$("#nLocId").val($(this).parent().parent().attr("id"));
	      $.ajax({
	        type: 'POST',
	        url: "../../backend/admin/operations.php",
	        data: "strAction=Get" + "&" + $("#param_form").serialize() + "&nLocId=" + $(this).parent().parent().attr("id"),
	        dataType:"json",
	        cache:false,
	        success: function(data)
	        { 
	        	$("#popup_form #strEditLocation").val(data['rstRow']['Name']);
	        	$("#popup_form #nSubDeptId").val(data['rstRow']['SubDepartmentId']);

	        	if(data['rstRow']['IsActive'] == "1")
		        	$("#isactive_cb").iCheck("check");
	        	else
	        		$("#isactive_cb").iCheck("uncheck");

        		$("#location_popup").modal("show");
	        }
	      });
		});

		$(document).on("click", ".table th", function(){
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

		if($("#strSortOrder").val() != "" && $("#strSortOrder").val() == "desc" && nPage != 1){
			strSortOrder = "asc";
		}
		
		$("#nPage").val(nPage);
		$("#strSortOrder").val(strSortOrder);
		$("#location_table_tbody").html('');
		$(".loader-wrapper").show();
		
    	$.ajax({
            type: "POST",
            url: "../../backend/admin/json.php",
            cache:false,
            data: "strAction=getLocations&nPage=" + nPage + "&" + "&strSortColumnIndex=" + strOrderColumn + "&strSortOrder=" + strSortOrder + "&" + $("#filter_form").serialize(),
            dataType:"json",
            success:function(data){
                if(data != null){
                    $("#location_table_tbody").html(data);
                    $(".loader-wrapper").hide();
                }
                else{
                	$("#location_table_tbody").html('');
                	$(".loader-wrapper").hide();
                }

                $('#insertion_form').find('input,select,textarea').val('');
                $("#strLocation").focus();
            }
        });
	}
</script>
<?php include '../../../includes/footer.php';?>
