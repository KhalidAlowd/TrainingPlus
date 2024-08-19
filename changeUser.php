
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
    $errold="old Username required";
    $errnew="new Username required";
    $errcnew="Confirm new Username Required";
  }
  else{
  if(trim($_POST['oldpsw'])==""){
    $errold="old Username required";
  }
  else{
    if(trim($_POST['newpsw'])==""){
        $errnew="new Username required";
    }
    else{
      
      if(trim($_POST['cnewpsw'])==""){
        $errcnew="Confirm new Username is Required";
    }
    else{
      if($_POST['newpsw']!==$_POST['cnewpsw']){$errcnew="Username Don't Match";}
      else{
        
        $oldpsw = $_POST["oldpsw"];
        $newpsw = $_POST["newpsw"];
        try {
            include('connection.php');
            if ($oldpsw == $user) {
              $stmt2 = $db->prepare("UPDATE users SET username = :newpsw WHERE username = :user");
              $stmt2->bindParam(':newpsw', $newpsw);
              $stmt2->bindParam(':user', $user);
              $stmt2->execute();
              $msg = "Username updated successfully";
        
              // Clear the session
              session_unset();
              session_destroy();
        
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
button[type="button"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button[type="button"]:hover {
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
    <form id="myForm" class='1' action='changeUser.php' method='post'>
        <img src='training-plus-logo.png' alt='Avatar' class='avatar'>
        <div class='box'>
            <label for='oldpsw'><b>old Username</b></label>
            <input type='text' placeholder='Enter Old Username' name='oldpsw'>
            <label class='err'><?php echo $errold; ?></label>
        </div>
        <div class='box'>
            <label for='newpsw'><b>new Username</b></label>
            <input type='text' placeholder='Enter New Username' name='newpsw'>
            <label class='err'><?php echo $errnew; ?></label>
        </div>
        <div class='box'>
            <label for='cnewpsw'><b>Confirm new Username</b></label>
            <input type='text' placeholder='Confirm New Username' name='cnewpsw'>
            <label class='err'><?php echo $errcnew; ?></label>
        </div>
        <div>
            <button id="mybutton" type='button' onclick="submitForm()">Change Username</button>
        </div>
    </form>
    <?php endif; ?>

</div>
</body>
<script>
    // Additional JavaScript code can be added here
</script>
</html>