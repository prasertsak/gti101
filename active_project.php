<?
$user_id = $_SESSION['user_id'];
$pin_id = $_REQUEST['pin_id'];
$sel = $_REQUEST['sel'];
$pt_id = $_REQUEST['pt_id'];
$pt_name = $_REQUEST['pt_name'];
$act = $_REQUEST['act'];
$term = $_REQUEST['term'];
$date_start = $_REQUEST['date_start'];
$date_stop = $_REQUEST['date_stop'];

$pt_idx = $_REQUEST['pt_idx'];
$pt_namex = $_REQUEST['pt_namex'];
$termx = $_REQUEST['termx'];
$date_startx = $_REQUEST['date_startx'];
$date_stopx = $_REQUEST['date_stopx'];

$terme = $_REQUEST['terme'];
$pt_ide = $_REQUEST['pt_ide'];
$pt_namee = $_REQUEST['pt_namee'];
$date_starte = $_REQUEST['date_starte'];
$date_stope = $_REQUEST['date_stope'];

$sub_sys="รายชื่อโครงการ";
$color="#ccffcc";
?>									
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><? echo $menu_name;?></h3>	
	</div>
	<!-- /.col-lg-12 -->
</div>
<? 
if(($act=="add_proj")  && !empty($termx)){
		//	term	pt_id	pt_name 	date_start	date_stop
		$sql6="INSERT INTO `act_project_title` (`term`, `pt_id`, `pt_name`, `date_start`, `date_stop`) VALUES ('$termx','$pt_idx', '$pt_namex','$date_startx', '$date_stopx');";
		//echo $sql6."=b<br>";
		$results6 = $mysqli->query($sql6);
		$act="";
}

if(($act=="del_proj")  && !empty($term)){
		//	term	pt_id	pt_name 	date_start	date_stop
		$sql6="DELETE FROM `act_project_title` WHERE `term` =  '$term'  and `pt_id` =  '$pt_id' ;";
		//echo $sql6."=b<br>";
		$results6 = $mysqli->query($sql6);
		$act="";
}

if(($act=="edit_proj")  && !empty($terme)){
	//	term	pt_id	pt_name 	date_start	date_stop
	$sql1="UPDATE `act_project_title` SET `pt_name` = '$pt_namee' ,`date_start` = '$date_starte' ,`date_stop` = '$date_stope' WHERE term='$terme'  and `pt_id` =  '$pt_ide' ";
	//echo $sql1."<br>";
	$results1 = $mysqli->query($sql1);
	$act="";	
}

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

