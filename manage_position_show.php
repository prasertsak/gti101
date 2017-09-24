<?
$pin_id = $_SESSION['user_id'];
$sel = $_REQUEST['sel'];
$po_id = $_REQUEST['po_id'];
$send_count = $_REQUEST['send_count'];
$send_data = $_REQUEST['send_data'];
$send_id = $_REQUEST['send_id'];
$act = $_REQUEST['act'];
//echo  $sel."=<br>";
//echo  $po_id."=<br>";
$color="gray";
$this_sys_sub1="ข้อมูลตำแหน่งงาน";

if(($act=="save_show")){
	//// 	position_id	position_name	position_show	color
	$sql1="UPDATE `psn_position` SET `position_show` = '0' WHERE  1;";
	$results1 = $mysqli->query($sql1);
	//echo  $sql1."=a<br>";

	for($a = 1;$a <= $send_count;$a++ )	{
		//echo  $send_id[$a]."=$a<br>";
		//echo  $send_data[$a]."=$a<br>";
		
		$check_fin=0;
		if(!empty($send_data[$a]))
		{		
			$sql1="UPDATE `psn_position` SET `position_show` = '1' WHERE `position_id` = $send_id[$a] ;";
			$results1 = $mysqli->query($sql1);
				//echo  $sql1."=b<br>";
			$check_fin++;
		}
	}
		?>
		<script>			
				alert("บันทึกข้อมูลแล้ว <? echo $check_fin;?> รายการ");
		</script>
		<?
		
}
if(($act=="save") && !empty($po_id)){
	
	$sql1=("DELETE  FROM psn_position_link_menu where position_id='$po_id' ");
	$results1 = $mysqli->query($sql1);

	for($a = 1;$a <= $send_count;$a++ )	{
		//echo  $send_data[$a]."=$a<br>";
		//echo  $send_id[$a]."=$a<br>";
		$check_fin=0;
		if(!empty($send_data[$a]))
		{		
			$sql1="INSERT INTO `psn_position_link_menu` (`position_id`, `menu_id`) VALUES ('$po_id', '$send_id[$a]');";
			$results1 = $mysqli->query($sql1);
			$alert_update[$send_id[$a]]=1;
			$check_fin++;
		}
	}
	$sel="";
		?>
		<script>			
				alert("บันทึกข้อมูลแล้ว");
		</script>
		<?
}

