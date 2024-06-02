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
$SD = $_GET['Sd'];
$D = $_GET['D'];
$DEP = $_GET['DEP'];
$qry = mysqli_query($db,"select * from prof_tb2 where Sub_id='$SD' AND Division='$D' AND Branch='$DEP';");
$data = mysqli_fetch_array($qry);
if(isset($_POST['update'])) // when click on Update button
{
	 $PN=$_POST['P_N'];
	 $CID=$_POST['C_ID'];
	 $D=$_POST['D'];
	 $S=$_POST['S'];
	 $DEP=$_POST['Dep'];
	 $sql="UPDATE prof_tb2 SET  Name=?, Sub_id=?, Division=?, Sem=?, Branch=? where Sub_id='$SD' AND Division='$D' AND Branch='$DEP'";
		 $stmt= $db->prepare($sql);
		 $stmt->bind_param("sssis", $PN, $CID, $D, $S, $DEP);
		 $stmt->execute();
		 if ($stmt)
		{
			echo "Record Updated Successfully";
			mysqli_close($db); // Close connection
			header("location:prof1.php?Sem=".$data['Sem']."&Department=".$data['Branch'].""); // redirects to all records page
			exit;
		}
		else
		{
			echo "Error Updating Record";
	 }
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>Dmce &copy;</title>
<style>
 table,tr, td{cell-spacing:3px;}
 th{text-align:center;
    margin:5px;}
 input[type=text],select{width:100%;
 padding: 4px 5px;}
 </style>
 </head>
<body>
	<div class="loginbox">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">DMCE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
			  <li class="nav-item">
                <a class="nav-link" href="analysis.php">Main Home</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="prof1.php">Faculty Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="report.php"></a>
              </li>
            </ul>
              </div>
        </div>
      </nav><br>
	  <form method="POST" >
   <table style='width:100%'>
      <tr>
	  <th><b>Professor Name</b></th>
		 <th><b>Course_ID</b></th>
		 <th><b>Division</b></th>
		 <th><b>Sem</b></th>
		 <th><b>Branch</b></th>		 
      </tr>
      <tr>
	  <td><input type="text" name="P_N"  required value="<?php echo $data['Name'] ?>"></td>
	  <td><input type="text" name="C_ID" required value="<?php echo $data['Sub_id'] ?>"></td>
	  <td><select name="D" required>
	  <option value="" disabled selected>Select an Division...</option>
			  <option value="A">A</option>
			  <option value="B">B</option>
			  <option value="A&B">A & B</option></select></td>
	  <td><select name="S" required>
        	  <option value="" disabled selected>Select a SEM...</option>
			  <option value="1">SEM I</option>
			  <option value="2">SEM II</option>
			  <option value="3">SEM III</option>
			  <option value="4">SEM IV</option>
			  <option value="5">SEM V</option>
			  <option value="6">SEM VI</option>
			  <option value="7">SEM VII</option>
			  <option value="8">SEM VIII</option>
       </select></td>
	  <td><select name="Dep">
	      <option value="" disabled selected>Select a Department...</option>
			  <option value="COMPUTER">COMPUTER</option>
			  <option value="CHEMICAL">CHEMICAL</option>
			  <option value="MECHANICAL">MECHANICAL</option>
			  <option value="CIVIL">CIVIL</option>
			  <option value="ELECTRONICS">ELECTRONICS</option>
	   </select></td>
	   <td><input type="submit" name="update" value="Update"></td>
	  </tr>
	   </table>
</form>
</body>
</html>