<?php 
ob_start();
session_start();
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}
if (isset($_POST['logout'])) {
	// Clear the session
	session_unset();
	session_destroy();
	header("Location: login.php");
	exit();
}
if (isset($_POST['pass'])) {
	// Clear the session
	header('location:changeSelect.php');
}
if (isset($_POST['deleteAcc'])) {
	// Clear the session
	header('location:deleteAccount.php');
}
if (isset($_POST['add'])) {
	// Clear the session
	header('location:addNewData.php');
}
if (isset($_POST['edit'])) {
	// Clear the session
	header('location:editData.php');
}
?>
<!DOCTYPE html>
<html>
<form method="post">
<button class="right" type="submit" name="logout" > Logout </button>
<button class="right" type="submit" name="pass" > Security Changes </button>
<button class="right" type="submit" name="deleteAcc" > Delete Account </button>
        </form>
<head>

	<title>Database</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
.right{

}
		/* table {
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
		} */

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
button {
  padding: 5px 10px;
  border: none;
  background-color: #539256;
  color: #fff;
  font-size: 14px;
  cursor: pointer;
}

button:hover {
  background-color: #3e8e41;
}



input:focus {
  outline: none;
}

.show {
  background-color: #f2f2f2;
}

.edit_button {
  margin-right: 5px;
}

.topright{
  position: absolute;
  top: 80px;
  right:4px;
}

.avatar{
  width: 100px;
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
	<button type="submit" name='edit'>  Edit Learner Informations</button><br><br>

</form>
	<label >Search here :</label>
			  <select name='para' id='para'>
			  <option ></option>
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
<input type='text' id='search' name='search'>
<button id='printBtn'>Print</button>
<button id='exportBtn'>Download to excel</button>
	<br>
	
	<br>
	<div id="searchResult">

	<table id='mytable'>
		<thead>
			<tr>
            <th></th>
				<th>Date</th>
				<th>Name</th>
				<th>Company</th>
				<th>Position</th>
				<th>Phone Number</th>
				<th>Email</th>
				<th>Reason</th>
                <th>Status</th>
				<th>Added By</th>
				
			</tr>
		</thead>
		<tbody><?php 
              include('connection.php');
              $stmt99 = $db->prepare("SELECT * FROM trainingplus");
              $stmt99->execute();
              $results=$stmt99->fetchAll(PDO::FETCH_ASSOC);
			  ?>
			  <?php 
			  foreach($results as $row){
                 $x=$row['serial_number'];
				echo"	
				<tr>     
				<td>  <form method='post' action='followup.php?serial=$x'>
                <button type='submit'>Follow Up</button>
            </form></td> 
				<td hidden>". $row['serial_number']."</td>
				<td>". $row['Date']."</td>
				<td>". $row['Name']."</td>
				<td>". $row['Company']."</td>
                <td>". $row['Position']."</td>
				<td>". $row['Phone_Number']."</td>
				<td>". $row['Email']."</td>
				<td>". $row['Reason']."</td>
				<td>". $row['Status']."</td>
				<td>". $row['added_by']."</td>
			</tr>";
			
			}


?>
		</tbody>
	</table>
  
	</div>



</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/file-saver"></script>
 <script>
$(document).ready(function() {

	$('#exportBtn').click(function(){
    exportToExcel();
  });

 

  $('#printBtn').click(function(){
    printTable();
  });

  function exportToExcel() {
    var wb = XLSX.utils.table_to_book(document.getElementById('mytable'), {sheet: 'Sheet1'});
    var wbout = XLSX.write(wb, {bookType: 'xlsx', type: 'array'});
    saveAs(new Blob([wbout], {type: 'application/octet-stream'}), 'table_data.xlsx');
  }

 
 
  function printTable() {
    window.print();
  }







    $("#para, #search").on('change keyup', function() {
        var input1 = $("#para").val();
        var input2 = $("#search").val();
		

		if(input2!=="" || input2==""){
			console.log(input2);
			if(input1==""){
				input1="all";
 			}
            $.ajax({
                url: "searching.php",
                method: "POST",
                data: {
                    input1: input1,
                    input2: input2
                },
                success: function(data) {
                    $("#searchResult").html(data);
                }
            });
        }
		
		
    });
});
	</script>
</html>
