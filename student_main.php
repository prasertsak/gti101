<?
 session_start();
 include("config.php");
 include("set_bootstrap.php");
 include("check_session.php");
 include("function.php");
 $msel=$_REQUEST["msel"];
?>

<body>

    <div id="wrapper">
        <? 
			include("student_nav.php");
			?>
        <div id="page-wrapper">
		<? 
		if($msel=="")
			include("student_show_link.php");
		else{
									// 	menu_id		menu_name		menu_link		menu_icon
			$sql5=("SELECT * FROM system_menu where menu_id='$msel' and  menu_id_child != '0'  ");
			//echo $sql5."=<br>";
			$results5 = $mysqli->query($sql5);
			//echo $results5->num_rows."=<br>";
			if($results5->num_rows > 0){		
				$row5 = $results5->fetch_assoc() ;
					$menu_name=$row5["menu_name"];
					$menu_link=$row5["menu_link"];
					$menu_icon=$row5["menu_icon"];
					include($menu_link);
												
			}
		}
			?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?
 include("foot_bootstrap.php");
?>


</body>

</html>
