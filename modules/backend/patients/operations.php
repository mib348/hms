<?php
    require_once '../../../includes/defs.php';
    
    global $strModule;
    
    $arr['Name'] = ucwords(trim($_REQUEST['strName']));
    $arr['FatherName'] = ucwords(trim($_REQUEST['strFatherName']));
    $arr['HusbandName'] = ucwords(trim($_REQUEST['strHusbandName']));
    $arr['DOB'] = date('Y-m-d', strtotime($_REQUEST['strDOB']));
    $arr['NIC'] = $_REQUEST['nNIC'];
    $arr['MaritalStatusId'] = $_REQUEST['nMarialStatus'];
    $arr['BloodGroupId'] = $_REQUEST['nBloodGroup'];
    $arr['Email'] = $_REQUEST['strEmail'];
    $arr['EmergencyNumber'] = $_REQUEST['nEmergencyNumber'];
    $arr['Mobile'] = $_REQUEST['nMobileNumber'];
    $arr['Landline'] = $_REQUEST['nLandline'];
    $arr['PermanentAddress'] = $_REQUEST['strPermanentAddress'];
    $arr['TemporaryAddress'] = $_REQUEST['strTemporaryAddress'];
    $arr['CityId'] = $_REQUEST['nCityId'];
    $arr['Occupation'] = $_REQUEST['strOccupation'];
    $arr['Religion'] = $_REQUEST['strReligion'];
    $arr['Remarks'] = $_REQUEST['strRemarks'];
    
    $arr['Gender'] = $_REQUEST['nGender'];
    $arr['IsActive'] = $_REQUEST['isactive_cb'] == "on" ? true : false;
    $arr['CreatedBy'] = $_SESSION['UserID'];
    $path_parts = pathinfo($_FILES['image']["name"]);
    $fileName = $path_parts['filename'].'-'.uniqid().'.'.$path_parts['extension'];
    if($_FILES["image"]["type"]== "image/jpeg" || $_FILES["image"]["type"]== "image/png"){
        $targetfile = $target_dir . $fileName;
        if(fileUpload($targetfile, $_FILES['image']["tmp_name"])){
            $arr['UserPicture'] = $fileName;
        }
    }

    switch ($_REQUEST['strAction']){
        case "Add":
            $nRef = InsertRec("Patients", $arr);
            GenerateLog("User added a patient id {$nRef}", ucwords($strModule), $_REQUEST['nPatId']);
            break;
        case "Edit":
            UpdateRec("Patients","PatientId = '{$_REQUEST['nPatId']}'", $arr);
            $nRef = $_REQUEST['nPatId'];
            GenerateLog("User updated a patient id {$nRef}", ucwords($strModule), $_REQUEST['nPatId']);
            break;
        case "Get":
            $rstRow = GetRecord("Patients","MRnumber = '{$_REQUEST['strPatientMRNum']}' and IsActive = 1");
            $rstRow['Gender'] = GetGender(intval($rstRow['Gender']));
            $rstRow['BloodGroupId'] = GetField("BloodGroups","GroupName","BloodGroupId = '{$rstRow['BloodGroupId']}'");
            $rstRow['CityId'] = GetField("Cities","CityName","CityId = '{$rstRow['CityId']}'");
            $rstRow['Age'] = DateDifference($rstRow['DOB'], date('Y-m-d H:i:s'));
            $rstRow['MaritalStatusId'] = GetField("MaritalStatus","Description","MaritalStatusId = '{$rstRow['MaritalStatusId']}'");
            break;
        case "Delete":
            $arr['IsActive'] = 0;
            
            UpdateRec("Patients","PatientId = '{$_REQUEST['nPatId']}'", $arr);
            $nRef = $_REQUEST['nPatId'];
            GenerateLog("User deleted a patient id {$nRef}", ucwords($strModule), $_REQUEST['nPatId']);
            break;
    }
    
    if (empty($nRef) || !$nRef){
        global $conn;
        odbc_rollback($conn);
    }
    
    $arrReturn['nRef'] = $nRef;
    $arrReturn['rstRow'] = $rstRow;
    
    echo json_encode($arrReturn);
//     header("location: ../../frontend/patients/index.php");
?>