<?	
	session_start();
	include ('config.php');	

	$tcode=$_REQUEST[userlogin];
	$tpass=$_REQUEST[password];

	$tcode = $mysqli->escape_string($tcode);
	$tpass = $mysqli->escape_string($tpass);
	$uare="";
	//Table: psn_personal
	//pin_id		user_name		user_password		prename		fname		lname		birth
	$sql=("SELECT * FROM psn_personal WHERE user_name = '$tcode'	and user_password = '$tpass'  ");
	$results = $mysqli->query($sql);
	//echo $sql."=1<br>";
	//echo $results->num_rows."=2<br>";
	
	//return;
	if($results->num_rows == 0){

		$sql2=("SELECT * FROM student_login WHERE user_name = '$tcode'	and user_password = '$tpass'  ");
		$results2 = $mysqli->query($sql2);
		//echo $sql."=1<br>";
		//echo $results->num_rows."=2<br>";
		
		//return;
		if($results2->num_rows == 0){
			$sql3=("SELECT CODE,PIN_ID,BIRT,FNAME,LNAME,PRE_NAME FROM std_student WHERE CODE = '$tcode'	and PIN_ID = '$tpass'  ");
			$results3= $mysqli->query($sql3);
			if($results3->num_rows == 0){
				header("location:index.php?error=1");	
			}
			else
			{

				$row3 = $results3->fetch_assoc();
				$student_id=$row3["CODE"];
				$pin_id=$row3["PIN_ID"];
				$student_birth=$row3["BIRT"];
				$pre_name=$row3["PRE_NAME"];
				$fname=$row3["FNAME"];
				$lname=$row3["LNAME"];

				$sql4="INSERT INTO `student_login` (`student_id`, `pin_id`, `user_name`, `user_password`, `prename`, `fname`, `lname`, `birth`) VALUES ('$student_id', '$pin_id', '$student_id', '$pin_id', '$pre_name', '$fname', '$lname', '$student_birth');";				
				$results4= $mysqli->query($sql4);

				$mysqli->close();
				$_SESSION["user_id"] = $student_id;
				$_SESSION["user_name"] =$fname." ".$lname;
				$_SESSION["u_are"] = "student";
				echo  $_SESSION['user_id']."==1<br>";
				echo  $_SESSION['user_name']."==1<br>";
				//echo  $_SESSION['u_are']."==2<br>";
				session_write_close();		
				//return;
			
				 header("location:student_main.php");
			

			}
		}
		else
		{
			while($row2 = $results2->fetch_assoc()) {
				$student_id=$row2["student_id"];
				$prename=$row2["prename"];
				$fname=$row2["fname"];
				$lname=$row2["lname"];
				$pin_id=$row2["pin_id"];
			}
			$mysqli->close();
			$_SESSION["user_id"] = $student_id;
			$_SESSION["user_name"] =$fname." ".$lname;
			$_SESSION["u_are"] = "student";
			echo  $_SESSION['user_id']."==1<br>";
			echo  $_SESSION['user_name']."==1<br>";
			//echo  $_SESSION['u_are']."==2<br>";
			session_write_close();		
			//return;
			
			header("location:student_main.php");	
			
		}		
	}
	else
	{
		while($row = $results->fetch_assoc()) {
			$prename=$row["prename"];
			$fname=$row["fname"];
			$lname=$row["lname"];
			$pin_id=$row["pin_id"];
		}   
		$mysqli->close();
	$_SESSION["user_id"] = $pin_id;
	$_SESSION["user_name"] =$fname." ".$lname;
	$_SESSION["u_are"] = "staff";
	echo  $_SESSION['user_id']."==1<br>";
	echo  $_SESSION['user_name']."==1<br>";
	//echo  $_SESSION['u_are']."==2<br>";
	session_write_close();		
	//return;

	header("location:main.php");	   
	
	}		
	

?>