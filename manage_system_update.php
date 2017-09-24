<?	
	session_start();
	include ('config.php');	

 $menu_id=$_REQUEST[menu_id];
 $menu_name=$_REQUEST[menu_name];
 $menu_link=$_REQUEST[menu_link];	
 $menu_icon=$_REQUEST[menu_icon];
 $menu_show=$_REQUEST[menu_show];	
	
//Table: psn_menu
	////menu_id	menu_name	menu_link	menu_icon	menu_show

	$sql=("UPDATE `system_menu` SET `menu_name` = '$menu_name', `menu_link` = '$menu_link' , `menu_icon` = '$menu_icon'  , `menu_show` = '$menu_show' WHERE `system_menu`.`menu_id` = $menu_id; ");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_system.php?s_id=$s_id");	
	
	
		

?>