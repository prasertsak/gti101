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

//	term	pt_id	student_id	date_join	date_upload
// std_group :	CODE 	GROUPS 	NAME		ADVISOR		MAN		LADY		TOTAL		SEMES		DEPWORK		TELEPHONE
	$sql5=("SELECT std_student.GRO,count(std_student.GRO) scount ,std_group.GROUPS gg,std_group.NAME gn FROM std_student JOIN std_group  on  std_student.GRO = std_group.CODE where std_student.ENDCHK=''  group by std_student.GRO  order by std_student.GRO DESC ");
	
	$results5 = $mysqli->query($sql5);
	//echo $sql5."<br>";
	?>						
	
				<div class="panel-heading">
				    <div class="text-center">
						รายชื่อกลุ่มเรียนนักศึกษาเข้าร่วมกิจกรรม<br>
						<? echo $pt_name;?><br>
						วันที่ <? echo $date_show;?><br>
						
						ปีการศึกษา <? echo $term;?>	<br>
						จำนวน  <? echo $results5->num_rows ;?> กลุ่ม	
					</div>
				</div>

				<!-- /.panel-heading -->
				<div class="panel-body">
				<div class="table">
					<table width="100%" class="table datatable2  table-striped table-bordered table-hover" >
						<thead>
							<tr>																							
								<th class="text-center">ลำดับที่</th>	
								<th class="text-center">รหัสกลุ่ม</th>	
								<th class="text-center">ชื่อกลุ่ม</th>	
								<th class="text-center">จำนวนนักศึกษา<br>(เฉพาะนักเรียนที่ยังศึกษาอยู่ ไม่รวม DROP)</th>
								<th class="text-center">พบข้อมูล</th>
								
							</tr>
						</thead>
						<tbody>		
						
							<?		
							//		term	pt_id	pt_name
								if($results5->num_rows > 0){		
									$mcount=0;
									while($row5 = $results5->fetch_assoc()) {
										$mcount++;										
										$g_id=$row5['GRO'];
										$student_count=$row5['scount'];
										$g_name=$row5['gn'];
										$g_class=$row5['gg'];
//act_project_datain : term		pt_id		student_id		date_join		date_upload
										$sql7=("SELECT act_project_datain.date_join 	FROM act_project_datain 	where   group_id ='$g_id' and  term ='$term' and  pt_id ='$pt_id' group by date_join ");		
										$results7 = $mysqli->query($sql7);
										$count_in=$results7->num_rows;	
										
										?>						
										<tr>
											<td class="text-center"><? echo $mcount;?></td>
											<td class="text-center">
												<a href="active_report_act.php?term=<? echo $term;?>&pt_id=<? echo $pt_id;?>&g_id=<? echo $g_id;?>" target="_BLANK">
												<? echo $g_id;?></td>	
											<td>
												<a href="active_report_act.php?term=<? echo $term;?>&pt_id=<? echo $pt_id;?>&g_id=<? echo $g_id;?>" target="_BLANK">
											<? echo $g_class;?> (<? echo $g_name;?>)</td>	
											<td class="text-center">
												<a href="active_report_act.php?term=<? echo $term;?>&pt_id=<? echo $pt_id;?>&g_id=<? echo $g_id;?>" target="_BLANK"><? echo $student_count;?></td>
											<td class="text-center">
												<a href="active_report_act.php?term=<? echo $term;?>&pt_id=<? echo $pt_id;?>&g_id=<? echo $g_id;?>" target="_BLANK">
												<?
												if($count_in > 0){
													echo $count_in." วัน";
												}
												else{
													echo "-";													
												}
												 ?></td>
											
										</tr>	
										<?
										}											
									}	
								
							?>
						</tbody>
					</table>					
				</div>
				
<?
 include("foot_bootstrap.php");
?>






										
				