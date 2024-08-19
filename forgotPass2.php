<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
else{
$errnew="";
$errcnew="";
$msg="";
$username=$_SESSION['username'];
if(isset($_POST['newpsw'])){
    if(empty($_POST['newpsw']) && empty($_POST['cnewpsw'])){
        $errnew="New Password is Required";
        $errcnew="Confirm new Password is Required";
    }else{
    if(trim($_POST['newpsw'])==""){
        $errnew="New Password is Required";
    }
    else{
        

        if(trim($_POST['cnewpsw'])==""){
            $errcnew="Confirm new Password is Required";
        }
        else{
            if($_POST['newpsw']!==$_POST['cnewpsw']){$errcnew="Passwords Don't Match";}
else{
            include('connection.php');
        
        $newpsw = $_POST["newpsw"];
                        $hashedPassword = password_hash($newpsw, PASSWORD_DEFAULT);
                        $stmt2 = $db->prepare("UPDATE users SET password = :password WHERE username = :username");
                        $stmt2->bindParam(':password', $hashedPassword);
                        $stmt2->bindParam(':username', $username);
                        if ($stmt2->execute()) {
                            $msg = "Password updated successfully";
                            session_unset();
                            session_destroy();
                        } else {
                            $msg = "Failed to update the password";
                            session_unset();
                            session_destroy();
                        }
    }}
    }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

	<title>Database</title>
  <style>
		/* .container{
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .box{
      font-weight: bold;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
 */
        .myDiv {
            display: none; /* Hide the div by default */
        }

        .show {
            display: block; /* Show the div */
        }
        
		body {
  font-family: Arial, sans-serif;
  background-color: #f5f5dc;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

form {
  background-color: #f5f5dc;
  border-radius: 25px;
  padding: 50px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
}

label {
  display: block;
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  margin-bottom: 20px;
  box-sizing: border-box;
  font-size: 16px;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}
#mybutton{
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

#mybutton:hover {
  background-color: #3e8e41;
}

a {
  color: #000;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

button[type="forgot"] {
  background-color: #D3D3D3;
  color: #fff;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 5px;
}

button[type="forgot"]:hover {
  background-color: #808080;
}

/* Responsive styles */

@media screen and (max-width: 768px) {
  form {
    width: 90%;
  }
}
.dont{
  font-weight: bold;
}
.err{
  color: red;
}
.msgg{
    color: 	#008000;
    font-weight: bolder;
    font-family: Arial, Helvetica, sans-serif;

}
.msgg2{
color: #32cd32;
font-weight: bold;
font-family: Arial, Helvetica, sans-serif;

}
.icon-button {
  border: none;
  background: none;
  padding: 0;
  cursor: pointer;
}

.icon-button i {
  font-size: 24px;
  /* Additional styling for the icon */
}
.space{
  display: flex;
  justify-content: space-between;
}
	</style>
    <script>
        function submitForm() {
            document.getElementById('myForm').submit(); // Submit the form
        }
        
    </script>
</head>

<div class='container'>
<?php if (!empty($msg)) : ?>
    <div class='msgg' id='success-message'><?php echo $msg; ?></div>
    <script>
        setTimeout(function () {
            window.location.href = 'login.php'; // Replace 'login.php' with the desired destination URL
        }, 3000); // 3 seconds delay
    </script>
    <?php else :   ?>
    <form id="myForm" class='1' action='forgotPass2.php' method='post'>
        <img src='training-plus-logo.png' alt='Avatar' class='avatar'>
     
        <div class='box'>
            <label for='newpsw'><b>new Password</b></label>
            <div class='space'>

            <input type='password' placeholder='Enter New Password' name='newpsw'>
            <button type='button' class='icon-button' onclick='handleButtonClick()'>
    <i class='fa fa-eye'></i>
      </button>   
</div>
            <label class='err'><?php echo $errnew; ?></label>
        </div>
        <div class='box'>
            <label for='cnewpsw'><b>Confirm new Password</b></label>
            <div class='space'>

            <input type='password' placeholder='Confirm New Password' name='cnewpsw'>
            <button type='button' class='icon-button' onclick='handleButtonClick()'>
    <i class='fa fa-eye'></i>
      </button>   
</div>
            <label class='err'><?php echo $errcnew; ?></label>
        </div>
        <div>
            <button id="mybutton" type='button' onclick="submitForm()">Change Password</button>
        </div>
    </form>
    <?php endif; ?>

</div>
</html>
<?php
}
?>