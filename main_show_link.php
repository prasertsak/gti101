<?
 $pin_id = $_SESSION['user_id'];
		 //Table: psn_personal_link_department
		//pin_id dep_id position_id date
		$sql2=("SELECT * FROM psn_personal_link_department WHERE pin_id = '$pin_id'  order by dep_id,position_id ");
		$results2 = $mysqli->query($sql2);
		if($results2->num_rows > 0){		
			while($row2 = $results2->fetch_assoc()) {
				$dep_id=$row2["dep_id"];	
				$position_id=$row2["position_id"];

				//Table: psn_department
				// 		dep_id		depgroup_id		dep_name		depsub_id		dep_show
				$sql3=("SELECT * FROM psn_department WHERE dep_id = '$dep_id' ");
				$results3 = $mysqli->query($sql3);
				if($results3->num_rows > 0){		
					while($row3 = $results3->fetch_assoc()) {
						$dep_name=$row3["dep_name"];	
						$depsub_id=$row3["depsub_id"];
						$dep_show=$row3["dep_show"];						
					}
				}
				else {
					$dep_name="ไม่พบข้อมูล";	
					$depsub_id="ไม่พบข้อมูล";	
				}

				//Table: psn_position
				//position_id  position_name  color
				$sql5=("SELECT * FROM psn_position WHERE position_id = '$position_id' ");
				$results5 = $mysqli->query($sql5);
				if($results5->num_rows > 0){		
					while($row5 = $results5->fetch_assoc()) {
						$position_name=$row5["position_name"];	
						$po_color=$row5["color"];	
					}
				}
				else {
					$position_name="ไม่พบข้อมูล";	
					$po_color="ไม่พบข้อมูล";	
				}									

					// Table: psn_department_link_menu
				//		dep_id		position_id		menu_id
				$sql6=("SELECT * FROM psn_position_link_menu WHERE position_id = '$position_id' ");
				$results6 = $mysqli->query($sql6);
				?>						
				
					<div class="row">
							<div class="col-lg-12">

								<h3 class="page-header"><? echo $dep_name;?> : <? echo $position_name;?></h3>	
								<i><? echo "พบข้อมูล ".$results6->num_rows." รายการ ";?></i>
															
							</div>
							<!-- /.col-lg-12 -->
					</div>
						
				<?
				
				

				if($results6->num_rows > 0){		
					while($row6 = $results6->fetch_assoc()) {
						$menu_id=$row6["menu_id"];

						// 	menu_id		menu_name		menu_link		menu_icon
						$sql7=("SELECT * FROM system_menu WHERE menu_id = '$menu_id' ");
						$results7 = $mysqli->query($sql7);
						if($results7->num_rows > 0){		
							while($row7 = $results7->fetch_assoc()) {
								$menu_name=$row7["menu_name"];
								$menu_link=$row7["menu_link"];
								$menu_icon=$row7["menu_icon"];
								?>			
								<div class="row">
								<div class="col-lg-2 col-md-3">	
										<style>
										a.five:link {color:#4a4a4a;text-decoration:none;}
										a.five:visited {color:#4a4a4a;text-decoration:none;}
										a.five:hover {color:#000000;text-decoration:none;}
										</style>
											<a href="<? echo $menu_link;?>" class="five">
												<div class = "panel custom_class" style="border-color:<? echo $po_color;?>">
												   <div class = "panel-heading custom_class"  
												          style="background-color:<? echo $po_color;?>;">
													  <div class="row">
														  <div class = "panel-title">													  
															<div class="col-xs-3">
																<div><? echo $menu_id;?></div>												
															</div>
															<div class="col-xs-9 text-right">
																<i class="fa <? echo $menu_icon;?> fa-2x"></i>										
															</div>
														</div>
													  </div>
												   </div>
												   <div class = "panel-body">
													  <? echo $menu_name;?>
												   </div>
												</div>
											</a>
										</div>
								<?
							}								
						}			
					} 	
					?>
						</div>
						<?	
				}
			}
		}				
	
	?>