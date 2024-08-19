<?php
session_start();
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}
if (isset($_POST['home'])) {
	// Clear the session
	header('location:home.php');
}
$DateMsg="";
$NameMsg="";
$CompanyMsg="";
$PositionMsg="";
$PhoneNumberMsg="";
$EmailMsg="";
$StatusMsg="";
$errorempty="";
$reasonForMSg="";
$added="";

if(isset($_POST['submit'])){
  if(isset($_POST['Date']) && isset($_POST['Name'])
 && isset($_POST['Company']) && isset($_POST['Position']) 
 && isset($_POST['Phone_Number'])&&
  isset($_POST['Email'])&&
  isset($_POST['Reason'])&&
   isset($_POST['Status'])&&
    isset($_POST['followup1'])&&
    isset($_POST['followup2'])&&
    isset($_POST['followup3'])){
      if(trim($_POST['Date'])=="" 
&& trim($_POST['Name'])==""
&& trim($_POST['Reason'])==""
&& trim($_POST['Company'])==""
&& trim($_POST['Position'])==""
&& trim($_POST['Phone_Number'])==""
&& trim($_POST['Email'])==""
&& trim($_POST['Status'])==""


){$errorempty= "No Data Inserted";}
else{
  if(trim($_POST['Date'])==""){$DateMsg="Date is required<br>";}
  else{  $Date=$_POST['Date']; }
  if(trim($_POST['Reason'])==""){$reasonForMSg="Reason is required<br>";}
  else{  $Reason=$_POST['Reason']; }
    if(trim($_POST['Name'])==""){  $NameMsg="Name is required<br>";}
    else{   $Name=$_POST['Name'];  }
    if(trim($_POST['Company'])==""){  $CompanyMsg="Company is required<br>";}
    else{  $Company=$_POST['Company']; }
    if(trim($_POST['Position'])==""){  $PositionMsg="Position is required<br>";}
    else{     $Position=$_POST['Position'];}
    if(trim($_POST['Phone_Number'])==""){  $PhoneNumberMsg="Phone Number is required<br>";}
    else{      $Phone_Number=$_POST['Phone_Number'];  }
    if(trim($_POST['Email'])==""){  $EmailMsg="Email is required<br>";}
    else{      $Email=$_POST['Email'];  }
    if(trim($_POST['Status'])==""){  $StatusMsg="Status is required<br>";}
    else{      $Status=$_POST['Status'];    }

      if(trim($_POST['Date'])=="" 
|| trim($_POST['Name'])==""
|| trim($_POST['Reason'])==""
|| trim($_POST['Company'])==""
|| trim($_POST['Position'])==""
|| trim($_POST['Phone_Number'])==""
|| trim($_POST['Email'])==""
|| trim($_POST['Status'])==""


){$errorempty= "Some Area is missing";}
else{
     $addedBy=$_SESSION['active'];
  if(isset($_POST['followup1'])){$follow1=$_POST['followup1'];}
  else{$follow1="";} 
  if(isset($_POST['followup2'])){$follow2=$_POST['followup2'];}
  else{$follow2="";} 
  if(isset($_POST['followup3'])){$follow3=$_POST['followup3'];}
  else{$follow3="";}

      include('connection.php');  
    
      $stmt = $db->prepare("INSERT INTO trainingplus (Date, Name, Company, Position, Phone_Number, Email,Reason, Status,followups1,followups2,followups3,added_by) VALUES (:Date, :Name, :Company, :Position, :Phone_Number, :Email,:Reason, :Status,:followups1,:followups2,:followups3,:added_by)");
      $stmt->bindParam(':Date', $Date);
      $stmt->bindParam(':Name', $Name);
      $stmt->bindParam(':Company', $Company);
      $stmt->bindParam(':Position', $Position);
      $stmt->bindParam(':Phone_Number', $Phone_Number);
      $stmt->bindParam(':Email', $Email);
      $stmt->bindParam(':Reason', $Reason);
      $stmt->bindParam(':Status', $Status);
      $stmt->bindParam(':followups1', $follow1);
      $stmt->bindParam(':followups2', $follow2);
      $stmt->bindParam(':followups3', $follow3);
      $stmt->bindParam(':added_by', $addedBy);

      
      $stmt->execute();
      $added="New Student Inserted Successfully";
    }
     }
    }

}

