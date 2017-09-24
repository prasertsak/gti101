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
//echo  $sel."=<br>";
//echo  $po_id."=<br>";
$color="#ff99ff";
$this_sys_sub1="รายชื่อบุคลากร";
 
if(($act=="del_po") && !empty($pin_id)){
	//$sql1=("UPDATE `psn_personal_link_department` SET `position_id` = '0' WHERE `psn_personal_link_department`.`pin_id` = '1000000000000' AND `psn_personal_link_department`.`dep_id` = 303 AND `psn_personal_link_department`.`position_id` = 14;");
	$sql1=("UPDATE `psn_personal_link_department` SET `position_id` = '0' WHERE `psn_personal_link_department`.`pin_id` = '$pin_id' AND `psn_personal_link_department`.`dep_id` = $dep_id  AND `psn_personal_link_department`.`position_id` = $po_id;");
	//echo  $sql1."=<br>";
	//$sql1=("DELETE  FROM  psn_personal_link_department where pin_id='$pin_id' and dep_id=$send_id[$a]");
	$results1 = $mysqli->query($sql1);
}
if(($act=="del_dep") && !empty($pin_id)){
	//$sql1=("UPDATE `psn_personal_link_department` SET `position_id` = '0' WHERE `psn_personal_link_department`.`pin_id` = '$pin_id' AND `psn_personal_link_department`.`dep_id` = $dep_id;");
	//echo  $sql1."=<br>";
	$sql1=("DELETE  FROM  psn_personal_link_department WHERE `psn_personal_link_department`.`pin_id` = '$pin_id' AND `psn_personal_link_department`.`dep_id` = $dep_id AND `psn_personal_link_department`.`position_id` = $po_id;");
	$results1 = $mysqli->query($sql1);
}

if(($act=="save_po") && !empty($pin_id)){
	$sql1=("UPDATE `psn_personal_link_department` SET `position_id` = '$po_id' WHERE `psn_personal_link_department`.`pin_id` = '$pin_id' AND `psn_personal_link_department`.`dep_id` = $dep_id  AND `psn_personal_link_department`.`position_id` = 0;");
	//echo  $sql1."=<br>";
	//$sql1=("DELETE  FROM  psn_personal_link_department where pin_id='$pin_id' and dep_id=$send_id[$a]");
	$results1 = $mysqli->query($sql1);
	
		
	$sel="";
}
if(($act=="save") && !empty($pin_id)){
	for($a = 1;$a <= $send_count;$a++ )	{
		//echo  $send_data[$a]."=$a<br>";
		//echo  $send_id[$a]."=$a<br>";
		if($send_data[$a]==1)
		{
			    $sql1="INSERT INTO psn_personal_link_department (`pin_id`, `dep_id`, `date`) VALUES ('$pin_id', '$send_id[$a]','');";
				//echo $sql1."<br>";
				$results1 = $mysqli->query($sql1);				
		}		
	}
		$sel="";
}

