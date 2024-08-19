<?php
session_start();
if(!isset($_SESSION['active'])){
	header('location:checkLogin.php');
}
include("connection.php");

if (isset($_POST['input1']) && isset($_POST['input2'])) {
    $input1 = $_POST['input1'];
    $value = $_POST['input2'];
    $stmt99="";

if ($input1=="all"){
		$stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE Date LIKE '{$value}%' OR added_by LIKE '{$value}%' OR Company LIKE '{$value}%' OR Name LIKE '{$value}%' OR Position LIKE '{$value}%' OR Email LIKE '{$value}%' OR Phone_Number LIKE '{$value}%' OR Status LIKE '{$value}%' OR Reason LIKE '{$value}%' OR followups1 LIKE '{$value}%' OR followups2 LIKE '{$value}%' OR followups3 LIKE '{$value}%' ");
		$stmt99->execute();
}
if ($input1=="Name"){
    $stmt99 = $db->query("SELECT * FROM trainingplus WHERE Name LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="Date"){
    $stmt99 = $db->query("SELECT * FROM trainingplus WHERE Date LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="Company"){
    $stmt99 = $db->query("SELECT * FROM trainingplus WHERE Company LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="Position"){
    $stmt99 = $db->query("SELECT * FROM trainingplus WHERE Position LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="Phone_Number"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE Phone_Number LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="Email"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE Email LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="Reason"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE Reason LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="Status"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE Status LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="follow"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE followups1 LIKE '{$value}%' OR followups2 LIKE '{$value}%' OR followups3 LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="follow1"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE followups1 LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="follow2"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE followups2 LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="follow3"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE followups3 LIKE '{$value}%'");
    $stmt99->execute();
}
if ($input1=="added_by"){
    $stmt99 = $db->prepare("SELECT * FROM trainingplus WHERE added_by LIKE '{$value}%'");
    $stmt99->execute();
}


if($stmt99!==""){
    if ($stmt99->rowCount()>0){?>
        <table>
            <thead>
                <tr>
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
                <th>Added By</th>
      
         
			
			</tr>
		</thead>
             
		<tbody><?php 
              $results1=$stmt99->fetchAll(PDO::FETCH_ASSOC);
			  foreach($results1 as $row){
                 $x=$row['serial_number'];
				echo"		
				<tr>     
				<td>  <form method='post' action='followup.php?serial=$x'>
                <button type='submit'>Follow Up</button>
            </form></td> 		
            <td>". $row['serial_number']."</td>
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
                
                
                
                
                
                <?php }else{
                    if($input1=="all"){$input1="value";}
                    echo"<h2>Sorry no records with this ".$input1. "<h2>";
    }
}

}



?>