?>

<!DOCTYPE html>
<html>
<head>
      <form method="post">
<button class="right" type="submit" name="home" > Back to home </button>
        </form>
	<title>Add New Data</title>
	<style>

.avatar{
  width: 100px;
}
    .btn{
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 8px 8px;
    }
    .back{
      
    }
		h1{
      text-align: center;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    .boxes{
      display: flex;
      align-items: center;
      justify-content: center;
    }
    table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #4CAF50;
			color: white;
      font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
		}
		tr:hover {
			background-color: #f5f5f5;
		}

    body{
  background-color: #f5f5dc;
}

button {
  padding: 5px 10px;
  border: none;
  background-color: #4CAF50;
  color: #fff;
  font-size: 14px;
  cursor: pointer;
}

button:hover {
  background-color: #3e8e41;
}
.errorempty{
  display: flex;
  align-items: center;
  justify-content: center;
  color: red;
}
.added{
  display: flex;
  align-items: center;
  justify-content: center;
  color: green;
}
.errbox{
  color: red;
}
	</style>
</head>
<body>
<h1>Add New Learner</h1>
<h3 class="errorempty"><?php echo $errorempty; ?></h3>
<h3 class="added"><?php echo $added; ?></h3>
<container class='all'>
<table>
		<thead>
			<tr><th>new learner details</th></tr></thead>
  <tbody>
<form action='addNewData.php' method='post'>
 <div class="boxes">
  <tr><td>
  <label for='Date'>Date</label>
  <input type='date' id='Date' name='Date'>
 <label class="errbox"> <?php echo $DateMsg; ?></label>
  </td></tr>
</div>
<div class="boxes">
<tr><td>
  <label for='Name'>Name</label>
  <input type='text' id='Name' name='Name'>
  <label class="errbox">  <?php echo$NameMsg; ?></label>
  </td></tr>

</div>
<div class="boxes">
<tr><td>
  <label for='name'>Company</label>
  <input type='text' id='Company' name='Company'>
  <label class="errbox"><?php echo$CompanyMsg; ?> </label>
  </tr></td>

</div>
<div class="boxes">
<tr><td>

<label for='Position'>Position</label>
  <input type='text' id='Position' name='Position'>
  <label class="errbox"><?php echo$PositionMsg; ?> </label>
  </tr></td>

</div>
<div class="boxes">
  <tr><td>

  <label for='Phone_Number'>Phone_Number</label>
  <input type='number' id='Phone_Number' name='Phone_Number'>
  <label class="errbox"> <?php echo$PhoneNumberMsg; ?></label>

  </tr></td>

</div>
<div class="boxes">
<tr><td>

  <label for='Email'>Email</label>
  <input type='email' id='Email' name='Email'>
  <label class="errbox"><?php echo$EmailMsg; ?></label>

  </tr></td>

</div>
<div class="boxes">
<tr><td>

  <label for='Reason'>Reason For Contacting</label>
  <input type='Reason' id='Reason' name='Reason'>
  <label class="errbox"><?php echo$reasonForMSg; ?></label>

  </tr></td>

</div><div class="boxes">
<tr><td>

  <label for='Status'>Status</label>
  <input type='Status' id='Status' name='Status'>
  <label class="errbox"><?php echo$StatusMsg; ?></label>

  </tr></td>

</div>

<div class="boxes">
<tr><td>

  <label for='followup1'>Follow Up 1</label>
  <input type='followup1' id='followup1' name='followup1'>

  </tr></td>

</div>
<div class="boxes">
<tr><td>

  <label for='followup2'>Follow Up 2</label>
  <input type='followup2' id='followup2' name='followup2'>

  </tr></td>

</div>
<div class="boxes">
<tr><td>

  <label for='followup3'>Follow Up 3</label>
  <input type='followup3' id='followup3' name='followup3'>

  </tr></td>

</div>
  <div class="boxes">
  <tr><td>
  <button class="btn" name='submit' type='submit'>Add Learner</button>
  </td></tr>
  </div>

</form>
</tbody>
</table>

</container>
</body>
</html>