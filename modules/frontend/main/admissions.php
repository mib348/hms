<?php 
include '../../../includes/header.php';
GenerateLog("User accessed Admisssions Admin Page", ucwords($strModule));
?>
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/pickers/colorpicker/bootstrap-colorpicker.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/pickers/miniColors/jquery.minicolors.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/pickers/spectrum/spectrum.css" />
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
<input type="hidden" id="strSubModule" name="strSubModule" value="Admisssions" />
<input type="hidden" id="strOrderColumn" name="strOrderColumn" value="0" />
<input type="hidden" id="strSortOrder" name="strSortOrder" value="desc" />
</form>

<div class="row search_portion">
<div class="col-xs-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Search Admisssion</h4>
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
                                    <label class="label" for="nFilterPatientId">Patient</label>
                                    <br>
                                    <?php TableComboMsSql("Patients", "Name", "PatientId", " IsActive = 1 order by Name asc", "nFilterPatientId", "", "", "--- Select ---", "", "select2-nPatientId form-control", "required");?>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="label" for="nFilterCompanyId">Company</label>
                                    <?php TableComboMsSql("Companies", "Name", "CompanyId", " IsActive = 1 order by Name asc", "nFilterCompanyId", "", "", "--- Select ---", "", "select2-nCompanyId form-control", "required");?>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="label" for="nFilterSourceId">Source</label>
                                    <select id="nFilterSourceId" name="nFilterSourceId" class="form-control">
                                        <option value="">-- Select --</option>
                                        <option value="1">OPD</option>
                                        <option value="2">IPD</option>
                                        <option value="3">Direct Service</option>
                                    </select>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="label" for="nFilterConsultantId">Consultant</label>
                                    <?php TableComboMsSql("Consultants", "Name", "ConsultantId", " IsActive = 1 order by Name asc", "nFilterConsultantId", "", "", "--- Select ---", "", "select2-nConsultantId form-control", "required");?>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="label" for="nFilterMedicalDeptId">Medical Dept</label>
                                    <?php TableComboMsSql("MedicalDepartments", "Name", "MedicalDeptId", " IsActive = 1 order by Name asc", "nFilterMedicalDeptId", "", "", "--- Select ---", "", "select2-nMedicalDeptId form-control", "required");?>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="label" for="strFilterDischargeDate">Discharged Date</label>
                                    <input type="date" class="form-control required" id="strFilterDischargeDate" name="strFilterDischargeDate" value="<?php echo $arrPatient['DOB'];?>" style="background-color: white;" required data-validation-required-message="This field is required">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="label" for="nFilterBedId">Bed</label>
                                    <?php TableComboMsSql("Beds", "BedNo", "BedId", " IsActive = 1 order by BedId asc", "nFilterBedId", "", "", "--- Select ---", "", "select2-nBedId form-control", "required");?>
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
            <h4 class="card-title">Add Admisssion</h4>
            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="icon-plus4 expand_icon"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body collapse" aria-expanded="false" style="display:none;">
            <div class="card-block">
                <div class="repeater-default">
                    <div data-repeater-list="companys">
                        <div data-repeater-item="">
                            <form id="insertion_form" class="form-horizontal form" novalidate>
                                <input type="hidden" id="nAdmisssionId" name="nAdmisssionId" value="" />
                                <div class="row form-group">
                                    <div class="col-xs-3  text-xs-right">
                                        <label class="label" for="nPatientId">Patient</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="controls">
                                        <?php TableComboMsSql("Patients", "Name", "PatientId", " IsActive = 1 order by Name asc", "nPatientId", "", "", "--- Select ---", "", "select2-nPatientId form-control", "required");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-3  text-xs-right">
                                        <label class="label" for="nCompanyId">Company</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="controls">
                                        <?php TableComboMsSql("Companies", "Name", "CompanyId", " IsActive = 1 order by Name asc", "nCompanyId", "", "", "--- Select ---", "", "select2-nCompanyId form-control", "required");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-3  text-xs-right">
                                        <label class="label" for="nSourceId">Source</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="controls">
                                            <select id="nSourceId" name="nSourceId" class="form-control">
                                                <option value="">-- Select --</option>
                                                <option value="1">OPD</option>
                                                <option value="2">IPD</option>
                                                <option value="3">Direct Service</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-3  text-xs-right">
                                        <label class="label" for="nConsultantId">Consultant</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="controls">
                                        <?php TableComboMsSql("Consultants", "Name", "ConsultantId", " IsActive = 1 order by Name asc", "nConsultantId", "", "", "--- Select ---", "", "select2-nConsultantId form-control", "required");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-3  text-xs-right">
                                        <label class="label" for="nMedicalDeptId">Medical Dept</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="controls">
                                        <?php TableComboMsSql("MedicalDepartments", "Name", "MedicalDeptId", " IsActive = 1 order by Name asc", "nMedicalDeptId", "", "", "--- Select ---", "", "select2-nMedicalDeptId form-control", "required");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-3  text-xs-right">
                                        <label class="label" for="strDischargeDate">Discharged Date</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="controls">
                                            <input type="date" class="form-control required" id="strDischargeDate" name="strDischargeDate" value="<?php echo $arrPatient['DOB'];?>" style="background-color: white;" required data-validation-required-message="This field is required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-3  text-xs-right">
                                        <label class="label" for="nBedId">Bed</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="controls">
                                            <?php TableComboMsSql("Beds", "BedNo", "BedId", " IsActive = 1 order by BedId asc", "nBedId", "", "", "--- Select ---", "", "select2-nBedId form-control", "required");?>
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
            <h4 class="card-title">Admisssions Listing</h4>
        </div>
        <div class="card-body">
            <div class="card-block">
                <div class="table-responsive">
                    <table id="company_table" class="table table-bordered table-hover table-condensed table-vcenter">
                        <thead>
                            <tr>
                                <th>MR NO</th>
                                <th>Pateint</th>
                                <th>Source</th>
                                <th>Admission Date</th>
                                <th>Consultant</th>
                                <th>Med. Dept</th>
                                <th>Company</th>
                                <!-- <th>Discharged Date</th> -->
                                <!-- <th>Bed</th> -->
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

