<?php
  error_reporting(0);
  
  
  $schemever=$_POST['schemever'];
  $ex_yr=$_POST['YEAR'];
  $ex_pr=$_POST['ex_pr'];
  $ex_rv=$_POST['ex_rv'];
  $branch=$_POST['Department'];
  $yr=$_POST['yr'];
  $sem=$_POST['SEM'];
  $rkp=$_POST['RKP'];
  $GDS=$_POST['GDS'];
  $gzt=$_POST['gz'];
  $S_N=$_POST['Seat_Num'];
  $file=$_FILES['PDF'];
  $s=$file['name'];
  $conn = mysqli_connect("localhost", "root", "","result_analysis");
  mysqli_query($conn,"TRUNCATE TABLE e_detaiils;");
  if (mysqli_num_rows(mysqli_query($conn,"Select File_name from file_uploads where Schemver='$schemever' AND EX_YR=$ex_yr AND EX_PR=$ex_pr AND EX_RV='$ex_rv' AND Branch='$branch' AND YR='$yr' AND SEM=$sem"))==0){
  $RT=mysqli_num_rows(mysqli_query($conn,"Select C_ID from course_info where SEM=$sem AND GRADE_SYSTEM='$GDS'"));
  if ($RT!=0){
	      mysqli_query($conn,"INSERT into file_uploads values('$s','$schemever',$ex_yr,$ex_pr,'$ex_rv','$branch','$yr',$sem);");
	  if (isset($file)){
	  if (filesize($file['tmp_name'])){
		  
		  mysqli_query($conn,"INSERT into e_detaiils values('$schemever',$ex_yr,$ex_pr,'$ex_rv','$branch','$yr',$sem,$rkp,$gzt,'$GDS',$S_N);");  
		  move_uploaded_file($file['tmp_name'],"file/"."1T00727.pdf");
		  if ($_POST["SEM"]!='8'){
          $command = escapeshellcmd("python Text_To_DB_SEM1to7.py");
		  shell_exec($command);   
		  echo "<script>alert('Successfully Converted')</script> ";
		  echo "<script>window.location = 'import_pdf.php'</script>";
		  }
		  else {
		  $command = escapeshellcmd("python Text_To_DB_SEM8.py");
		  shell_exec($command);
		  echo "<script>alert('Successfully Converted')</script> ";
		  echo "<script>window.location = 'import_pdf.php'</script>";
		  }
		  /*mysqli_query($conn,"TRUNCATE TABLE e_detaiils;");*/
	   } 
		 else{
		 echo "<script>alert('FILE SIZE IS ZERO!!!')</script> ";
		  } 
  }}
  else{
	  echo "<script>alert('Enter The Course schema First with proper sequence of Courses Appeared in Uploading PDF!!!!!')</script>";
	  echo "<script>window.location = 'import_pdf.php'</script>";
  }}
  else{
	  echo "<script>alert('Data Already Exists of Uploading PDF')</script>";
	  echo "<script>window.location = 'import_pdf.php'</script>";
  }
?>