<?
 $pin_id = $_SESSION['user_id'];
 $stu_id = $_REQUEST['stu_id'];
 $pt_id2 = $_REQUEST['pt_id2'];
 $act = $_REQUEST['act'];
$color="#ff99ff";
$sub_sys="ค้นหาข้อมูลร่วมกิจกรรม";
//$this_sys_sub2="";
// 	menu_id		menu_name		menu_link		menu_icon
$sql5=("SELECT * FROM system_menu where menu_id_child='$s_id' order by menu_id ");
$results5 = $mysqli->query($sql5);

//	term   mark_use
$sql5=("SELECT * FROM system_term_mark where mark_use='1'   ");
$results5 = $mysqli->query($sql5);
if($results5->num_rows > 0){		
		$send_count=0;
		while($row5 = $results5->fetch_assoc()) {
			$term=$row5["term"];
			//$mark_use=$row5["mark_use"];		
		}
}
?>									
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><? echo $menu_name;?></h3>	
											
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<? echo $sub_sys;?> ปีการศึกษา <? echo $term;?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">	
			<form method="POST" class="form-inline">
				<label for="stu_id" >ใส่รหัสนักศึกษา 10 หลัก</label>
				<input name="stu_id"  id="stu_id" > 					
				<input type="submit" class="btn btn-primary" value="ค้นหา">					
				<input type="hidden" name="act" value="find">
			</form>
			</div>
		</div>
	</div>
