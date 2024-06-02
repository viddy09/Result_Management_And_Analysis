<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>Dmce &copy;</title>
	<style>
	   input [type=number]  {
	   width: 100%;
	   }
	   input [type=file]  {
       float:center;	   
	   }
   table {
    width: 50%;
    margin-left: auto;
    margin-right: auto;
     }
   loginbox {
     
	 
   }
	</style>
</head>
<body style="background-color:#A5FFFA ;">
	<div class="loginbox">
	    <br>
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
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="analysis.php">Main</a>
              </li>
            </ul>
            
          </div>
        </div>
      </nav><br>
	  <H4 style="text-align:center;">IMPORT TO Data-Base</H4><br>
	     <Select onchange="location = this.value;" style="align:center;">
          <option value="" disabled selected>Select a file format...</option>		 
          <option value="import_pdf.php">.pdf</a></option>
          <option value="import_xlsx.php">.xlsx</a></option>
	     </Select> 
</div>
<form action="import.php" method="POST">
	  <br>
      <select name="Sem">
			  <option value="" disabled selected>Select a SEM...</option> 
			  <option value="1">SEM I</option>
			  <option value="2">SEM II</option>
			  <option value="3">SEM III</option>
			  <option value="4">SEM IV</option>
			  <option value="5">SEM V</option>
			  <option value="6">SEM VI</option>
			  <option value="7">SEM VII</option>
			  <option value="8">SEM VIII</option>
       </select>
	   <select name="Department">
	          <option value="" disabled selected>Select a Department...</option>
			  <option value="COMPUTER">COMPUTER</option>
			  <option value="CHEMICAL">CHEMICAL</option>
			  <option value="MECHANICAL">MECHANICAL</option>
			  <option value="CIVIL">CIVIL</option>
			  <option value="ELECTRONICS">ELECTRONICS</option>
	   </select>	
	   <input type=Submit>
	   </form>
</body>
</html>
<?php 
$Sem = $_GET['Sem'];
$Branch =$_GET['Department'];
$Schemever =$_GET['Schemever'];
$EX_YR =$_GET['EX_YR'];
$EX_PR =$_GET['EX_PR'];
$EX_RV =$_GET['EX_RV'];
$YR =$_GET['YR'];
$F_N=$_GET['F_N'];
$host    = "localhost";
		$user    = "root";
		$pass    = "";
		$db_name = "result_analysis";
		$conn = mysqli_connect($host, $user, $pass, $db_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// sql to delete a record
$sql1= "DELETE FROM file_uploads where Schemver='$Schemever' AND EX_YR=$EX_YR AND EX_PR=$EX_PR AND EX_RV='$EX_RV' AND Branch='$Branch' AND YR='$YR' AND SEM=$Sem";
mysqli_query($conn, $sql1);
$sql = "DELETE FROM sem_3to6 where schemever='$Schemever' AND ex_yr=$EX_YR AND ex_pr=$EX_PR AND ex_rv='$EX_RV' AND branch='$Branch' AND yr='$YR' AND sem=$Sem"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo '<script type="text/javascript">'; 
	echo 'alert("Data related to file'.$F_N.' deleted Successfully")</script>;';
    echo "<script>window.location = 'import.php?Sem=".$Sem."&Department=".$Branch."'</script>";	
} else {
    echo "Error deleting record";
}
?>