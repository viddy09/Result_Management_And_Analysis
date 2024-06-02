<?php
$host= "localhost";
$user    = "root";
$pass    = "";
$db_name = "result_analysis";
$db = mysqli_connect($host, $user, $pass, $db_name);
if(mysqli_connect_errno()){
	die("connection failed: "
				. mysqli_connect_error()
				. " (" . mysqli_connect_errno()
				. ")");
		   }
$id = $_GET['id'];
$qry = mysqli_query($db,"select * from course_info where C_ID='$id';");
$data = mysqli_fetch_array($qry);
if(isset($_POST['update'])) // when click on Update button
{
	 $CID=$_POST['C_ID'];
	 $CN=$_POST['C_N'];
	 $THM=$_POST['TH_M'];
	 $IAM=$_POST['IA_M'];
	 $THC=$_POST['TH_C'];
	 $TWM=$_POST['TW_M'];
	 $P=$_POST['P_M'];
	 $O=$_POST['O_M'];
	 $POC=$_POST['PO_C'];
	 $SEQ=$_POST['SEQ'];
	 if ((($THM!="" && $THM!="0") && ($THC!="" && $THC!="0")) || ($THM=="" && $THC=="")){
		 if (((($P!="" && $P!="0" && $O =="" ) || ($O!="" && $O!="0" && $P=="") || ($TWM!="" && $TWM!="0" && $P=="" && $O=="")) && ($POC!='' && $POC!='0')) || ($P=="" && $O=="" && $POC=="")){
			 if (($SEQ!="" && $SEQ!= "0")){
	     $THM = !empty($THM) ? $THM : NULL;
		 $IAM = !empty($IAM) ? $IAM : NULL;
		 $THC = !empty($THC) ? $THC : NULL;
		 $TWM = !empty($TWM) ? $TWM : NULL;
		 $P = !empty($P) ? $P : NULL;
		 $O = !empty($O) ? $O : NULL;
		 $POC = !empty($POC) ? $POC : NULL;
		 $sql="UPDATE course_info SET  THEORY_MARKS=?, IA_MARKS=?, THEORY_CREDIT=?, TW_MARKS=?, PRACT_MARKS=?, ORAL_MARKS=?, TW_PRACT_ORAL_CREDIT=?, SEQUENCE=?  where C_ID=?";
		 $stmt= $db->prepare($sql);
		 $stmt->bind_param("sssssssss", $THM, $IAM, $THC, $TWM, $P, $O, $POC, $SEQ, $id );
		 $stmt->execute();
		 if ($stmt)
		{
			echo "Record Updated Successfully";
			mysqli_close($db); // Close connection
			header("location:Course.php?Sem=".$data['SEM']."&Department=".$data['BRANCH'].""); // redirects to all records page
			exit;
		}
		else
		{
			echo "Error Updating Record";
	 } }
	 else{
		 echo '<script type="text/javascript">'; 
		 echo 'alert("'.$id.' Please enter the Proper Sequence Number");';
		 echo '</script>';
		 }}else{
		 echo '<script type="text/javascript">'; 
		 echo 'alert("'.$id.' Please enter the valid Marks Scheme");';
		 echo '</script>';
		 }
	 }
     else{
		 echo '<script type="text/javascript">'; 
		 echo 'alert("'.$id.' Please enter the valid Marks Scheme");';
		 echo '</script>';
		 }
	 
}
?>
<html>

<head>
<style>
 table,tr, td{cell-spacing:3px;}
 th{text-align:center;
    margin:5px;}
 input[type=text]{width:100%;
 padding: 4px 5px;}
 .topnav {
	  overflow: hidden;
	  background-color: DBEAED;
	}

	.topnav a {
	  float: right;
	  color: black;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	  font-size: 14px;
	}

	.topnav a:hover {
	  background-color: #ddd;
	  color: black;
	}
</style>
</head>
<body>
<div class="topnav">
	  <a class="active" href="add.php">ADD_Course</a>	  
	  <a href="Course.php">View Course Details</a>
	  <a href="import.php">IMPORT</a>
	  </div>
	  <H2 style="text-align:center;">Course Schema</H2>
	  <br>
<form method="POST" >
   <table style='width:100%'>
      <tr>
		 <th><b>Course_ID</b></th>
		 <th><b>Course_name</b></th>
		 <th><b>Theory Marks</b></th>
		 <th><b>IA Marks</b></th>
		 <th><b>Theory Credit</b></th>
		 <th><b>Termwork Marks</b></th>
		 <th><b>Practical Marks</b></th>
		 <th><b>Oral Marks</b></th>
		 <th><b>TW_PRACT/ORAL_CREDIT</b></th>
		 <th><b>SEQUENCE</b></th>
   </tr>
      <tr id="row1">
	    <td><input type="text" name="C_ID" value="<?php echo $data['C_ID'] ?>"></td>
		<td><input type="text" name="C_N" value="<?php echo $data['C_NAME'] ?>"></td>
		<td><input type="text" name="TH_M" value="<?php echo $data['THEORY_MARKS'] ?>"></td>
		<td><input type="text" name="IA_M" value="<?php echo $data['IA_MARKS'] ?>"></td>
		<td><input type="text" name="TH_C" value="<?php echo $data['THEORY_CREDIT'] ?>"></td>
		<td><input type="text" name="TW_M" value="<?php echo $data['TW_MARKS'] ?>"></td>
		<td><input type="text" name="P_M" value="<?php echo $data['PRACT_MARKS'] ?>"></td>
		<td><input type="text" name="O_M" value="<?php echo $data['ORAL_MARKS'] ?>"></td>
		<td><input type="text" name="PO_C" value="<?php echo $data['TW_PRACT_ORAL_CREDIT'] ?>"></td>
		<td><input type="text" name="SEQ" value="<?php echo $data['SEQUENCE'] ?>"></td>
		<td><input type="submit" name="update" value="Update"></td>
   </tr>
   </table>
</form>
</body>
</html>