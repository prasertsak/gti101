<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                        
						<li>
							<div class="text-center">
								<br>
									<img src="images/man_blank.jpg" class="img-circle" alt="รูป" width="80" height="80" ><br>
									ชื่อผู้ใช้งาน<br>
									<? echo $_SESSION["user_name"];?>
							</div>
                        </li>
                        <li>
                            <a href="profile.php"><i class="fa fa-dashboard fa-fw"></i> ข้อมูลส่วนตัว</a>
                        </li>
						
<?
 $pin_id = $_SESSION['user_id'];
		 //Table: psn_personal_link_department
		//pin_id dep_id  date
		$sql2=("SELECT * FROM psn_personal_link_department WHERE pin_id = '$pin_id' order by dep_id,position_id");
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

				
				
				?>						
				<li>
					<a href="#"><i class="fa fa-user  fa-fw"></i> <? echo $dep_name;?> : <? echo $position_name;?><span class="fa arrow"></span></a>					
                     
				<?
				// Table: psn_department_link_menu
				//		dep_id		position_id		menu_id
				$sql6=("SELECT * FROM psn_position_link_menu WHERE position_id = '$position_id' order by menu_id");
				$results6 = $mysqli->query($sql6);

				if($results6->num_rows > 0){		
					?>
					<ul class="nav nav-second-level">   
						<?
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
								<li>
									<a href="<? echo $menu_link;?>"><i class="fa <? echo $menu_icon;?> fa-fw"></i> <? echo $menu_name;?></a>
								</li>
								<?
							}								
						}			
					} 	?>
				</ul>
				<?			
				}
				?>	  <!-- /.nav-second-level -->
					

				</li>
				<?		
				}				
			} 						
		
		?>

</ul>
						<li>
                            <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>