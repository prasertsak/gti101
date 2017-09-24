<?	
	session_start();
	include ('config.php');	


 $pin_id=$_REQUEST[pin_id];
 $user_name=$_REQUEST[user_name];
 $user_password=$_REQUEST[user_password];	
 $prename=$_REQUEST[prename];
 $fname=$_REQUEST[fname];	
 $lname=$_REQUEST[lname];	
 $birth=$_REQUEST[birth];	
 
	//Table: psn_personal
   //pin_id	user_name	user_password	 prename  	fname	lname  	birth

	$sql="INSERT INTO `psn_personal` (`pin_id`, `user_name`, `user_password`, `prename`, `fname`, `lname`, `birth`) VALUES ('$pin_id', '$user_name', '$user_password','$prename', '$fname', '$lname', '$birth');";
	$results = $mysqli->query($sql);
	echo $sql."=1<br>";
	//echo $results->effact."=2<br>";

	$mysqli->close();
	//return;
	header("location:personal_name.php");	
	
	
		

?>