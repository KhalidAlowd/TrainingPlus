
<?php
ob_start();
session_start();
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}
$errold="";
$errnew="";
$msg="";
$user=$_SESSION['active'];
if (isset($_POST['home'])) {
	// Clear the session
	header('location:home.php');
}

if(isset($_POST['oldpsw'])){
  if(trim($_POST['oldpsw'])==""&& trim($_POST['newpsw'])==""){
    $errold="username is required";
    $errnew="password is required";
  }
  else{
  if(trim($_POST['oldpsw'])==""){
    $errold="username is required";
  }
  else{
  $user=$_POST['oldpsw'];
  include('connection.php');
  $stmt2 = $db->prepare("SELECT * FROM users WHERE username = :user");
  $stmt2->bindParam(':user', $user);
  $stmt2->execute();

  if ($stmt2->rowCount() > 0) {
    $results=$stmt2->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row){
      $x=$row['password'];}
  if( trim($_POST['newpsw'])=="" ){
    $errnew="password is required";
  }
  else{
  if(password_verify($_POST['newpsw'],$x)){

        $oldpsw = $_POST["oldpsw"];
       
            include('connection.php');
              $stmt2 = $db->prepare("DELETE FROM users WHERE username = :user ");
              $stmt2->bindParam(':user', $oldpsw);
              $stmt2->execute();
              $msg = "Account Deleted Successfully";
              // Clear the session
              if($_SESSION['active']==$oldpsw){
              session_unset();
              session_destroy();
              header("Refresh:1");
              ob_end_flush();
              }
              else{
                header("Refresh:1");
                ob_end_flush();
              }
    
     
      
      }
      else{
        $errnew="password is incorrect";
      }
    }
  




    }
  

else{
  $errold="no account with this username";
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
 <form method="post">
<button class="right" type="submit" name="home" > Back to home </button>
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
    <?php else :   ?>    <form id="myForm" class='1' action='deleteAccount.php' method='post'>
        <img src='training-plus-logo.png' alt='Avatar' class='avatar'>
        <div class='box'>
            <label for='oldpsw'><b>Username</b></label>
            <input type='text' placeholder='Enter Username' name='oldpsw'>
            <label class='err'><?php echo $errold; ?></label>
        </div>
        <div class='box'>
            <label for='newpsw'><b>Password</b></label>
            <div class='space'>

            <input type='password' placeholder='Enter Password' name='newpsw' id='ps'>
            <button type='button' class='icon-button' onclick='handleButtonClick()'>
    <i class='fa fa-eye'></i>
      </button>   
</div>
            <label class='err'><?php echo $errnew; ?></label>
        </div>
        <div>
            <button id="mybutton" type='button' onclick="submitForm()">Delete Account</button>
        </div>
    </form>
    <?php endif; ?>
</div>
</body>
<script>
function handleButtonClick() {
  var passwordInput = document.getElementById("ps");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}</script>
</html>