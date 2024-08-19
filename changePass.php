
<?php
session_start();
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}
$errold="";
$errnew="";
$errcnew="";
$msg="";
$user=$_SESSION['active'];
if (isset($_POST['home'])) {
	// Clear the session
	header('location:changeSelect.php');
}

if(isset($_POST['oldpsw'])){
  if(trim($_POST['oldpsw'])=="" && trim($_POST['newpsw'])=="" && trim($_POST['cnewpsw'])==""){
    $errold="old password required";
    $errnew="new Password required";
    $errcnew="Confirm new Password Required";
  }
  else{
  if(trim($_POST['oldpsw'])==""){
    $errold="old password required";
  }
  else{
    if(trim($_POST['newpsw'])==""){
        $errnew="new Password required";
    }
    else{
      
      if(trim($_POST['cnewpsw'])==""){
        $errcnew="Confirm new Password is Required";
    }
    else{
      if($_POST['newpsw']!==$_POST['cnewpsw']){$errcnew="Passwords Don't Match";}
      else{
        
        $oldpsw = $_POST["oldpsw"];
        $newpsw = $_POST["newpsw"];
      try{

        include('connection.php');
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
      
      // bind the parameter
      $stmt->bindParam(':username', $user);
      
      // execute the query
      $stmt->execute();
      
      
        if ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
          if (password_verify($oldpsw, $row2['password'])) {
            $hashedPassword = password_hash($newpsw, PASSWORD_DEFAULT);
            $stmt2 = $db->prepare("UPDATE users SET password = :password WHERE username = :username");
            $stmt2->bindParam(':password', $hashedPassword);
            $stmt2->bindParam(':username', $user);
            $stmt2->execute();          
            $msg="Password Updated Successfully";
            session_unset();
	          session_destroy();
      }
      else{
        $errold= "Incorrect old password";
      }
    }
    
  
      }
      catch(PDOException $e){
        echo"error";
        die($e->getMessage());
      }
      }





    }
  }
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

form.1 {
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

a {
  color: #000;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
#mybutton {
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
#show9{
   color:limegreen;
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
.checkbox-container {
    display: flex;
    align-items: center;
  }

  .checkbox-container label, .checkbox-container input[type="checkbox"] {
    margin-right: 7px;
    margin-bottom: 3px;
    margin-left: 6px;
  }
  .space{
  display: flex;
  justify-content: space-between;
}
.icon-button{
  border: none;
  background: none;
  padding: 0;
  cursor: pointer;
}

.icon-button{
  font-size: 24px;
  /* Additional styling for the icon */
}
	</style>
    <form method="post">
<button class="right" type="submit" name="home" > Back </button>
        </form>
        <script>
        function submitForm() {
            document.getElementById('myForm').submit(); // Submit the form
        }
    </script>
</head>
<body>










<div class='container'>
<?php if (!empty($msg)) : ?>
    <div class='msgg' id='success-message'><?php echo $msg; ?></div>
    <script>
        setTimeout(function () {
            window.location.href = 'login.php'; // Replace 'login.php' with the desired destination URL
        }, 3000); // 3 seconds delay
    </script>
    <?php else :   ?>
    <form id="myForm" class='1' action='changePass.php' method='post'>
        <img src='training-plus-logo.png' alt='Avatar' class='avatar'>
       

      
        <div class='box'>
            <label for='oldpsw'><b>old password</b></label>
            <div class='space'>
            <input type='password' placeholder='Enter Old Password' id='old' name='oldpsw'>
            <button type='button' class='icon-button' onclick='handleButtonClick1()'>
    <i class='fa fa-eye'></i>
      </button>   
</div>
            <label class='err'><?php echo $errold; ?></label>
        </div>
        <div class='box'>
            <label for='newpsw'><b>new Password</b></label>
            <div class='space'>
            <input type='password' placeholder='Enter New Password' id='new' name='newpsw'>
            <button type='button' class='icon-button' onclick='handleButtonClick2()'>
    <i class='fa fa-eye'></i>
      </button>   
</div>
            <label class='err'><?php echo $errnew; ?></label>
        </div>
        <div class='box'>
            <label for='cnewpsw'><b>Confirm new Password</b></label>
            <div class='space'>
            <input type='password' placeholder='Confirm New Password' id='ch' name='cnewpsw'>
            <button type='button' class='icon-button' onclick='handleButtonClick3()'>
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
</body>
<script>
function handleButtonClick1() {
  var passwordInput = document.getElementById("old");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}
function handleButtonClick2() {
  var passwordInput = document.getElementById("new");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}
function handleButtonClick3() {
  var passwordInput = document.getElementById("ch");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}
</script>
</html>