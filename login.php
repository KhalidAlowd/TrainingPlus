
<?php
session_start();
$erruname="";
$errpass="";
if(isset($_POST['register'])){
  header('location:register.php');
}
if(isset($_POST['forgot'])){
  header('location:forgotPass.php');
}
if(isset($_POST['uname'])){
  if(trim($_POST['uname'])=="" && trim($_POST['psw'])==""){
    $erruname="username required";
    $errpass="Password required";
  }
  else{
  if(trim($_POST['uname'])==""){
    $erruname="username required";
  }
  else{
    if(trim($_POST['psw'])==""){
      $errpass="password required";
    }
    else{
        $username = $_POST["uname"];
        $password = $_POST["psw"];
      try{

        include('connection.php');
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
      
      // bind the parameter
      $stmt->bindParam(':username', $username);
      
      // execute the query
      $stmt->execute();
      
      
      if($row=$stmt->rowCount()>0){
        if ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
          if (password_verify($password, $row2['password'])) {
        $_SESSION['active']=$username;
        header('location:checkLogin2.php');
      }
      else{
        $errpass= "Incorrect password";
      }
    }
    }
      else{
        $erruname="user doesn't exist";
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

a {
  color: #000;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

button.forgot{
  background-color: #D3D3D3;
  color: #fff;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 5px;
}

button.fogot:hover {
  background-color: #808080;
}
.dd{
  color: green;
  font-weight: bold;

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
</head>
<body>













<?php

echo"
<div class='container'>
<form action='login.php' method='post'>
    <img src='training-plus-logo.png' alt='Avatar' class='avatar'>
<div class='box'>
      <label for='uname'><b>Username</b></label>
    <input type='text' placeholder='Enter Username' name='uname'>
    <label class='err'>"; echo $erruname."</label>
 </div>
<div class='box'>
    <label for='psw'><b>Password</b></label>
    <div class='space'>
    <input type='password' placeholder='Enter Password' name='psw' id='psw'> 
    <button type='button' class='icon-button' onclick='handleButtonClick()'>
    <i class='fa fa-eye'></i>
      </button>   
</div>
       <label class='err'>"; echo $errpass."</label>
</div>
<div>
    <button type='submit' value='signin'>Login</button>
    <button name='forgot' class='forgot' type='submit'>Forgot Password ?</button>
 
    </div>
<div>
<span class='dd'>don't have account ?    </span>
<button name='register'  type='submit'>Create Account</button>
</div>

</form></div>";



?>
</body>
<script>
function handleButtonClick() {
  var passwordInput = document.getElementById("psw");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}
	
	</script>
</html>