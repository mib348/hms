<style>
    .patient_info_area{background-color: whitesmoke;}
    #patient_info_table{margin-bottom: 0px;}
</style>

<div class="form-group row">
	<div class="col-xs-12">
		<div class="controls">
			<input type="text" class="form-control" id="strPatientMRNum" name="strPatientMRNum" placeholder="Enter Patient MRNumber" aria-label="MRNumber" maxlength="50" required="required"/>
		</div>
	</div>
</div>
<div class="form-group row patient_info_area">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="patient_info_table" class="table table-condensed table-vcenter">
				<tr>
					<td><b>Name</b></td>
					<td id="Name"></td>
					<td><b>Father Name</b></td>
					<td id="FatherName"></td>
					<td><b>Husband Name</b></td>
					<td id="HusbandName"></td>
					<td><b>Gender</b></td>
					<td id="Gender"></td>
					<td><b>Age</b></td>
					<td id="Age"></td>
				</tr>
				<tr>
					<td><b>Marital Status</b></td>
					<td id="MaritalStatusId"></td>
					<td><b>Blood Group</b></td>
					<td id="BloodGroupId"></td>
					<td><b>CNIC</b></td>
					<td id="NIC"></td>
					<td><b>City</b></td>
					<td id="CityId"></td>
					<td><b>Mobile</b></td>
					<td id="Mobile"></td>
				</tr>
				<tr>
					<td><b>Permanent Address</b></td>
					<td colspan="4" id="PermanentAddress"></td>
					<td><b>Remarks</b></td>
					<td colspan="4" id="Remarks"></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<script>
	$(function(){
		$(document).on("keyup","#strPatientMRNum",function(){
			$.ajax({
				url:"../../backend/patients/operations.php",
				data:"strAction=Get&strPatientMRNum=" + $("#strPatientMRNum").val(),
				dataType:"json",
				cache:false,
				success:function(data){
					if(data['rstRow']['MRnumber'] != null && data['rstRow']['MRnumber'] != ""){
    					$("#patient_info_table tr td").each(function(){
    						if(typeof $(this).attr("id") !== typeof undefined && $(this).attr("id") !== false)
    							if(data['rstRow'][$(this).attr("id")] != 'Null')
    								$(this).html(data['rstRow'][$(this).attr("id")]);
    					});
					}
					else{
						$("#patient_info_table tr td").each(function(){
    						if(typeof $(this).attr("id") !== typeof undefined && $(this).attr("id") !== false)
								$(this).html('');
    					});
					}
				}
			});
		});
		
	});
</script>
