<?php
    require_once '../../../includes/defs.php';
    
    switch ($_REQUEST['strAction']){
        case "getBillingDetail":
            echo json_encode(getBillingDetail());
            break;
    }
    
    function getBillingDetail(){
        global $conn;
        
        $strQuery = "select Companies.Name as Company, Consultants.Name as Consultant, MedicalDepartments.Name as MedicalDepartment, TotalNetAmount as Amount, Remarks from Admissions
        			left outer join MedicalDepartments on MedicalDepartments.MedicalDeptId = Admissions.MedicalDeptId
        			left outer join Consultants on Consultants.ConsultantId = Admissions.ConsultantId
        			left outer join Companies on Companies.CompanyId = Admissions.CompanyId
        			left outer join PatientBillMaster on PatientBillMaster.AdmissionId = Admissions.AdmissionId
        			left outer join PatientBillDetail on PatientBillDetail.BillNumber = PatientBillMaster.BillNumber
        			where Admissions.AdmissionId = '{$_REQUEST['nAdmissionId']}'
        			";
        $nResult = odbc_exec($conn, $strQuery);
        while ($rstRow = odbc_fetch_array($nResult)){
        	return $rstRow;
        }
    }
?>