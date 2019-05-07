<?php
    require_once '../../../includes/defs.php';
    
    switch ($_REQUEST['strAction']){
        case "getCities":
            echo json_encode(getCities());
            break;
            
        case "getDepartments":
            echo json_encode(getDepartments());
            break;
            
        case "getSubDepartments":
            echo json_encode(getSubDepartments());
            break;
            
        case "getLocations":
            echo json_encode(getLocations());
            break;
            
        case "getCompanies":
            echo json_encode(getCompanies());
            break;
            
        case "getMainServices":
            echo json_encode(getMainServices());
            break;
            
        case "getSubServices":
            echo json_encode(getSubServices());
            break;
            
        case "getServices":
            echo json_encode(getServices());
            break;
            
        case "getServiceRates":
            echo json_encode(getServiceRates());
            break;
            
        case "getSpecialities":
            echo json_encode(getSpecialities());
            break;
            
        case "getConsultants":
            echo json_encode(getConsultants());
            break;
            
        case "getWardTypes":
            echo json_encode(getWardTypes());
            break;
            
        case "getWards":
            echo json_encode(getWards());
            break;
            
        case "getBeds":
            echo json_encode(getBeds());
            break;
            
        case "getMedicalDepartments":
            echo json_encode(getMedicalDepartments());
            break;
            
        case "getCOACodes":
            echo json_encode(getCOACodes());
            break;
            
        case "getPaymentHeads":
            echo json_encode(getPaymentHeads());
            break;
            
        case "getPatientBillMaster":
            echo json_encode(getPatientBillMaster());
            break;
    }
    
    function getMainServices(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "MainServiceId";
        $arrColumn[] = "MainServiceName";
        $arrColumn[] = "IsActive";
        $strFields = implode(", ", $arrColumn);
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and MainServiceName LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, $strFields
    					from MainServices
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['MainServiceId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['MainServiceId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['MainServiceName']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("MainServices", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Main Service.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Main Service found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    function getSpecialities(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "SpecialityId";
        $arrColumn[] = "Name";
        $arrColumn[] = "IsActive";
        $strFields = implode(", ", $arrColumn);
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and Name LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, $strFields
    					from Specialities
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['SpecialityId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['SpecialityId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['Name']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Specialities", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Speciality.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Speciality found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    function getCOACodes(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "COACodeId";
        $arrColumn[] = "COACode";
        $arrColumn[] = "Description";
        $arrColumn[] = "Type";
        $strFields = implode(", ", $arrColumn);
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterCOACode']))
            $strWhere .= " and COACode LIKE '%{$_REQUEST['strFilterCOACode']}%' ";
        if (!empty($_REQUEST['strFilterDesc']))
            $strWhere .= " and Description LIKE '%{$_REQUEST['strFilterDesc']}%' ";
        if (!empty($_REQUEST['strFilterType']))
            $strWhere .= " and Type = '{$_REQUEST['strFilterType']}'";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, $strFields
    					from COACodes
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['COACodeId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['COACodeId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['COACode']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['Description']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords(GetCOACodeType($rstRow['Type'])) . "</td>";
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
        
        $nTotalRec = RecCount("COACodes", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec COA Codes.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No COA Code found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    function getPaymentHeads(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "PaymentHeadId";
        $arrColumn[] = "COACode";
        $arrColumn[] = "Description";
        $strFields = implode(", ", $arrColumn);
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterCOACodeId']))
            $strWhere .= " and COACode = '{$_REQUEST['strFilterCOACodeId']}' ";
        if (!empty($_REQUEST['strFilterDescription']))
            $strWhere .= " and Description LIKE '%{$_REQUEST['strFilterDescription']}%' ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, $strFields
    					from PaymentHeads
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['PaymentHeadId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['PaymentHeadId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['COACode']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['Description']) . "</td>";
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
        
        $nTotalRec = RecCount("PaymentHeads", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Payment Heads.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Payment Head found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    function getCities(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "CityId";
        $arrColumn[] = "CityName";
        $arrColumn[] = "IsActive";
        $strFields = implode(", ", $arrColumn);
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and CityName LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, $strFields
    					from Cities
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['CityId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['CityId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['CityName']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Cities", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Cities.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No City found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    
    function getDepartments(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "DepartmentId";
        $arrColumn[] = "Name";
        $arrColumn[] = "IsActive";
        $strFields = implode(", ", $arrColumn);
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and Name LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum, $strFields
    					from Departments
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['DepartmentId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['DepartmentId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['Name']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Departments", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Departments.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Department found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    function getSubDepartments(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrOrderColumn[] = "SubDepartmentId";
        $arrOrderColumn[] = "SubDepartments.Name";
        $arrOrderColumn[] = "Departments.Name";
        $arrOrderColumn[] = "SubDepartments.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterDeptId']))
            $strWhere .= " and SubDepartments.DepartmentId = '{$_REQUEST['nFilterDeptId']}'";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and SubDepartments.Name LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and SubDepartments.IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrOrderColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        SubDepartmentId, SubDepartments.Name as SubDepartment, Departments.Name as Department, SubDepartments.IsActive, SubDepartments.DepartmentId
    					from SubDepartments
                        left outer join Departments on Departments.DepartmentId = SubDepartments.DepartmentId
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['SubDepartmentId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['SubDepartmentId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['SubDepartment']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['Department']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("SubDepartments", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Sub Departments.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Sub Department found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    function getSubServices(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrOrderColumn[] = "SubServiceId";
        $arrOrderColumn[] = "SubServiceName";
        $arrOrderColumn[] = "MainServiceName";
        $arrOrderColumn[] = "SubServices.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterMainServiceId']))
            $strWhere .= " and SubServices.MainServiceId = '{$_REQUEST['nFilterMainServiceId']}'";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and SubServiceName LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and SubServices.IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrOrderColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        SubServiceId, SubServiceName, MainServiceName, SubServices.IsActive
    					from SubServices
                        left outer join MainServices on MainServices.MainServiceId = SubServices.MainServiceId
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['SubServiceId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['SubServiceId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['SubServiceName']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['MainServiceName']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("SubServices", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Sub Services.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Sub Service found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    
    function getServices(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrOrderColumn[] = "ServiceId";
        $arrOrderColumn[] = "ServiceName";
        $arrOrderColumn[] = "SubServiceName";
        $arrOrderColumn[] = "Services.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterSubServiceId']))
            $strWhere .= " and Services.SubServiceId = '{$_REQUEST['nFilterSubServiceId']}'";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and ServiceName LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and Services.IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrOrderColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        ServiceId, ServiceName, SubServiceName, Services.IsActive
    					from Services
                        left outer join SubServices on SubServices.SubServiceId = Services.SubServiceId
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['ServiceId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['ServiceId'] . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['ServiceName']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['SubServiceName']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Services", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Services.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Service found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    
    function getServiceRates(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrOrderColumn[] = "ServiceRateId";
        $arrOrderColumn[] = "Rate";
        $arrOrderColumn[] = "ServiceName";
        $arrOrderColumn[] = "Companies.Name";
        $arrOrderColumn[] = "ServicesRates.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterServiceId']))
            $strWhere .= " and ServicesRates.ServiceId = '{$_REQUEST['nFilterServiceId']}'";
        if (!empty($_REQUEST['nFilterCompanyId']))
            $strWhere .= " and ServicesRates.CompanyId = '{$_REQUEST['nFilterCompanyId']}' ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and Rate = '{$_REQUEST['strFilterName']}' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and ServicesRates.IsActive = {$_REQUEST['bEnabled']} ";
        
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrOrderColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        Services.ServiceId, ServiceName, ServicesRates.IsActive, Companies.Name as Company, Rate, ServiceRateId
    					from ServicesRates
                        left outer join Services on Services.ServiceId = ServicesRates.ServiceId
                        left outer join Companies on Companies.CompanyId = ServicesRates.CompanyId
    			 		where $strWhere 
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['ServiceRateId']}'>";
                $html .= "<td class='text-right'>" . $rstRow['ServiceRateId'] . "</td>";
                $html .= "<td class='text-right'>" . ucwords($rstRow['Rate']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['ServiceName']) . "</td>";
                $html .= "<td class='text-left'>" . ucwords($rstRow['Company']) . "</td>";
                $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("ServicesRates", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } else
            $strPrev = "";
        
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
        
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Service Rates.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Service Rate found.</td>";
            $html .= "</tr>";
        }	
        
        return $html;
    }
    
    
    function getLocations(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "LocationId";
        $arrColumn[] = "Locations.Name";
        $arrColumn[] = "SubDepartments.Name";
        $arrColumn[] = "Locations.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterSubDeptId']))
            $strWhere .= " and Locations.SubDepartmentId = '{$_REQUEST['nFilterSubDeptId']}'";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and Locations.Name LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and Locations.IsActive = {$_REQUEST['bEnabled']} ";
                
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        LocationId, Locations.Name as Location, Locations.IsActive, SubDepartments.Name as SubDepartment
    					from Locations 
                        left outer join SubDepartments on SubDepartments.SubDepartmentId = Locations.SubDepartmentId
    			 		where $strWhere
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['LocationId']}'>";
            $html .= "<td class='text-right'>" . $rstRow['LocationId'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Location']) . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['SubDepartment']) . "</td>";
            $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Locations", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } 
        else
            $strPrev = "";
            
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
                    
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Locations.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Location found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
    function getConsultants(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "ConsultantId";
        $arrColumn[] = "Consultants.Name";
        $arrColumn[] = "Specialities.Name";
        $arrColumn[] = "Consultants.Email";
        $arrColumn[] = "Consultants.Mobile";
        $arrColumn[] = "Consultants.Address";
        $arrColumn[] = "Consultants.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterSpecialityId']))
            $strWhere .= " and Consultants.SpecialityId = '{$_REQUEST['nFilterSpecialityId']}'";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and Consultants.Name LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and Consultants.IsActive = {$_REQUEST['bEnabled']} ";
                
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        ConsultantId, Consultants.Name as Consultant, Consultants.IsActive, Specialities.Name as Speciality, Email, Address, Mobile
    					from Consultants 
                        left outer join Specialities on Specialities.SpecialityId = Consultants.SpecialityId
    			 		where $strWhere
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['ConsultantId']}'>";
            $html .= "<td class='text-right'>" . $rstRow['ConsultantId'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Consultant']) . "</td>";
            $html .= "<td class='text-center'>" . ucwords($rstRow['Speciality']) . "</td>";
            $html .= "<td class='text-center'>" . ucwords($rstRow['Email']) . "</td>";
            $html .= "<td class='text-right'>" . ucwords($rstRow['Mobile']) . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Address']) . "</td>";
            $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Consultants", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } 
        else
            $strPrev = "";
            
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
                    
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Consultants.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Consultant found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
    function getCompanies(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "CompanyId";
        $arrColumn[] = "Name";
        $arrColumn[] = "Address";
        $arrColumn[] = "PhoneNumber";
        $arrColumn[] = "Email";
        $arrColumn[] = "IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and Companies.Name LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and Companies.IsActive = {$_REQUEST['bEnabled']} ";
                
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        CompanyId, Name, IsActive, Address, PhoneNumber, Email
    					from Companies 
    			 		where $strWhere
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['CompanyId']}'>";
            $html .= "<td class='text-right'>" . $rstRow['CompanyId'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Name']) . "</td>";
            $html .= "<td class='text-left'>" . $rstRow['Email'] . "</td>";
            $html .= "<td class='text-right'>" . $rstRow['PhoneNumber'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Address']) . "</td>";
            $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Companies", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } 
        else
            $strPrev = "";
            
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
                    
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Companies.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Company found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
    function getPatientBillMaster(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "BillNumber";
        $arrColumn[] = "PatientBillMaster.AdmissionId";
        $arrColumn[] = "ApprovedBy";
        $arrColumn[] = "TotalNetAmount";
        $arrColumn[] = "PatientBillMaster.Remarks";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterApprovedBy']))
            $strWhere .= " and ApprovedBy LIKE '%{$_REQUEST['strFilterApprovedBy']}%' ";
        if (!empty($_REQUEST['strFilterRemarks']))
            $strWhere .= " and PatientBillMaster.Remarks LIKE '%{$_REQUEST['strFilterRemarks']}%' ";
        if (!empty($_REQUEST['nFilterTotalNetAmount']))
            $strWhere .= " and TotalNetAmount = '{$_REQUEST['nFilterTotalNetAmount']}' ";
        if (!empty($_REQUEST['nFilterAdmissionId']))
            $strWhere .= " and PatientBillMaster.AdmissionId = '{$_REQUEST['nFilterAdmissionId']}' ";
                
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        BillNumber, ApprovedBy, PatientBillMaster.Remarks, TotalNetAmount, PatientBillMaster.AdmissionId, Name
    					from PatientBillMaster 
                        left outer join Admissions on Admissions.AdmissionId = PatientBillMaster.AdmissionId
                        left outer join Patients on Patients.PatientId = Admissions.PatientId
    			 		where $strWhere
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['BillNumber']}'>";
            $html .= "<td class='text-right'>" . $rstRow['BillNumber'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Name']) . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['ApprovedBy']) . "</td>";
            $html .= "<td class='text-right'>" . number_format($rstRow['TotalNetAmount'], 2) . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Remarks']) . "</td>";
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
        
        $nTotalRec = RecCount("PatientBillMaster", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } 
        else
            $strPrev = "";
            
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
                    
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Patient Bill Master Record(s).</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Patient Bill Master Record found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
    function getWardTypes(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "WardTypeId";
        $arrColumn[] = "WardTypeName";
        $arrColumn[] = "IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and WardTypeName LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and WardTypes.IsActive = {$_REQUEST['bEnabled']} ";
                
        $strQuery = "select * from
					(
                        select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
                        WardTypeId, WardTypeName, IsActive
    					from WardTypes 
    			 		where $strWhere
					) x
					where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['WardTypeId']}'>";
            $html .= "<td class='text-right'>" . $rstRow['WardTypeId'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['WardTypeName']) . "</td>";
            $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("WardTypes", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        } 
        else
            $strPrev = "";
            
        $nNext = $nPage + 1;
        
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
                    
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec WardTypes.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No WardType found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
    
    
    function getWards(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "WardId";
        $arrColumn[] = "WardName";
        $arrColumn[] = "WardTypeName";
        $arrColumn[] = "Wards.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterWardTypeId']))
            $strWhere .= " and Wards.WardTypeId = '{$_REQUEST['nFilterWardTypeId']}'";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and WardName LIKE '%{$_REQUEST['strFilterName']}%' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and Wards.IsActive = {$_REQUEST['bEnabled']} ";
            
        $strQuery = "select * from
		(
            select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
            WardId, WardName, WardTypeName, Wards.IsActive
			from Wards
            left outer join WardTypes on WardTypes.WardTypeId = Wards.WardTypeId
	 		where $strWhere
		) x
		where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['WardId']}'>";
            $html .= "<td class='text-right'>" . $rstRow['WardId'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['WardName']) . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['WardTypeName']) . "</td>";
            $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Wards", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        }
        else
            $strPrev = "";
                        
        $nNext = $nPage + 1;
            
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
            
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Wards.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Ward found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
    
    function getBeds(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "BedId";
        $arrColumn[] = "BedNo";
        $arrColumn[] = "WardName";
        $arrColumn[] = "Beds.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['nFilterWardId']))
            $strWhere .= " and Beds.WardId = '{$_REQUEST['nFilterWardId']}'";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and BedNo = '{$_REQUEST['strFilterName']}' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and Beds.IsActive = {$_REQUEST['bEnabled']} ";
            
        $strQuery = "select * from
		(
            select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
            BedId, BedNo, WardName, Beds.IsActive
			from Beds
            left outer join Wards on Wards.WardId = Beds.WardId
	 		where $strWhere
		) x
		where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            
            $html .= "<tr id='{$rstRow['BedId']}'>";
            $html .= "<td class='text-right'>" . $rstRow['BedId'] . "</td>";
            $html .= "<td class='text-right'>" . ucwords($rstRow['BedNo']) . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['WardName']) . "</td>";
            $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("Beds", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        }
        else
            $strPrev = "";
                        
        $nNext = $nPage + 1;
            
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
            
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Beds.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Bed found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
    function getMedicalDepartments(){
        global $conn;
        
        $nRowsPerPage = 20;
        $nPage = empty($_REQUEST['nPage']) ? 1 : $_REQUEST['nPage'];
        $nFrom = 1 + (($nPage-1) * $nRowsPerPage);
        $nTo = ($nFrom + $nRowsPerPage) - 1;
        
        $arrColumn[] = "MedicalDeptId";
        $arrColumn[] = "Name";
        $arrColumn[] = "Fees";
        $arrColumn[] = "RoomNo";
        $arrColumn[] = "MedicalDepartments.IsActive";
        $arrColumn[] = "MedicalDepartments.IsActive";
        
        $strWhere = " 1=1 ";
        if (!empty($_REQUEST['strFilterName']))
            $strWhere .= " and Name = '{$_REQUEST['strFilterName']}' ";
        if (isset($_REQUEST['bEnabled']) && $_REQUEST['bEnabled'] != "")
            $strWhere .= " and MedicalDepartments.IsActive = {$_REQUEST['bEnabled']} ";
            
        $strQuery = "select * from
		(
            select ROW_NUMBER() OVER (order by {$arrColumn[$_REQUEST['strSortColumnIndex']]} {$_REQUEST['strSortOrder']})  AS rowNum,
            MedicalDeptId, Name, Fees, MedicalDepartments.IsActive, RoomNo, Mon, Tue, Wed, Thu, Fri, Sat, Sun
			from MedicalDepartments
	 		where $strWhere
		) x
		where rowNum between $nFrom and $nTo";
        $nResult = odbc_exec($conn, $strQuery);
        $i = 0;
        while ($rstRow = odbc_fetch_array($nResult)){
            $strWeekDays = null;
            
            if($rstRow['Mon'])
                $strWeekDays .= "Monday" . ", "; 
            if($rstRow['Tue'])
                $strWeekDays .= "Tuesday" . ", "; 
            if($rstRow['Wed'])
                $strWeekDays .= "Wednesday" . ", "; 
            if($rstRow['Thu'])
                $strWeekDays .= "Thursday" . ", "; 
            if($rstRow['Fri'])
                $strWeekDays .= "Friday" . ", "; 
            if($rstRow['Sat'])
                $strWeekDays .= "Saturday" . ", "; 
            if($rstRow['Sun'])
                $strWeekDays .= "Sunday" . ", "; 
            
            $strWeekDays = substr($strWeekDays, 0, -2);
            
            $html .= "<tr id='{$rstRow['MedicalDeptId']}'>";
            $html .= "<td class='text-right'>" . $rstRow['MedicalDeptId'] . "</td>";
            $html .= "<td class='text-left'>" . ucwords($rstRow['Name']) . "</td>";
            $html .= "<td class='text-right'>" . ucwords($rstRow['Fees']) . "</td>";
            $html .= "<td class='text-right'>" . ucwords($rstRow['RoomNo']) . "</td>";
            $html .= "<td class='text-left'>" . ucwords($strWeekDays) . "</td>";
            $html .= "<td class='text-center'>" . IsActive($rstRow['IsActive']) . "</td>";
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
        
        $nTotalRec = RecCount("MedicalDepartments", $strWhere);
        
        if ($nPage > 1) {
            $nLast = $nPage - 1;
            $strPrev = "<button class='btn btn-primary' onClick='return getList($nLast, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'><< Back</button>";
        }
        else
            $strPrev = "";
                        
        $nNext = $nPage + 1;
            
        if ($nTotalRec <= $nEndRec)
            $strNext = "";
        else
            $strNext = "<button class='btn btn-primary' onClick='return getList($nNext, $(&quot;#strOrderColumn&quot;).val(), $(&quot;#strSortOrder&quot;).val(), false);'>Next >></button>";
            
        if ($nTotalRec > 0) {
            $html .= "<tr>";
            $html .= "	<td colspan='100'><div class='pull-left'>Showing $nStartRec to $nEndRec results of $nTotalRec Medical Departments.</div><div class='pull-right'>$strPrev &nbsp; $strNext</div></td>";
            $html .= "</tr>";
        } else {
            $html .= "<tr>";
            $html .= "	<td colspan='100' class='text-left'>No Medical Department found.</td>";
            $html .= "</tr>";
        }
        
        return $html;
    }
    
?>