<?	
	session_start();
	include ('config.php');	


 $menu_id=$_REQUEST[menu_id_add];
 $menu_name=$_REQUEST[menu_name_add];
 $menu_link=$_REQUEST[menu_link_add];	
 $menu_icon=$_REQUEST[menu_icon_add];
 $menu_show=$_REQUEST[menu_show_add];	
 
	//Table: psn_menu
	////menu_id	menu_name	menu_link	menu_icon	menu_show

	$sql=("INSERT INTO `system_menu` (`menu_id`, `menu_name`, `menu_link`, `menu_icon`, `menu_show`) VALUES ('$menu_id', '$menu_name', '$menu_link','$menu_icon', '$menu_show');");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:manage_system.php");	
	
	
		

?>