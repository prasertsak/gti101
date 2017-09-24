<?
include("config.php");
include("set_bootstrap.php");
?>
<style>
@media print {

  @page {                
    size: A4;
    margin: 10mm;
  }

  html, body {
    width: 1024px;
  }

  body {
    margin: 0 auto;
    line-height: 1em;
    word-spacing:1px;
    letter-spacing:0.2px;
    font: 16px "TH Sarabun", Times, serif;
    background:white;
    color:black;
    width: 90%;
    float: none;
  }

  /* avoid page-breaks inside a listingContainer*/
  .listingContainer{
    page-break-inside: avoid;
  }

  h1 {
    font: 32px "TH SarabunPSK", Times, serif;
  }

  h2 {
    font: 30px "TH SarabunPSK", Times, serif;
  }

  h3 {
    font: 28px "TH SarabunPSK", Times, serif;
  }

  /* Improve colour contrast of links */
  a:link, a:visited {
    color: #781351
  }

  /* URL */
  a:link, a:visited {
    background: transparent;
    color:#333;
    text-decoration:none;
  }

  a[href]:after {
    content: "" !important;
  }

  a[href^="http://"] {
    color:#000;
  }

  #header {
    height:75px;
    font-size: 24pt;
    color:black
  }
}

</style>
<?
$term = $_REQUEST['term'];
$pt_id = $_REQUEST['pt_id'];
$g_id = $_REQUEST['g_id'];
$sql1=("SELECT * FROM act_project_title where term='$term' and pt_id='$pt_id' ");
//echo $sql1."<br>";
$results1 = $mysqli->query($sql1);
if($results1->num_rows > 0){		
	while($row1 = $results1->fetch_assoc()) {
		$term=$row1["term"];
		$pt_id=$row1["pt_id"];											
		$pt_name=$row1["pt_name"];		
		$date_start=$row1["date_start"];											
		$date_stop=$row1["date_stop"];	
		if($date_start==$date_stop){
			$date_show=$date_start;
		}
		else{
			$date_show=$date_start." ถึง ".$date_stop;
		}
	}
}
else
{
	echo "ไม่พบข้อมูล";
return;
}

// std_group :	CODE 	GROUPS 	NAME		ADVISOR		MAN		LADY		TOTAL		SEMES		DEPWORK		TELEPHONE
	$sql5=("SELECT std_group.GROUPS gg,std_group.NAME gn FROM std_group  where CODE='$g_id' ");
	
	$results5 = $mysqli->query($sql5);
	//echo $sql5."<br>";
	while($row5 = $results5->fetch_assoc()) {							
		$g_class=$row5['gg'];
		$g_name=$row5['gn'];
	}

//act_project_datain :	term	pt_id	student_id	date_join	date_upload

	$sql5=("SELECT * FROM act_project_datain  WHERE  term='$term'  and pt_id='$pt_id'   group by date_join order by date_join ");	
	$results5 = $mysqli->query($sql5);
	//echo $sql5."<br>";
	if($results5->num_rows > 0){		
		$day_count=0;
		while($row5 = $results5->fetch_assoc()) {
			$day_count++;										
			$date_join_arr[$day_count]=$row5['date_join'];
			//echo $date_join_arr[$day_count]."<br>";
			$date_join_count_arr[$day_count]=0;
			$date_nojoin_count_arr[$day_count]=0;
		}
	}
	?>						
	
				<div class="panel-heading">
				    <div class="text-center">
						รายชื่อนักศึกษาเข้าร่วมกิจกรรม<br>
						<? echo $pt_name;?><br>	
						วันที่ <? echo $date_show;?><br>
						ปีการศึกษา <? echo $term;?>	<br>
						ชื่อกลุ่ม <? echo $g_class;?>(<? echo $g_name;?>)&nbsp;
						รหัสกลุ่ม <? echo $g_id;?>				
						จำนวน  <? echo $results5->num_rows ;?> วัน	
					</div>
				</div>

				<!-- /.panel-heading -->
				<div class="panel-body">				 
				<div class="table">
					<table width="100%" class="table datatable2  table-striped table-bordered table-hover" >
						<thead>
						
							<tr>																							
								<th class="text-center">ลำดับที่</th>	
								<th class="text-center">รหัสนักศึกษา</th>	
								<th class="text-center">ชื่อ-สกุล</th>	
							<?
								for($dc = 1;$dc <=$day_count;$dc++){											
								?>
								<th class="text-center">
									<? echo substr($date_join_arr[$dc],8,2);?><br>
									<? echo substr($date_join_arr[$dc],5,2);?><br>
									<? echo substr($date_join_arr[$dc],0,4);?></th>	
								<?
								}
								?>
								<th class="text-center">รวมเข้าร่วม</th>	
							</tr>
						
						</thead>
						<tbody>		
						
							<?	
							$sql5=("SELECT std_student.CODE,std_student.NAME,std_student.ENDCHK  FROM  std_student  WHERE  std_student.GRO='$g_id'  and std_student.ENDCHK=''    order by std_student.CODE ");
	//$sql5=("SELECT student_id FROM act_project_datain WHERE  term='$term'  and pt_id='$pt_id'  order by student_id ");
	$results5 = $mysqli->query($sql5);
	//echo $sql5."<br>";

							//		term	pt_id	pt_name
								if($results5->num_rows > 0){		
									$mcount=0;
									while($row5 = $results5->fetch_assoc()) {
										$mcount++;										
										$student_id=$row5['CODE'];
										$student_name=$row5['NAME'];										
										?>						
										<tr>
											<td class="text-center"><? echo $mcount;?></td>
											<td class="text-center"><? echo $student_id;?></td>	
											<td><? echo $student_name;?></td>
											
											<?
											$total_in=0;
											$total_out=0;
											for($dc = 1;$dc <=$day_count;$dc++){	
												?>
												<td  class="text-center">
												<?											
												$sql6=("SELECT std_student.CODE,std_student.NAME  FROM act_project_datain JOIN std_student ON act_project_datain.student_id=std_student.CODE WHERE  term='$term'  and pt_id='$pt_id'  and date_join='$date_join_arr[$dc]' and student_id='$student_id' ");
												//echo $sql6."<br>";
												$results6 = $mysqli->query($sql6);

												if($results6->num_rows > 0){
													echo "/";
													$date_join_count_arr[$dc]++;
													$total_in++;
												}
												else{
													echo "X";
													$date_nojoin_count_arr[$dc]++;
													$total_out++;
												}
												?>
												</td>
												<?
											}
											?>
											<td class="text-center"><? echo $total_in;?></td>

										</tr>	
										<?
										}	
										?>
									<tr>
											<td class="text-center" colspan="3">รวมเข้า</td>
											<?
											for($dc = 1;$dc <=$day_count;$dc++){	
											?>
											<td class="text-center"><? echo $date_join_count_arr[$dc];?></td>	
											<?
											}
											?>
									</tr>
									<tr>
											<td class="text-center" colspan="3">รวมไม่เข้า</td>
											<?
											for($dc = 1;$dc <=$day_count;$dc++){	
											?>
											<td class="text-center"><? echo $date_nojoin_count_arr[$dc];?></td>	
											<?
											}
											?>
									</tr>
										<?
									
									}							
							?>
						</tbody>
					</table>					
				</div>
				
<?
 include("foot_bootstrap.php");
?>






										
				