<?	
	session_start();
	include ('config.php');	

 $depgroup_id=$_REQUEST[depgroup_id];
	
	$sql=("DELETE FROM `psn_depgroup` WHERE `psn_depgroup`.`depgroup_id` = $depgroup_id; ");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_group.php");	
	
	
		

?>