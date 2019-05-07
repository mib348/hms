<?php
 	//error_reporting(E_ALL);
 	ini_set('display_errors',0);	
	
// 	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	clearstatcache();
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	define("INCLUDED_DEFS", 1);
	//	ini_set("register_globals", 1);
	session_start();

	include_once('config.php');
	include_once('cssandscripts.php');

	// check login before calling the api
// 	if($_SESSION['loggedin'] != true)
// 		return array("status" => false, "message" => "you are not login or authorised to access this.");

    //API SECURITY ROUTING
//     if ($_REQUEST['bErrorRouting'] == 1)
//         header("Location: index.php");
    if (($folders[5] == "backend") && empty($_SERVER['HTTP_REFERER'])) {
        $_SESSION['nUserId'] = null;
        header("Location: {$strLibPath}");
    }

	/*	the function remove single quote from the string
		and replace it with two single quotes

		strString:		string to be fixed
		returns:		fixed string
	*/
	function FixString($strString)
	{
		$strString = str_replace("'", "''", $strString);
		$strString = str_replace("\'", "'", $strString);
		
		return $strString;
	}

	/*	the function returns true if strString contains
		strFindWhat within itself otherwise it returns
		false

		strString:		string to be searched in
		strFindWhat:	string to be searched
		returns:		true if found, flase otherwise
	*/
	function HasString($strString, $strFindWhat)
	{
		$nPos = strpos($strString, $strFindWhat);
		
		if (!is_integer($nPos)) 
			return false;
		else
			return true;
	}


	// the function returns the assocatied array containing
	// the field name and field value pair for record.
	//
	// strTable:		table name.
	// strCriteria:		where criteria
	//
	function GetRecord($strTable, $strCriteria)
	{
		global $conn;
		$strQuery = "select * from $strTable ";

		if(!empty($strCriteria))
			$strQuery .= "where $strCriteria;";
			
// 		echo $strQuery;exit();
		$nResult = odbc_exec($conn, $strQuery);
		return odbc_fetch_array($nResult);
	}

	/*	the function deletes the record from the
		given table.

		strTable:		table name.
		strCriteria:	where criteria
	*/
	function DeleteRec($strTable, $strCriteria)
	{
		global $conn;
		$strQuery = "delete from $strTable where $strCriteria";	
		$nResult = odbc_exec($conn, $strQuery);
	}
	
	
	/*	the function insert a record in strTable with
		the values given by the associated array

		strTable:		table name where record will be inserted
		arrValue:		assoicated array with key-val pairs
		returns:		ID of the record inserted
	*/
	function InsertRec($strTable, $arrValue)
	{
		global $conn;
		$strQuery = "	insert into $strTable (";

		reset($arrValue);
		while(list ($strKey, $strVal) = each($arrValue))
		{
			$strQuery .= $strKey . ",";
		}

		// remove last comma
		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);
		$strQuery .= ") values (";

		reset($arrValue);
		while(list ($strKey, $strVal) = each($arrValue))
		{
			$strQuery .= "'" . FixString($strVal) . "',";
		}

		// remove last comma
		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);
		$strQuery .= ");";				
		
		// execute query
		odbc_exec($conn, $strQuery);
		
		// return id of last insert record
		$nResult = odbc_exec($conn, "SELECT @@Identity as LASTID");
		$rstRow = odbc_fetch_array($nResult);
		return $rstRow['LASTID'];
	}
	
	/* the function updates the given table.
	
		strTable:		table name to be updates.
		strWhere:		where clause for record selection.
		arrValue:		an associated array with key-value of fields
						to be updated.
	*/
	function UpdateRec($strTable, $strWhere, $arrValue)
	{
		global $conn;
		$strQuery = "	update $strTable set ";

		reset($arrValue);

		while (list ($strKey, $strVal) = each ($arrValue))
		{
			$strQuery .= $strKey . "='" . FixString($strVal) . "',";
		}

		// remove last comma
		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);

		$strQuery .= " where $strWhere;";

		// execute query
		odbc_exec($conn, $strQuery);	
	}

	// find the number of records in a table
	//
	// strTable:		name of table to count records in.
	// strCriteria:		select criteria,
	//					if this is not passed, returns the number of all
	//					rows in the table
	// returns:			number of rows in the table
	//
	function RecCount($strTable, $strCriteria = "")
	{
		global $conn;
		
		if(empty($strCriteria))
			$strQuery = "select count(*) as cnt from $strTable;";
		else
			$strQuery = "select count(*) as cnt from $strTable where $strCriteria;";

		// echo $strQuery;
		$nResult = odbc_exec($conn, $strQuery);
		$rstRow = odbc_fetch_array($nResult);
		return $rstRow["cnt"];
	}


	

	// the displays a text field in HTML row with two columns in it.
	// left column contains label and right column contains the
	// text field.
	//
	// strLabel:			Label in left column.
	// strField:			Text field name in form.
	// strValue:			Value to be shown in text field.
	// nSize:				Size attribute of text field.
	// nMaxLength:			Max length attribute of text field.
	// bPassword:			1 if to be displayed as password, 0 as text
	// strExtra				to write some thing extra like some onClick="alert('I'm Good')"
	//
	function TextField($strLabel, $strField, $strValue, $nSize, $nMaxLength, $bPassword, $strExtra="")
	{
		echo "<tr>";
		echo "	<td  valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";
		
		if($bPassword)
			echo "		<input type=password id=$strField name=$strField value=\"$strValue\" size=$nSize maxlength=$nMaxLength $strExtra>";
		else
			echo "		<input type=text id=$strField name=$strField value=\"$strValue\" size=$nSize maxlength=$nMaxLength $strExtra>";
		
		echo "	</td>";
		echo "</tr>";
	}
	
	function TextFieldArray($strLabel, $strFieldName, $strFieldID, $strValue, $nSize, $nMaxLength, $bPassword, $strExtra="")
	{
		echo "<tr>";
		echo "	<td  valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";
		
		if($bPassword)
			echo "		<input type=password id=$strFieldID name=$strFieldName value=\"$strValue\" size=$nSize maxlength=$nMaxLength $strExtra>";
		else
			echo "		<input type=text id=$strFieldID name=$strFieldName value=\"$strValue\" size=$nSize maxlength=$nMaxLength $strExtra>";
		
		echo "	</td>";
		echo "</tr>";
	}
	
	/*
		the function draws a check box in the form
		
		strLabel:			label in the left column
		strName:			name of check box in HTML form
		nChecked:			if true, checkbox will appear checked
							otherwise it appears unchecked
	*/
	function CheckBox($strLabel, $strName, $nChecked = false)
	{
		echo "<tr><td></td><td>";
		
		if($nChecked == true)
			echo "<input type=checkbox name=$strName CHECKED> $strLabel";
		else
			echo "<input type=checkbox name=$strName> $strLabel";
		
		echo "</td></tr>";
	}
	
	/*
		the function draws a 4 check box in the for
		
		strLabel:			label in the left column
		strName:			name of check box in HTML form
		nChecked:			if true, checkbox will appear checked
							otherwise it appears unchecked
	*/
	function CheckBox4($strLabel, $strName, $nChecked = false)
	{
		echo "<tr>
				<td>
					$strLabel
				</td>";
		
		if($nChecked == true)
		{
			echo "<td><input type=checkbox name= ".$strName ."_view CHECKED></td> ";
			echo "<td><input type=checkbox name= ".$strName ."_edit CHECKED></td> ";
			echo "<td><input type=checkbox name= ".$strName ."_delete CHECKED></td> ";
			echo "<td><input type=checkbox name= ".$strName ."_add CHECKED></td> ";
		}	
		else
		{
			echo "<td><input type=checkbox name= ".$strName. "_view ></td>";
			echo "<td><input type=checkbox name= ".$strName. "_edit ></td>";
			echo "<td><input type=checkbox name= ".$strName. "_delete ></td>";
			echo "<td><input type=checkbox name= ".$strName. "_add ></td>";
		}
		echo "</tr>";
	}

	//end of check box
	
	function ReadOnlyField($strLabel, $strField, $strValue, $nSize, $nMaxLength, $strExtra="")
	{
		echo "<tr>";
		echo "	<td>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";
		echo "		<input type=text name=$strField value=\"$strValue\" size=$nSize maxlength=$nMaxLength $strExtra READONLY>";		
		echo "	</td>";
		echo "</tr>";
	}


	// the displays a read only text field for as date field in HTML row with two columns in it.
	// left column contains label and right column contains the
	// text field.
	//

	// strLabel:			Label in left column.
	// strField:			Text field name in form.
	// strValue:			Value to be shown in text field.
	// nSize:				Size attribute of text field.
	// nMaxLength:			Max length attribute of text field.
	// strFormName:			Name of HTML form	
	//
	function DateField($strLabel, $strField, $strValue, $nSize, $nMaxLength, $strFormName)
	{
		$strUnique = time();
		echo "<tr>";
		echo "	<td>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";
		
		echo  "		
				<input type=text name='$strField' value='$strValue' size=$nSize maxlength=$nMaxLength readonly>
				<a href=\"JavaScript: CalPop_".$strUnique."('document.$strFormName.$strField');\"><img src='/images/ico-cal.gif' border=0></a>
			<script>
				function CalPop_".$strUnique."(sInputName)
				{
					window.open('/include/code/calender.php?strFieldName=' + escape(sInputName) , 'CalPop', 'toolbar=0,width=240,height=215');
				}
			</script>
			";
		
		echo "	</td>";
		echo "</tr>";
	}
	
	function CalendarWithoutTable($strField, $strDate="")
	{
		$myCalendar = new tc_calendar($strField);
		$myCalendar->setIcon("calendar/iconCalendar.gif");
		
		if(empty($strDate))
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
		else
		{
			$arr = explode("-", $strDate);
			$myCalendar->setDate($arr[2], $arr[1], $arr[0]);
		}
		
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2030);
		$myCalendar->dateAllow(date("2000-01-01"), '2030-12-31', false);
		$myCalendar->startMonday(true);
		$myCalendar->disabledDay("Fri");
		$myCalendar->writeScript();
	}
	
	// Display the inline calendar control
	function Calendar($strLabel, $strField, $strDate="")
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";

		CalendarWithoutTable($strField, $strDate);

		echo "	</td>";
		echo "</tr>";
	}
	
	// Same as Calendar() except that it submits to form URL 
	// when a date is selected.
	function CalendarAutoSubmit($strLabel, $strField, $strForm, $strDate="")
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";

		$myCalendar = new tc_calendar($strField);
		$myCalendar->setIcon("images/iconCalendar.gif");
		
		if(empty($strDate))
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
		else
		{
			$arr = explode("-", $strDate);
			$myCalendar->setDate($arr[2], $arr[1], $arr[0]);
		}
		
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2020);
		$myCalendar->dateAllow('2008-05-13', '2015-03-01', false);
		$myCalendar->startMonday(true);
		$myCalendar->disabledDay("Fri");
		$myCalendar->autoSubmit(true, $strForm);
		$myCalendar->writeScript();

		echo "	</td>";
		echo "</tr>";
	}
	
	/*	the function displays OK and Cancel buttons in the form

	*/
	function OKCancelButtons()
	{
		echo "<tr>";
		echo "	<td></td>";
		echo "	<td>";
		echo "		<input type=submit id='ok-button' value='   OK   '>";
		echo "</tr>";
	}

	/*	the function creates an hidden field
		
		strName:		name of hidden field
		strValue:		value to be passed in hidden field
	*/
	function HiddenField($strName, $strValue)
	{
		echo "<input type=hidden id='$strName' name='$strName' value='$strValue'>\r\n";
	}

	/*	the function creates a text area
		
		strLabel:			Label in left column.
		strField:			Text field name in form.
		strValue:			Value to be shown in text field.
		nRows:				number of rows in text area
		nCols:				number of columsn in text area
	*/	
	function TextArea($strLabel, $strField, $strValue, $nRows, $nCols, $strStyle="")
	{
		echo "<tr>";
		echo "	<td valign=top style='vertical-align:top;'>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";		
		echo "		<textarea id=$strField name=$strField rows=$nRows cols=$nCols style=$strStyle>$strValue</textarea>";
		
		echo "	</td>";
		echo "</tr>";
	}
	
	function ReadOnlyTextArea($strLabel, $strField, $strValue, $nRows, $nCols)
	{
		echo "<tr>";
		echo "	<td valign=top style='vertical-align:top;'>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";		
		echo "		<textarea id=$strField name=$strField rows=$nRows cols=$nCols readonly='readonly'>$strValue</textarea>";
		
		echo "	</td>";
		echo "</tr>";
	}


	/*
		the function displays combox box

		nSelectedVal:		index of selected value
		arr:				array containig items to be displayed
		bIndexValue:		true: use array index as item value e.g: 0, 1, 2, ...
							false: use array value as item value e.g: 2003, 2004, 2005, ...
	*/
	function ComboBox($nSelectedVal, $arr, $bIndexValue)
	{
		for($i=0; $i < sizeof($arr); $i++)
		{
			$j = $i+1;
			
			if($bIndexValue)
				if($j == $nSelectedVal)
					echo "<option value=$j selected>" . $arr[$i]  . PHP_EOL;
				else
					echo "<option value=$j>" . $arr[$i]  . PHP_EOL;
			else
				if($nSelectedVal == $arr[$i])
					echo "<option selected>" . $arr[$i]  . PHP_EOL;
				else
					echo "<option>" . $arr[$i]  . PHP_EOL;
		}
	}
	
	/*
		the function draws combo box fitted in table row by
		using the function ComboBox();
	*/
	function ArrayComboBox($strLable, $strName, $nSelectedVal, $arr, $bIndexValue, $strOnChange = "", $strStyle)
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLable;
		echo "	</td>";
		echo "	<td>";
		if(empty($strOnChange))
			echo "		<select name=$strName id=$strName style='$strStyle'>";
		else
			echo "<select name=$strName id=$strName onChange=\"javascript: $strOnChange\" style='$strStyle'><br>";
		ComboBox($nSelectedVal, $arr, $bIndexValue);
		echo "		</select>";
		echo "	</td>";
		echo "</tr>";	
	}
	
	function ArrayComboBoxWithoutLabel($strName, $nSelectedVal, $arr, $bIndexValue, $strOnChange = "", $strStyle, $strFirstItem = "", $bMultiSelect = false, $strClass = "", $strAttribute="")
	{
		if($bMultiSelect)
			$strMultiSelect = " data-placeholder=\"--- Select ---\" class=\"chosen-select\" multiple ";
	
		if(empty($strOnChange))
			echo "<select name='$strName' $strMultiSelect id='$strName' style='$strStyle' class='$strClass' $strAttribute>" . PHP_EOL;
		else
			echo "<select name='$strName' $strMultiSelect id='$strName' onChange=\"javascript: $strOnChange\" style='$strStyle' class='$strClass' $strAttribute>" . PHP_EOL;
			
		if(!empty($strFirstItem))
			echo "<option value=''>$strFirstItem</option>" . PHP_EOL;

		ComboBox($nSelectedVal, $arr, $bIndexValue);
		echo "</select>";
	}	
	
	/*
		the function draws multi list of combo box fitted in table row by
		using the function ComboBox();
	*/
	function MultiListArrayComboBox($strLable, $strName, $nSelectedVal, $arr, $bIndexValue, $strOnChange = "", $strStyle)
	{
		echo "<tr>";
		echo "	<td valign=top style='vertical-align:top;'>";
		echo		$strLable;
		echo "	</td>";
		echo "	<td>";
		if(empty($strOnChange))
			echo "		<select name=$strName id=$strName style=\"$strStyle\" multiple>";
		else
			echo "<select name=$strName id=$strName onChange=\"javascript: $strOnChange\"><br>";
		ComboBox($nSelectedVal, $arr, $bIndexValue);
		echo "		</select>";
		echo "	</td>";
		echo "</tr>";	
	}
	
	
	/*
		the function shows the date combo box
	*/
	function DateCombo($strLabel, $strField, $strDate = "")
	{
		echo "<tr>";
		echo "	<td valign=middle>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";		

		if(empty($strDate))
			$strDate = date("Y-m-d");
			
		$strDate = strtok($strDate, " ");
		
		$strYr = strtok($strDate, "-");
		$strMn = strtok("-");
		$strDy = strtok("-");
		
		$arrYr = array();

	//	for($i = $strYr-50; $i <= ($strYr+5); $i++)
		for($i = 1920; $i <= 2020; $i++)
			array_push($arrYr, $i);

		$arrDay = array();
		for($i = 1; $i <= 31; $i++)
			array_push($arrDay, sprintf("%02d",$i));
		
		$strTemp = $strField . "Year";
		echo "<select id='$strTemp' name=$strTemp>";
		ComboBox($strYr, $arrYr, false);
		echo "</select> ";

		$strTemp = $strField . "Month";
		echo "<select id='$strTemp' name=$strTemp>";
		$arr = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		ComboBox($strMn, $arr, true);
		echo "</select> ";

		$strTemp = $strField . "Date";
		echo "<select id='$strTemp' name=$strTemp>";
		ComboBox($strDy, $arrDay, false);
		echo "</select>";

		echo "	</td>";
		echo "</tr>";
	}

	/*
		the function shows time combox with first combo of hours and
		second combo of minutes.

		strTime:		time to show in combo
						Format: hh:mm[:ss]
	*/
	function TimeCombo($strLabel, $strField, $strTime)
	{
		$nHr = strtok($strTime, ":");
		$nMn = strtok(":");

		$arrHr = array();
		for($i = 0; $i <= 23; $i++)
			array_push($arrHr, $i);

		$strHr = $strField . "Hr";

		$arrMn = array();
		for($i = 0; $i <= 59; $i += 5)
			array_push($arrMn, $i);
		
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";
		echo "<select name=$strHr>";
		ComboBox(-1, $arrHr, true);
		echo "</select>";
		echo "<select name=$strMn>";
		ComboBox(-1, $arrMn, true);
		echo "</select>";
		echo "	</td>";
		echo "</tr>";
	}

	/*
		the function shows a combo box with values from a table

		strTable:			table name
		strDispField:		field name to show
		strIDField:			id field name
		strCriteria:		select criteria for where clause
		strName:			combo name
		nSelId:				id of selected record
		strOnChange			JS to be executed onChange event
		strFirstItem		complete html code for the first item in combo (for: All or <blank>)
		strCSS				CSS for <select>
	*/
	
	function TableComboMsSql($strTable, $strDispField, $strIDField, $strCriteria, $strName, $nSelId, $strOnChange = "", $strFirstItem = "", $strCSS="", $strClass="", $strAttribute="")
	{
		global $conn;
		
		// this handles when more than one fields are getting concatinated for display in combo
		$strKey = "defs_disp_field";
		$strDispField .= " as " . $strKey;
		
		if(empty($strCriteria))
			$strQuery = "select $strDispField, $strIDField from $strTable";
		else
			$strQuery = "select $strDispField, $strIDField from $strTable where $strCriteria";

		$nResult = odbc_exec($conn, $strQuery);
		if(empty($strOnChange))
			echo "<select name='$strName' id='$strName' style='$strCSS' class='$strClass' $strAttribute>" . PHP_EOL;
		else
			echo "<select name='$strName' id='$strName' style='$strCSS' class='$strClass' onChange=\"javascript: $strOnChange\" $strAttribute>" . PHP_EOL;
			
		if(!empty($strFirstItem)) echo "<option value=''>$strFirstItem</option>" . PHP_EOL;

		while($rstRow = odbc_fetch_array($nResult))
		{
			$nID = $rstRow[$strIDField];

			if($nID == $nSelId)
				echo "<option value=$nID selected>" . $rstRow[$strKey] . PHP_EOL;
			else
				echo "<option value=$nID>" . $rstRow[$strKey] . PHP_EOL;
		}
		
		echo "</select>" . PHP_EOL;
	}
	
	function TableComboMsSqlOptGroup($strTable, $strDispField, $strIDField, $nParentIdField, $strCriteria, $strName, $nSelId, $strOnChange = "", $strFirstItem = "", $strCSS="", $strClass="", $strAttribute="")
	{
		global $conn;
		$bGroupOpen = false;
		
		// this handles when more than one fields are getting concatinated for display in combo
		$strKey = "defs_disp_field";
		$strDispField .= " as " . $strKey;
		
		if(empty($strCriteria))
			$strQuery = "select $strDispField, $strIDField, $nParentIdField from $strTable";
		else
			$strQuery = "select $strDispField, $strIDField, $nParentIdField from $strTable where $strCriteria";

		$nResult = odbc_exec($conn, $strQuery);
		if(empty($strOnChange))
			echo "<select name='$strName' id='$strName' style='$strCSS' class='$strClass' $strAttribute>" . PHP_EOL;
		else
			echo "<select name='$strName' id='$strName' style='$strCSS' class='$strClass' onChange=\"javascript: $strOnChange\" $strAttribute>" . PHP_EOL;
			
		if(!empty($strFirstItem)) echo "<option value=''>$strFirstItem</option>" . PHP_EOL;

		while($rstRow = odbc_fetch_array($nResult))
		{
			$nID = $rstRow[$strIDField];
			$nParentId = $rstRow[$nParentIdField];
			
			if($nParentId == "-1") // if this is control account
			{
				if($bGroupOpen) echo "</optgroup>";
				
				echo "<optgroup label='{$rstRow[$strKey]}'>\r\n";
			
				$bGroupOpen = true;
			}
			else{
				if ($nParentId == "0" || empty($nParentId)){
					if($bGroupOpen)
						echo "</optgroup>";
					$bGroupOpen = false;
				}
				if($nID == $nSelId)
					echo "<option value=$nID selected>" . $rstRow[$strKey] . PHP_EOL;
				else
					echo "<option value=$nID>" . $rstRow[$strKey] . PHP_EOL;
			}
			
		}

		if($bGroupOpen) echo "</optgroup>\r\n";
		echo "</select>" . PHP_EOL;
	}
	
	function TableComboMsSqlOptGroupOrdered1Level($strTable, $strDispField, $strIDField, $nParentIdField, $strCriteria, $strName, $nSelId, $strOnChange = "", $strFirstItem = "", $strCSS="", $strClass="", $strAttribute="")
	{
		global $conn;
		$bGroupOpen = false;
		
		// this handles when more than one fields are getting concatinated for display in combo
		$strKey = "defs_disp_field";
		$strDispField .= " as " . $strKey;
		
		if(empty($strCriteria))
			$strQuery = "select $strDispField, $strIDField, $nParentIdField from $strTable";
		else
			$strQuery = "select $strDispField, $strIDField, $nParentIdField from $strTable where $strCriteria";

		$nResult = odbc_exec($conn, $strQuery);
		if(empty($strOnChange))
			echo "<select name='$strName' id='$strName' style='$strCSS' class='$strClass' $strAttribute>" . PHP_EOL;
		else
			echo "<select name='$strName' id='$strName' style='$strCSS' class='$strClass' onChange=\"javascript: $strOnChange\" $strAttribute>" . PHP_EOL;
			
		if(!empty($strFirstItem)) echo "<option value=''>$strFirstItem</option>" . PHP_EOL;

		while($rstRow = odbc_fetch_array($nResult))
		{
			$nID = $rstRow[$strIDField];
			$nParentId = $rstRow[$nParentIdField];
			
			$nChildCount = RecCount($strTable," $nParentIdField = '$nID'");
			if ($nChildCount > 0){
				echo "<optgroup label='{$rstRow[$strKey]}'>\r\n";
					$strQuery2 = "select $strDispField, $strIDField, $nParentIdField from $strTable where $nParentIdField = '$nID'";
					$nResult2 = odbc_exec($conn, $strQuery2);
					while($rstRow2 = odbc_fetch_array($nResult2))
					{
						$nID = $rstRow2[$strIDField];
						if($nID == $nSelId)
							echo "<option value=$nID selected>" . $rstRow2[$strKey] . PHP_EOL;
						else
							echo "<option value=$nID>" . $rstRow2[$strKey] . PHP_EOL;
					}
				echo "</optgroup>";
			}
			else{
				if($nID == $nSelId)
					echo "<option value=$nID selected>" . $rstRow[$strKey] . PHP_EOL;
				else
					echo "<option value=$nID>" . $rstRow[$strKey] . PHP_EOL;
			}
		}

		echo "</select>" . PHP_EOL;
	}

	/*
		the function creates radio buttons group

		strLabel:		lable to be shown in the right cell
		arrButtons:		the lables to be shown along radio buttons
		strName:		form name for the button group
		nSelIndex:		index of selected button
	*/
	function RadioButtons($strLabel, $arrButtons, $strName, $nSelIndex = -1)
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";

		for($i=0; $i<sizeof($arrButtons); $i++)
			if($i == $nSelIndex)
				echo "<input type=radio value=$i name=$strName checked> &nbsp;" . $arrButtons[$i] . "<br>";	
			else
				echo "<input type=radio value=$i name=$strName> &nbsp;" . $arrButtons[$i] . "<br>";	

		echo "	</td>";
		echo "</tr>";
	}

	/*
		show text in left and right cells of table

		strLeft:		text to appear in left cell
		strRight:		text to appera in right cell
	*/
	function TextCells($strLeft, $strRight)
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLeft;
		echo "	</td>";
		echo "	<td valign=top>";
		echo		$strRight;
		echo "	</td>";
		echo "</tr>\r\n";
	}

	/*
		the function converts data format from SQL data format
		to Month date, Year format e.g November 18, 2003
	*/
	function ConvertDateFormat($strDate, $strFormat = "M j, Y")
	{
		return date($strFormat, strtotime($strDate));
	}


	// send mail in HTML format
	function SendMail($strTo, $strSubject, $strBody)
	{
		global $strMailFrom;
		global $strMailReplyTo;
	
		$strHeaders = "MIME-Version: 1.0\n";
		$strHeaders .= "Content-type: text/html; charset: utf8\n";
		$strHeaders .= "From: $strMailFrom\n";
		$strHeaders .= "Reply-to: $strMailReplyTo\n";
	
		return mail($strTo, $strSubject, $strBody, $strHeaders);
	}

	// function returns the index of given strValue in array arrArray
	// returns -1 if no match found.
	function GetArrayIndex($arrArray, $strValue)
	{
		for($i=0; $i<count($arrArray); $i++)
			if($arrArray[$i] == $strValue)
				return $i;
				
		return -1;
	}
	
	function GetField($strTable, $strField, $strWhere)
	{
		$rstRow = GetRecord($strTable, $strWhere);
		return $rstRow[$strField];
	}	

	
	// return date difference in year, months and days
	function DateDifference($date1, $date2)
	{
		$diff = abs(strtotime($date2) - strtotime($date1));
		
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		
		return "$years Y $months M $days D";
	}
	
	function facebook_time_difference($created_time)
	{
		$str = strtotime($created_time);
		$today = strtotime(date('Y-m-d H:i:s'));

		// It returns the time difference in Seconds...
		$time_differnce = $today-$str;

		// To Calculate the time difference in Years...
		$years = 60*60*24*365;

		// To Calculate the time difference in Months...
		$months = 60*60*24*30;

		// To Calculate the time difference in Days...
		$days = 60*60*24;

		// To Calculate the time difference in Hours...
		$hours = 60*60;

		// To Calculate the time difference in Minutes...
		$minutes = 60;

		if(intval($time_differnce/$years) > 1)
		{
			return intval($time_differnce/$years)." years ago";
		}else if(intval($time_differnce/$years) > 0)
		{
			return intval($time_differnce/$years)." year ago";
		}else if(intval($time_differnce/$months) > 1)
		{
			return intval($time_differnce/$months)." months ago";
		}else if(intval(($time_differnce/$months)) > 0)
		{
			return intval(($time_differnce/$months))." month ago";
		}else if(intval(($time_differnce/$days)) > 1)
		{
			return intval(($time_differnce/$days))." days ago";
		}else if (intval(($time_differnce/$days)) > 0) 
		{
			return intval(($time_differnce/$days))." day ago";
		}else if (intval(($time_differnce/$hours)) > 1) 
		{
			return intval(($time_differnce/$hours))." hours ago";
		}else if (intval(($time_differnce/$hours)) > 0) 
		{
			return intval(($time_differnce/$hours))." hour ago";
		}else if (intval(($time_differnce/$minutes)) > 1) 
		{
			return intval(($time_differnce/$minutes))." minutes ago";
		}else if (intval(($time_differnce/$minutes)) > 0) 
		{
			return intval(($time_differnce/$minutes))." minute ago";
		}else if (intval(($time_differnce)) > 1) 
		{
			return intval(($time_differnce))." seconds ago";
		}else
		{
			return "few seconds ago";
		}
	}	
	

	function IndexTo24Time($nIndex)
	{
		global $arrTime;
		
		$t = strtotime("1970-01-01 " . $arrTime[$nIndex-1]);
		return date("H:i:s", $t);
	}
	
	function Time24HrtoIndex($strTime)
	{
		$t = strtotime("1970-01-01 " . $strTime);
		return ($t - 7200) / 900;
	}
	
	function startsWith($haystack, $needle)
	{
		return !strncmp($haystack, $needle, strlen($needle));
	}
	
	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) return true;

		return (substr($haystack, -$length) === $needle);
	}

    //function that returns part of string after specified sub-string
    function strafter($string, $substring) {
    	$pos = strpos($string, $substring);
    	if ($pos === false)
    		return $string;
    	else
    		return(substr($string, $pos+strlen($substring)));
    }
    
    //function that returns part of string before specified sub-string
    function strbefore($string, $substring) {
    	$pos = strpos($string, $substring);
    	if ($pos === false)
    		return $string;
    	else
    		return(substr($string, 0, $pos));
    }
    
    function contains_date($str)
    {
    	if (preg_match('/\b(\d{4})-(\d{2})-(\d{2})\b/', $str, $matches))
    	{
    		if (checkdate($matches[2], $matches[3], $matches[1]))
    		{
    			return true;
    		}
    	}
    	return false;
    }
    
    function formatSizeUnits($bytes)
    {
    	if ($bytes >= 1073741824)
    	{
    		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
    	}
    	elseif ($bytes >= 1048576)
    	{
    		$bytes = number_format($bytes / 1048576, 2) . ' MB';
    	}
    	elseif ($bytes >= 1024)
    	{
    		$bytes = number_format($bytes / 1024, 2) . ' KB';
    	}
    	elseif ($bytes > 1)
    	{
    		$bytes = $bytes . ' bytes';
    	}
    	elseif ($bytes == 1)
    	{
    		$bytes = $bytes . ' byte';
    	}
    	else
    	{
    		$bytes = '0 bytes';
    	}
    
    	return $bytes;
    }
    
    function writeExelFile($filename,$ar_data)
    {
    	require_once 'Classes/PHPExcel.php';
    	$pExcel = new PHPExcel();
    	$pExcel->setActiveSheetIndex(0);
    	$aSheet = $pExcel->getActiveSheet();
    	$writer_i=0;
    	foreach($ar_data as $ar)
    	{
    		$j=0;
    		foreach($ar as $val)
    		{
    			$aSheet->setCellValueByColumnAndRow($j,$writer_i,$val);
    			$j++;
    		}
    		$writer_i++;
    	}
    	$objWriter = new PHPExcel_Writer_Excel5($pExcel);
    	header('Content-Type: application/vnd.ms-excel');
    	header("Content-Disposition: attachment;filename=".$filename."");
    	header('Cache-Control: max-age=0');
    	$objWriter->save('php://output');
    }
    
    function time_difference($created_time)
    {
    	$str = strtotime($created_time);
    	$today = strtotime(date('Y-m-d H:i:s'));
    	$time_differnce = $today-$str;
    	$years = 60*60*24*365;
    	$months = 60*60*24*30;
    	$days = 60*60*24;
    	$hours = 60*60;
    	$minutes = 60;
    
    	$nDays = intval($time_differnce/$days);
    	$nHours = intval($time_differnce/$hours);
    
    	$strPassedTime = date('H',strtotime($created_time));
    	$strCurrentTime = date('H');
    	$nHours = intval($strPassedTime - $strCurrentTime);
    
    	if ($nHours < 0){
    		$nHours = $nHours * (-1);
//     		$strSign = "-";
    	}
    	else{
    		$nHours = $nHours;
//     		$strSign = "+";
    	}
    
    	if ($nDays < 0){
    		$nDays = $nDays * (-1);
//     		$strSign = "-";
    	}
    	else{
    		$nDays = $nDays;
//     		$strSign = "+";
    	}
    
//     	return $strSign . $nDays . "D, " . $nHours . "H";
    	return $nDays . "D";
    }
    
    function DateTimeDiff($datetime1, $datetime2){
    	$datetime1 = new DateTime('2 Jan 2008');
    	$datetime2 = new DateTime('5 July 2012');
    	$interval = $datetime1->diff($datetime2);
    	echo $interval->format('%y years %m months and %d days');
    }
    
    function time_diff_string($from, $to, $full = false) {
    	$from = new DateTime($from);
    	$to = new DateTime($to);
    	$diff = $to->diff($from);
    
    	$diff->w = floor($diff->d / 7);
    	$diff->d -= $diff->w * 7;
    
    	$string = array(
    			'y' => 'year',
    			'm' => 'month',
    			'w' => 'week',
    			'd' => 'day',
    			'h' => 'hour',
    			'i' => 'minute',
    			's' => 'second',
    	);
    	foreach ($string as $k => &$v) {
    		if ($diff->$k) {
    			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    		} else {
    			unset($string[$k]);
    		}
    	}
    
    	if (!$full) $string = array_slice($string, 0, 1);
    	return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    
    function unique_multidim_array($array, $key) {
    	$temp_array = array();
    	$i = 0;
    	$key_array = array();
    
    	foreach($array as $val) {
    		if (!in_array($val[$key], $key_array)) {
    			$key_array[$i] = $val[$key];
    			$temp_array[$i] = $val;
    		}
    		$i++;
    	}
    	return $temp_array;
    }
    
    function utf8EncodeArray($arrData){
    	function ArrayEncoderUtf8(&$value,$key){
    		$value = utf8_encode($value);
    	}
    		
    	array_walk_recursive($arrData, 'ArrayEncoderUtf8');
    	return $arrData;
    }
    
    function utf8DecodeArray($arrData){
    	function ArrayDecoderUtf8(&$value,$key){
    		$value = utf8_decode($value);
    	}
    		
    	array_walk_recursive($arrData, 'ArrayDecoderUtf8');
    	return $arrData;
    }
    
    function highlight($text, $words) {
    	$words = utf8_encode(trim($words));
    	
    		preg_match_all('~\w+~', $words, $m);
    		if(!$m)
    			return $text;
//     		$text = htmlentities($text);
    		$re = '~\\b(' . implode('|', $m[0]) . ')\\b~i';
    		 
    		$result = preg_replace($re, '<mark class="highlighted">$0</mark>', $text);
    		
//     		return html_entities_decode($result);
    		return $result;
    }
    
    function GetTimeZone(){
    	global $conn;
    	global $arrTimeZones;
    	 
    	$strQuery5 = "DECLARE @TimeZone VARCHAR(50)
					EXEC MASTER.dbo.xp_regread 'HKEY_LOCAL_MACHINE',
					'SYSTEM\CurrentControlSet\Control\TimeZoneInformation',
					'TimeZoneKeyName',@TimeZone OUT
					SELECT @TimeZone as TMZ";
    	$nResult5 = odbc_exec($conn, $strQuery5);
    	while($rstRow = odbc_fetch_array($nResult5))
    	{
    		$strTimeZone = $rstRow['TMZ'];
    		 
    		$strQuery6 = "DECLARE @TimeZone VARCHAR(60)
    		EXEC MASTER.dbo.xp_regread 'HKEY_LOCAL_MACHINE',
    		'SOFTWARE\Microsoft\Windows NT\CurrentVersion\Time Zones\\{$strTimeZone}',
    		'Display',@TimeZone OUT
    		SELECT @TimeZone as TimeZone";
    		$nResult6 = odbc_exec($conn, $strQuery6);
    		while($rstRow2 = odbc_fetch_array($nResult6))
    		{
    			$strTZ = $rstRow2['TimeZone'];
    		}
    	}
    	 
    	$arrCities = explode(") ", $strTZ);
    	$arrCity = explode(", ", $arrCities[1]);
    	 
    	foreach ($arrTimeZones as $strTimeZone){
    		foreach ($arrCity as $strCity){
    			if (stripos($strTimeZone, $strCity) == true){
    				return $strTimeZone;
    			}
    		}
    	}
    }
    
    function GetServerTimeDiff(){
    	global $conn;
    
    	$strQuery5 = "select GETDATE() as CurrentTime";
    	$nResult5 = odbc_exec($conn, $strQuery5);
    	while($rstRow = odbc_fetch_array($nResult5))
    	{
    		$strLocalTime = $rstRow['CurrentTime'];
    	}
    	 
    	$timezone = 'Europe/Oslo';
    	$date = new DateTime('now', new DateTimeZone($timezone));
    	$strServerTime = $date->format('Y-m-d H:i:s');
    	 
    	$time1 = strtotime($strLocalTime);  // 2012-12-06 23:56
    	$time2 = strtotime($strServerTime);  // 2012-12-06 00:21
    	$temp  = $time1 - $time2;
    	// 	$temp  = $temp - 60;
    	if ($temp > 0)
    		$temp = "-$temp";
    	else
    		$temp *= -1;
    			 
    	return $temp / 60 / 60;
    			// 	echo ($time1 - $time2)/60;
    			// 	echo date("H:i:s",$temp);
    }
    
    /* this function will just call a one line query */
    
    function ExecQuery($strQuery)
    {
        global $conn;
        $nResult = odbc_exec($conn, $strQuery);
        return $nResult;
    }
    
    function GetStatus($strChar)
    {
        switch($strChar)
        {
            case "X": return "Deleted";
            case "D": return "Draft";
            case "A": return "Assigned";
            case "V": return "Archived";
            case "R": return "Resolved";
            case "J": return "Rejected";
            case "U": return "Published";
            case "Q": return "Needs Review";
            case "C": return "Closed";
            case "N": return "New";
            case "W": return "Work In Progress";
            case "E": return "Pending Expert Assistance";
            case "F": return "Pending other Helpdesk Feedback";
            case "S": return "Pending Submitter Feedback";
            case "M": return "Pending Modification";
            case "P": return "Pending Part Arrival";
            case "O": return "Pending Operational Opportunity";
            case "I": return "Pending Investigation";
            case "B": return "Pending Implementation";
            case "G": return "Pending Other Reason";
            case "H": return "On Hold";
            case "T": return "Pending Expert Review";
            case "Z": return "Reopen";
            case "Y": return "Expired";
        }
    }
    
    function GetGender($nGender)
    {
        switch($nGender)
        {
            case "1": return "Male";
            case "0": return "Female";
        }
    }
    
    
    function GetSourceType($nSourceType)
    {
        switch($nSourceType)
        {
            case "1": return "OPD";
            case "2": return "IPD";
            case "3": return "Direct Service";
        }
    }
    
    function GetCOACodeType($strType)
    {
        switch($strType)
        {
            case "EQ": return "Equity";
            case "LI": return "Liability";
            case "AS": return "Asset";
        }
    }
    
    function IsActive($bIsActive)
    {
        switch($bIsActive)
        {
            case "1": return "Yes";
            case "0": return "No";
        }
    }
    
    function GenerateLog($strRemarks, $strModule, $nModuleId = null){
        if (empty($nModuleId))
            $nModuleId = null;
        
        $arr["UserId"] = $_SESSION['UserID'];
        $arr["ModuleId"] = $nModuleId;
        $arr["ModuleName"] = ucwords($strModule);
        $arr["LogDescription"] = trim($strRemarks);
        $arr["UserName"] = ucwords(GetField("Users","FirstName","UserID = '{$_SESSION['UserID']}'")) . " " . ucwords(GetField("Users","LastName","UserID = '{$_SESSION['UserID']}'"));
        
        $nRef = InsertRec("Log", $arr);
        return $arr;
	}
	
	function getValueFromArray($arrData, $strKey)
	{
		foreach ($arrData as $key => $value){
			if (is_array($value)){
				foreach ($value as $k => $v){
					if ($k == $strKey){
						return $v;
					}
				}
			}
			else
				return $value;
		}
	}

	function fileUpload($trtFile, $tmpfile) // function to upload the image files
	{
		$uploadOk = 1;
		$imageFileType = pathinfo($trtFile,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($tmpfile);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($trtFile)) {
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {

		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($tmpfile, $trtFile)) {
				return true;
			} else {
				return false;
			}
		}
	}
	
?>
