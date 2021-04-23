<?php
	$url=$_SERVER['REQUEST_URI'];
	header("Refresh: 5; URL=$url"); // Refresh the webpage every 5 seconds
?>
<html>
	<head>
		<title>Arduino Ethernet Database</title>
		<style type="text/css">
			.table_titles {
				padding-right: 20px;
				padding-left: 20px;
				color:#FFF;
				background-color:#606060;
			}
			table {
				border: 2px solid #333;
			}
			.table_cells_odd {
				background-color:#F0F0F0;
				padding-right: 20px;
				text-align:right;
			}
			.table_cells_even {
				background-color:#A0A0A0;
				padding-right: 20px;
				text-align:right;
			}
			body { 
				font-family: "Trebuchet MS", Courier; 
			}
		</style>
	</head>

	<body>
		<h1>Arduino Data Logging to Database</h1>
		<table border="0" cellspacing="0" cellpadding="4">
			<tr>
				<td class="table_titles">ID</td>
				<td class="table_titles">Entrance</td>
			</tr>
			<?php
				include('connection.php');

				$result = mysqli_query($con,'SELECT * FROM gate_ins ORDER BY id DESC');
				$oddrow = true;

				while($row = mysqli_fetch_array($result))
				{
					if ($oddrow) {
						$css_class=' class="table_cells_odd"';
					}else{
						$css_class=' class="table_cells_even"';
					}

					$oddrow = !$oddrow; 
					echo "<tr>";
					echo "<td '.$css_class.'>" . $row['id'] . "</td>";
					echo "<td '.$css_class.'>" . $row['gate_in'] . "</td>";
					echo "</tr>"; 
				}
				 
				// Close the connection
				mysqli_close($con);
			?>
		</table>
	</body>
</html>