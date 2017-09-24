<?	
	session_start();
	include ('config.php');	

	$depgroup_id=$_REQUEST[depgroup_id_add];
	$depgroup_name=$_REQUEST[depgroup_name_add];
	$link=$_REQUEST['link_add'];	
	$show=$_REQUEST[show_add];
	
	//Table: psn_depgroup
	//depgroup_id	depgroup_name	show	link

	$sql=("INSERT INTO `psn_depgroup` (`depgroup_id`, `depgroup_name`, `link`, `show`) VALUES ('$depgroup_id', '$depgroup_name', '$link', '$show');");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_group.php");	
	
	
		

?>