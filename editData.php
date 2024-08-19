<?php 
ob_start();
session_start();
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}
if (isset($_POST['add'])) {
	// Clear the session
	header('location:addNewData.php');
}
if (isset($_POST['home'])) {
	// Clear the session
	header('location:home.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Database</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
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
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		.avatar{
  width: 100px;
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
body{
  background-color: #f5f5dc;
}
	</style>
</head>
<body>
<div class='container'>
	<h1>Training Plus</h1>
	<form method="post">
	<button type="submit" name='add'> add new learner </button><br><br>
	<button  type="submit" name="home" > Back to home </button>
</form>
	<label> Search here :<label>
	<select id="searchParam">
		<option></option>
			  <option value='all'>All</option>
				<option value='Date'>Date</option>
				<option value='Name'>Name</option>
				<option value='Company'>Company</option>
				<option value='Position'>Position</option>
				<option value='Phone_Number'>Phone Number</option>
				<option value='Email'>Email</option>
				<option value='Reason'>Reason</option>
				<option value='Status'>Status</option>
				<option value='follow'>follow ups</option>
				<option value='follow1'>follow up1</option>
				<option value='follow2'>follow up2</option>
				<option value='follow3'>follow up3</option>
				<option value='added_by'>Added By</option>
</select>
	<input type='text' id='search' Date='search-value'>

	<table id='mytable'>
		<thead>
        <tr>
           
		<th></th>
		<th></th>
		<th></th>
		<th></th>
				<th>Date</th>
				<th>Name</th>
				<th>Company</th>
				<th>Position</th>
				<th>Phone Number</th>
				<th>Email</th>
				<th>Reason</th>
                <th>Status</th>
                <th>follow up1</th>
                <th>follow up2</th>
                <th>follow up3</th>
                <th>Added By</th>
			
         
			</tr>
		
		</thead>
		<tbody><?php 
              include('connection.php');
              $stmt99 = $db->prepare("SELECT * FROM `trainingplus` WHERE 1");
              $stmt99->execute();
              $results=$stmt99->fetchAll(PDO::FETCH_ASSOC);
			  foreach($results as $row){
                 $x=$row['serial_number'];
				echo"		
				<tr>
				<td><button id='button_$x' class='edit_button' onclick='editRow($x)'>Edit</button></td>
				<td><form method='post'><button type='submit' hidden id='button3_$x' name='submitting3_$x' class='edit_button'>Delete</button></td>
				<td><button type='submit' name='submitting_$x' hidden id='button2_$x' class='edit_button2'>Save</button></td>		
				<td><input hidden disabled class='show' type='number' id='serial' name='SN_$x' value=". $row['serial_number']."></td>
				<td><input disabled class='show' type='date' id='Date' name='Date_$x' value=". $row['Date']."></td>
				<td><input disabled class='show' type='text' id='Name' name='Name_$x' value=". $row['Name']."></td>
				<td><input disabled class='show' type='text' id='Company'  name='Company_$x' value=". $row['Company']."></td>
                <td><input disabled class='show' type='text' id='Position' name='Position_$x' value=". $row['Position']."></td>
				<td><input disabled class='show' type='number'id='Phone_Number' name='Phone_Number_$x' value=". $row['Phone_Number']."></td>
				<td><input disabled class='show' type='email' id='Email' name='Email_$x' value=". $row['Email']."></td>
				<td><input disabled class='show' type='text' id='Reason' name='Reason_$x' value=". $row['Reason']."></td>
				<td><input disabled class='show' type='text' id='Status' name='Status_$x' value=". $row['Status']."></td>
				<td><input disabled class='show' type='text' id='follow1' name='follow1_$x' value=". $row['followups1']."></td>
				<td><input disabled class='show' type='text' id='follow2' name='follow2_$x' value=". $row['followups2']."></td>
				<td><input disabled class='show' type='text' id='follow3' name='follow3_$x' value=". $row['followups3']."></td>
				<td><input disabled class='show' type='text' id='added_by' name='added_by_$x' value=". $row['added_by']."></td>
			    </form></tr>";
				if(isset($_POST["submitting_$x"])){
					saveRow($x);
              
            }
			if(isset($_POST["submitting3_$x"])){
				deleteRow($x);
			}
		}
	
		function deleteRow($x){
			include('connection.php');
			
			$stmt0 = $db->prepare("SELECT * FROM `trainingplus` WHERE `serial_number`=?");
				$stmt0->execute([$x]);
				$results0=$stmt0->fetchAll(PDO::FETCH_ASSOC);
				foreach($results0 as $row0){
					$l=$row0['Name'];}
			// Delete the row
			$stmt = $db->prepare("DELETE FROM trainingplus WHERE serial_number = :serial_number");
			$stmt->bindValue(':serial_number', $x);
			
			// Execute the delete statement
			if($stmt->execute()){
				// Row deleted successfully
				echo "Student ".$l." has been deleted";
				header("Refresh:1");
				ob_end_flush();
			} else {
				// Failed to delete the row
				echo "Failed to delete Student".$l."";
			}
		}
		function saveRow($x){
				$edited="";
				include('connection.php');
				$stmt0 = $db->prepare("SELECT * FROM `trainingplus` WHERE `serial_number`=?");
				$stmt0->execute([$x]);
				$results0=$stmt0->fetchAll(PDO::FETCH_ASSOC);
				foreach($results0 as $row0){
					$l=$row0['Name'];
					if (isset($_POST["Date_$x"])&&trim($_POST["Date_$x"])!==""&&trim($_POST["Date_$x"])!==$row0['Date']){$Date=$_POST["Date_$x"];}else{$Date=$row0['Date'];}
					if (isset($_POST["Name_$x"])&&trim($_POST["Name_$x"])!==""&&trim($_POST["Name_$x"])!==$row0['Name']){$Name=$_POST["Name_$x"];}else{$Name=$row0['Name'];}
					if (isset($_POST["Company_$x"])&&trim($_POST["Company_$x"])!==""&&trim($_POST["Company_$x"])!==$row0['Company']){$Company=$_POST["Company_$x"];}else{$Company=$row0['Company'];}
					if (isset($_POST["Position_$x"])&&trim($_POST["Position_$x"])!==""&&trim($_POST["Position_$x"])!==$row0['Position']){$Position=$_POST["Position_$x"];}else{$Position=$row0['Position'];}
					if (isset($_POST["Phone_Number_$x"])&&trim($_POST["Phone_Number_$x"])!==""&&trim($_POST["Phone_Number_$x"])!==$row0['Phone_Number']){$Phone_Number=$_POST["Phone_Number_$x"];}else{$Phone_Number=$row0['Phone_Number'];}
					if (isset($_POST["Email_$x"])&&trim($_POST["Email_$x"])!==""&&trim($_POST["Email_$x"])!==$row0['Email']){$Email=$_POST["Email_$x"];}else{$Email=$row0['Email'];}
					if (isset($_POST["Reason_$x"])&&trim($_POST["Reason_$x"])!==""&&trim($_POST["Reason_$x"])!==$row0['Reason']){$Reason=$_POST["Reason_$x"];}else{$Reason=$row0['Reason'];}
					if (isset($_POST["Status_$x"])&&trim($_POST["Status_$x"])!==""&&trim($_POST["Status_$x"])!==$row0['Status']){$Status=$_POST["Status_$x"];}else{$Status=$row0['Status'];}
					if (isset($_POST["follow1_$x"])&&trim($_POST["follow1_$x"])!==""&&trim($_POST["follow1_$x"])!==$row0['followups1']){$follow1=$_POST["follow1_$x"];}else{$follow1=$row0['followups1'];}
					if (isset($_POST["follow2_$x"])&&trim($_POST["follow2_$x"])!==""&&trim($_POST["follow2_$x"])!==$row0['followups2']){$follow2=$_POST["follow2_$x"];}else{$follow2=$row0['followups2'];}
					if (isset($_POST["follow3_$x"])&&trim($_POST["follow3_$x"])!==""&&trim($_POST["follow3_$x"])!==$row0['followups3']){$follow3=$_POST["follow3_$x"];}else{$follow3=$row0['followups3'];}
					$added_by=$row0['added_by'];					
				
		}
		$stmt = $db->prepare("UPDATE `trainingplus` SET `Date`=?,`Name`=?,`Company`=?,`Position`=?,`Phone_Number`=?,`Email`=?,`Reason`=?,`Status`=?,`followups1`=?,`followups2`=?,`followups3`=? ,`added_by`=? WHERE `serial_number`=?");
	$stmt->execute([$Date,$Name,$Company,$Position,$Phone_Number,$Email,$Reason,$Status,$follow1,$follow2,$follow3,$added_by,$x]);
	echo"Student ".$l." Updated Successfully !";
	header("Refresh:1");
ob_end_flush();}
	?>
		</tbody>
	</table>

    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>

function editRow(id) {
	let row = document.getElementById(`button_${id}`).parentNode.parentNode;
	let row2 = document.getElementById(`button2_${id}`);
	let row3 = document.getElementById(`button3_${id}`);
  let inputs = row.querySelectorAll('input');
  $f=true
  row2.hidden=!$f;
  row3.hidden=!$f;
  for (let i = 1; i < inputs.length-1; i++) {
    inputs[i].disabled = false;
  }
  let button = row.querySelector('.edit_button');
  button.innerHTML = 'Edit';
  button.onclick = function() { closeRow(id); };
}
function deleteRow() {
console.log('hi');}
function closeRow(id) {
  let row = document.getElementById(`button_${id}`).parentNode.parentNode;
  let row2 = document.getElementById(`button2_${id}`);
  let row3 = document.getElementById(`button3_${id}`);
  let inputs = row.querySelectorAll('input');
  $f=true 
  row2.hidden=$f;
  row3.hidden=$f;
  for (let i = 0; i < inputs.length; i++) {
    inputs[i].disabled = true;
  }
  let button = row.querySelector('.edit_button');
  button.innerHTML = 'Edit';
  button.onclick = function() { editRow(id); };
	   
}
$(document).ready(function(){
	$('#search').keyup(function(){
  search_table();
});

function search_table() {
  var param = $('#searchParam').val();
  var value = $('#search').val().toLowerCase();
  $('#mytable tbody tr').each(function () {
    var found = false;
    $(this).find('td').each(function (index) {

		if ((param === 'all'|| param=="") && 
		($(this).find('input').attr('id') == 'Date'  ||
        $(this).find('input').attr('id') == 'Name' ||
		 $(this).find('input').attr('id') == 'Company' ||
		 $(this).find('input').attr('id') == 'Position' ||
		 $(this).find('input').attr('id') == 'Phone_Number' ||
		 $(this).find('input').attr('id') == 'Email' ||
		 $(this).find('input').attr('id') == 'Reason' ||
		 $(this).find('input').attr('id') == 'Status' ||
		 $(this).find('input').attr('id') == 'follow1' ||
		 $(this).find('input').attr('id') == 'follow2' ||
		 $(this).find('input').attr('id') == 'follow3'||
		 $(this).find('input').attr('id') == 'added_by'
)) {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
		

 
	  if (param === 'Date' && $(this).find('input').attr('id') == 'Date') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'Name' && $(this).find('input').attr('id') == 'Name') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'Company' && $(this).find('input').attr('id') == 'Company') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'Position' && $(this).find('input').attr('id') == 'Position') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'Phone_Number' && $(this).find('input').attr('id') == 'Phone_Number') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'Email' && $(this).find('input').attr('id') == 'Email') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'Reason' && $(this).find('input').attr('id') == 'Reason') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'Status' && $(this).find('input').attr('id') == 'Status') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'follow' &&( $(this).find('input').attr('id') == 'follow1'
	  ||$(this).find('input').attr('id') == 'follow2'||$(this).find('input').attr('id') == 'follow3')) {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'follow1' && $(this).find('input').attr('id') == 'follow1') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'follow2' && $(this).find('input').attr('id') == 'follow2') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'follow3' && $(this).find('input').attr('id') == 'follow3') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
	  if (param === 'added_by' && $(this).find('input').attr('id') == 'added_by') {
        var cellValue = $(this).find('input').val().toLowerCase();
        if (cellValue.charAt(0) === value.charAt(0)) {
			if(cellValue.indexOf(value)>=0){

			
found = true;
}}
      }
      
    });
    if (value === '' || found) {
      $(this).show();

    } else {
		$(this).hide();
    }
  });
  $('#mytable thead tr').show();
}})
	</script>
</html>
