<?php
session_start();

if (isset($_SESSION['active'])) {
    // Display the "You should login first" message
    $message = "Welcome ".$_SESSION['active'];
} else {
    // Redirect to the home page or any other appropriate action
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <script>
         setTimeout(function() {
            // Redirect to the login page or any other appropriate action
            window.location.href = "home.php";
        }, 2000); // 5 seconds delay
    </script>
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

label.hh {
  display: block;
  margin-bottom: 10px;
  font-size: 20px;
  font-weight: bold;
font-family:Arial, Helvetica, sans-serif;
}




/* Responsive styles */

@media screen and (max-width: 768px) {
  form {
    width: 90%;
  }
}
img{
    width: 50%;
    padding-bottom: 20px;

}
	</style>


</head>
<body>
<div class='container'>
<form >

<div class='box'>
<img src='training-plus-logo.png' alt='Avatar' class='avatar'>
</div>
<div class="box2">
<label class="hh" ><?php echo $message; ?></label>
    <label class="hhh"> please wait redirecting you in few seconds ... </label>

</div>

    
  
</form></div>";
</body>
</html>