<?
$system_name="ระบบข้อมูลสารสนเทศ";
 //$school_name="วิทยาลัยเทคนิคพิจิตร";
$school_name="ไม่พบข้อมูล";
$school_id="ไม่พบข้อมูล";
$host="localhost";
$user="root";
$pass="12345678";
$db = "college_db";

$mysqli = new mysqli($host,$user,$pass,$db);

//Output any connection error
if ($mysqli->connect_error) {
	header("Location: connect_error.php"); /* Redirect browser */
    exit();
    //die('ไม่สามารถเชื่อมต่อได้ <br>Error Code : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
$results = $mysqli->query("SELECT * FROM `std_school`");
//$mysqli->escape_string('This is an unescape "string"');
//print '<table border="1">';
//echo $result->num_rows;
while($row = $results->fetch_assoc()) {
    //print '<tr>';
    //print '<td>'.$row["IDNOSCL"].'</td>';
    //print '<td>'.$row["SCNAME"].'</td>';    
    //print '</tr>';
	$school_name=$row["SCNAME"];
	$school_id=$row["IDNOSCL"];
}  


//	term   mark_use
$sql5=("SELECT * FROM system_term_mark where mark_use='1'   ");
$results5 = $mysqli->query($sql5);
if($results5->num_rows > 0){		
		$send_count=0;
		while($row5 = $results5->fetch_assoc()) {
			$term=$row5["term"];
			//$mark_use=$row5["mark_use"];		
		}
}
//print '</table>';

//mysqli_close($mysqli);
date_default_timezone_set('Asia/Bangkok');


?>