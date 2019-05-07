<?php
    require_once '../../../includes/defs.php';
    
    switch ($_REQUEST['strSubModule']){
        case "Admisssions":
            echo json_encode(Admisssions());
            break;
    }
    
    function Admisssions(){
        global $strModule;
        
        $arrRow = array();
        $arr['PatientId'] = $_REQUEST['nPatientId'];
        $arr['CompanyId'] = $_REQUEST['nCompanyId'];
        $arr['Source'] = $_REQUEST['nSourceId'];
        $arr['ConsultantId'] = $_REQUEST['nConsultantId'];
        $arr['MedicalDeptId'] = $_REQUEST['nMedicalDeptId'];
        $arr['DischargedDate'] = date('Y-d-m', strtotime($_REQUEST['strDischargeDate']));
        $arr['BedId'] = $_REQUEST['nBedId'];
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Admissions", $arr);
                GenerateLog("User added a Admissions id {$nRef}", ucwords($strModule), $nRef);
                break;

            case "Get":
                $rstRow = GetRecord("Admissions","AdmissionId = '{$_REQUEST['nAdmisssionId']}'");
                $rstRow['strDischargeDate'] = date('d-m-Y', strtotime($rstRow['DischargedDate']));
                break;
            
            case "Edit":
                UpdateRec("Admissions","AdmissionId = '{$_REQUEST['nAdmisssionId']}'", $arr);
                $nRef = $_REQUEST['nAdmisssionId'];
                GenerateLog("User updated a Admissions id {$nRef}", ucwords($strModule), $nRef);
                break;

            case "Delete":
                DeleteRec("Admissions","AdmissionId = '{$_REQUEST['nAdmisssionId']}'");
                $nRef = $_REQUEST['nAdmisssionId'];
                GenerateLog("User deleted a mainservice id {$nRef}", ucwords($strModule), $nRef);
                break;
        }
        
        if (empty($nRef) || !$nRef){
            global $conn;
            odbc_rollback($conn);
        }
        
        $arrReturn['nRef'] = $nRef;
        $arrReturn['rstRow'] = $rstRow;
        
        return $arrReturn;
    }
    
?>