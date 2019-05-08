<?php
    include_once("../../../includes/defs.php");
    
    if(isset($_SESSION['UserID'])){
        header("Location: ../main/index.php");
    }
    $nServerPort = ($_SERVER['SERVER_PORT'] == 80) ? "" : ":" . $_SERVER['SERVER_PORT'];
    $strLibPath = "http://" . $_SERVER['SERVER_NAME'] . $nServerPort . "/hms";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="description" content=" - Hospital Management System" />
    <meta name="keywords" content="rhms, hms, hospital, management, system, digitalmib, binarytech, software, project, tool" />
    <meta name="author" content="" />
    <meta name="creation_date" content="2017-11-02" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>Hospital Management System</title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?php echo $strLibPath; ?>/libraries/vendor/angle/vendor/fontawesome/css/font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?php echo $strLibPath; ?>/libraries/vendor/angle/vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo $strLibPath; ?>/libraries/vendor/angle/app/css/bootstrap.css" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo $strLibPath; ?>/libraries/vendor/angle/app/css/app.css" id="maincss">
</head>

<body>
   <div class="wrapper">
      <div class="block-center mt-xl wd-xl">
         <!-- START panel-->
         <div class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
               <a href="#">
                  <img class="block-center img-rounded" src="<?php echo $strLibPath; ?>/images/Hospital-management-system.png" height="150" width="150" alt="Image">
               </a>
            </div>
            <div class="panel-body">
               <p class="text-center pv">SIGN IN TO CONTINUE.</p>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div id="notificationDiv" class="alert" role="alert" style="display:none;">
                            <span id="notificationMessage"></span>
                        </div>
                    </div>
                </div>
               <form class="mb-lg" role="form" data-parsley-validate="" novalidate="">
                  <div class="form-group has-feedback">
                     <input class="form-control" id="strUserName" name="strUserName" type="text" placeholder="Username" autocomplete="off" required>
                     <span class="fa fa-user  form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <input class="form-control" id="strPassword" name="strPassword" type="password" placeholder="Password" required>
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="clearfix">
                     <div class="checkbox c-checkbox pull-left mt0">
                        <label>
                           <input type="checkbox" value="" id="rememberMe" name="rememberMe">
                           <span class="fa fa-check"></span>Remember Me</label>
                     </div>
                  </div>
                  <button type="button" class="btn btn-block btn-primary mt-lg" id="strLogin">Login</button>
               </form>
            </div>
         </div>
         <!-- END panel-->
         <div class="p-lg text-center">
            <span>&copy;</span>
            <span>2016</span>
            <span>-</span>
            <a href="https://www.binarytech.org/" target="_blank"><span>BinaryTech</span></a>
         </div>
      </div>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="<?php echo $strLibPath; ?>/libraries/vendor/angle/vendor/modernizr/modernizr.custom.js"></script>
   <!-- JQUERY-->
   <script src="<?php echo $strLibPath; ?>/libraries/vendor/angle/vendor/jquery/dist/jquery.js"></script>
   <!-- BOOTSTRAP-->
   <script src="<?php echo $strLibPath; ?>/libraries/vendor/angle/vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="<?php echo $strLibPath; ?>/libraries/vendor/angle/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="<?php echo $strLibPath; ?>/libraries/vendor/angle/app/js/app.js"></script>
   <script>
    	$(function()
        {
            $("#strUserName").focus();
        	$(document).on('click', "#strLogin", function()
            {
                var response = checkUserName($("#strUserName").val());
                var response2 = hasWhiteSpace($("#strUserName").val());
                if($("#strUserName").val() == '' && $("#strPassword").val() == ''){ // check if both username and password is empty
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid username and password");
                    $("#strUserName").focus();
                }else if($("#strUserName").val() == ''){     // check if username
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid username");
                    $("#strUserName").focus();
                }else if(response['status'] == "false"){    // check if username contains special characters  
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text(response['message']);
                    $("#strUserName").focus();
                }else if(response2['status'] == "false"){   // check if username contains white space
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text(response2['message']);
                    $("#strUserName").focus();
                }else if($("#strPassword").val() == ''){  // check if password is empty
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid password");
                    $("#strPassword").focus();
                }else if($("#strPassword").val().length >50 ){    // check if password lenght is greater then 50
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid password");
                    $("#strPassword").focus();
                }else{
                    $("#strLogin").prop("disabled", true);
                    if ($('#rememberMe').is(':checked')) {
                        var rememberMe = "true";
                    }else{
                        var rememberMe = "false";
                    }
                	$.ajax({
    					url:	"../../backend/login/operations.php?strOper=login",
    					type:   "post",
                        dataType: 'json',
    					data: { user_name: $("#strUserName").val(), user_password : $("#strPassword").val(), rememberMe : rememberMe} ,
    					success: function(data)
                        {
                            switch(data['status'])
                            {
                                case 'true':
                                    $("#notificationDiv").removeClass('alert-danger');
                                    $("#notificationDiv").addClass('alert-success').show();
                                    $("#notificationMessage").text(data['message']);
                                    setTimeout(function(){window.location.href = '../main/index.php'}, 1200);
                                    break;
                                
                                case 'false':
                                    $("#notificationDiv").removeClass('alert-success');
                                    $("#notificationDiv").addClass('alert-danger').show();
                                    $("#notificationMessage").text(data['message']);
                                    $("#strLogin").prop("disabled", false);
                                    break;
                            }
    					}
    				});    
                } 
            });

            $(window).keydown(function(e)
            {
                if(e.keyCode == 13){
                    $("#strLogin").trigger('click');
                }
            });	
        });

        function hasWhiteSpace(strUserName) 
        {
            var reWhiteSpace = new RegExp("/^\s+$/");
            // Check for white space
            if (/\s/.test(strUserName)) {
                var arr = { "status" : "false", "message" : "Please enter username without space."}; 
                return arr;
            }else if (strUserName.indexOf(' ') >= 0) {
                var arr = { "status" : "false", "message" : "Please enter username without space."}; 
                return arr;
            }else{
                var arr = { "status" : "true", "message" : ""}; 
                return arr;
            }
        }

        function checkUserName(strUserName) {
            var pattern = new RegExp(/[~`!#$%\^@&*+=\-\[\]\\';,/{}|\\":<>\?]/); //unacceptable chars
            if (pattern.test(strUserName)) {
                var arr = { "status" : "false", "message" : "Please enter username without alphanumeric characters and space."}; 
                return arr;
            }else{
                var arr = { "status" : "true", "message" : ""}; 
                return arr;
            }
        }
    </script>
</body>

</html>