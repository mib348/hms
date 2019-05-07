<?php
    require_once '../../../includes/defs.php';
    
    $arrPatient = GetRecord("Patients","MRnumber = {$_REQUEST['strPatientMRNum']} and IsActive = 1");
    
    $arrAdmissions['PatientId'] = $arrPatient['PatientId'];
    $arrAdmissions['CompanyId'] = $_REQUEST['nCompanyId'];
    $arrAdmissions['Source'] = '1';
    $arrAdmissions['ConsultantId'] = $_REQUEST['nConsultantId'];
    $arrAdmissions['MedicalDeptId'] = $_REQUEST['nMedDeptId'];
    $arrAdmissions['AdmissionDate'] = date("Y-m-d H:i:s");
    $arrAdmissions['CreatedBy'] = $_SESSION['UserID'];
    $nAdmissionRef = InsertRec("Admissions", $arrAdmissions);
    
    // if (empty($nAdmissionRef) || !$nAdmissionRef){
    //     global $conn;
    //     odbc_rollback($conn);
    //     exit;
    // }
    
    // $arrBillingMaster['AdmissionId'] = $nAdmissionRef;
    // InsertRec("PatientBillMaster", $arrBillingMaster);
    
?>