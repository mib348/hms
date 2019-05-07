<?php
    require_once '../../../includes/defs.php';
/*     
    function getPatients(){
        global $conn;
        
        $nRowsPerPage = $_REQUEST['length'];
        $nPage = empty($_REQUEST['draw']) ? 1 : $_REQUEST['draw'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $strWhere = " 1=1 ";
        
        $arrColumn[] = "PatientId";
        $arrColumn[] = "MRnumber";
        $arrColumn[] = "Name";
        $arrColumn[] = "FatherName";
        $arrColumn[] = "DOB";
        $arrColumn[] = "Gender";
        $arrColumn[] = "GroupName";
        $arrColumn[] = "Remarks";
        $strFields = implode(", ", $arrColumn);
        
        if (!empty($_REQUEST['search']['value'])){
            $strWhere .= " and (";
            foreach ($arrColumn as $strColumn){
                $strWhere .= " $strColumn LIKE '{$_REQUEST['search']['value']}' or";
            }
            $strWhere = substr($strWhere, 0, -3);
            $strWhere .= " )";
        }
        
        $strTables = "select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['order'][0]['column']]} {$_REQUEST['order'][0]['dir']})  AS rowNum, $strFields
    					from Patients
    					left outer join BloodGroups on BloodGroups.BloodGroupId = Patients.BloodGroupId
    			 		where ";
        
        $strQuery = "select * from
					(
						$strTables $strWhere
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
//             $html = "";
//             $arrData[$i][] = $rstRow['MRnumber'];
//             $arrData[$i][] = $rstRow['Name'];
//             $arrData[$i][] = $rstRow['FatherName'];
//             $arrData[$i][] = DateDifference($rstRow['DOB'], date('Y-m-d H:i:s'));
//             $arrData[$i][] = GetGender($rstRow['Gender']);
//             $arrData[$i][] = $rstRow['GroupName'];
//             $arrData[$i][] = $rstRow['Remarks'];
            
            $arrData["data"][] = array(
                $rstRow['PatientId'],
                $rstRow['MRnumber'],
                $rstRow['Name'],
                $rstRow['FatherName'],
                DateDifference($rstRow['DOB'], date('Y-m-d H:i:s')),
                GetGender($rstRow['Gender']),
                $rstRow['GroupName'],
                $rstRow['Remarks']
            );
            
//             $html .= "<tr>";
//                 $html .= "<td>" . $rstRow['MRnumber'] . "</td>";
//                 $html .= "<td>" . $rstRow['Name'] . "</td>";
//                 $html .= "<td>" . $rstRow['FatherName'] . "</td>";
//                 $html .= "<td>" . DateDifference($rstRow['DOB'], date('Y-m-d H:i:s')) . "</td>";
//                 $html .= "<td>" . GetGender($rstRow['Gender']) . "</td>";
//                 $html .= "<td>" . $rstRow['GroupName'] . "</td>";
//                 $html .= "<td>" . $rstRow['Remarks'] . "</td>";
//             $html .= "<tr>"; 
            
//             $arrData[$i][] = $html;
            
            $i++;
        }
        
        $arrData["draw"] = intval($nPage);
        $arrData["recordsTotal"] = intval(RecCount("Patients", " 1=1 "));
        $arrData["recordsFiltered"] = intval(RecCount("Patients", $strWhere));
        
        return $arrData;
    } */
    
    function getPatients(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "PatientId";
        $arrColumn[] = "MRnumber";
        $arrColumn[] = "Name";
        $arrColumn[] = "FatherName";
        $arrColumn[] = "HusbandName";
        $arrColumn[] = "DOB";
        $arrColumn[] = "Gender";
        $arrColumn[] = "GroupName";
        $arrColumn[] = "Remarks";
        $strFields = implode(", ", $arrColumn);
        
        $strWhere = " 1=1 and IsActive = 1 ";

        if(!empty($_REQUEST['nPatientId'])){
            $strWhere .= " and PatientId LIKE '%{$_REQUEST['nPatientId']}%' ";
        }
        if(!empty($_REQUEST['nMRNumber'])){
            $strWhere .= " and MRnumber LIKE '%{$_REQUEST['nMRNumber']}%' ";
        }
        if(!empty($_REQUEST['strPatientName'])){
            $strWhere .= " and Name LIKE '%{$_REQUEST['strPatientName']}%' ";
        }
        // if(!empty($_REQUEST['gaurdian'])){
        //     $strWhere .= " and FatherName LIKE '%{$_REQUEST['gaurdian']}%' ";
        // }
        if(!empty($_REQUEST['strFatherName'])){
            $strWhere .= " and FatherName LIKE '%{$_REQUEST['strFatherName']}%' ";
        }
        if(!empty($_REQUEST['strHusbandName'])){
            $strWhere .= " and HusbandName LIKE '%{$_REQUEST['strHusbandName']}%' ";
        }
        if(!empty($_REQUEST['nPatientAge'])){
            $strWhere .= " and DOB LIKE '%{$_REQUEST['nPatientAge']}%' ";
        }
        if($_REQUEST['nGender'] == 0 || $_REQUEST['nGender'] == 1){
            $strWhere .= " and Gender LIKE '%{$_REQUEST['nGender']}%' ";
        }
        if(!empty($_REQUEST['strBloodGroup'])){
            $strWhere .= " and GroupName LIKE '%{$_REQUEST['strBloodGroup']}%' ";
        }
        // if (!empty($_REQUEST['strSearch'])){
        //     $strWhere .= " and (";
        //     foreach ($arrColumn as $strColumn){
        //         $strWhere .= " $strColumn LIKE '%{$_REQUEST['strSearch']}%' or";
        //     }
        //     $strWhere = substr($strWhere, 0, -3);
        //     $strWhere .= " )";
        // }
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, $strFields
    					from Patients
    					left outer join BloodGroups on BloodGroups.BloodGroupId = Patients.BloodGroupId
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
//             $html = "";
//             $arrData[$i][] = $rstRow['MRnumber'];
//             $arrData[$i][] = $rstRow['Name'];
//             $arrData[$i][] = $rstRow['FatherName'];
//             $arrData[$i][] = DateDifference($rstRow['DOB'], date('Y-m-d H:i:s'));
//             $arrData[$i][] = GetGender($rstRow['Gender']);
//             $arrData[$i][] = $rstRow['GroupName'];
//             $arrData[$i][] = $rstRow['Remarks'];
            
//             $arrData["data"][] = array(
//                 $rstRow['PatientId'],
//                 $rstRow['MRnumber'],
//                 $rstRow['Name'],
//                 $rstRow['FatherName'],
//                 DateDifference($rstRow['DOB'], date('Y-m-d H:i:s')),
//                 GetGender($rstRow['Gender']),
//                 $rstRow['GroupName'],
//                 $rstRow['Remarks']
//             );
            
            $html .= "<tr id='{$rstRow['PatientId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['PatientId'] . "</td>";
                $html .= "<td class='text-right'>" . $rstRow['MRnumber'] . "</td>";
                $html .= "<td class='text-left'>" . $rstRow['Name'] . "</td>";
                $html .= "<td class='text-left'>" . $rstRow['FatherName'] . "</td>";
                $html .= "<td class='text-left'>" . $rstRow['HusbandName'] . "</td>";
                $html .= "<td class='text-center'>" . DateDifference($rstRow['DOB'], date('Y-m-d H:i:s')) . "</td>";
                $html .= "<td class='text-center'>" . GetGender($rstRow['Gender']) . "</td>";
                $html .= "<td class='text-center'>" . $rstRow['GroupName'] . "</td>";
                $html .= "<td class='text-left'>" . $rstRow['Remarks'] . "</td>";
                $html .= '<td class="text-center">
                               <button type="button" class="btn btn-info btn-xs edit_btn"><i class="fa fa-edit"></i></button>
                               <button type="button" class="btn btn-danger btn-xs delete_btn"><i class="fa fa-trash"></i></button>
                            </td>';
            $html .= "<tr>"; 
            
            if(empty($nStartRec)) 
                $nStartRec = $rstRow["rowNum"];
            $nEndRec = $rstRow["rowNum"];
            
            $i++;
        }
        
        $nTotalRec = RecCount("Patients left outer join BloodGroups on BloodGroups.BloodGroupId = Patients.BloodGroupId", $strWhere);
        
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
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Patients.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Patient found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    switch ($_REQUEST['strAction']){
        case "getPatients":
            echo json_encode(getPatients());
            break;
    }
?>