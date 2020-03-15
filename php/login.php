<!DOCTYPE html>
<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	if(isset($_POST['submit1'])) 
	{   $_SESSION['email']=$_POST['email'];
        $_SESSION['pass']=$_POST['pass'];
		header("location:../php/signin.php") ;
	}
    if(isset($_POST['submit2'])) 
	{ $_SESSION['email']=$_POST['email1'];
      $_SESSION['type']=$_POST['type'];
		header("location:../php/signupcheck.php") ;
		
	}
	
}
?>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HOME PAGE</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="../css/login.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
</head>


<body>
<form method="post" action="login.php">
 <div class="container">
  <div class="cont">
   <div class="form sign-in">
    <h2>Welcome back,</h2>
    <label>
      <span>Email</span>
      <input type="email" name="email" autocomplete="off" required>
    </label>
    <label>
      <span>Password</span>
      <input type="password" name="pass" required>
    </label>
    <p class="forgot-pass">Forgot password?</p>
    <button type="submit" class="submit" name="submit1">Sign In</button>
   
  </div>
  </form>
  <div class="sub-cont">
    <div class="img">
      <div class="img__text m--up">
        <h2>New here?</h2>
        <p>Sign up and get started!!</p>
      </div>
      <div class="img__text m--in">
        <h2>One of us?</h2>
        <p>If you already have an account, just sign in.</p>
      </div>
      <div class="img__btn">
        <span class="m--up">Sign Up</span>
        <span class="m--in">Sign In</span>
      </div>
    </div>
	<form method="post" action="login.php">
    <div class="form sign-up">
      <h2>Join us</h2>
      <label>
        <span>Email</span>
        <input type="email" name="email1" autocomplete="off" required >
      </label>
      <label>
        <span>Account Type</span><br>
        <select name="type">
		<option value="student">Student</option>
		<option value="teacher">Teacher</option>
		</select>
      </label>
      <button type="submit" class="submit" name="submit2">Sign Up</button>
    
    </div>
  </div>
</div>

</div>
  
</form>  

    <script  src="../js/login.js"></script>




</body>

</html>
