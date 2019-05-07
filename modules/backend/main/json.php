<?php
    require_once '../../../includes/defs.php';
    
    switch ($_REQUEST['strAction']){
        case "getAdmisssions":
            echo json_encode(getAdmisssions());
            break;
    }
    
    function getAdmisssions(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "Admissions.AdmissionId";
        $arrColumn[] = "Patients.Name";
        $arrColumn[] = "Companies.Name as CompanyName";
        $arrColumn[] = "Source.Name as SourceName";
        $arrColumn[] = "Consultants.Name as ConsultantName";
        $arrColumn[] = "MedicalDepartments.Name as MedicalDepartmentName";
        $arrColumn[] = "Beds.BedNo";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterPatientId']))
            $strWhere .= " and Admissions.PatientId LIKE '%{$_REQUEST['nFilterPatientId']}%' ";
        if (!empty($_REQUEST['nFilterCompanyId']))
            $strWhere .= " and Admissions.CompanyId LIKE '%{$_REQUEST['nFilterCompanyId']}%' ";
        if (!empty($_REQUEST['nFilterSourceId']))
            $strWhere .= " and Admissions.Source LIKE '%{$_REQUEST['nFilterSourceId']}%' ";
        if (!empty($_REQUEST['nFilterConsultantId']))
            $strWhere .= " and Admissions.ConsultantId LIKE '%{$_REQUEST['nFilterConsultantId']}%' ";
        if (!empty($_REQUEST['nFilterMedicalDeptId']))
            $strWhere .= " and Admissions.MedicalDeptId LIKE '%{$_REQUEST['nFilterMedicalDeptId']}%' ";
        if (!empty($_REQUEST['strFilterDischargeDate'])){
            $date = date("Y-m-d", strtotime($_REQUEST['strFilterDischargeDate']));
            $strWhere .= " and Admissions LIKE '%{$date}%' ";
        }
        if (!empty($_REQUEST['nFilterBedId']))
            $strWhere .= " and Admissions.BedId LIKE '%{$_REQUEST['nFilterBedId']}%' ";
                  

        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, Admissions.AdmissionId as AdmissionId, Admissions.AdmissionDate as AdmissionDate, Patients.MRnumber as MRnumber, Patients.Name as PatientName,  Companies.Name as CompanyName, Source, Consultants.Name as ConsultantName, MedicalDepartments.Name as MedicalDepartmentName, Beds.BedNo as BedNo, DischargedDate
                        from Admissions
                        left outer join Patients on Admissions.PatientId = Patients.PatientId
                        left outer join Companies on Admissions.CompanyId = Companies.CompanyId
                        left outer join Consultants on Admissions.ConsultantId = Consultants.ConsultantId
                        left outer join MedicalDepartments on Admissions.MedicalDeptId = MedicalDepartments.MedicalDeptId
                        left outer join Beds on Admissions.BedId = Beds.BedId
    			 		where $strWhere 
					) x
                    where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult))
        {
            switch ($rstRow['Source']) {
                case '1':
                    $source = "OPD";
                    break;
                
                case '2':
                    $source = "IPD";
                    break;
                
                case '3':
                    $source = "Direct Service";
                    break;
                
                default:
                    # code...
                    break;
            }    
            $html .= "<tr id='{$rstRow['AdmissionId']}'>";
                $html .= "<td class='text-xs-right'>" . $rstRow['MRnumber'] . "</td>";
                $html .= "<td class='text-xs-left'>" . ucwords($rstRow['PatientName']) . "</td>";
                $html .= "<td class='text-xs-left'>" . $source . "</td>";
                $html .= "<td class='text-xs-center'>" . date("d-m-Y", strtotime($rstRow['AdmissionDate']))  . "</td>";
                $html .= "<td class='text-xs-left'>" . ucwords($rstRow['ConsultantName']) . "</td>";
                $html .= "<td class='text-xs-left'>" . ucwords($rstRow['MedicalDepartmentName'])  . "</td>";
                $html .= "<td class='text-xs-left'>" . ucwords($rstRow['CompanyName'])  . "</td>";
                // currently these are hidden will be available on requirement.
                // $html .= "<td class='text-xs-center'>" . date("d-m-Y", strtotime($rstRow['DischargedDate']))  . "</td>";
                // $html .= "<td class='text-xs-right'>" . ucwords($rstRow['BedNo']) . "</td>"; 
                $html .= '<td class="text-xs-center">
                               <button type="button" class="btn btn-info btn-sm edit_btn"><i class="icon-edit"></i></button>
                               <button type="button" class="btn btn-danger btn-sm delete_btn"><i class="icon-android-delete"></i></button>
                            </td>';
            $html .= "<tr>"; 
            
            if(empty($nStartRec)) 
                $nStartRec = $rstRow["rowNum"];
            $nEndRec = $rstRow["rowNum"];
            
            $i++;
        }
        
        $nTotalRec = RecCount("Admissions
        left outer join Patients on Admissions.PatientId = Patients.PatientId
        left outer join Companies on Admissions.CompanyId = Companies.CompanyId
        left outer join Consultants on Admissions.ConsultantId = Consultants.ConsultantId
        left outer join MedicalDepartments on Admissions.MedicalDeptId = MedicalDepartments.MedicalDeptId
        left outer join Beds on Admissions.BedId = Beds.BedId", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='float-xs-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Admission.</div><div class='float-xs-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-xs-left'>No Admission found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    
?>