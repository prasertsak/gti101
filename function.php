<?php
function add_date($givendate,$day=0,$mth=0,$yr=0) {
		$cd = strtotime($givendate);
		$newdate = date('Y-m-d', mktime(date('h',$cd),
		date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
		date('d',$cd)+$day, date('Y',$cd)+$yr));
		return $newdate;
     }
//echo add_date("2010-12-09",2,1,0);

function week_dates($date = null, $format = null, $start = 'monday') {
  // is date given? if not, use current time...
  if(is_null($date)) $date = 'now';

  // get the timestamp of the day that started $date's week...
  $weekstart = strtotime('last '.$start, strtotime($date));

  // add 86400 to the timestamp for each day that follows it...
  for($i = 0; $i < 7; $i++) {
    $day = $weekstart + (86400 * $i);
    if(is_null($format)) $dates[$i] = $day;
    else $dates[$i] = date($format, $day);
  }

  return $dates;
}

function calendar_m($year,$month,&$day_check){
	//$year=2017; 

//for($month=1;$month<13;$month++) { 
	//echo count($day_check);
	//for($dc=1;$dc <= count($day_check);$dc++ )
	//{
	//	echo $day_check[$dc]."=<br>";
	//}
	$month_arr=array( "","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	?>
	<div class="col-md-4">
	<table class="table"  border='1' width="200">
	<tr class="text-center"><th colspan='7'  class="text-center"><? echo $month_arr[date("m",mktime(0,0,0,$month,1,$year))+0];?>&nbsp;<? echo $year+543;?></th></tr>
	<tr><th>อา.</th><th>จ.</th><th>อ.</th><th>พ.</th><th>พฤ.</th><th>ศ.</th><th>ส.</th></tr>
	<?
	$fdom=date("w",mktime(0,0,0,$month,1,$year)); 
	$ct=0; 
	for($row=1;$row<7;$row++) 
	{ 
		echo "<tr>";
		for($week=1;$week<8;$week++) 
		{ 
			$ct++; 
			//echo date("Y-m-d",$value)."=xx<br>";
			$value=mktime(0,0,0,$month,$ct-$fdom,$year); 
			
			$colorx="#FFFFFF";
			for($dc=1;$dc <= count($day_check);$dc++ )
			{
				//echo $day_check[$dc]."=<br>";
				if($day_check[$dc]==date("Y-m-d",$value))
				{
					$colorx="#00ff66";
				}
			}
			if (date("m",$value)==$month) 
			{ 
				?>
				<th bgcolor="<? echo $colorx;?>"><? echo date("d",$value);?> 
				<?
			} 
			else { ?><td></td><? } 
		} 
		?></tr><?
	} 
	?></table>
	</div>
	<?
//} 

}
?>