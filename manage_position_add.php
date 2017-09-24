<?	
	session_start();
	include ('config.php');	

 $position_id=$_REQUEST[position_id_add];
 $position_name=$_REQUEST[position_name_add];
 $pcolor=$_REQUEST[pcolor_add];	
	
	//Table: psn_position
	//position_id  position_name  color  

	$sql=("INSERT INTO `psn_position` (`position_id`, `position_name`, `color`) VALUES ('$position_id', '$position_name', '$pcolor');");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_position.php?s_id=$s_id");	
	
	
		

?>