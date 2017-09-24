<?	
	session_start();
	include ('config.php');	

//depgroup_id	depgroup_name	show	link
 $depgroup_id=$_REQUEST[depgroup_id];
 $depgroup_name=$_REQUEST[depgroup_name];
 $link=$_REQUEST['link'];	
  $show=$_REQUEST[show];	
	
	//Table: psn_depgroup
	//depgroup_id	depgroup_name	show	link

	$sql=("UPDATE `psn_depgroup` SET `depgroup_name` = '$depgroup_name', `show` = '$show', `link` = '$link' WHERE `psn_depgroup`.`depgroup_id` = $depgroup_id;");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_group.php");	
	
	
		

?>