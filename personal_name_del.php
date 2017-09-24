<?	
	session_start();
	include ('config.php');	

 $menu_id=$_REQUEST[menu_id];
	
//Table: psn_menu
	////menu_id	menu_name	menu_link	menu_icon	menu_show

	$sql=("DELETE FROM `system_menu` WHERE `system_menu`.`menu_id` = $menu_id; ");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_system.php");	
	
	
		

?>