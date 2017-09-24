<?
 $pin_id = $_SESSION['user_id'];
$color="#ff99ff";
//$this_sys_sub2="";
// 	menu_id		menu_name		menu_link		menu_icon
$sql5=("SELECT * FROM system_menu where menu_id_child='$s_id' order by menu_id ");
$results5 = $mysqli->query($sql5);
?>									
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><? echo $menu_name;?></h3>	
		<i><? echo "พบข้อมูล ".$results5->num_rows." รายการ ";?></i>											
	</div>
	<!-- /.col-lg-12 -->
</div>
						
						
				