<?php
    include_once 'defs.php';
    global $css, $js, $strLibPath;
    if(isset($_COOKIE['UserID']))
    {
      if($_SESSION['loggedin'] == '')
      {
        if(RecCount("Users", "UserID = '{$_COOKIE["UserID"]}' and IsActive = 1") > 0)
        {
          $arrUser = GetRecord("Users", "UserID = '{$_COOKIE["UserID"]}' and IsActive = 1");
          $_SESSION['UserID'] = $arrUser['UserID']; // placing user information in session
          $_SESSION['loggedin'] = true;
          $_SESSION['UserRole'] = $arrUser['UserRole'];
          $_SESSION['FirstName'] = $arrUser['FirstName']; // placing user information in session
          $_SESSION['LastName'] = $arrUser['LastName']; 
        }
      }
      
    }else if($_SESSION['loggedin'] != true){
      header("Location: ../login/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
    <head>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
	    <meta name="description" content="Hospital Management System" />
	    <meta name="keywords" content="rhms, hms, hospital, management, system, , group, software, project, tool" />
	    <meta name="author" content="" />
	    <meta name="creation_date" content="2017-11-02" />
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <meta http-equiv="Content-Language" content="en" />
	    <meta http-equiv="cache-control" content="max-age=0" />
	    <meta http-equiv="cache-control" content="no-cache" />
	    <meta http-equiv="expires" content="0" />
	    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	    <meta http-equiv="pragma" content="no-cache" />
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $strLibPath;?>/images/favicon.ico" />
	    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $strLibPath;?>/images/favicon.ico" />
	    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $strLibPath;?>/images/favicon.ico" />
	    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $strLibPath;?>/images/favicon.ico" />
	    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $strLibPath;?>/images/favicon.ico" />
	    <link rel="shortcut icon" type="image/png" href="<?php echo $strLibPath;?>/images/favicon.ico" />
		    
	    <title><?php echo $strTitle;?> - Hospital Management System</title>
	      <?php echo nl2br($css);  ?>
      	<script src="<?php echo $strLibPath;?>/libraries/custom/js/jquery.min.js"></script>
  </head>
<body>
<?php include_once 'response.php'; ?> 
  <div class="wrapper">
  
<?php include_once 'menu.php'; ?>        
<?php include_once 'sidebar.php'; ?> 

      <section>
         <div class="content-wrapper">
        
       
