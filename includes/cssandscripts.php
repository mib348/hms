<?php
    
    
    global $strLibPath, $strModule;
    $fileName = basename($_SERVER['REQUEST_URI']);
    $css = '';
    $js = '';

    switch ($strModule) {
        case 'main':
            switch ($fileName) {
                case 'index.php':
                    $strTitle = " Hospital Managment System";
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/bootstrap.css" id="bscss">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/app.css" id="maincss">';
                
                    
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/matchMedia/matchMedia.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery.easing/js/jquery.easing.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/animo.js/animo.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/slimScroll/jquery.slimscroll.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/screenfull/dist/screenfull.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery-localize-i18n/dist/jquery.localize.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/sparkline/index.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/flot/jquery.flot.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/flot/jquery.flot.resize.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/flot/jquery.flot.pie.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/flot/jquery.flot.time.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/flot/jquery.flot.categories.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/flot-spline/js/jquery.flot.spline.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/moment/min/moment-with-locales.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/app/js/demo/demo-flot.js"></script>';
                    break;
            }
            break;
        
        case 'patients':
            switch ($fileName) {
                case 'index.php':
                    $strTitle = " Hospital Managment System";
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/animate.css/animate.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/whirl/dist/whirl.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/bootstrap.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/app.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/custom/css/datepicker-plugin.css">';
                    
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/matchMedia/matchMedia.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery.easing/js/jquery.easing.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/animo.js/animo.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/slimScroll/jquery.slimscroll.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/screenfull/dist/screenfull.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery-localize-i18n/dist/jquery.localize.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/custom/js/bootstrap.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/custom/js/jquery.form.js"></script>';
                    
                    break;
                
                case 'patient-listing.php':
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/animate.css/animate.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/css/select2.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2-bootstrap-theme/dist/select2-bootstrap.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/bootstrap.css" id="bscss">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/app.css" id="maincss">';
                    
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/parsleyjs/dist/parsley.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/js/select2.js"></script>';
                    break;
            }
            break;
        
        //ibrahim
        case 'reports':
            switch ($fileName) {
                default:
                    $strTitle = "Reports |  Hospital Managment System";
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/animate.css/animate.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/css/select2.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2-bootstrap-theme/dist/select2-bootstrap.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/bootstrap.css" id="bscss">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/app.css" id="maincss">';
                    
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/parsleyjs/dist/parsley.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/js/select2.js"></script>';
                    break;
            }
            break;
            
        case 'admin':
            switch ($fileName) {
                default:
                    $strTitle = "Admin |  Hospital Managment System";
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/animate.css/animate.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/css/select2.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2-bootstrap-theme/dist/select2-bootstrap.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/bootstrap.css" id="bscss">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/app.css" id="maincss">';
                    
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/parsleyjs/dist/parsley.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/js/select2.js"></script>';
                    break;
            }
            break;
            
        case 'opd':
            switch ($fileName) {
            	case "patient-history.php":
                    $strTitle = "OPD Patient History |  Hospital Managment System";
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/animate.css/animate.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/bootstrap.css" id="bscss">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/app.css" id="maincss">';
                    
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/nestable/jquery.nestable.js"></script>';
                    break;

                default:
                    $strTitle = "OPD |  Hospital Managment System";
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/animate.css/animate.min.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/css/select2.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/vendor/select2-bootstrap-theme/dist/select2-bootstrap.css">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/bootstrap.css" id="bscss">';
                    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/vendor/angle/app/css/app.css" id="maincss">';
                    
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/parsleyjs/dist/parsley.min.js"></script>';
                    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/vendor/select2/dist/js/select2.js"></script>';
                    break;
            }
            break;
    }

    $css .=  '<link rel="stylesheet" href="'.$strLibPath.'/libraries/custom/css/custom.css">';
    // files to be included at the end of scripts.
    $js .=  '<script src="'.$strLibPath.'/libraries/vendor/angle/app/js/app.js"></script>';
    $js .=  '<script src="'.$strLibPath.'/libraries/custom/js/custom.js"></script>';
    
?>
    
