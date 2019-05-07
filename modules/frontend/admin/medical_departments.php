<?php 
    include '../../../includes/header.php';
    GenerateLog("User accessed Medical MedicalDepartments Admin Page", ucwords($strModule));
?>
<style>
	.table th {	text-align: center;}
	.table th:hover {	cursor: pointer;}
	#filter_form label {	margin-top: 5px;}
	.table td:nth-child(5) {	width: 16%;}
</style>

<form id="param_form">
	<input type="hidden" id="nPage" name="nPage" value="" /> 
	<input type="hidden" id="strSubModule" name="strSubModule" value="MedicalDepartments" /> 
	<input type="hidden" id="strOrderColumn" name="strOrderColumn" value="0" /> 
	<input type="hidden" id="strSortOrder" name="strSortOrder" value="desc" />
</form>

<div class="content-heading">Medical Departments</div>
<div class="row">
	<div class="col-xs-12">
		<div class=" panel panel-default">
			<div class="panel-body">
				Search
				<form id="filter_form" role="form">
					<div class="form-group">
						<div class="col-xs-12 col-sm-2">
							<label>Name</label> 
							<input type="text" class="form-control" name="strFilterName" id="strFilterName">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12 col-sm-2">
							<label for="bEnabled">Enabled</label> 
							<select id="bEnabled" name="bEnabled" class="form-control">
								<option value="">-- Select --</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
				</form>
				<div class="clear clearfix"></div>
				<br>
				<hr>
				Add
				<form id="insertion_form" data-parsley-validate="">
					<input type="hidden" id="nMedicalDeptId" name="nMedicalDeptId" value="" />
					<div class="form-group">
						<div class="col-xs-12 col-sm-2">
							<label>Name</label> 
							<input type="text" class="form-control" id="strMedicalDepartment" name="strMedicalDepartment" required/>
						</div>
						<div class="col-xs-12 col-sm-2">
							<label>Fees</label> 
							<input type="number" class="form-control" id="nFees" name="nFees" min="0" />
						</div>
						<div class="col-xs-12 col-sm-2">
							<label>Room No</label> 
							<input type="text" class="form-control" id="nRoomNum" name="nRoomNum" />
						</div>
						<div class="col-xs-12 col-sm-2">
							<label>Enabled</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="isactive_cb" id="isactive_cb" class="isactive_cb" value="1" checked> 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="clear clearfix"></div>
					<br>
					<div class="form-group">
						<div class="col-xs-12 col-sm-1">
							<label>Mondays</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="Mondays_cb" id="Mondays_cb" class="Mondays_cb" value="1" /> 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1">
							<label>Tuesdays</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="Tuesdays_cb" id="Tuesdays_cb" class="Tuesdays_cb" value="1" /> 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1">
							<label>Wednesdays</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="Wednesdays_cb" id="Wednesdays_cb" class="Wednesdays_cb" value="1" > 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1">
							<label>Thursdays</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="Thursdays_cb" id="Thursdays_cb" class="Thursdays_cb" value="1" > 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1">
							<label>Fridays</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="Fridays_cb" id="Fridays_cb" class="Fridays_cb" value="1" > 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1">
							<label>Saturdays</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="Saturdays_cb" id="Saturdays_cb" class="Saturdays_cb" value="1" > 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1">
							<label>Sundays</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="Sundays_cb" id="Sundays_cb" class="Sundays_cb" value="1" > 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="clear clearfix"></div>
    				<br>
    				<div class="btn-group" style="padding-left: 10px;">
    					<button type="submit" class="btn btn-success submit_btn">
    						Submit
    					</button>
    					<button type="reset" class="btn btn-warning reset_btn">
    						Reset
    					</button>
    				</div>
				</form>
				<br>
				<div class="clear clearfix"></div>
				<br>
				<hr>
				Listing
				<br>
				<div class="table-responsive">
					<table id="company_table" class="table table-bordered table-hover table-condensed table-vcenter">
						<thead>
							<tr>
            					<th>ID</th>
            					<th>Name</th>
            					<th>Fees</th>
            					<th>Room No</th>
            					<th>WeekDays</th>
            					<th>Enabled</th>
            					<th>Action</th>
							</tr>
						</thead>
						<tbody id="company_table_tbody">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#strMedicalDepartment").focus();
	$(function(){
		  
		getList(1, $("#strOrderColumn").val(), $("#strSortOrder").val(), false);

		  $('#insertion_form').parsley().on('field:validated', function() {}).on('form:submit', function() {
			    $(".submit_btn").attr("disabled", true);
			    
				if($("#nMedicalDeptId").val() != "")
					var strAction = "Edit";
				else
					var strAction = "Add";
		    
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: $('#insertion_form').serialize() + "&" + $("#param_form").serialize() + "&strAction=" + strAction,
		        success: function(data)
		        { 
		        	getList($("#nPage").val(), $("#strOrderColumn").val(), $("#strSortOrder").val(), false);
		        	$("#insertion_form input[type=checkbox]").attr("checked", false);
		        	$("#insertion_form input[type=checkbox]").prop("checked", false);
		        	$("#insertion_form .isactive_cb").attr("checked", true);
		        	$("#insertion_form .isactive_cb").prop("checked", true);
		        }
		      });

		      $("#strMedicalDepartment").focus();
		    	return false; // Don't submit form for this demo
		  });

		$(document).on("click", ".delete_btn", function(){
			$("#nMedicalDeptId").val($(this).parent().parent().attr("id"));
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: "strAction=Delete" + "&" + $("#param_form").serialize() + "&nMedicalDeptId=" + $(this).parent().parent().attr("id"),
		        success: function(data)
		        { 
		        	getList($("#nPage").val(), $("#strOrderColumn").val(), $("#strSortOrder").val(), false);
		        }
		      });
