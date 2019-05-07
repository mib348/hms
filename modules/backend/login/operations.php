<?php 
    
    require_once "../../../includes/defs.php";

    switch ($_REQUEST['strOper']){
        case 'login':
            echo json_encode(login($_REQUEST['user_name'], $_REQUEST['user_password']));
            GenerateLog("User Logged In", ucwords($strModule));
            break;
        
        case 'logout':
            GenerateLog("User Logged Out", ucwords($strModule));
            echo json_encode(logout());
            break;
    }
    
    function login($user_name, $user_password)
    {
        $password = md5(md5($user_password));
        if(RecCount("Users", "UserName = '$user_name' and Password = '$password' and IsActive = '1' and UserRole ='1'")>0)
        {	
            $arrUser = GetRecord("Users", "UserName = '$user_name' and Password = '$password' and IsActive = '1' and UserRole ='1'");
            $_SESSION['UserID'] = $arrUser['UserID']; // placing user information in session
            $_SESSION['loggedin'] = true;
            $_SESSION['UserRole'] = $arrUser['UserRole'];
            $_SESSION['FirstName'] = $arrUser['FirstName']; // placing user information in session
            $_SESSION['LastName'] = $arrUser['LastName']; 
            if(isset($_REQUEST['rememberMe']) && $_REQUEST['rememberMe'] == 'true'){
				setcookie('UserID', $arrUser['UserID'], strtotime( '+30 days' ), "/"); // 86400 = 1 day
			}
            return array(
                        "status" => "true", 
                        "message" => "Successfully Login."
                    );
        }else{
            return array(
                        "status" => "false", 
                        "message" => "Login Failed."
                    );
        }
    }

    function logout()
    {
        session_destroy();	// destroy the login session
		unset($_SESSION);	// delete every thing in the session
		$_SESSION = [];
		$_SESSION['UserID'] = '';
        $_SESSION['loggedin'] = '';
        $_SESSION['UserRole'] = '';
        $_SESSION['FirstName'] = '';
        $_SESSION['LastName'] = ''; 
		$cookie_name = "UserID";
		unset($_COOKIE[$cookie_name]);
		// empty value and expiration one hour before
        $res = setcookie($cookie_name, null, -1, '/');
        setcookie("PHPSESSID", "",strtotime( '-30 days' ),"/");
        setcookie("PHPSESSID", "",strtotime( '-30 days' ),"/");
        setcookie("PHPSESSID", "",strtotime( '-30 days' ),"/");
		return array("status" => "true");
    }
    
?>