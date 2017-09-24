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
						<li>
                            <a href="main.php"><i class="fa fa-home   fa-fw"></i> หน้าหลัก</a>
                        </li>
						
<?
 $pin_id = $_SESSION['user_id'];
		
						// 	menu_id		menu_name		menu_link		menu_icon
						$sql5=("SELECT * FROM system_menu where menu_id_child='$s_id' and  menu_id_child != '0' order by menu_id  ");
						//echo $sql5."=<br>";
						$results5 = $mysqli->query($sql5);
						if($results5->num_rows > 0){		
							while($row5 = $results5->fetch_assoc()) {
								$menu_name=$row5["menu_name"];
								$menu_link=$row5["menu_link"];
								$menu_icon=$row5["menu_icon"];
								?>							
								<li>
									<a href="<? echo $menu_link;?>"><i class="fa <? echo $menu_icon;?> fa-fw"></i> <? echo $menu_name;?></a>
								</li>
								<?
							}								
						}			
					
			
		?>


						<li>
                            <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>