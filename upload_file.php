<?
$target_dir = "dataup/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "txt" ) {
		echo "กรุณาเลือกชนิดของไฟล์ txt.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "โอนข้อมูลไม่สำเร็จ";
	// if everything is ok, try to upload file
	} else {
		$target_file=$target_dir.date('Y-m-d-H-i-s').".txt";
		//echo $target_file."<br>";
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			$filename =$target_file;
			$openfiles = fopen($filename, "r");
			$excutefiles = fread($openfiles, filesize($filename) );
			fclose($openfiles);
			$queryuser = explode("\n", $excutefiles);

			$all_data =0;
			$all =0;
			 for($i = 0; $i < sizeof($queryuser); $i++) 
			{
				 $all_data++;
				 $student_id = substr(trim($queryuser[$i]),0,10);
				 //echo strlen(trim($checkempty)),"<br>";
				 
				if(strlen($student_id) > 0){				
					
					$sql6=("SELECT std_student.GRO g_id 	FROM std_student 	where   std_student.CODE ='$student_id' ");		
					$results6 = $mysqli->query($sql6);
					//echo $sql6."=a<br>";					
					if($results6->num_rows > 0){
						$row6 = $results6->fetch_assoc();
						$g_id=$row6['g_id'];
					}
					else
					{
						$g_id="";	
					}
					//term	pt_id	student_id	date_join	date_upload

					$sql6="INSERT INTO `act_project_datain` (`term`, `pt_id`, `student_id`, `group_id`, `date_join`, `date_upload`) VALUES ('$termu','$pt_idu', '$student_id','$g_id','$date_inu', NOW());";
					// $sql6."=b<br>";
					$results6 = $mysqli->query($sql6);
					if($results6)	{
						$stu_add ++;
					}
					else{
							$stu_no ++;
							//echo $stu_added."*".$queryuser[$i]."<br>";
					}
				}	
				
			}
			?>
			<script>
				alert('โอนข้อมูลได้ <? echo $stu_add;?> คน');
			</script>
			<?
			
		} else {
			echo "error โอนข้อมูลไม่สำเร็จ";
		}
	}
?>