<?	
	session_start();
	include ('config.php');	

 $position_id=$_REQUEST[position_id];
	
	//Table: psn_position
	//position_id  position_name  color  

	$sql=("DELETE FROM `psn_position` WHERE `psn_position`.`position_id` = $position_id; ");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_position.php");	
	
	
		

?>