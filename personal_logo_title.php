 <?
$s_id=17;

$sql5=("SELECT * FROM system_menu WHERE menu_id = '$s_id' ");
$results5 = $mysqli->query($sql5);
if($results5->num_rows > 0){		
	while($row5 = $results5->fetch_assoc()) {
		$this_sys=$row5["menu_name"];
		$menu_link=$row5["menu_link"];
		$menu_icon=$row5["menu_icon"];
	}
}
 ?>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main.php"><? echo $system_name;?> : <? echo $school_name;?></a>
				
            </div>
            <!-- /.navbar-header -->
