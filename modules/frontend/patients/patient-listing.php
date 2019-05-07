<?php 
    include '../../../includes/header.php';
    GenerateLog("User accessed Patient Listing Page", ucwords($strModule));
?>
<style>
	.table th {	text-align: center;}
	.table th:hover {	cursor: pointer;}
	#filter_form label {	margin-top: 5px;}
	.table td:nth-child(5) {	width: 14%;}
	div.table-responsive{
		border: 1px solid #d9d9d9;
	}
</style>

<form id="param_form">
	<input type="hidden" id="nPage" name="nPage" value="" />
	<input type="hidden" id="strSubModule" name="strSubModule" value="Consultants" />
	<input type="hidden" id="strOrderColumn" name="strOrderColumn" value="0" />
	<input type="hidden" id="strSortOrder" name="strSortOrder" value="desc" />
</form>

<div class="content-heading">Patient Listing</div>
<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class=" panel panel-default">
			<div class="panel-body">
				Search
				<form id="filter_form" role="form">
					<div class="form-group mb-1 col-sm-12 col-md-3">
                                            <label for="nPatientId">Patient ID</label>
                                            <br>
                                            <input type="text" class="form-control patient" name="nPatientId" id="nPatientId" placeholder="Patient ID">
                                        </div>
                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                            <label for="nMRNumber">MRNumber</label>
                                            <br>
                                            <input type="text" class="form-control patient" name="nMRNumber" id="nMRNumber" placeholder="MRNumber">
                                        </div>
                                        <div class="form-group mb-1 col-sm-12 col-md-3">
											<label for="strPatientName">Name</label>
											<br>
											<input type="text" class="form-control patient" name="strPatientName" id="strPatientName" placeholder="Name">
										</div>
                                        <div class="form-group mb-1 col-sm-12 col-md-3">
											<label for="strFatherName">Father Name</label>
											<br>
											<input type="text" class="form-control patient" name="strFatherName" id="strFatherName" placeholder="Father Name">
										</div>
                                        <div class="form-group mb-1 col-sm-12 col-md-3">
											<label for="strHusbandName">Husband Name</label>
											<br>
											<input type="text" class="form-control patient" name="strHusbandName" id="strHusbandName" placeholder="Husband Name">
										</div>
										<div class="form-group mb-1 col-sm-12 col-md-3">
											<label for="nPatientAge">Age</label>
											<br>
											<input type="text" class="form-control patient" name="nPatientAge" id="nPatientAge" placeholder="Age">
										</div>
										<div class="form-group mb-1 col-sm-12 col-md-3">
											<label for="nGender">Gender</label>
											<br>
											<select id="nGender" name="nGender" class="form-control patient">
												<option value="">-- Select --</option>
												<option value="1">Male</option>
												<option value="0">Female</option>
											</select>
										</div>
										<div class="form-group mb-1 col-sm-12 col-md-3">
											<label for="strBloodGroup">Blood Group</label>
											<br>
											<select id="strBloodGroup" name="strBloodGroup" class="form-control patient">
												<option value="">-- Select --</option>
												<option value="A+">A+</option>
												<option value="A-">A-</option>
												<option value="B+">B+</option>
												<option value="B-">B-</option>
												<option value="O+">O+</option>
												<option value="O-">O-</option>
												<option value="AB+">AB+</option>
												<option value="AB-">AB-</option>
											</select>
										</div>
				</form>
				<div class="clear clearfix"></div>
				<br>
				<div class="table-responsive">
					<table id="company_table" class="table table-bordered table-hover table-condensed table-vcenter">
						<thead>
							<tr>
								<th>Patient ID</th>
								<th>MRNumber</th>
								<th style="min-width: 180px;">Name</th>
								<th style="min-width: 180px;">Father Name</th>
								<th style="min-width: 175px;">Husband Name</th>
								<th style="min-width: 120px;">Age</th>
								<th>Gender</th>
								<th style="max-width: 110px;">Blood Group</th>
								<th style="min-width: 180px;">Remarks</th>
								<th style="min-width: 90px;"><i class="fa fa-fire"></i></th>
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
 	
<script>
	$(function(){
		$('.searchable').select2({
		    theme: "bootstrap"
		});
		
		getList(1, $("#strOrderColumn").val(), $("#strSortOrder").val(), false);

		$(document).on("click", ".edit_btn", function(){
			window.location.replace("index.php?nPatId=" + $(this).parent().parent().attr("id"));
		});


		$(document).on("click", ".delete_btn", function(){
	    	$.ajax({
	            type: "POST",
	            url: "../../backend/patients/operations.php",
	            cache:false,
	            data: "strAction=Delete&nPatId=" + $(this).parent().parent().attr("id"),
	            dataType:"json",
	            success:function(data){
	            	getList(1, $("#strOrderColumn").val(), $("#strSortOrder").val(), false);
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
            url: "../../backend/patients/json.php",
            cache:false,
            data: "strAction=getPatients&nPage=" + nPage + "&" + $("#filter_form").serialize() + "&strSortColumnIndex=" + strOrderColumn + "&strSortOrder=" + strSortOrder,
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
            }
        });
		
	}
</script>
<?php include '../../../includes/footer.php';?>
