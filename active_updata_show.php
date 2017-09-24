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
    font: 16px "TH SarabunIT๙", Times, serif;
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
    font: 32px "TH SarabunIT๙", Times, serif;
  }

  h2 {
    font: 30px "TH SarabunIT๙", Times, serif;
  }

  h3 {
    font: 28px "TH SarabunIT๙", Times, serif;
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

.row-eq-height {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}
.table {
  background-color: #eee;
  height: 100%;
  margin-bottom: 0;
}
.table-responsive {
  height: 100%;
}
</style>
<?
$term = $_REQUEST['term'];
$pt_id = $_REQUEST['pt_id'];
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
	}
}
else
{
	echo "ไม่พบข้อมูล";
return;
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
						ปีการศึกษา <? echo $term;?>	<br>
						จำนวน  <? echo $results5->num_rows ;?> วัน	
					</div>
				</div>

				<!-- /.panel-heading -->
				<div class="panel-body">				 
				<div class="table">
					<table width="100%" class="table datatable  table-striped table-bordered table-hover" >
						<thead>
						
							<tr>																							
								<th class="text-center">ลำดับที่</th>	
								<th class="text-center">รหัสนักศึกษา</th>	
								<th class="text-center">ชื่อ-สกุล</th>	
							<?
								for($dc = 1;$dc <=$day_count;$dc++){											
								?>
								<th  class="text-center">
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
							$sql5=("SELECT std_student.CODE,std_student.NAME  FROM act_project_datain JOIN std_student ON act_project_datain.student_id=std_student.CODE WHERE  term='$term'  and pt_id='$pt_id'   group by std_student.CODE order by act_project_datain.student_id ");
	//$sql5=("SELECT student_id FROM act_project_datain WHERE  term='$term'  and pt_id='$pt_id'  order by student_id ");
	$results5 = $mysqli->query($sql5);

							//		term	pt_id	pt_name
								if($results5->num_rows > 0){		
									$mcount=0;
									while($row5 = $results5->fetch_assoc()) {
										$mcount++;										
										$student_id=$row5['CODE'];
										$student_name=$row5['NAME'];
										$student_dep=$row5['DEPWORK'];
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






										
				