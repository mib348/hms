<?php
    include_once("../../../includes/defs.php");
    
    if(isset($_SESSION['UserID'])){
        header("Location: ../main/index.php");
    }
    $nServerPort = ($_SERVER['SERVER_PORT'] == 80) ? "" : ":" . $_SERVER['SERVER_PORT'];
    $strLibPath = "http://" . $_SERVER['SERVER_NAME'] . $nServerPort . "/hms";
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="description" content=" - Hospital Management System" />
    <meta name="keywords" content="rhms, hms, hospital, management, system, , group, software, project, tool" />
    <meta name="author" content="" />
    <title> - Hospital Management System</title>
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $strLibPath;?>/libraries/custom/images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $strLibPath;?>/libraries/custom/images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $strLibPath;?>/libraries/custom/images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $strLibPath;?>/libraries/custom/images/favicon.ico" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $strLibPath;?>/libraries/custom/images/favicon.ico" />
    <link rel="shortcut icon" type="image/png" href="<?php echo $strLibPath;?>/libraries/custom/images/favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/vendors.min.css" />
    <!-- BEGIN VENDOR CSS-->
    <!-- BEGIN Font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/fonts/icomoon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/fonts/flag-icon-css/css/flag-icon.min.css" />
    <!-- END Font icons-->
    <!-- BEGIN Plugins CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/sliders/slick/slick.css" />
    <!-- END Plugins CSS-->
    
    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/icheck.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/plugins/forms/icheck/custom.css" />
    <!-- END Vendor CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" href="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/css/app.min.css" />
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $strLibPath;?>/libraries/vendors/robust/assets/css/style.css" />
    <!-- END Custom CSS-->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
  <body data-open="hover" data-menu="vertical-mmenu" data-col="1-column" class="vertical-layout vertical-mmenu 1-column bg-full-screen-image blank-page">
    <!-- START PRELOADER-->

    <div id="preloader-wrapper">
      <div id="loader" class="square-spin loader-white">
        <div></div>
      </div>
      <div class="loader-section section-top bg-success"></div>
      <div class="loader-section section-bottom bg-success"></div>
    </div>

    <!-- END PRELOADER-->
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="robust-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
            <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-3 p-0">
                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                    <div class="card-header no-border">
                        <div class="card-title text-xs-center">
                            <img src="<?php echo $strLibPath;?>/libraries/custom/images/logo.png" alt="branding logo" />
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="row">
							<div class="col-xs-12 col-lg-12">
                                <div class="col-xs-12 col-lg-12">
                                    <div id="notificationDiv" class="alert mb-2" role="alert" style="display:none;">
                                        <span id="notificationMessage"></span>
                                    </div>
                                </div>
							</div>
						</div>
                        <div class="card-block">
                            <form class="form-horizontal" novalidate="" />
                                <fieldset class="form-group has-feedback has-icon-left">
                                    <input type="text" class="form-control" id="user-email" placeholder="Your Username" required="" />
                                    <div class="form-control-position">
                                        <i class="icon-head"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group has-feedback has-icon-left">
                                    <input type="password" class="form-control" id="user-password" maxlength="50" placeholder="Enter Password" required="" />
                                    <div class="form-control-position">
                                        <i class="icon-key3"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group row">
                                    <div class="col-md-6 col-xs-12 text-xs-center">
                                        <fieldset>
                                            <input type="checkbox" id="remember-me" class="chk-remember" />
                                            <label for="remember-me"> Remember Me</label>
                                        </fieldset>
                                    </div>
                                </fieldset>
                                <button type="button" id="login" class="btn btn-outline-primary btn-block"><i class="icon-unlock2"></i> Login</button>
                            </form>
                        </div>
                        <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 my-1"><span>Copyright  &copy; 2017 <a href="https://group.com" target="_blank" class="text-bold-800 grey darken-2">GROUP</a></span></p>
                    </div>
                </div>
            </div>
        </section>

        </div>
      </div>
    </div>

    <script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/vendors.min.js"></script>
    <script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/app.min.js"></script>
    <script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/components/forms/form-login-register.js" type="text/javascript"></script>
    <!-- <script src="<?php echo $strLibPath;?>/libraries/vendors/robust/robust-assets/js/plugins/forms/validation/jquery.validate.min.js" type="text/javascript"></script> -->
    <script>
    	$(function(){
        	$(document).on('click', "#login", function()
            {
                var response = checkUserName($("#user-email").val());
                var response2 = hasWhiteSpace($("#user-email").val());
                if($("#user-email").val() == '' && $("#user-password").val() == ''){ // check if both username and password is empty
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid username and password");
                }else if($("#user-email").val() == ''){     // check if username
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid username");
                }else if(response['status'] == "false"){    // check if username contains special characters  
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text(response['message']);
                }else if(response2['status'] == "false"){   // check if username contains white space
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text(response2['message']);
                }else if($("#user-password").val() == ''){  // check if password is empty
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid password");
                }else if($("#user-password").val().length >50 ){    // check if password lenght is greater then 50
                    $("#notificationDiv").addClass('alert-danger').show();
                    $("#notificationMessage").text("Please enter valid password");
                }else{
                    $("#login").prop("disabled", true);
                    if ($('input.chk-remember').is(':checked')) {
                        var rememberMe = "true";
                    }else{
                        var rememberMe = "false";
                    }
                	$.ajax({
    					url:	"../../backend/login/operations.php?strOper=login",
    					type:   "post",
                        dataType: 'json',
    					data: { user_name: $("#user-email").val(), user_password : $("#user-password").val(), remember_me : rememberMe} ,
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
                                    $("#login").prop("disabled", false);
                                    break;
                            }
    					}
    				});    
                } 
            });

            $(window).keydown(function(e)
            {
                if(e.keyCode == 13){
                    $("#login").trigger('click');
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