<?php
ob_start();
session_start();
include('connection.php');
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}
$msg="";


if (isset($_GET['serial'])) {
    $serial = $_GET['serial'];
	
if(isset($_POST['follow'])){
$stmt99 = $db->prepare("SELECT * FROM `trainingplus` WHERE `serial_number`='$serial'");
$stmt99->execute();
$results = $stmt99->fetchAll(PDO::FETCH_ASSOC);
	if(trim($_POST['follow-up-1'])!==""){
		$f1=$_POST["follow-up-1"];
		if($f1!==$results[0]['followups1']){
			$stmt99 = $db->prepare(" UPDATE `trainingplus` SET `followups1`='$f1' WHERE `serial_number`='$serial'");
			$stmt99->execute();
			$msg="Updated Successfully";
			header("Refresh:1");
			ob_end_flush();
		}
		
	}
	if(trim($_POST['follow-up-2'])!==""){
		$f2=$_POST["follow-up-2"];
		if($f2!==$results[0]['followups2']){
			$stmt99 = $db->prepare(" UPDATE `trainingplus` SET `followups2`='$f2' WHERE `serial_number`='$serial'");
			$stmt99->execute();
			$msg="Updated Successfully";
			header("Refresh:1");
			ob_end_flush();
		}
		
	}
	if(trim($_POST['follow-up-3'])!==""){
		$f3=$_POST["follow-up-3"];
		if($f3!==$results[0]['followups3']){
			$stmt99 = $db->prepare(" UPDATE `trainingplus` SET `followups3`='$f3' WHERE `serial_number`='$serial'");
			$stmt99->execute();
			$msg="Updated Successfully";
			header("Refresh:1");
			ob_end_flush();

		}
		
	}

}

 
} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Follow-up Form</title>
	<style>
		.msgs{
			display: flex;
			align-items: center;
			justify-content: center;
			color: green;
		}
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5dc;
		}
		.container {
			margin: 50px auto;
			max-width: 600px;
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}
		.form-group {
			margin-bottom: 20px;
		}
		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}
		input[type="text"] {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border-radius: 5px;
			border: none;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		}
		button {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			margin-top: 10px;
		}
		button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>

<form action="home.php" method="post">
    <br>
    <button type="submit"> Back To Home</button>
</form>

<?php 
$stmt99 = $db->prepare("SELECT * FROM `trainingplus` WHERE `serial_number`='$serial'");
$stmt99->execute();
$results = $stmt99->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
	<h3 class="msgs"><?php echo $msg; ?></h3>
    <form method="post">
        <div class="form-group">
            <label for="follow-up-1">Follow-up 1:</label>
            <input type="text" id="follow-up-1" name="follow-up-1" value="<?php echo $results[0]['followups1'];  ?>">
        </div>
        <div class="form-group">
            <label for="follow-up-2">Follow-up 2:</label>
            <input type="text" id="follow-up-2" name="follow-up-2" value="<?php echo $results[0]['followups2'];  ?>">
        </div>
        <div class="form-group">
            <label for="follow-up-3">Follow-up 3:</label>
            <input type="text" id="follow-up-3" name="follow-up-3" value="<?php echo $results[0]['followups3'];  ?>">
        </div>
        <button name="follow" type="submit">Submit</button>
    </form>
</div>
</body>
</html>