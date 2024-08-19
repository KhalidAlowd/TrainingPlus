
<?php
session_start();
$erruname="";
if(isset($_POST['login'])){
  header('location:login.php');
}
if(isset($_POST['uname'])){
  if(trim($_POST['uname'])==""){
    $erruname="username required";
  }    
    else{
        $username = $_POST["uname"];
        try {
            include('connection.php');
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
          
          // bind the parameter
          $stmt->bindParam(':username', $username);
          
          // execute the query
          $stmt->execute();
          
          if($row=$stmt->rowCount()>0){
            $_SESSION['username'] = $username; // Store the username in a session variable
            header('location:forgotPass2.php');
        }
          else{

            $erruname="User Doesn't Exist";
      }
      }
      catch(PDOException $e){
        echo"error";
        die($e->getMessage());
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
	</style>
 <script>
        
      
    </script>
</head>
<body>
    <div class="container">
            <form id="myForm1" action="forgotPass.php" method="post">
                <img src="training-plus-logo.png" alt="Avatar" class="avatar">
                <div class="box">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname">
                    <label class="err"><?php echo $erruname; ?></label>
                </div>
             
                <div>
                    <button id="mybutton" type="submit">Recover Password</button><br><br>
                    <button name="login" type="submit">Log in</button>

                </div>

            </form>
    </div>
      
        

</body>
</html>