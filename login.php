<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Login Form with Avatar Image</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style>
	body {
		color: #fff;
		background: #d47677;
	}
	.form-control {
        min-height: 41px;
		background: #fff;
		box-shadow: none !important;
		border-color: #e3e3e3;
	}
	.form-control:focus {
		border-color: #70c5c0;
	}
    .form-control, .btn {        
        border-radius: 2px;
    }
	.login-form {
		width: 350px;
		margin: 0 auto;
		padding: 100px 0 30px;		
	}
	.login-form form {
		color: #7a7a7a;
		border-radius: 2px;
    	margin-bottom: 15px;
        font-size: 13px;
        background: #ececec;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;	
        position: relative;	
    }
	.login-form h2 {
		font-size: 22px;
        margin: 35px 0 25px;
    }
	.login-form .avatar {
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -50px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #70c5c0;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.login-form .avatar img {
		width: 100%;
	}	
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
		background: #70c5c0;
		border: none;
		margin-bottom: 20px;
    }
	.login-form .btn:hover, .login-form .btn:focus {
		background: #50b8b3;
        outline: none !important;
	}    
	.login-form a {
		color: #fff;
		text-decoration: underline;
	}
	.login-form a:hover {
		text-decoration: none;
	}
	.login-form form a {
		color: #7a7a7a;
		text-decoration: none;
	}
	.login-form form a:hover {
		text-decoration: underline;
	}
</style>
</head>
<body>

<?php
session_start();
require_once("./functions.php");

$username = getValue("username", "POST", "str", "");
$password = getValue("password", "POST", "str", "");
$action = getValue("action", "POST", "str", "");


var_dump($_POST);
var_dump($username);
var_dump($password);

$errorMsg = "";
?>

<?php
    // define variables and set to empty values

    $Message = $ErrorUname = $ErrorPass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = check_input($_POST["username"]);

        if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
            $ErrorUname = "Space and special characters not allowed but you can use underscore(_).";
        } else {
            $fusername = $username;
        }

        $fpassword = check_input($_POST["password"]);

        if ($ErrorUname != "") {
            $Message = "Login failed! Errors found";
        } else {
            include("dbConnection.php");
            $dbConnection = new dbConnection();
            $conn = $dbConnection->getConnection();
            $query = mysqli_query($conn, "select * from `member` where username='$fusername' && password='$fpassword'");
            $num_rows = mysqli_num_rows($query);
            $row = mysqli_fetch_array($query);

            //login check v1
            // if ($num_rows > 0) {
            //     $Message = "Login Successful!";
            // } else {
            //     $Message = "Login Failed! User not found";
            // }
            //login check v2
        }
    }

    function check_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    
<div class="login-form">
    <form method="POST">
    <?php
            if ($action == "login") {
                if ($num_rows > 0) {
                    $_SESSION["logged"] = 1;
                    header("Location: dashboard.php");
                } else {
                    echo ('<span style="color: red;">*Login Fail</span>');
                }
            }
    ?>
		<div class="avatar">
			<img src="/examples/images/avatar.png" alt="Avatar">
		</div>
        <h2 class="text-center">Member Login</h2>   
        <div class="form-group">
        	<input type="text" class="form-control" name="username" placeholder="Username" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </div>
		<div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>
        <input type="hidden" id="action" name="action" value="login" />
    </form>
    <p class="text-center small">Don't have an account? <a href="register.php">Sign up here!</a></p>
    <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" ><a href="register.php">Sign up here</a></button>
    </div>
</div>
</body>
</html>