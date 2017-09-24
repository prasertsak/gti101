<?
$user_id = $_SESSION['user_id'];
$pin_id = $_REQUEST['pin_id'];
$sel = $_REQUEST['sel'];
$po_id = $_REQUEST['po_id'];
$dep_id = $_REQUEST['dep_id'];
$send_count = $_REQUEST['send_count'];
$send_data = $_REQUEST['send_data'];
$send_id = $_REQUEST['send_id'];
$act = $_REQUEST['act'];
$termx = $_REQUEST['termx'];

$act2 = $_REQUEST['act2'];
$d = $_REQUEST['d'];
$wy = $_REQUEST['wy'];
$sw = $_REQUEST['sw'];
$iw = $_REQUEST['iw'];
$nx = $_REQUEST['nx'];

$sub_sys="ปีการศึกษา";
$color="#ffcc33";
?>									
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><? echo $menu_name;?></h3>	
	</div>
	<!-- /.col-lg-12 -->
</div>
<? 

if(($act=="add_term")  && !empty($termx)){
			
		//term  mark_use
		$sql6="INSERT INTO `system_term_mark` (`term`, `mark_use`) VALUES ('$termx', '0');";
		//echo $sql6."=b<br>";
		$results6 = $mysqli->query($sql6);
		$act="";
	
}

if(($act=="del_term")  && !empty($termx)){
			
		//term  mark_use
		$sql6="DELETE FROM `system_term_mark` WHERE `term` =  '$termx' ;";
		//echo $sql6."=b<br>";
		$results6 = $mysqli->query($sql6);
		$act="";
	
}

if(($act=="edit") &&($act2=="del")  && !empty($termx)){
	$sql7="DELETE FROM `system_term_date` WHERE `term` =  '$termx' and `date` >= '$d' ";
	//SELECT * FROM `system_term_date` WHERE term = '2/2560' and `date` > '2018-01-15'
	//echo $sql7."=a<br>";
	$results7 = $mysqli->query($sql7);	

	$date_start=$_REQUEST["nx"];	
	$set_week=(18-$sw)+1;
	$set_day=7;
	//echo $date_start."=a1<br>";
	//echo $set_week."=a2<br>";
	//echo $set_day."=a3<br>";

	$school_week=$sw;
	for($run=0;$run < ($set_week*	$set_day);$run++)
	{		
		$date = add_date($date_start,$run,0,0);
		$week_inyear = date("W", strtotime($date));
		$day_inweek = date("N", strtotime($date));
		
		//echo $run ."=".$date."=".$school_week."=".$week_inyear."=".$day_inweek."<br>";
		$sql6="INSERT INTO `system_term_date` (`term`, `date`, `week_inyear`, `school_week`, `in_week`) VALUES ('$termx', '$date', '$week_inyear', '$school_week', '$day_inweek');";
		//echo $sql6."=b<br>";
		$results6 = $mysqli->query($sql6);	
		if($day_inweek==7)
			$school_week++;
	}
}


if(($act=="save_t") && !empty($termx)){

// term  mark_use
		//$sql1="DELETE FROM system_term_mark WHERE 1";
		$sql1="UPDATE `system_term_mark` SET `mark_use` = '0' WHERE 1";
		//echo $sql1."<br>";
		$results1 = $mysqli->query($sql1);	
		
		$sql1="UPDATE `system_term_mark` SET `mark_use` = '1' WHERE term='$termx'  ";
		//echo $sql1."<br>";
		$results1 = $mysqli->query($sql1);
		$sel="";
}

if($act=="create")
{
	date_default_timezone_set('Asia/Bangkok');
	$date_start=$_REQUEST["date_start"];	
	//echo $date_start."=เริ่ม<br>";
	//echo $termx."=เทอม<br>";
	//echo $week = date("W", strtotime($date_start))."=สัปดาแรก<br>";
	$set_week=18;
	$set_day=7;
	$school_week=1;
	for($run=0;$run < ($set_week*	$set_day);$run++)
	{
		
		$date = add_date($date_start,$run,0,0);
		$week_inyear = date("W", strtotime($date));
		$day_inweek = date("N", strtotime($date));
		
		//echo $run ."=".$date."=".$school_week."=".$week_inyear."=".$day_inweek."<br>";
		$sql6="INSERT INTO `system_term_date` (`term`, `date`, `week_inyear`, `school_week`, `in_week`) VALUES ('$termx', '$date', '$week_inyear', '$school_week', '$day_inweek');";
		$results6 = $mysqli->query($sql6);	
		if($day_inweek==7)
			$school_week++;
	}
	$act="";

}	