if($sel=="")
{
	// 	position_id  position_name  color
	$sql5=("SELECT * FROM psn_position order by position_id ");
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
					<? echo $this_sys_sub1;?>
					<!-- Add btn-->
					
					   <a class="add-position">
						<button class="btn btn-default">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button>	
					  </a>
					<!-- /.btn_add -->
			
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
				
					<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
						<thead>
							<tr >
								<th class="text-center">รหัส</th>
								<th class="text-center">ตำแหน่ง</th>
								<th class="text-center">สี</th>
								<th class="text-center">แสดง</th>
								<th class="text-center">รายการสิทธิ์</th>
								<th class="text-center">กระทำ</th>							
							</tr>
						</thead>
						<tbody>		
						<form method="POST" action="">
							<?		
							// 	position_id	position_name	position_show	color
									if($results5->num_rows > 0){	
										$send_count=0;
									while($row5 = $results5->fetch_assoc()) {
										$position_id=$row5["position_id"];
										$position_name=$row5["position_name"];
										$color=$row5["color"];
										$position_show=$row5["position_show"];
										$send_count++;

										$sql6=("SELECT * FROM psn_position_link_menu where position_id='$position_id' ");
										$results6 = $mysqli->query($sql6);
										?>						
										<tr>
											<td class="text-center"><? echo $position_id;?></td>
											<td><? echo $position_name;?></td>
											<td><? echo $color;?></td>
											<td><? //echo $position_show;?>
											<div class="text-center">
													<?
												if($position_show == 1){
													$check = "checked";
												}
												else{
													$check = "";
												}

													?>
												<label class="switch">
												  <input type="checkbox"   name="send_data[<? echo $send_count;?>]" value='1'  <? echo $check;?>>
												 											 
												  <span class="slider round"></span>
												</label>
											</div>
											
										</td>
										<input type="hidden" name="send_id[<? echo $send_count;?>]" value="<? echo $position_id;?>">	
											<td class="text-center"><? echo $results6->num_rows;?></td>
											<td class="center">										    
												<div class="dropdown">
													<button class="btn btn-default dropdown-toggle"
													class="drop-edit" data-toggle="dropdown">
														<i class="fa fa-cog"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu">
														<li>
															<a class="edit-position"
															data-position_id="<?php echo $position_id; ?>"
															data-position_name="<?php echo $position_name; ?>"
															data-color="<?php echo $color; ?>"	>
															แก้ไข</a>
														</li>
														<li>
															<a href="manage_position.php?s_id=<? echo $s_id;?>&sel=permit&po_id=<? echo $position_id;?>">															
															สิทธ์ใช้งานระบบ</a>
														</li>
														<li><a  href="manage_position_del.php?s_id=<? echo $s_id;?>&position_id=<?php echo $position_id; ?>" onclick="return confirm('ลบ?')">ลบ</a></li>
													</ul>
												</div><!-- /.dropdown -->														
											</td>                                        
										</tr>
										<?
									}								
								}			
							?><tr>
						 <td></td>
						 <td></td>
						 <td></td> 						 
						 <td>
							 <div class="text-center">
								<input type="submit" class="btn btn-primary" value="บันทึก">
								<input type="hidden" name="send_count" value="<? echo $send_count; ?>">				
								<input type="hidden" name="act" value="save_show">
							</div>
						 </td>
						 <td></td>
						 <td></td>
                         </tr>
						</tbody>
					</table>
					
				</div>
					<!-- Modal Zone -->
					<!-- Edit Form -->
					<div class="modal fade" id="formEditPosition">
						<div class="modal-dialog">
							<form action="manage_position_update.php" method="post">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title">แก้ไขข้อมูลตำแหน่ง</h4>
									</div>
									<div class="modal-body">
										<!-- Hidden Zone -->
										<input type="hidden" name="position_id" id="position_id" >
						 
										<div class="form-group">
											<label for="position_name">ชื่อตำแหน่ง</label>
											<input type="text" id="position_name" name="position_name">
										</div>
										 
										<div class="form-group">
											<label for="pcolor">สี</label>
											<input type="text" 
											id="pcolor"   name="pcolor" >
										</div>			 
						 
									</div><!--/.modal-body-->
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">
										Close
										</button>
										<input type="submit" class="btn btn-primary" value="Save">
									</div><!--/.modal-footer-->
								</div><!-- /.modal-content -->
							</form>
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<!-- end edit form -->

					<!-- Add Form -->
					<div class="modal fade" id="formAddPosition">
						<div class="modal-dialog">
							<form action="manage_position_add.php" method="post">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title">เพิ่มข้อมูลตำแหน่ง</h4>
									</div>
									<div class="modal-body">
										<!-- Hidden Zone -->									
										<div class="form-group">
											<label for="position_id_add">รหัส</label>
											<input type="text" id="position_id_add" name="position_id_add">
										</div>
						 
										<div class="form-group">
											<label for="position_name_add">ชื่อตำแหน่ง</label>
											<input type="text" id="position_name_add" name="position_name_add">
										</div>
										 
										<div class="form-group">
											<label for="pcolor_add">สี</label>
											<input type="text" 
											id="pcolor_add"   name="pcolor_add" >
										</div>			 
						 
									</div><!--/.modal-body-->
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">
										Close
										</button>
										<input type="submit" class="btn btn-primary" value="เพิ่ม">
									</div><!--/.modal-footer-->
								</div><!-- /.modal-content -->
							</form>
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<!-- end add form -->

					<!-- permittion Form -->
					<div class="modal fade" id="formEditPermit">
						<div class="modal-dialog">
							<form action="manage_position_permit.php" method="post">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title">แก้ไขสิทธิ์เข้าระบบงาน</h4>
									</div>
									<div class="modal-body">
										<!-- Hidden Zone -->		
										<?
										//table : psn_menu
										//menu_id 	menu_name	menu_link	menu_icon	menu_show
										$sql6=("SELECT * FROM psn_menu order by menu_id ");
										$results6 = $mysqli->query($sql6);
										if($results6->num_rows > 0){		
											while($row6 = $results6->fetch_assoc()) {
												$menu_id=$row6["menu_id"];
												$menu_name=$row6["menu_name"];											
										?>
										<div class="form-group">									
											<input type="checkbox" id="menu_id[<? echo $menu_id;?>]" 
											name="menu_id[<? echo $menu_id;?>]"><? echo $menu_name;?>													
										</div>
										<?
											}
										}
										?>
											 
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
					<!-- end permittion Form -->

				</div>
			</div>
		</div>
	</div>
	<?
}
else if($sel=="permit")
{
	$sub_sys="สิทธิ์เข้าใช้ระบบ";

//	position_id	menu_id
	$sql6=("SELECT * FROM psn_position_link_menu where position_id='$po_id' order by menu_id ");
	$results6 = $mysqli->query($sql6);

//	position_id	position_name color
	$sql7=("SELECT * FROM psn_position where position_id='$po_id'  ");
	$results7 = $mysqli->query($sql7);
	if($results7->num_rows > 0){		
		while($row7 = $results7->fetch_assoc()) {
			$position_name=$row7["position_name"];
		}
	}
	else
	{
		$position_name="ไม่พบข้อมูลตำแหน่ง";
	}

//	menu_id	menu_name	menu_link	menu_icon	menu_show
	$sql5=("SELECT * FROM system_menu where menu_show=1 and menu_id_child = '0'  order by menu_id ");
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
					<? echo $this_sys_sub1;?> / <? echo $sub_sys;?> / <? echo $position_name;?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
				<div class="table">
					<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
						<thead>
							<tr>
								<th class="text-center">รหัส</th>
								<th class="text-center">ชื่อระบบ</th>								
								<th class="text-center">เลือก</th>							
							</tr>
						</thead>
						<tbody>		
						<form method="POST" action="">
							<?		
							//menu_id	menu_name	menu_link	menu_icon	menu_show
								if($results5->num_rows > 0){		
									$send_count=0;
									while($row5 = $results5->fetch_assoc()) {
										$menu_id=$row5["menu_id"];
										$menu_name=$row5["menu_name"];	
										$send_count++;										
										
										?>						
										<tr >
											<td class="text-center"><? echo $menu_id;?></td>
											<td><? echo $menu_name;?></td>
											<?
											$check=0;
												//	position_id	menu_id
												$sql6=("SELECT * FROM psn_position_link_menu where position_id='$po_id' and menu_id='$menu_id'");
												$results6 = $mysqli->query($sql6);
												if($results6->num_rows > 0){								
													$check="checked";
												}
												else{
													$check="";
												}
												
											?>
											<td>
												<label class="switch">
												  <input type="checkbox"   name="send_data[<? echo $send_count;?>]" value='1'  <? echo $check;?>>
												  
												  <span class="slider round"></span>
												</label>
												
											</td>
											<input type="hidden" name="send_id[<? echo $send_count;?>]" value="<? echo $menu_id;?>">	                                       
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
					<input type="hidden" name="sel" value="<? echo $sel; ?>">
					<input type="hidden" name="po_id" value="<? echo $po_id; ?>">
					<input type="hidden" name="s_id" value="<? echo $s_id; ?>">
					<input type="hidden" name="act" value="save">
					</div>
				</div>
					

	<?
}





				