if($sel=="")
{

	//`psn_personal_link_department`.`pin_id`
	//		pin_id	user_name	user_password	 prename  	fname	lname  	birth
	//$sql5=("SELECT * FROM `psn_personal`, `psn_personal_link_department` where `psn_personal_link_department`.`pin_id`=`psn_personal_link_department`.`pin_id`  order by `psn_personal_link_department`.`dep_id`  ");
	$sql5=("SELECT * FROM `psn_personal`  order by prename,fname  ");
	//SELECT * FROM Ltable LEFT JOIN Rtable ON Ltable.id = Rtable.id;
	$results5 = $mysqli->query($sql5);

	?>									
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><? echo $this_sys;?></h3>	
			<i><? echo "พบข้อมูล ".$results5->num_rows." รายการ ";?></i>		
			<!--<a class="alert" href=#>Alert!</a>-->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
				<? echo $this_sys;?>
					/<? echo $this_sys_sub1;?>
					<!-- Add btn-->
					
					   <a class="add-name">
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
								<th>ลำดับที่่</th>
								<th>ชื่อ-สกุล</th>
								<th>งาน->หน้าที่</th>								
								<th>กระทำ</th>							
							</tr>
						</thead>
						<tbody>					
							<?		
							//		pin_id	user_name	user_password	 prename  	fname	lname  	birth
								if($results5->num_rows > 0){		
									$p_count=0;
									while($row5 = $results5->fetch_assoc()) {
										$p_count++;
										$pin_id=$row5["pin_id"];
										$user_name=$row5["user_name"];
										$user_password=$row5["user_password"];
										$prename=$row5["prename"];
										$fname=$row5["fname"];
										$lname=$row5["lname"];
										$birth=$row5["birth"];

										
										?>						
										<tr>
											<td class="center"><? echo $p_count;?></td>
											<td><? echo $prename.$fname."&nbsp;&nbsp;".$lname;?></td>
											<td>
											<ul class="nav navbar-top-links navbar-right">
												<a href="?sel=permit&pin_id=<? echo $pin_id;?>" >
													<i class="fa fa-plus-circle">เพิ่มงาน</i>																
												</a>
											</ul>

												<?
												$dep_id="";
												$position_id="";
												//	 pin_id  dep_id  date
												$sql6=("SELECT * FROM psn_personal_link_department where pin_id='$pin_id'  ");
												$results6 = $mysqli->query($sql6);
												$job_count=$results6->num_rows;
												if(!empty($job_count))
												{
													while($row6 = $results6->fetch_assoc()) {														
														$dep_id=$row6["dep_id"];
														$position_id=$row6["position_id"];

														// 	dep_id		depgroup_id		dep_name		depsub_id		dep_show
														$sql7=("SELECT * FROM psn_department where dep_id='$dep_id'  ");
														$results7 = $mysqli->query($sql7);
														$job_count=$results7->num_rows;
														if(!empty($job_count))
														{
															while($row7 = $results7->fetch_assoc()) {														
																$dep_name=$row7["dep_name"];
																$depgroup_id=$row7["depgroup_id"];
															}
														}	
														else
														{
															$dep_name="ไม่พบข้อมูล";
														}
														
														// 	position_id		position_name		color
														$sql7=("SELECT * FROM psn_position where position_id='$position_id'  ");
														$results7 = $mysqli->query($sql7);
														$job_count=$results7->num_rows;
														if(!empty($job_count))
														{
															while($row7 = $results7->fetch_assoc()) {														
																$position_name=$row7["position_name"];																
															}
														}	
														else
														{
															$position_name="";
														}														
														?>
														<? echo $dep_name;?>														
																<a href="?act=del_dep&pin_id=<?php echo $pin_id; ?>&dep_id=<?php echo $dep_id; ?>&po_id=<?php echo $position_id; ?>" onclick="return confirm('ลบ?')">																															
																	<i class="fa fa-minus-circle"></i>																
															  </a>
															->
														<?
														if(!empty($position_name))
														{
															echo $position_name;
															?>
																<a href="?act=del_po&pin_id=<?php echo $pin_id; ?>&dep_id=<?php echo $dep_id; ?>&po_id=<?php echo $position_id; ?>" onclick="return confirm('ลบ?')">																															
																	<i class="fa fa-minus-circle"></i>																
															  </a>
															<?
														}
														else{
															?>
																<a href="?sel=add_po_form&pin_id=<?php echo $pin_id; ?>&dep_id=<?php echo $dep_id; ?>">											
																	<i class="fa fa-plus-circle"></i>													
															  </a>
															  <?
														}
														?><br>
														<?
													}
												}

												?>
											</td>											
											<td class="center">										    
												<div class="dropdown">
													<button class="btn btn-default dropdown-toggle"
													class="drop-edit" data-toggle="dropdown">
														<i class="fa fa-cog"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu">
														<li>
															<a class="edit-name"
															data-pin_id	="<?php echo $pin_id; ?>"
															data-user_name	="<?php echo $user_name; ?>"
															data-user_password	 ="<?php echo $user_password; ?>"
															data-prename  	="<?php echo $prename ; ?>"
															data-fname	="<?php echo $fname; ?>"
															data-lname  	="<?php echo $lname; ?>"
															data-birth="<?php echo $birth; ?>">
															แก้ไข</a>
														</li>
														
														<li><a  href="personal_name_del.php?pin_id=<?php echo $pin_id; ?>" onclick="return confirm('ลบ?')">ลบ</a></li>
													</ul>
												</div><!-- /.dropdown -->														
											</td>                                        
										</tr>
										<?
									}								
								}			
							?>
						</tbody>
					</table>
				</div>
					<!-- Modal Zone -->
					<!-- Edit Form -->
					<div class="modal fade" id="formEditName">
						<div class="modal-dialog">
							<form action="personal_name_update.php" method="post">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title">แก้ไขข้อมูลชื่อ</h4>
									</div>
									<div class="modal-body">
										<!-- Hidden Zone
										//		pin_id	user_name	user_password	 prename  	fname	lname  	birth
										-->
										<input type="hidden" name="pin_id" id="pin_id" >
						 
										<div class="form-group">
											<label for="prename">คำนำหน้าชื่อ</label>
											<input type="text" id="prename" name="prename">
										</div>
										 
										<div class="form-group">
											<label for="fname">ชื่อ</label>
											<input type="text"  id="fname"   name="fname" >
										</div>	
										
										<div class="form-group">
											<label for="lname">นามสกุล</label>
											<input type="text"  id="lname"   name="lname" >
										</div>	

										<div class="form-group">
											<label for="birth">วันเกิด(yyyy-mm-dd)</label>
											<input type="text"  id="birth"   name="birth" >
										</div>	

										<div class="form-group">
											<label for="user_name">ชื่อเข้าระบบ</label>
											<input type="text" id="user_name" name="user_name">
										</div>

										<div class="form-group">
											<label for="user_password">รหัสผ่านเข้าระบบ</label>
											<input type="text" id="user_password" name="user_password">
										</div>
						 
									</div><!--/.modal-body-->
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">
										ยกเลิก
										</button>
										<input type="submit" class="btn btn-primary" value="บันทึก">
									</div><!--/.modal-footer-->
								</div><!-- /.modal-content -->
							</form>
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<!-- end edit form -->

					<!-- Add Form -->
					<div class="modal fade" id="formAddName">
						<div class="modal-dialog">
							<form action="personal_name_add.php" method="post">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title">เพิ่มข้อมูลบุคลากร</h4>
									</div>
									<div class="modal-body">
										<!-- Hidden Zone
										//		pin_id	user_name	user_password	 prename  	fname	lname  	birth
										-->
										
										<div class="form-group">
											<label for="pin_id">รหัสประชาชน</label>
											<input type="text" id="pin_id" name="pin_id">
										</div>
						 
										<div class="form-group">
											<label for="prename">คำนำหน้าชื่อ</label>
											<input type="text" id="prename" name="prename">
										</div>
										 
										<div class="form-group">
											<label for="fname">ชื่อ</label>
											<input type="text"  id="fname"   name="fname" >
										</div>	
										
										<div class="form-group">
											<label for="lname">นามสกุล</label>
											<input type="text"  id="lname"   name="lname" >
										</div>	

										<div class="form-group">
											<label for="birth">วันเกิด(yyyy-mm-dd)</label>
											<input type="text"  id="birth"   name="birth" >
										</div>	

										<div class="form-group">
											<label for="user_name">ชื่อเข้าระบบ</label>
											<input type="text" id="user_name" name="user_name">
										</div>

										<div class="form-group">
											<label for="user_password">รหัสผ่านเข้าระบบ</label>
											<input type="text" id="user_password" name="user_password">
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">
										ยกเลิก
										</button>
										<input type="submit" class="btn btn-primary" value="เพิ่ม">
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
else if($sel=="permit")
{
	$sub_sys="เลือกงาน";

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

//			dep_id		depgroup_id		dep_name		depsub_id		dep_show
	$sql5=("SELECT * FROM psn_department where dep_show=1  order by depgroup_id,dep_id ");
	$results5 = $mysqli->query($sql5);
	?>									
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><? echo $this_sys;?></h3>	
			<i><? echo "พบข้อมูล ".$results6->num_rows." จากทั้งหมด ".$results5->num_rows." รายการ";?></i>		
			<!--<a class="alert" href=#>Alert!</a>-->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<? echo $this_sys_sub1;?> / <? echo $sub_sys;?> / <? echo $u_name;?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
				<div class="table">
					<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
						<thead>
							<tr>
								<th>รหัส</th>
								<th>กลุ่ม</th>
								<th>ชื่อระบบ</th>								
								<th>เลือก</th>							
							</tr>
						</thead>
						<tbody>		
						<form method="POST" action="">
							<?		
							////			dep_id		depgroup_id		dep_name		depsub_id		dep_show
								if($results5->num_rows > 0){		
									$send_count=0;
									while($row5 = $results5->fetch_assoc()) {
										$dep_id=$row5["dep_id"];
										$depgroup_id=$row5["depgroup_id"];	
										$dep_name=$row5["dep_name"];
										$depsub_id=$row5["depsub_id"];
										$dep_show=$row5["dep_show"];
										$send_count++;										
										
										?>						
										<tr >
											<td class="center"><? echo $dep_id;?></td>
											<td><? echo $depgroup_id;?></td>
											<td><? echo $dep_name;?></td>											
											<td>
												<label class="switch">
												  <input type="checkbox"   name="send_data[<? echo $send_count;?>]" value='1'  >
												  
												  <span class="slider round"></span>
												</label>
												
											</td>
											<input type="hidden" name="send_id[<? echo $send_count;?>]" value="<? echo $dep_id;?>">	                                       
										</tr>
										<?
									}								
								}			
							?>
						</tbody>
					</table>
					<div class="text-center">
					<input type="submit" class="btn btn-primary" value="บันทึก">
					<input type="hidden" name="send_count" value="<? echo $send_count; ?>">
					<input type="hidden" name="sel" value="">
					<input type="hidden" name="pin_id" value="<? echo $pin_id; ?>">					
					<input type="hidden" name="act" value="save">
					</div>
				</div>
					

	<?
}
else if($sel=="add_po_form")
{
	$sub_sys="เลือกตำแหน่งงาน";

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

// 	dep_id		depgroup_id		dep_name		depsub_id		dep_show
	$sql7=("SELECT * FROM psn_department where dep_id='$dep_id'  ");
	$results7 = $mysqli->query($sql7);
	$job_count=$results7->num_rows;
	if(!empty($job_count))
	{
		while($row7 = $results7->fetch_assoc()) {														
			$dep_name=$row7["dep_name"];
			$depgroup_id=$row7["depgroup_id"];
		}
	}	
	else
	{
		$dep_name="ไม่พบข้อมูล";
	}

//	position_id	position_name position_show	color
	$sql5=("SELECT * FROM psn_position where position_show=1  order by position_id ");
	$results5 = $mysqli->query($sql5);
	?>									
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><? echo $this_sys;?></h3>	
			<i><? echo "พบข้อมูลทั้งหมด ".$results5->num_rows." รายการ";?></i>		
			<!--<a class="alert" href=#>Alert!</a>-->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<? echo $this_sys_sub1;?> / <? echo $sub_sys;?> / <? echo $u_name;?> / <? echo $dep_name;?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
				<div class="table">
					<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
						<thead>
							<tr>																							
								<th>เลือก</th>							
							</tr>
						</thead>
						<tbody>		
						<form method="POST" action="">
							<?		
							//	position_id	position_name position_show	color
								if($results5->num_rows > 0){		
									$send_count=0;
									while($row5 = $results5->fetch_assoc()) {
										$position_id=$row5["position_id"];
										$position_name=$row5["position_name"];											
										$send_count++;										
										
										?>						
										<tr >											
											
											<td>
											<div class="radio radio-danger">
												<input type="radio" name="po_id" id="<? echo $position_id;?>" value="<? echo $position_id;?>">
												<label for="<? echo $position_id;?>">
													<? echo $position_name;?>
												</label>
											</div>
											</td>											                                       
										</tr>
										<?
									}								
								}			
							?>
						</tbody>
					</table>
					<div class="text-center">
					<input type="submit" class="btn btn-primary" value="บันทึก">					
					<input type="hidden" name="pin_id" value="<? echo $pin_id; ?>">		
					<input type="hidden" name="dep_id" value="<? echo $dep_id; ?>">		
					<input type="hidden" name="act" value="save_po">
					</div>
				</div>
					

	<?
}





				