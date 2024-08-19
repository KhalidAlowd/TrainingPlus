
<?php
session_start();
$msgg="";
$msgg2="";
$errpass="";
$erruname="";
if(isset($_POST['register'])){
    header('location:login.php');
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
        try {
            include('connection.php');
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
          
          // bind the parameter
          $stmt->bindParam(':username', $username);
          
          // execute the query
          $stmt->execute();
          
          
          if($row=$stmt->rowCount()>0){
            $erruname="User Already Exists";
          }
          else{
            $stmt2 = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

            // hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // bind the parameters
            $stmt2->bindParam(':username', $username);
            $stmt2->bindParam(':password', $hashedPassword);

            // execute the query
            $stmt2->execute();

            $msgg= "User Registered Successfully<br";}
            $msgg2="Redirecting to Login Page...";
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
<body>
    <div class="container">
        <?php if (!empty($msgg)) : ?>
            <div class="msgg" id="success-message"><?php echo $msgg; ?></div>
            <div class="msgg2" id="success-message"><?php echo $msgg2; ?></div>
            <script>
                setTimeout(function() {
                    window.location.href = 'login.php'; // Replace 'login.php' with the desired destination URL
                }, 3000); // 3 seconds delay
            </script>
        <?php else : ?>
            <form id="myForm" action="Register.php" method="post">
                <img src="training-plus-logo.png" alt="Avatar" class="avatar">
                <div class="box">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname">
                    <label class="err"><?php echo $erruname; ?></label>
                </div>
                <div class="box">
                    <label for="psw"><b>Password</b></label>
                    <div class='space'>
                    <input type="password" placeholder="Enter Password" name="psw" id='ps'>
                    <button type='button' class='icon-button' onclick='handleButtonClick()'>
    <i class='fa fa-eye'></i>
      </button>   
</div>
                    <label class="err"><?php echo $errpass; ?></label>
                </div>
                <div>
                    <button id="mybutton" type="button" onclick="submitForm()">Sign Up</button>
                </div>
                <small class="dont">Already have an account?</small>
                <button name="register" type="submit">Log in</button>
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