<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/components/forms/checkbox-radio.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/pickers/dateTime/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/pickers/pickadate/picker.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/pickers/pickadate/picker.date.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/pickers/pickadate/picker.time.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/pickers/pickadate/legacy.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/components/pickers/dateTime/picker-date-time.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/extensions/moment.min.js" type="text/javascript"></script>





<script>
$("#strAdmisssion").focus();
$(function(){
    getList(1);

    $("#strDischargeDate").pickadate({
        selectYears: 112,
        selectMonths: true,
        max: true,
        format:"dd-mm-yyyy"
    });

    $('#insertion_form').find('input,select,textarea').not('[type=submit]').jqBootstrapValidation({
    submitSuccess: function ($form, event) {
        $(".submit_btn").attr("disabled", true);
        
        if($("#nAdmisssionId").val() != "")
            var strAction = "Edit";
        else
            var strAction = "Add";
    
        $.ajax({
        type: 'POST',
        url: "../../backend/main/operations.php",
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
        $("#nAdmisssionId").val($(this).parent().parent().attr("id"));
          $.ajax({
            type: 'POST',
            url: "../../backend/main/operations.php",
            data: "strAction=Delete" + "&" + $("#param_form").serialize() + "&nAdmisssionId=" + $(this).parent().parent().attr("id"),
            success: function(data)
            { 
                getList(1);
            }
          });
    });
    

    $(document).on("click", ".edit_btn", function(){
        $("#nAdmisssionId").val($(this).parent().parent().attr("id"));
      $.ajax({
        type: 'POST',
        url: "../../backend/main/operations.php",
        data: "strAction=Get" + "&" + $("#param_form").serialize() + "&nAdmisssionId=" + $(this).parent().parent().attr("id"),
        dataType:"json",
        cache:false,
        success: function(data)
        {
            $("#nPatientId").val(data['rstRow']['PatientId']);
            $("#nCompanyId").val(data['rstRow']['CompanyId']);
            $("#nSourceId").val(data['rstRow']['Source']);
            $("#nConsultantId").val(data['rstRow']['ConsultantId']);
            $("#nMedicalDeptId").val(data['rstRow']['MedicalDeptId']);
            $("#strDischargeDate").val(data['rstRow']['strDischargeDate']);
            $("#nBedId").val(data['rstRow']['BedId']);
            expandArea();
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
    $("#strSortOrder").val(strSortOrder);
    $("#company_table_tbody").html('');
    $(".loader-wrapper").show();
    
    $.ajax({
        type: "POST",
        url: "../../backend/main/json.php",
        cache:false,
        data: "strAction=getAdmisssions&nPage=" + nPage + "&" + "&strSortColumnIndex=" + strOrderColumn + "&strSortOrder=" + strSortOrder + "&" + $("#filter_form").serialize(),
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
                $("#strAdmisssion").focus();
        }
    });
}
</script>
<?php include '../../../includes/footer.php';?>
