<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
<?php
    var_dump($_POST);
    require 'xuli.php';
    ?>
<div id="login-box">
  <div class="left">
    <h1>Sign up</h1>
    <form class="login" method="POST">
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <input type="text" name="email" placeholder="E-mail" />
        <input type="text" name="phone" placeholder="Phone" />
    
        <input type="submit" name="signup_submit" value="Sign me up" name="action" />
</form>
  </div>
  
  <div class="right">
    <span class="loginwith">Sign in with<br />social network</span>
    
    <button class="social-signin facebook">Log in with facebook</button>
    <button class="social-signin twitter">Log in with Twitter</button>
    <button class="social-signin google">Log in with Google+</button>
  </div>
  <div class="or">OR</div>
</div>
</body>
</html>