</div>
<?
if($act=="find")
{
	
$student_name="ไม่พบข่อมูล";
$gname="ไม่พบข่อมูล";
$gdep="ไม่พบข่อมูล";
$sql6=("SELECT std_student.NAME sn,std_student.GRO sg FROM std_student WHERE   CODE='$stu_id' ");
	//echo $sql6."<br>";
	$results6 = $mysqli->query($sql6);

	if($results6->num_rows > 0){
		//echo "พบข้อมูล ".$results6->num_rows." รายการ	";	
		while($row6 = $results6->fetch_assoc()) {
			$mcount++;										
			$student_name=$row6['sn'];
			$student_g_id=$row6['sg'];
		}
		//std_group :		CODE		GROUPS		NAME		ADVISOR		MAN		LADY		TOTAL		SEMES		DEPWORK		TELEPHONE
		$sql61=("SELECT GROUPS,NAME	 FROM std_group WHERE   CODE='$student_g_id' ");
		//echo $sql6."<br>";
		$results61 = $mysqli->query($sql61);

		if($results61->num_rows > 0){
			//echo "พบข้อมูล ".$results61->num_rows." รายการ	";	
			while($row61 = $results61->fetch_assoc()) {
				$mcount++;										
				$gname=$row61['GROUPS'];
				$gdep=$row61['NAME'];
			}
		}
	}
	else
	{
		return;
	}
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<? echo $sub_sys;?> ปีการศึกษา <? echo $term;?> ของ นักศึกษา รหัส <? echo $stu_id;?> 
				ชื่อ <? echo $student_name;?> กลุ่ม  <? echo $gname;?>(<? echo $gdep;?>)
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">	
				<div class="table">
						<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
							<thead>
								<tr>																							
									<th class="text-center">ลำดับที่</th>	
									<th class="text-center">ชื่อกิจกรรม</th>	
									<th class="text-center">วันที่</th>							
									<th class="text-center">จำนวน</th>
									
								</tr>
							</thead>
							<tbody>		
	<?
	$sql6=("SELECT act_project_datain.pt_id,count(act_project_datain.date_join) adj FROM act_project_datain WHERE   student_id='$stu_id' and term='$term' group by act_project_datain.term,act_project_datain.pt_id order by pt_id");
	//echo $sql6."<br>";
	$results6 = $mysqli->query($sql6);

	if($results6->num_rows > 0){
		echo "พบข้อมูล ".$results6->num_rows." รายการ	";	
		while($row6 = $results6->fetch_assoc()) {
			$mcount++;										
			$pt_id=$row6['pt_id'];
			$adj=$row6['adj'];

			//	term	pt_id	pt_name 	date_start	date_stop
			$sql7=("SELECT * FROM act_project_title where term='$term' and  pt_id='$pt_id'  ");
			$results7 = $mysqli->query($sql7);
			if($results7->num_rows > 0){
				$row7= $results7->fetch_assoc();
				//$term=$row7["term"];
				$pt_id=$row7["pt_id"];											
				$pt_name=$row7["pt_name"];		
				$date_start=$row7["date_start"];											
				$date_stop=$row7["date_stop"];	
				?>
				<tr>																							
					<td class="text-center"><? echo $pt_id;?></td>	
					<td class="text-center"><? echo $pt_name;?></td>	
					<td class="text-center"><? echo $date_start;?> ถึง <? echo $date_stop;?></td>	
					<td class="text-center">
					<a href="?msel=<? echo $msel;?>&mlink=<? echo $mlink;?>&act=date&stu_id=<? echo $stu_id;?>&pt_id2=<? echo $pt_id;?>">
					<? echo $adj;?> วัน
					</a>
					</td>	
				</tr>			
				<?
			}
		}
	}
	else
	{
		echo "ไม่พบข้อมูลเข้าร่วมกิจกรรม";
	}
	?>
			</div>
		</div>
	</div>
</div>
	<?
}
else if($act=="date")
{
$student_name="ไม่พบข่อมูล";
$gname="ไม่พบข่อมูล";
$gdep="ไม่พบข่อมูล";
$sql6=("SELECT std_student.NAME sn,std_student.GRO sg FROM std_student WHERE   CODE='$stu_id' ");
	//echo $sql6."<br>";
	$results6 = $mysqli->query($sql6);

	if($results6->num_rows > 0){
		//echo "พบข้อมูล ".$results6->num_rows." รายการ	";	
		while($row6 = $results6->fetch_assoc()) {
			$mcount++;										
			$student_name=$row6['sn'];
			$student_g_id=$row6['sg'];
		}
		//std_group :		CODE		GROUPS		NAME		ADVISOR		MAN		LADY		TOTAL		SEMES		DEPWORK		TELEPHONE
		$sql61=("SELECT GROUPS,NAME	 FROM std_group WHERE   CODE='$student_g_id' ");
		//echo $sql6."<br>";
		$results61 = $mysqli->query($sql61);

		if($results61->num_rows > 0){
			//echo "พบข้อมูล ".$results61->num_rows." รายการ	";	
			while($row61 = $results61->fetch_assoc()) {
				$mcount++;										
				$gname=$row61['GROUPS'];
				$gdep=$row61['NAME'];
			}
		}
	}
	else
	{
		return;
	}
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<? echo $sub_sys;?> ปีการศึกษา <? echo $term;?> ของ นักศึกษา รหัส <? echo $stu_id;?> 
				ชื่อ <? echo $student_name;?> กลุ่ม  <? echo $gname;?>(<? echo $gdep;?>)
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">	
				<div class="table">
						<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
							<thead>
								<tr>																							
									<th class="text-center">ลำดับที่</th>	
									<th class="text-center">ชื่อกิจกรรม</th>	
									<th class="text-center">วันที่</th>							
									<th class="text-center">จำนวน</th>
									
								</tr>
							</thead>
							<tbody>		
	<?
	$sql6=("SELECT act_project_datain.pt_id,count(act_project_datain.date_join) adj FROM act_project_datain WHERE   student_id='$stu_id' and term='$term' and pt_id='$pt_id2' group by act_project_datain.term,act_project_datain.pt_id order by pt_id");
	//echo $sql6."<br>";
	$results6 = $mysqli->query($sql6);

	if($results6->num_rows > 0){
		//echo "พบข้อมูล ".$results6->num_rows." รายการ	";	
		while($row6 = $results6->fetch_assoc()) {
			//$mcount++;										
			$pt_id=$row6['pt_id'];
			$adj=$row6['adj'];

			$sql62=("SELECT act_project_datain.date_join adj FROM act_project_datain WHERE   student_id='$stu_id' and term='$term' and pt_id='$pt_id2'  order by date_join");
			//echo $sql6."<br>";
			$results62 = $mysqli->query($sql62);
			$adj_count=0;
			if($results62->num_rows > 0){
				//echo "พบข้อมูล ".$results62->num_rows." รายการ	";	
				while($row62 = $results62->fetch_assoc()) {
					$adj_count++;	
					$adj_arr[$adj_count]=$row62['adj'];
					//echo $adj_arr[$adj_count]."<br>";
					$y= substr($adj_arr[$adj_count],0,4)-543;
					//$m= substr($adj_arr[$adj_count],5,2);
					$adj_arr_eng[$adj_count] = $y."-".substr($adj_arr[$adj_count],5,5);
				}
			}

			$sql63=("SELECT substr(date_join,6,2) mj ,substr(date_join,1,4) yj FROM act_project_datain WHERE   student_id='$stu_id' and term='$term' and pt_id='$pt_id2' group by  yj,mj  order by yj,mj");
			//echo $sql6."<br>";
			$results63 = $mysqli->query($sql63);
			$mj_count=0;
			if($results63->num_rows > 0){
				//echo "พบข้อมูล ".$results62->num_rows." รายการ	";	
				while($row63 = $results63->fetch_assoc()) {
					$mj_count++;	
					$mj_arr[$mj_count]=$row63['mj'];
					$yj_arr[$mj_count]=$row63['yj'];
					//echo $yj_arr[$mj_count]." - ".$mj_arr[$mj_count]."<br>";
				}
			}

			//	term	pt_id	pt_name 	date_start	date_stop
			$sql7=("SELECT * FROM act_project_title where term='$term' and  pt_id='$pt_id'  ");
			$results7 = $mysqli->query($sql7);
			if($results7->num_rows > 0){
				$row7= $results7->fetch_assoc();
				//$term=$row7["term"];
				$pt_id=$row7["pt_id"];											
				$pt_name=$row7["pt_name"];		
				$date_start=$row7["date_start"];											
				$date_stop=$row7["date_stop"];	
				?>
				<tr>																							
					<td class="text-center"><? echo $pt_id;?></td>	
					<td class="text-center"><? echo $pt_name;?></td>	
					<td class="text-center"><? echo $date_start;?> ถึง <? echo $date_stop;?></td>	
					<td class="text-center">
					<a href="?msel=<? echo $msel;?>&act=date&stu_id=<? echo $stu_id;?>&pt_id2=<? echo $pt_id;?>">
					<? echo $adj;?> วัน
					</a>
					</td>	
				</tr>			
				<?
			}
		}
		?>
		</tbody>
		</table>
		
		<table> 	
		<tr>
		<?
		//$mj_arr[$mj_count]
		for($d=1;$d <= $mj_count ;$d++)
		{	
			if((($d-1) % 3)==0)
			{
			?>
			<tr>
			<?
			}
			?>
			<td>
			<?
			$y= substr($adj_arr[$d],0,4)-543;
			$m= substr($adj_arr[$d],5,2);
			//$adj_arr_eng[$d] = $y."-".substr($adj_arr[$d],5,5);
			calendar_m($y,$m,$adj_arr_eng);
			?>
			</td>
			<?
		}
		?>
		</table>
		<?
	}
	else
	{
		echo "ไม่พบข้อมูลเข้าร่วมกิจกรรม";
	}
	?>
			</div>
		</div>
	</div>
</div>
	<?
}
	?>
						
						
				