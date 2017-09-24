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

$termu = $_REQUEST['termu'];
$pt_idu = $_REQUEST['pt_idu'];
$date_inu = $_REQUEST['date_inu'];


$sub_sys="เลือกโครงการเพื่อโอนข้อมูลการเข้าร่วมกิจกรรม";
$color="#ccffcc";
?>									
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><? echo $menu_name;?></h3>	
	</div>
	<!-- /.col-lg-12 -->
</div>
<? 
if(($act=="upload_data")  && !empty($termu)){
	include("upload_file.php");
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
								<th class="text-center">จำนวนข้อมูล(วัน)</th>	
								<th class="text-center">รายงาน</th>	
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
									//act_project_datain : 		term		pt_id		student_id		group_id		date_join		date_upload

									$sql6=("SELECT * FROM act_project_datain where term='$term' and  pt_id='$pt_id'  group by date_join");
									$results6 = $mysqli->query($sql6);										 
									
									?>						
									<tr>
										<td class="text-center"><? echo $term;?></td>
										<td class="text-center"><? echo $pt_id;?></td>	
										<td><? echo $pt_name;?></td>	
										<td class="text-center"><? echo $date_start;?> ถึง <? echo $date_stop;?></td>
										<td class="text-center"><? echo $results6->num_rows;?></td>
										<td class="text-center">
										<?
										if(!empty($results6->num_rows)){
										?>	<a href="active_updata_show.php?term=<? echo $term;?>&pt_id=<? echo $pt_id;?>" target="_BLANK">
											รายบุคคล
											</a>
											&nbsp;
											<a href="active_updata_showg.php?term=<? echo $term;?>&pt_id=<? echo $pt_id;?>" target="_BLANK">
											รายกลุ่ม
											</a>
											
											<?
										}
											else{
												?>
												-
												<?
											}

											?>
										</td>
										<td>
												&nbsp;														
												 <a  class="updata-project"
													data-pt_idu="<? echo $pt_id; ?>"
													data-pt_nameu="<? echo $pt_name; ?>"
													data-termu="<? echo $term; ?>"	>
												
													<i class="fa fa-pencil">โอนข้อมูล</i>
												
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
				<!-- Updata Form -->
				<div class="modal fade" id="formUpdata">
					<div class="modal-dialog">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">โอนข้อมูลผู้เข้าร่วมกิจกรรม</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->									
									<div class="form-group">
										<label for="termu">ปีการศึกษา</label>
										<input type="text" id="termu" name="termu" value="<? echo $term;?>" readonly>
									</div> 
									
									<div class="form-group">
										<label for="pt_idu">รหัส</label>
										<input type="text" id="pt_idu" name="pt_idu" readonly  value="<? echo $pt_id+1;?>">
									</div>
									
									<div class="form-group">
										<label for="pt_nameu">ชื่อโครงการ</label>
										<input type="text" id="pt_nameu" name="pt_nameu" readonly>
									</div>

									<div class="form-group">
										<label for="date_inu" >เลือกวันเข้่าร่วมกิจกรรม</label>
										<input name="date_inu"  id="date_inu" class="datepicker2" data-date-format="yyyy/mm/dd"> 
									</div>

									<div class="form-group">
										<label  for="fileToUpload">เลือกไฟล์</label>
										<input  name="fileToUpload" id="fileToUpload" type="file" class="file">
									</div>
									
								</div><!--/.modal-body-->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
									ยกเลิก
									</button>
									<input type="submit" class="btn btn-primary" value="เพิ่ม">
									<input type="hidden" name="act" value="upload_data">
								</div><!--/.modal-footer-->
							</div><!-- /.modal-content -->
						</form>
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- end add form -->				
			</div>
		</div>
	</div>
</div>

<?
}








										
				