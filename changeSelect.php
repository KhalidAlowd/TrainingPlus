
<?php
session_start();
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}

if (isset($_POST['home'])) {
	// Clear the session
	header('location:home.php');
}

if (isset($_POST['passCh'])) {
	// Clear the session
	header('location:changePass.php');
}

if (isset($_POST['userCh'])) {
	// Clear the session
	header('location:changeUser.php');
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
  height: 70vh;
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
margin-top: 15px;
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
<button class="right" type="submit" name="home" > Back to home </button>
        </form>
   
</head>
<body>










<div class='container'>
    <div class='msgg' id='success-message'></div>

    <form id="myForm" class='1' action='changeSelect.php' method='post'>
        <img src='training-plus-logo.png' alt='Avatar' class='avatar'>
        <br>
        <div>
            <button name="userCh" type='submit'>Change Username</button>
        </div>
        <br>
        <div>
            <button name="passCh" type='submit'>Change Password</button>
        </div>
     
    </form>

</div>
</body>
<script>
    // Additional JavaScript code can be added here
</script>
</html>