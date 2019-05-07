<?php
    include '../../../includes/defs.php';
    
    switch ($_REQUEST['strReportType']){
        case "OPD":
            $strReportName = "opd_patients_wise";
            break;
    }
    
    exec("CrystalReportsNinja -F $strReportName.rpt -O $strReportName.pdf -E pdf ");
    
    header("Content-type:application/pdf");
    header("Content-Length: " . filesize("$strReportName.pdf"));
    header("Content-Disposition: inline; filename=$strReportName.pdf");
    readfile("$strReportName.pdf");
?>