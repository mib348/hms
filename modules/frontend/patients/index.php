<?php 
    include '../../../includes/header.php';
    $arrPatient = GetRecord("Patients","PatientId = '{$_REQUEST['nPatId']}'");
	GenerateLog("User accessed Patient Enrollment form", ucwords($strModule), $_REQUEST['nPatId']);
?>

<form id="param_form">
	<input type="hidden" id="nPatId" name="nPatId" value="<?php echo $_REQUEST['nPatId'];?>" />
</form>
        <div class="content-heading">
            Patient Registration
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-10 col-sm-12">
                            <div class="panel panel-default" style="padding-right:14px;padding-bottom:14px;padding-left:14px;">
                                <div class="panel-heading">Personal Info</div>
                                <div class="panel-body" style="padding-top: 0px;">
                                    <form id="patientForm" role="form" novalidate>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6">
                                                <label>Name*</label>
                                                <input class="form-control input-sm" type="text" id="strName" name="strName" placeholder="Name" required />
                                                <ul id="strNameError" class="parsley-errors-list filled" style="display:none;"><li class="parsley-required">This value is required.</li></ul>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>Father Name</label>
                                                <input class="form-control input-sm" type="text" id="strFatherName" name="strFatherName" placeholder="Father Name" required />
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>Husband Name</label>
                                                <input class="form-control input-sm" type="text" id="strHusbandName" name="strHusbandName" placeholder="Husband Name" required/>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>Date of Birth *</label>
                                                <input class="form-control datepicker input-sm" type="text" id="strDOB" name="strDOB" data-date-format="dd-mm-yyyy" placeholder="Date of Birth" style="background-color: #fff;" readonly>
                                                <ul id="strDOBError" class="parsley-errors-list filled" style="display:none;"><li class="parsley-required">This value is required.</li></ul>
                                            </div>
                                        </div>
                                        <div class="row rtm5">
                                            <div class="col-md-3 col-sm-6">
                                                <label>NIC</label>
                                                <input class="form-control input-sm" type="text" id="nNIC" name="nNIC" placeholder="NIC">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label for="nMarialStatus">Marital Status</label>
                                                <select name="nMarialStatus" id="nMarialStatus" class="form-control input-sm">
                                                    <option value="">--- Select ---</option>
                                                    <option value="1">Single</option>
                                                    <option value="2">Married</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label class="control-label">Gender*</label>
                                                <select name="nGender" id="nGender" class="form-control input-sm" >
                                                    <option value="">--- Select ---</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                                <ul id="nGenderError" class="parsley-errors-list filled" style="display:none;"><li class="parsley-required">This value is required.</li></ul>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label class="control-label">Blood Group</label>
                                                <select name="nBloodGroup" id="nBloodGroup" style="" class="form-control">
                                                    <option value="">--- Select ---</option>
                                                    <option value="1">A+</option>
                                                    <option value="2">A-</option>
                                                    <option value="3">AB+</option>
                                                    <option value="4">AB-</option>
                                                    <option value="5">B+</option>
                                                    <option value="6">B-</option>
                                                    <option value="7">O+</option>
                                                    <option value="8">O-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row rtm5">
                                            <div class="col-md-3 col-sm-6">
                                                <label>Occupation</label>
                                                <input class="form-control input-sm" type="text" id="strOccupation" name="strOccupation" placeholder="Occupation">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>Email</label>
                                                <input class="form-control input-sm" type="email" id="strEmail" name="strEmail" placeholder="Email">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>Emergency Number</label>
                                                <input class="form-control input-sm" type="text" id="nEmergencyNumber" name="nEmergencyNumber" placeholder="Emergency Number">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>Religion</label>
                                                <select name="strReligion" id="strReligion" class="form-control input-sm" >
                                                    <option value="">--- Select ---</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row rtm5">
                                            <div class="col-md-3 col-sm-6">
                                                <label>Mobile</label>
                                                <input class="form-control input-sm" type="text" id="nMobileNumber" name="nMobileNumber" placeholder="Mobile">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>Landline</label>
                                                <input class="form-control input-sm" type="text" id="nLandline" name="nLandline" placeholder="Landline">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>City</label>
                                                <select name="nCityId" id="nCityId" class="form-control input-sm" aria-invalid="false">
                                                    <option value="">--- Select ---</option>
                                                    <option value="3">Islamabad</option>
                                                    <option value="2">Karachi</option>
                                                    <option value="1">Lahore</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label></label>
                                                <div class="checkbox c-checkbox">
                                                    <label>
                                                        <input type="checkbox" id="isactive_cb" name="isactive_cb">
                                                        <span class="fa fa-check"></span>Is Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row rtm5">
                                            <div class="col-md-4 col-sm-6">
                                                <label>Permanent Address</label>
                                                <textarea id="strPermanentAddress" name="strPermanentAddress" style="overflow:auto;resize:none" rows="2" class="form-control" placeholder="Permanent Address.."></textarea>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <label>Temporary Address</label>
                                                <textarea id="strTemporaryAddress" name="strTemporaryAddress" style="overflow:auto;resize:none" rows="2" class="form-control" placeholder="Temporary Address.."></textarea>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label>Remarks</label>
                                                <textarea id="strRemarks" name="strRemarks" rows="2" style="overflow:auto;resize:none" class="form-control" placeholder="Remarks.."></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12" style="padding-left:25px;padding-right:25px;">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading"></div>
                                    <div class="panel-body text-center" style="padding-top:0px;">
                                        <form id="patientPictureForm" enctype="multipart/form-data" role="form">
                                            <div class="form-group">
                                                <img id="previewPhoto" src="../../../images/profile-default.png" class="dz-clickable" data-id="1" height="175" width="150">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" name="fileElem" id="fileElem" class="previewPhoto form-control" data-id="1" accept="image/*">
                                            </div>
                                            <div class="form-group">
                                                <button  type="button" class="btn btn-labeled btn-danger" id="removePatientPic" onclick="$('#patientPictureForm')[0].reset();$('#previewPhoto').attr('src', '../../../images/profile-default.png');$(this).hide();" style="display:none;">
                                                    <span class="btn-label"><i class="fa fa-times"></i></span>Remove
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <button class="mb-sm btn btn-success btn-block" id="strSave" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    $("#nMRNum").focus();
    // var file = '';
	$(function(){
        var message = '<ul class="parsley-errors-list filled"><li class="parsley-required">This value is required.</li></ul>';
		if($("#nPatId").val() != "")
			$("#strAction").val("Edit");


        $('.datepicker').datepicker().change(function(){
            $(this).datepicker("hide");
        });

        $(document).on('change', '#fileElem', function(e){
            var file = e.target.files[0],                               // selected file
            mime = file.type;
            $("#previewPhoto").show();
            readURL(this, "previewPhoto");
            $("#removePatientPic").show();
        });
        
        $(document).on('click', "#strSave", function()
        {
            var check = true;
            var strName = $("#strName");
            if(strName.val() == ''){
                strName.addClass("parsley-error");
                $("#strNameError").show();
                check = false;
            }else{
                strName.removeClass("parsley-error");
                $("#strNameError").hide();
                check = true;
            }
            
            var strDOB = $("#strDOB");
            if(strDOB.val() == ''){
                strDOB.addClass("parsley-error");
                $("#strDOBError").show();
                check = false;
            }else{
                strDOB.removeClass("parsley-error");
                $("#strDOBError").hide();
                check = true;
            }
            
            var nGender = $("#nGender");
            if(nGender.val() == ''){
                nGender.addClass("parsley-error");
                $("#nGenderError").show();
                check = false;
            }else{
                nGender.removeClass("parsley-error");
                $("#nGenderError").hide();
                check = true;
            }
            
            if(check == true)
            {
                var form = $("#patientForm")[0];
                var formData = new FormData(form);
                var file = $("#fileElem")[0].files[0];
                formData.append('image', file, file.name);

                var xhr = new XMLHttpRequest();
                xhr.responseType = 'json';
                xhr.open('POST', '../../backend/patients/operations.php?strAction=Add&' + $("#param_form").serialize(), true);
                xhr.send(formData);
                xhr.onload = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        if(this.response.nRef){
                            location.reload();
                        }
                    }
                };
            }
        });
          
        // var $loading = $('#loadingDiv').hide();
        // $(document)
        //     .ajaxStart(function () {
        //         $loading.show();
        //     })
        //     .ajaxStop(function () {
        //         $loading.hide();
        //     });
	});
</script>
<?php include '../../../includes/footer.php';?>