if($act=="")
{
//	term	pt_id	pt_name 	date_start	date_stop
	$sql5=("SELECT * FROM act_project_title where term='$term' order by substr(term,3,4), substr(term,1,1),date_start DESC ");
	$results5 = $mysqli->query($sql5);
	?>						
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<? echo $sub_sys;?>/ปีการศึกษา <? echo $term;?>
					<!-- Add btn-->
				
				   <a class="add-project">
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
								<th class="text-center">ปีการศึกษา</th>	
								<th class="text-center">รหัสโครงการ</th>	
								<th class="text-center">ชื่อโครงการ</th>	
								<th class="text-center">วันจัดกิจกรรม</th>	
								<th class="text-center">กระทำ</th>
							</tr>
						</thead>
						<tbody>		
						
							<?		
							//		term	pt_id	pt_name
								if($results5->num_rows > 0){		
									$send_count=0;
									while($row5 = $results5->fetch_assoc()) {
										$term=$row5["term"];
										$pt_id=$row5["pt_id"];											
										$pt_name=$row5["pt_name"];		
										$date_start=$row5["date_start"];											
										$date_stop=$row5["date_stop"];		
										
										?>						
										<tr>
											<td class="text-center"><? echo $term;?></td>
											<td class="text-center"><? echo $pt_id;?></td>	
											<td><? echo $pt_name;?></td>	
											<td class="text-center"><? echo $date_start;?> ถึง <? echo $date_stop;?></td>	
											<td><a href="?msel=<? echo $msel;?>&act=del_proj&term=<? echo $term;?>&pt_id=<? echo $pt_id;?>" onclick="return confirm('ลบ?')">
														<i class="fa fa-minus-circle">ลบ</i>																
													</a>
													&nbsp;	
													
													 <a  class="edit-project"
													    data-pt_ide="<? echo $pt_id; ?>"
														data-pt_namee="<? echo $pt_name; ?>"
														data-terme="<? echo $term; ?>"	
														data-date_starte="<? echo $date_start; ?>"
														data-date_stope="<? echo $date_stop; ?>"	>
													
														<i class="fa fa-pencil">แก้ไข</i>
													
												  </a>
												 
											</td>
											
										</tr>	
												<?
										}											
									}								
											
							?>
							
						</tbody>
					</table>					
				</div>
				<!-- Add Form -->
				<div class="modal fade" id="formAddProject">
					<div class="modal-dialog">
						<form action="" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">เพิ่มข้อมูลโครงการ</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->									
									<div class="form-group">
										<label for="termx">ปีการศึกษา</label>
										<input type="text" id="termx" name="termx" value="<? echo $term;?>" readonly>
									</div> 
									<?
									$sql5=("SELECT * FROM act_project_title where term='$term' order by substr(term,3,4), substr(term,1,1),pt_id DESC ");
									$results5 = $mysqli->query($sql5);
									$row5 = $results5->fetch_assoc();
									$pt_id=$row5["pt_id"];	
									?>

									<div class="form-group">
										<label for="pt_idx">รหัส</label>
										<input type="text" id="pt_idx" name="pt_idx" readonly  value="<? echo $pt_id+1;?>">
									</div>
									
									<div class="form-group">
										<label for="pt_namex">ชื่อโครงการ</label>
										<input type="text" id="pt_namex" name="pt_namex" >
									</div>

									<div class="form-group">
										<label for="date_startx" >วันเริ่มจัดกิจกรรม</label>
										<input name="date_startx"  id="date_startx" class="datepicker2" data-date-format="yyyy/mm/dd"> 
									</div>

									<div class="form-group">
										<label for="date_stopx" >วันสิ้นสุดจัดกิจกรรม</label>
										<input name="date_stopx"  id="date_stopx" class="datepicker2" data-date-format="yyyy/mm/dd"> 
									</div>
						 
								</div><!--/.modal-body-->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
									ยกเลิก
									</button>
									<input type="submit" class="btn btn-primary" value="เพิ่ม">
									<input type="hidden" name="act" value="add_proj">
								</div><!--/.modal-footer-->
							</div><!-- /.modal-content -->
						</form>
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- end add form -->
				<!-- Edit Form -->
				<div class="modal fade" id="formEditProject">
					<div class="modal-dialog">
						<form action="" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">แก้ไขข้อมูลโครงการ</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->									
									<div class="form-group">
										<label for="terme">ปีการศึกษา</label>
										<input type="text" id="terme" name="terme">
									</div> 

									<div class="form-group">
										<label for="pt_ide">รหัส</label>
										<input type="text" id="pt_ide" name="pt_ide" >
									</div>
									
									<div class="form-group">
										<label for="pt_namee">ชื่อโครงการ</label>
										<input type="text" id="pt_namee" name="pt_namee" >
									</div>

									<div class="form-group">
										<label for="date_starte" >วันเริ่มจัดกิจกรรม</label>
										<input name="date_starte"  id="date_starte" class="datepicker2" data-date-format="yyyy/mm/dd"> 
									</div>

									<div class="form-group">
										<label for="date_stope" >วันสิ้นสุดจัดกิจกรรม</label>
										<input name="date_stope"  id="date_stope" class="datepicker2" data-date-format="yyyy/mm/dd"> 
									</div>
						 
								</div><!--/.modal-body-->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
									ยกเลิก
									</button>
									<input type="submit" class="btn btn-primary" value="บันทึก">
									<input type="hidden" name="act" value="edit_proj">
								</div><!--/.modal-footer-->
							</div><!-- /.modal-content -->
						</form>
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- end edit form -->
			</div>
		</div>
	</div>
</div>

<?
}








										
				