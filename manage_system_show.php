<?
$pin_id = $_SESSION['user_id'];
$sel = $_REQUEST['sel'];
$po_id = $_REQUEST['po_id'];
$send_count = $_REQUEST['send_count'];
$send_data = $_REQUEST['send_data'];
$send_id = $_REQUEST['send_id'];
$act = $_REQUEST['act'];
$color="#ffcc99";
$this_sys_sub1="ข้อมูลระบบงาน";
if(($act=="save")){
	
	$sql1="UPDATE `system_menu` SET `menu_show` = '0' WHERE  1;";
	$results1 = $mysqli->query($sql1);

	for($a = 1;$a <= $send_count;$a++ )	{
		//echo  $send_id[$a]."=$a<br>";
		//echo  $send_data[$a]."=$a<br>";
		
		$check_fin=0;
		if(!empty($send_data[$a]))
		{		
			$sql1="UPDATE `system_menu` SET `menu_show` = '1' WHERE `system_menu`.`menu_id` = $send_id[$a] ;";
			$results1 = $mysqli->query($sql1);			
			$check_fin++;
		}
	}
		?>
		<script>			
				alert("บันทึกข้อมูลแล้ว");
		</script>
		<?
}

// 		menu_id	menu_name	menu_link	menu_icon	menu_show
$sql5=("SELECT * FROM system_menu where menu_id_child = '0' order by menu_id ");
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
				<? echo $this_sys_sub1;?>
				<!-- Add btn-->
				
				   <a class="add-system">
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
							<th class="text-center">รหัส</th>
							<th class="text-center">ชื่อระบบ</th>
							<th class="text-center">ลิ๊ง</th>
							<th class="text-center">icon</th>
							<th class="text-center">แสดง</th>
							<th class="text-center">กระทำ</th>							
						</tr>
					</thead>
					<tbody>	
					<form method="POST" action="">
						<?							
							if($results5->num_rows > 0){		
								$send_count=0;
								while($row5 = $results5->fetch_assoc()) {
									$menu_id=$row5["menu_id"];
									$menu_name=$row5["menu_name"];
									$menu_link=$row5["menu_link"];
									$menu_icon=$row5["menu_icon"];
									$menu_show=$row5["menu_show"];
									$send_count++;
									?>						
									<tr class="<? echo $color;?>">
                                        <td><? echo $menu_id;?></td>
                                        <td><? echo $menu_name;?></td>
                                        <td><? echo $menu_link;?></td>
										<td><? echo $menu_icon;?></td>                                        
										<td>
											<div class="text-center">
													<?
												if($menu_show == 1){
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
										<input type="hidden" name="send_id[<? echo $send_count;?>]" value="<? echo $menu_id;?>">	
                                        <td class="center">										    
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle"
												class="drop-edit" data-toggle="dropdown">
													<i class="fa fa-cog"></i>
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li>
														<a class="edit-system"
														

														data-menu_id="<?php echo $menu_id; ?>"
														data-menu_name="<?php echo $menu_name; ?>"
														data-menu_link="<?php echo $menu_link; ?>"	
														data-menu_icon="<?php echo $menu_icon; ?>"
														data-menu_show="<?php echo $menu_show; ?>"	>
														แก้ไข</a>
													</li>
													<li><a  href="manage_system_del.php?s_id=<?php echo $s_id; ?>&menu_id=<?php echo $menu_id; ?>" onclick="return confirm('ลบ?')">ลบ</a></li>
												</ul>
											</div><!-- /.dropdown -->							
										</td>                                        
                                    </tr>
									<?
								}								
							}			
						?>
						<tr>
						 <td></td>
						 <td></td>
						 <td></td> 
						 <td></td>
						 <td>
							 <div class="text-center">
								<input type="submit" class="btn btn-primary" value="บันทึก">
								<input type="hidden" name="send_count" value="<? echo $send_count; ?>">				
								<input type="hidden" name="act" value="save">
							</div>
						 </td>
						 <td></td>
                         </tr>
					</tbody>
				</table>
				
			</div>
				<!-- Modal Zone -->
				<!-- Edit Form -->
				<div class="modal fade" id="formEditSystem">
					<div class="modal-dialog">
						<form action="manage_system_update.php?s_id=<?php echo $s_id; ?>" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">แก้ไขข้อมูลระบบงาน</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->
									
									<input type="hidden" name="menu_id" id="menu_id" >
					 
									<div class="form-group">
										<label for="menu_name">ชื่อระบบงาน</label>
										<input type="text" id="menu_name" name="menu_name">
									</div>
									 
									<div class="form-group">
										<label for="menu_link">ลิ๊ง</label>
										<input type="text" 	id="menu_link"   name="menu_link" >
									</div>	
									
									<div class="form-group">
										<label for="menu_icon">ลิ๊ง</label>
										<input type="text" 	id="menu_icon"   name="menu_icon" >
									</div>	

									<div class="form-group">
										<label for="menu_show">ลิ๊ง</label>
										<input type="text" 	id="menu_show"   name="menu_show" >
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
				<div class="modal fade" id="formAddSystem">
					<div class="modal-dialog">
						<form action="manage_system_add.php?s_id=<?php echo $s_id; ?>" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">เพิ่มข้อมูลระบบงาน</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->									
									<div class="form-group">
										<label for="menu_id_add">รหัส</label>
										<input type="text" id="menu_id_add" name="menu_id_add">
									</div>
					 
									<div class="form-group">
										<label for="menu_name_add">ชื่อระบบงาน</label>
										<input type="text" id="menu_name_add" name="menu_name_add">
									</div>
									 
									<div class="form-group">
										<label for="menu_link_add">ลิ๊ง</label>
										<input type="text" 	id="menu_link_add"   name="menu_link_add" >
									</div>	
									
									<div class="form-group">
										<label for="menu_icon_add">icon</label>
										<input type="text" 	id="menu_icon_add"   name="menu_icon_add" >
									</div>	

									<div class="form-group">
										<label for="menu_show_add">แสดง</label>
										<input type="text" 	id="menu_show_add"   name="menu_show_add" >
									</div>				 
					 
								</div><!--/.modal-body-->
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




				