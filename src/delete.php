<HTML>
   <HEAD>
   <style>
      table,tr td{border: 1px solid black;}
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
   </HEAD>
   <BODY>
      <div class="topnav">
	  <a class="active" href="add.php">ADD_Course</a>	  
	  <a href="Course.php">View Course Details</a>
	  <a href="import.php">IMPORT</a>
	  <a href="">Home</a>
	  </div>
	  <H2 style="text-align:center;">Course details</H2>
   </BODY>
<?php
$id = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "result_analysis");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$qry = mysqli_query($conn,"select * from course_info where C_ID='$id';");
$data = mysqli_fetch_array($qry);
// sql to delete a record
$sql = "DELETE FROM course_info WHERE C_ID = '$id'"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo '<script type="text/javascript">'; 
	echo 'alert("'.$id.' deleted Successfully")</script>;';
    echo "<script>window.location = 'Course.php?Sem=".$data['SEM']."&Department=".$data['BRANCH']."'</script>";	
} else {
    echo "Error deleting record";
}
?>