//	 pin_id  dep_id  date
	$sql6=("SELECT * FROM psn_personal_link_department where pin_id='$pin_id'  ");
	$results6 = $mysqli->query($sql6);
	//echo $sql6."<br>";

//		pin_id		user_name		user_password		prename		fname		lname		birth
	$sql7=("SELECT * FROM psn_personal where pin_id='$pin_id'  ");
	$results7 = $mysqli->query($sql7);
	if($results7->num_rows > 0){		
		while($row7 = $results7->fetch_assoc()) {
			$prename=$row7["prename"];
			$fname=$row7["fname"];
			$lname=$row7["lname"];
			$u_name=$prename.$fname."&nbsp;&nbsp;".$lname;
		}
	}
	else
	{
		$u_name="ไม่พบข้อมูลตำแหน่ง";
	}

if($act=="")
{
//	term   mark_use
	$sql5=("SELECT * FROM system_term_mark  order by substr(term,3,4), substr(term,1,1) ");
	$results5 = $mysqli->query($sql5);
	?>						
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<? echo $sub_sys;?>
					<!-- Add btn-->
				
				   <a class="add-term">
					<button class="btn btn-default">
						<i class="fa fa-plus-circle"></i>
					</button>	
				  </a>
				<!-- /.btn_add -->
				</div>

				<!-- /.panel-heading -->
				<div class="panel-body">
				<div class="table">
					<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
						<thead>
							<tr>																							
								<th  class="text-center">เลือก</th>	
								<th class="text-center">กำหนดวัน</th>	
								<th class="text-center">กระทำ</th>	
							</tr>
						</thead>
						<tbody>		
						<form method="POST" action="">
							<?		
							//	term   mark_use
								if($results5->num_rows > 0){		
									$send_count=0;
									while($row5 = $results5->fetch_assoc()) {
										$term=$row5["term"];
										$mark_use=$row5["mark_use"];											
										$send_count++;		
										if($mark_use)
											$check="checked";
										else
											$check="";
										
										?>						
										<tr >											
											
											<td>
											
												<div class="radio radio-danger">
													<input type="radio" name="termx" id="<? echo $term;?>" value="<? echo $term;?>" <? echo $check;?>>
													<label for="<? echo $term;?>">
														<? echo $term;?>
													</label>
													
												</div>
												
											
											</td>	
											<td>
											<?
											$first_date="";
											$last_date="";
											//term	date week_inyear	week	in_week

											$sql6=("SELECT * FROM  system_term_date where term='$term'  order by date ");
											$results6 = $mysqli->query($sql6);											
											if($results6->num_rows > 0){													
												$row6 = $results6->fetch_assoc();
												$term=$row6["term"];
												$first_date=$row6["date"];
												$week_year=$row6["week_inyear"];
												$week=$row6["week"];
												$in_week=$row6["in_week"];

												$sql6=("SELECT * FROM  system_term_date where term='$term'   order by date DESC ");
												$results6 = $mysqli->query($sql6);											
												if($results6->num_rows > 0){													
													$row6 = $results6->fetch_assoc();
													$term=$row6["term"];
													$last_date=$row6["date"];
													$week_year=$row6["week_inyear"];
													$week=$row6["week"];
													$in_week=$row6["in_week"];
												}
												?>
												
												<a href="?msel=22&act=edit&termx=<? echo $term;?>">
												<? echo "เริ่มวันที่ ".$first_date." ถึงวันที่ ".$last_date;?>
												</a>
												<?
										if(!empty($first_date))
										{

											?>
											<ul class="nav navbar-top-links navbar-right">
													<a href="?msel=<? echo $msel;?>&act=del_term&termx=<? echo $term;?>" onclick="return confirm('ลบ?')">
														<i class="fa fa-minus-circle">ลบวันในปีการศึกษาทั้งหมด</i>																
													</a>
												</ul>
												<?
										}
											?>
												<?
											}
											else{
												?>
												<a href="?msel=22&act=new_set&termx=<? echo $term;?>">ไม่พบข้อมูลวันกดที่นี่เพื่อกำหนด</a>
												<?
											
											}
												
											?>
											</td>
											<td>
											<?
										if(empty($first_date))
										{

											?>
											<ul class="nav navbar-top-links navbar-right">
													<a href="?msel=<? echo $msel;?>&act=del_term&termx=<? echo $term;?>" onclick="return confirm('ลบ?')">
														<i class="fa fa-minus-circle">ลบปีการศึกษา</i>																
													</a>
												</ul>
												<?
										}
											?>
											</td>
										</tr>
										<?
									}								
								}			
							?>
							<tr>
							<td><div class="text-center">
					<input type="submit" class="btn btn-primary" value="บันทึก">			
					
					<input type="hidden" name="act" value="save_t">
					</div></td>
							<td></td>
							<td></td>
							</tr>
						</tbody>
					</table>
					
				</div>
				<!-- Add Form -->
				<div class="modal fade" id="formAddTerm">
					<div class="modal-dialog">
						<form action="" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">เพิ่มข้อมูลปีการศึกษา</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->									
									<div class="form-group">
										<label for="termx">ปีการศึกษา</label>
										<input type="text" id="termx" name="termx">
									</div> 
					 
								</div><!--/.modal-body-->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
									ยกเลิก
									</button>
									<input type="submit" class="btn btn-primary" value="เพิ่ม">
									<input type="hidden" name="act" value="add_term">
								</div><!--/.modal-footer-->
							</div><!-- /.modal-content -->
						</form>
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- end add form -->
<?
}
else if($act=="new_set")
{
	?>						
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<? echo $sub_sys;?>/<? echo $termx;?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">	
				<form method="POST" class="form-inline">
				
						
					<label for="date_start" >กรุณาเลือกวันแรกของเทอม</label>
					<input name="date_start"  id="date_start" class="datepicker" data-date-format="yyyy/mm/dd"> 					
					<input type="submit" class="btn btn-primary" value="สร้างข้อมูล 18 สัปดาห์">						
				
					<input type="hidden" name="termx" id="<? echo $termx;?>" value="<? echo $termx;?>">							
					<input type="hidden" name="act" value="create">
				</form>
				</div>
			</div>
		</div>
	</div>
<?
}
else if($act=="edit")
{


	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<? echo $sub_sys;?>/<? echo $termx;?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">	
					<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
							<thead>
								<tr>																							
									<th class="text-center">สัปดาห์ที่ของโรงเรียน</th>	
									<th class="text-center">สัปดาห์ที่ของปีจริง</th>	
									<th class="text-center">เริ่มวันที่</th>	
									<th class="text-center">สิ้นสุดวันที่</th>
									<th class="text-center">กระทำ</th>
								</tr>
							</thead>
							<tbody>		
						<?
						
						// 	term	date	week_inyear	school_week	in_week
						$sql6="select * from`system_term_date` where`term`='$termx'  and in_week='1'  order by date";
						$results6 = $mysqli->query($sql6);	

						if($results6->num_rows > 0){													
							while($row6 = $results6->fetch_assoc()){
								$term=$row6["term"];
								$date=$row6["date"];
								$week_year=$row6["week_inyear"];
								$school_week=$row6["school_week"];
								$in_week=$row6["in_week"];

								$sql7="select * from`system_term_date` where`term`='$termx'  and in_week='7' and school_week='$school_week'  ";
								$results7 = $mysqli->query($sql7);	

								if($results7->num_rows > 0){													
									while($row7 = $results7->fetch_assoc()){										
										$date2=$row7["date"];
									}
								}
								$next_date = add_date($date,7,0,0);
								//$week_inyear = date("W", strtotime($date));
								//$day_inweek = date("N", strtotime($date));
								?>
								<tr>
									<td class="text-center"><? echo $school_week;?></td>
									<td class="text-center"><? echo $week_year;?></td>
									<td class="text-center"><? echo $date;?></td>
									<td class="text-center"><? echo $date2;?></td>									
									<td><a href="?msel=<? echo $msel;?>&act=edit&act2=del&termx=<? echo $term;?>&d=<? echo $date;?>&wy=<? echo $week_year;?>&sw=<? echo $school_week;?>&iw=<? echo $in_week;?>&nx=<? echo $next_date;?>" onclick="return alert('ลบ?')">
									<i class="fa fa-minus-circle">ลบ</a></td>

								</tr>


								<?
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?
}	
?>








										
				