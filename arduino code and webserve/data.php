<?php
	include ('connection.php');

	$sql_insert = "INSERT INTO gates (gate_in, gate_out, created_at) VALUES ('".$_GET["gate_in"]."', '".$_GET["gate_out"]."', CURRENT_TIMESTAMP())";
	
	if(mysqli_query($con, $sql_insert)) {
		
		echo "Done";
		mysqli_close($con);

	} else {
		echo "error is ".mysqli_error($con);
	}
?>