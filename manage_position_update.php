<?	
	session_start();
	include ('config.php');	

 $position_id=$_REQUEST[position_id];
 $position_name=$_REQUEST[position_name];
 $pcolor=$_REQUEST[pcolor];	
	
	//Table: psn_position
	//position_id  position_name  color  

	$sql=("UPDATE `psn_position` SET `position_name` = '$position_name', `color` = '$pcolor' WHERE `psn_position`.`position_id` = $position_id; ");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_position.php?s_id=$s_id");	
	
	
		

?>