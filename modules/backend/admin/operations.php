<?php
    require_once '../../../includes/defs.php';
    
    switch ($_REQUEST['strSubModule']){
        case "Cities":
            echo json_encode(Cities());
            break;
            
        case "Departments":
            echo json_encode(Departments());
            break;
            
        case "SubDepartments":
            echo json_encode(SubDepartments());
            break;
            
        case "Locations":
            echo json_encode(Locations());
            break;
            
        case "Companies":
            echo json_encode(Companies());
            break;
            
        case "MainServices":
            echo json_encode(MainServices());
            break;
            
        case "SubServices":
            echo json_encode(SubServices());
            break;
            
        case "Services":
            echo json_encode(Services());
            break;
            
        case "ServiceRates":
            echo json_encode(ServiceRates());
            break;
            
        case "Specialities":
            echo json_encode(Specialities());
            break;
            
        case "Consultants":
            echo json_encode(Consultants());
            break;
            
        case "WardTypes":
            echo json_encode(WardTypes());
            break;
            
        case "Wards":
            echo json_encode(Wards());
            break;
            
        case "Beds":
            echo json_encode(Beds());
            break;
            
        case "MedicalDepartments":
            echo json_encode(MedicalDepartments());
            break;
            
        case "COACodes":
            echo json_encode(COACodes());
            break;
            
        case "PaymentHeads":
            echo json_encode(PaymentHeads());
            break;
            
        case "PatientBillMaster":
            echo json_encode(PatientBillMaster());
            break;
    }
    

    function MainServices(){
        global $strModule;
        
        $arr['MainServiceName'] = trim($_REQUEST['strMainService']);
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("MainServices", $arr);
                GenerateLog("User added a mainservice id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("MainServices","MainServiceId = '{$_REQUEST['nMainServiceId']}'");
                break;
            case "Edit":
                UpdateRec("MainServices","MainServiceId = '{$_REQUEST['nMainServiceId']}'", $arr);
                $nRef = $_REQUEST['nMainServiceId'];
                GenerateLog("User updated a mainservice id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("MainServices","MainServiceId = '{$_REQUEST['nMainServiceId']}'");
                $nRef = $_REQUEST['nMainServiceId'];
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
    
    function Specialities(){
        global $strModule;
        
        $arr['Name'] = trim($_REQUEST['strSpeciality']);
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Specialities", $arr);
                GenerateLog("User added a speciality id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Specialities","SpecialityId = '{$_REQUEST['nSpecialityId']}'");
                break;
            case "Edit":
                UpdateRec("Specialities","SpecialityId = '{$_REQUEST['nSpecialityId']}'", $arr);
                $nRef = $_REQUEST['nSpecialityId'];
                GenerateLog("User updated a speciality id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("Specialities","SpecialityId = '{$_REQUEST['nSpecialityId']}'");
                $nRef = $_REQUEST['nSpecialityId'];
                GenerateLog("User deleted a speciality id {$nRef}", ucwords($strModule), $nRef);
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
    
    function COACodes(){
        global $strModule;
        
        $arr['COACode'] = trim($_REQUEST['strCOACode']);
        $arr['Description'] = trim($_REQUEST['strDesc']);
        $arr['Type'] = $_REQUEST['strType'];
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("COACodes", $arr);
                GenerateLog("User added a coa code id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("COACodes","COACodeId = '{$_REQUEST['nCOACodeId']}'");
                break;
            case "Edit":
                UpdateRec("COACodes","COACodeId = '{$_REQUEST['nCOACodeId']}'", $arr);
                $nRef = $_REQUEST['nCOACodeId'];
                GenerateLog("User updated a coa code id {$nRef}", ucwords($strModule), $_REQUEST['nCOACodeId']);
                break;
            case "Delete":
                DeleteRec("COACodes","COACodeId = '{$_REQUEST['nCOACodeId']}'");
                $nRef = $_REQUEST['nCOACodeId'];
                GenerateLog("User deleted a coa code id {$nRef}", ucwords($strModule), $_REQUEST['nCOACodeId']);
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
    
    function PaymentHeads(){
        global $strModule;
        
        $arr['COACode'] = trim($_REQUEST['strCOACodeId']);
        $arr['Description'] = trim($_REQUEST['strPaymentHead']);
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("PaymentHeads", $arr);
                GenerateLog("User added a payment head id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("PaymentHeads","PaymentHeadId = '{$_REQUEST['nPaymentHeadId']}'");
                break;
            case "Edit":
                UpdateRec("PaymentHeads","PaymentHeadId = '{$_REQUEST['nPaymentHeadId']}'", $arr);
                $nRef = $_REQUEST['nPaymentHeadId'];
                GenerateLog("User updated a payment head id {$nRef}", ucwords($strModule), $_REQUEST['nPaymentHeadId']);
                break;
            case "Delete":
                DeleteRec("PaymentHeads","PaymentHeadId = '{$_REQUEST['nPaymentHeadId']}'");
                $nRef = $_REQUEST['nPaymentHeadId'];
                GenerateLog("User deleted a payment head id {$nRef}", ucwords($strModule), $_REQUEST['nPaymentHeadId']);
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
    
    function Cities(){
        global $strModule;
        
        $arr['CityName'] = ucwords(trim($_REQUEST['strCity']));
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Cities", $arr);
                GenerateLog("User added a city id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Cities","CityId = '{$_REQUEST['nCityId']}'");
                break;
            case "Edit":
                UpdateRec("Cities","CityId = '{$_REQUEST['nCityId']}'", $arr);
                $nRef = $_REQUEST['nCityId'];
                GenerateLog("User updated a city id {$nRef}", ucwords($strModule), $_REQUEST['nCityId']);
                break;
            case "Delete":
                DeleteRec("Cities","CityId = '{$_REQUEST['nCityId']}'");
                $nRef = $_REQUEST['nCityId'];
                GenerateLog("User deleted a city id {$nRef}", ucwords($strModule), $_REQUEST['nCityId']);
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
    
    function Departments(){
        global $strModule;
        
        $arr['Name'] = ucwords(trim($_REQUEST['strDepartment']));
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Departments", $arr);
                GenerateLog("User added a department id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Departments","DepartmentId = '{$_REQUEST['nDeptId']}'");
                break;
            case "Edit":
                UpdateRec("Departments","DepartmentId = '{$_REQUEST['nDeptId']}'", $arr);
                $nRef = $_REQUEST['nDeptId'];
                GenerateLog("User updated a department id {$nRef}", ucwords($strModule), $_REQUEST['nDeptId']);
                break;
            case "Delete":
                //             $arr['IsActive'] = 0;
                
                //             UpdateRec("Departments","DepartmentId = '{$_REQUEST['nDeptId']}'", $arr);
                DeleteRec("Departments","DepartmentId = '{$_REQUEST['nDeptId']}'");
                $nRef = $_REQUEST['nDeptId'];
                GenerateLog("User deleted a department id {$nRef}", ucwords($strModule), $_REQUEST['nDeptId']);
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
    
    function SubDepartments(){
        global $strModule;
        
        $arr['Name'] = ucwords(trim($_REQUEST['strSubDepartment']));
        $arr['DepartmentId'] = $_REQUEST['nDeptId'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("SubDepartments", $arr);
                GenerateLog("User added a sub-department id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("SubDepartments","SubDepartmentId = '{$_REQUEST['nSubDeptId']}'");
                break;
            case "Edit":
                UpdateRec("SubDepartments","SubDepartmentId = '{$_REQUEST['nSubDeptId']}'", $arr);
                $nRef = $_REQUEST['nSubDeptId'];
                GenerateLog("User updated a sub-department id {$nRef}", ucwords($strModule), $_REQUEST['nSubDeptId']);
                break;
            case "Delete":
                DeleteRec("SubDepartments","SubDepartmentId = '{$_REQUEST['nSubDeptId']}'");
                $nRef = $_REQUEST['nSubDeptId'];
                GenerateLog("User deleted a sub-department id {$nRef}", ucwords($strModule), $_REQUEST['nSubDeptId']);
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
    
    function SubServices(){
        global $strModule;
        
        $arr['SubServiceName'] = $_REQUEST['strSubService'];
        $arr['MainServiceId'] = $_REQUEST['nMainServiceId'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("SubServices", $arr);
                GenerateLog("User added a sub-service id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("SubServices","SubServiceId = '{$_REQUEST['nSubServiceId']}'");
                break;
            case "Edit":
                UpdateRec("SubServices","SubServiceId = '{$_REQUEST['nSubServiceId']}'", $arr);
                $nRef = $_REQUEST['nSubServiceId'];
                GenerateLog("User updated a sub-service id {$nRef}", ucwords($strModule), $_REQUEST['nSubServiceId']);
                break;
            case "Delete":
                DeleteRec("SubServices","SubServiceId = '{$_REQUEST['nSubServiceId']}'");
                $nRef = $_REQUEST['nSubServiceId'];
                GenerateLog("User deleted a sub-service id {$nRef}", ucwords($strModule), $_REQUEST['nSubServiceId']);
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
    
    function Services(){
        global $strModule;
        
        $arr['ServiceName'] = trim($_REQUEST['strService']);
        $arr['SubServiceId'] = $_REQUEST['nSubServiceId'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Services", $arr);
                GenerateLog("User added a service id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Services","ServiceId = '{$_REQUEST['nServiceId']}'");
                break;
            case "Edit":
                UpdateRec("Services","ServiceId = '{$_REQUEST['nServiceId']}'", $arr);
                $nRef = $_REQUEST['nServiceId'];
                GenerateLog("User updated a service id {$nRef}", ucwords($strModule), $_REQUEST['nServiceId']);
                break;
            case "Delete":
                DeleteRec("Services","ServiceId = '{$_REQUEST['nServiceId']}'");
                $nRef = $_REQUEST['nServiceId'];
                GenerateLog("User deleted a service id {$nRef}", ucwords($strModule), $_REQUEST['nServiceId']);
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
    
    function ServiceRates(){
        global $strModule;
        
        $arr['Rate'] = trim($_REQUEST['strServiceRate']);
        $arr['ServiceId'] = $_REQUEST['nServiceId'];
        $arr['CompanyId'] = $_REQUEST['nCompanyId'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("ServicesRates", $arr);
                GenerateLog("User added a service rate id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("ServicesRates","ServiceRateId = '{$_REQUEST['nServiceRateId']}'");
                break;
            case "Edit":
                UpdateRec("ServicesRates","ServiceRateId = '{$_REQUEST['nServiceRateId']}'", $arr);
                $nRef = $_REQUEST['nServiceRateId'];
                GenerateLog("User updated a service rate id {$nRef}", ucwords($strModule), $_REQUEST['nServiceRateId']);
                break;
            case "Delete":
                DeleteRec("ServicesRates","ServiceRateId = '{$_REQUEST['nServiceRateId']}'");
                $nRef = $_REQUEST['nServiceRateId'];
                GenerateLog("User deleted a service rate id {$nRef}", ucwords($strModule), $_REQUEST['nServiceRateId']);
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
    
    function Consultants(){
        global $strModule;
        
        $arr['Name'] = trim($_REQUEST['strConsultant']);
        $arr['SpecialityId'] = $_REQUEST['nSpecialityId'];
        $arr['Email'] = $_REQUEST['strEmail'];
        $arr['Mobile'] = $_REQUEST['strPhone'];
        $arr['Address'] = $_REQUEST['strAddress'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Consultants", $arr);
                GenerateLog("User added a consultant id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Consultants","ConsultantId = '{$_REQUEST['nConsultantId']}'");
                break;
            case "Edit":
                UpdateRec("Consultants","ConsultantId = '{$_REQUEST['nConsultantId']}'", $arr);
                $nRef = $_REQUEST['nConsultantId'];
                GenerateLog("User updated a consultant id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("Consultants","ConsultantId = '{$_REQUEST['nConsultantId']}'");
                $nRef = $_REQUEST['nConsultantId'];
                GenerateLog("User deleted a consultant id {$nRef}", ucwords($strModule), $nRef);
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
    
    function PatientBillMaster(){
        global $strModule;
        
        $arr['AdmissionId'] = $_REQUEST['nAdmissionId'];
        $arr['ApprovedBy'] = trim($_REQUEST['strApprovedBy']);
        $arr['TotalNetAmount'] = $_REQUEST['nTotalNetAmount'];
        $arr['Remarks'] = trim($_REQUEST['strRemarks']);
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("PatientBillMaster", $arr);
                GenerateLog("User added a patient bill master id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("PatientBillMaster","BillNumber = '{$_REQUEST['nPatientBillMasterId']}'");
                break;
            case "Edit":
                UpdateRec("PatientBillMaster","BillNumber = '{$_REQUEST['nPatientBillMasterId']}'", $arr);
                $nRef = $_REQUEST['nPatientBillMasterId'];
                GenerateLog("User updated a patient bill master id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("PatientBillMaster","BillNumber = '{$_REQUEST['nPatientBillMasterId']}'");
                $nRef = $_REQUEST['nPatientBillMasterId'];
                GenerateLog("User deleted a patient bill master id {$nRef}", ucwords($strModule), $nRef);
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
    
    
    function Locations(){
        global $strModule;
        
        $arr['Name'] = trim($_REQUEST['strLocation']);
        $arr['SubDepartmentId'] = $_REQUEST['nSubDeptId'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Locations", $arr);
                GenerateLog("User added a location id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Locations","LocationId = '{$_REQUEST['nLocId']}'");
                break;
            case "Edit":
                UpdateRec("Locations","LocationId = '{$_REQUEST['nLocId']}'", $arr);
                $nRef = $_REQUEST['nLocId'];
                GenerateLog("User updated a location id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("Locations","LocationId = '{$_REQUEST['nLocId']}'");
                $nRef = $_REQUEST['nLocId'];
                GenerateLog("User deleted a location id {$nRef}", ucwords($strModule), $nRef);
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
    
    function Companies(){
        global $strModule;
        
        $arr['Name'] = ucwords(trim($_REQUEST['strCompany']));
        $arr['Address'] = ucwords(trim($_REQUEST['strAddress']));
        $arr['PhoneNumber'] = trim($_REQUEST['strPhone']);
        $arr['Email'] = trim($_REQUEST['strEmail']);
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Companies", $arr);
                GenerateLog("User added a company id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Companies","CompanyId = '{$_REQUEST['nCompanyId']}'");
                break;
            case "Edit":
                UpdateRec("Companies","CompanyId = '{$_REQUEST['nCompanyId']}'", $arr);
                $nRef = $_REQUEST['nCompanyId'];
                GenerateLog("User updated a company id {$nRef}", ucwords($strModule), $_REQUEST['nCompanyId']);
                break;
            case "Delete":
                DeleteRec("Companies","CompanyId = '{$_REQUEST['nCompanyId']}'");
                $nRef = $_REQUEST['nCompanyId'];
                GenerateLog("User deleted a company id {$nRef}", ucwords($strModule), $_REQUEST['nCompanyId']);
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
    
    function WardTypes(){
        global $strModule;
        
        $arr['WardTypeName'] = trim($_REQUEST['strWardType']);
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("WardTypes", $arr);
                GenerateLog("User added a wardtype id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("WardTypes","WardTypeId = '{$_REQUEST['nWardTypeId']}'");
                break;
            case "Edit":
                UpdateRec("WardTypes","WardTypeId = '{$_REQUEST['nWardTypeId']}'", $arr);
                $nRef = $_REQUEST['nWardTypeId'];
                GenerateLog("User updated a wardtype id {$nRef}", ucwords($strModule), $_REQUEST['nWardTypeId']);
                break;
            case "Delete":
                DeleteRec("WardTypes","WardTypeId = '{$_REQUEST['nWardTypeId']}'");
                $nRef = $_REQUEST['nWardTypeId'];
                GenerateLog("User deleted a wardtype id {$nRef}", ucwords($strModule), $_REQUEST['nWardTypeId']);
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
    
    
    
    function Wards(){
        global $strModule;
        
        $arr['WardName'] = trim($_REQUEST['strWard']);
        $arr['WardTypeId'] = $_REQUEST['nWardTypeId'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Wards", $arr);
                GenerateLog("User added a ward id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Wards","WardId = '{$_REQUEST['nWardId']}'");
                break;
            case "Edit":
                UpdateRec("Wards","WardId = '{$_REQUEST['nWardId']}'", $arr);
                $nRef = $_REQUEST['nWardId'];
                GenerateLog("User updated a ward id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("Wards","WardId = '{$_REQUEST['nWardId']}'");
                $nRef = $_REQUEST['nWardId'];
                GenerateLog("User deleted a ward id {$nRef}", ucwords($strModule), $nRef);
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
    
    
    function Beds(){
        global $strModule;
        
        $arr['BedNo'] = trim($_REQUEST['strBed']);
        $arr['WardId'] = $_REQUEST['nWardId'];
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("Beds", $arr);
                GenerateLog("User added a bed id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("Beds","BedId = '{$_REQUEST['nBedId']}'");
                break;
            case "Edit":
                UpdateRec("Beds","BedId = '{$_REQUEST['nBedId']}'", $arr);
                $nRef = $_REQUEST['nBedId'];
                GenerateLog("User updated a bed id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("Beds","BedId = '{$_REQUEST['nBedId']}'");
                $nRef = $_REQUEST['nBedId'];
                GenerateLog("User deleted a bed id {$nRef}", ucwords($strModule), $nRef);
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
    
    function MedicalDepartments(){
        global $strModule;
        
        $arr['Name'] = trim($_REQUEST['strMedicalDepartment']);
        $arr['Fees'] = $_REQUEST['nFees'];
        $arr['RoomNo'] = $_REQUEST['nRoomNum'];
//         $arr['ServiceId'] = $_REQUEST['nRoomNum'];
        $arr['Mon'] = (isset($_REQUEST['Mondays_cb'])) ? 1 : 0;
        $arr['Tue'] = (isset($_REQUEST['Tuesdays_cb'])) ? 1 : 0;
        $arr['Wed'] = (isset($_REQUEST['Wednesdays_cb'])) ? 1 : 0;
        $arr['Thu'] = (isset($_REQUEST['Thursdays_cb'])) ? 1 : 0;
        $arr['Fri'] = (isset($_REQUEST['Fridays_cb'])) ? 1 : 0;
        $arr['Sat'] = (isset($_REQUEST['Saturdays_cb'])) ? 1 : 0;
        $arr['Sun'] = (isset($_REQUEST['Sundays_cb'])) ? 1 : 0;
        $arr['IsActive'] = (isset($_REQUEST['isactive_cb'])) ? 1 : 0;
        $arr['CreatedBy'] = $_SESSION['UserID'];
        
        switch ($_REQUEST['strAction']){
            case "Add":
                $nRef = InsertRec("MedicalDepartments", $arr);
                GenerateLog("User added a medical department id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Get":
                $rstRow = GetRecord("MedicalDepartments","MedicalDeptId = '{$_REQUEST['nMedicalDeptId']}'");
                break;
            case "Edit":
                UpdateRec("MedicalDepartments","MedicalDeptId = '{$_REQUEST['nMedicalDeptId']}'", $arr);
                $nRef = $_REQUEST['nMedicalDeptId'];
                GenerateLog("User updated a medical department id {$nRef}", ucwords($strModule), $nRef);
                break;
            case "Delete":
                DeleteRec("MedicalDepartments","MedicalDeptId = '{$_REQUEST['nMedicalDeptId']}'");
                $nRef = $_REQUEST['nMedicalDeptId'];
                GenerateLog("User deleted a medical department id {$nRef}", ucwords($strModule), $nRef);
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