<?php
	include ('connection.php');
	$sql_insert = "INSERT INTO gate_ins (gate_in) VALUES ('".$_GET["gate_in"]."')";
	
	if(mysqli_query($con, $sql_insert)) {
		
		echo "Done";
		mysqli_close($con);

	} else {
		echo "error is ".mysqli_error($con);
	}
?>