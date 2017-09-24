<?
$pin_id = $_SESSION['user_id'];
$color="#00ff66";
$this_sys_sub1="ข้อมูลกลุ่ม";

// 		depgroup_id	depgroup_name	show	link
$sql5=("SELECT * FROM psn_depgroup order by depgroup_id ");
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
				
				   <a class="add-group">
					<button class="btn btn-default">
						<i class="fa fa-plus-circle"></i>
					</button>	
				  </a>
				<!-- /.btn_add -->
		
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
			<div class="col-lg-12">
			<div class="table">
				<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
					<thead>
						<tr>
							<th>รหัส</th>
							<th>ชื่อกลุ่ม</th>
							<th>ลิ๊ง</th>
							<th>แสดง</th>							
							<th>กระทำ</th>							
						</tr>
					</thead>
					<tbody>					
						<?		
							if($results5->num_rows > 0){		
								while($row5 = $results5->fetch_assoc()) {
									
									$depgroup_id=$row5["depgroup_id"];
									$depgroup_name=$row5["depgroup_name"];
									$show=$row5["show"];
									$link=$row5["link"];
									?>						
									<tr class="<? echo $color;?>">
                                        <td class="center"><? echo $depgroup_id;?></td>
                                        <td><? echo $depgroup_name;?></td>                                        
										<td><? echo $link;?></td>
										<td><? echo $show;?>
										<!--<input type="checkbox" checked data-toggle="toggle" data-size="small"> -->
										
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
														<a class="edit-group"														
														data-depgroup_id="<?php echo $depgroup_id; ?>"
														data-depgroup_name="<?php echo $depgroup_name; ?>"
														data-link="<?php echo $link; ?>"	
														data-show="<?php echo $show; ?>"	>
														แก้ไข</a>
													</li>
													<li><a  href="manage_group_del.php?depgroup_id=<?php echo $depgroup_id; ?>" onclick="return confirm('ลบ?')">ลบ</a></li>
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
			</div>
				<!-- Modal Zone -->
				<!-- Edit Form -->
				<div class="modal fade" id="formEditGroup">
					<div class="modal-dialog">
						<form action="manage_group_update.php" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">แก้ไขข้อมูลกลุ่ม</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->
																	
									<div class="form-group">
										<label for="depgroup_id">รหัส</label>
										<input type="text" id="depgroup_id" name="depgroup_id">
									</div>	
									<div class="form-group">
										<label for="depgroup_name">ชื่อกลุ่ม</label>
										<input type="text" id="depgroup_name" name="depgroup_name">
									</div>
									 
									<div class="form-group">
										<label for="link">ลิ๊ง</label>
										<input type="text" 
										id="link"   name="link" >
									</div>
									<div class="form-group">
										<label for="show">แสดง</label>
										<input type="text" 
										id="show"   name="show" >
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
				<div class="modal fade" id="formAddGroup">
					<div class="modal-dialog">
						<form action="manage_group_add.php" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" 	aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">เพิ่มข้อมูลกลุ่ม</h4>
								</div>
								<div class="modal-body">
									<!-- Hidden Zone -->									
									<div class="form-group">

									
										<label for="depgroup_id_add">รหัส</label>
										<input type="text" id="depgroup_id_add" name="depgroup_id_add">
									</div>
					 
									<div class="form-group">
										<label for="depgroup_name_add">ชื่อกลุ่ม</label>
										<input type="text" id="depgroup_name_add" name="depgroup_name_add">
									</div>
									 
									<div class="form-group">
										<label for="link_add">ลิ๊ง</label>
										<input type="text" 
										id="link_add"   name="link_add" >
									</div>
									
									<div class="form-group">
										<label for="show_add">แสดง</label>
										<input type="text" 
										id="show_add"   name="show_add" >
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




				