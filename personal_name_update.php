<?	
	session_start();
	include ('config.php');	
//pin_id	user_name	user_password	 prename  	fname	lname  	birth
 $pin_id=$_REQUEST[pin_id];
 $user_name=$_REQUEST[user_name];
 $user_password=$_REQUEST[user_password];	
 $prename=$_REQUEST[prename];
 $fname=$_REQUEST[fname];	
 $lname=$_REQUEST[lname];	
 $birth=$_REQUEST[birth];	
	
//Table: psn_personal
	////pin_id	user_name	user_password	 prename  	fname	lname  	birth

	$sql=("UPDATE `psn_personal` SET `user_name` = '$user_name', `user_password` = '$user_password' , `prename` = '$prename'  , `fname` = '$fname'  , `lname` = '$lname'  , `birth` = '$birth'  WHERE `psn_personal`.`pin_id` = $pin_id; ");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	header("location:personal_name.php");			

?>