// 		      setTimeout(function(){window.scrollTo(0, $("#company_table").offset().top);}, 400);
		});
		

		$(document).on("click", ".edit_btn", function(){
			$("#nMedicalDeptId").val($(this).parent().parent().attr("id"));
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: "strAction=Get" + "&" + $("#param_form").serialize() + "&nMedicalDeptId=" + $(this).parent().parent().attr("id"),
		        dataType:"json",
		        cache:false,
		        success: function(data)
		        {
		        	$("#strMedicalDepartment").val(data['rstRow']['Name']);
		        	$("#nFees").val(data['rstRow']['Fees']);
		        	$("#nRoomNum").val(data['rstRow']['RoomNo']);

		        	if(data['rstRow']['Mon'] == "1"){
			        	$("#Mondays_cb").attr("checked", true);
			        	$("#Mondays_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#Mondays_cb").attr("checked", false);
		        		$("#Mondays_cb").prop("checked", false);
		        	}

		        	if(data['rstRow']['Tue'] == "1"){
			        	$("#Tuesdays_cb").attr("checked", true);
			        	$("#Tuesdays_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#Tuesdays_cb").attr("checked", false);
		        		$("#Tuesdays_cb").prop("checked", false);
		        	}

		        	if(data['rstRow']['Wed'] == "1"){
			        	$("#Wednesdays_cb").attr("checked", true);
			        	$("#Wednesdays_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#Wednesdays_cb").attr("checked", false);
		        		$("#Wednesdays_cb").prop("checked", false);
		        	}

		        	if(data['rstRow']['Thu'] == "1"){
			        	$("#Thursdays_cb").attr("checked", true);
			        	$("#Thursdays_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#Thursdays_cb").attr("checked", false);
		        		$("#Thursdays_cb").prop("checked", false);
		        	}

		        	if(data['rstRow']['Fri'] == "1"){
			        	$("#Fridays_cb").attr("checked", true);
			        	$("#Fridays_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#Fridays_cb").attr("checked", false);
		        		$("#Fridays_cb").prop("checked", false);
		        	}

		        	if(data['rstRow']['Sat'] == "1"){
			        	$("#Saturdays_cb").attr("checked", true);
			        	$("#Saturdays_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#Saturdays_cb").attr("checked", false);
		        		$("#Saturdays_cb").prop("checked", false);
		        	}

		        	if(data['rstRow']['Sun'] == "1"){
			        	$("#Sundays_cb").attr("checked", true);
			        	$("#Sundays_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#Sundays_cb").attr("checked", false);
		        		$("#Sundays_cb").prop("checked", false);
		        	}

		        	if(data['rstRow']['IsActive'] == "1"){
			        	$("#isactive_cb").attr("checked", true);
			        	$("#isactive_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#isactive_cb").attr("checked", false);
		        		$("#isactive_cb").prop("checked", false);
		        	}

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

	function getList(nPage, strOrderColumn, strSortOrder, bSort=true){
		if(strOrderColumn == undefined)
			strOrderColumn = 0;
		if(strSortOrder == undefined)
			strSortOrder = 'desc';

		if((nPage != 1 || strOrderColumn == $("#strOrderColumn").val()) && bSort == true){
			if(strSortOrder == "asc" && $("#strSortOrder").val() == "asc")
				strSortOrder = "desc";
			else if(strSortOrder == "desc" && $("#strSortOrder").val() == "desc")
				strSortOrder = "asc";
		}

		$("#nPage").val(nPage);
		$("#strSortOrder").val(strSortOrder);
		$("#strOrderColumn").val(strOrderColumn);
		$("#company_table_tbody").html('');
		$(".loader-wrapper").show();
		
    	$.ajax({
            type: "POST",
            url: "../../backend/admin/json.php",
            cache:false,
            async:false,
            data: "strAction=getMedicalDepartments&nPage=" + nPage + "&" + "&strSortColumnIndex=" + strOrderColumn + "&strSortOrder=" + strSortOrder + "&" + $("#filter_form").serialize(),
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

                $('#insertion_form').find('input,select,textarea').val('');
                $(".submit_btn").attr("disabled", false);
//             	$("#strMedicalDepartment").focus();
            }
        });
	}
</script>
<?php include '../../../includes/footer.php';?>
