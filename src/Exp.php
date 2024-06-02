<!DOCTYPE html>
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
	   input [type=submit]{
       margin-left: auto;
       margin-right: auto;	   
	   }
	   #my_id{
		   display:none;
	   }
	</style>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script>

	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">DMCE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="analysis.php">Main Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
			<li class="nav-item">
      <a href="logout.php" class="btn btn-danger" role="button" button type="button">Sign Out</a>
			</li>            
          </div>
        </div>
	</nav><br>
	  <H4 style="text-align:center;">Export From Data-Base</H4><br>
	<form action="" method="POST" enctype="multipart/form-data" >
	<label> BRANCH : 	
	   <select name="Department" required>
	          <option value="" disabled selected>Select a Department...</option>
			  <option value="COMPUTER">COMPUTER</option>
			  <option value="CHEMICAL">CHEMICAL</option>
			  <option value="MECHANICAL">MECHANICAL</option>
			  <option value="CIVIL">CIVIL</option>
			  <option value="ELECTRONICS">ELECTRONICS</option>
			  <option value="IT">INFORMATION TECHNOLOGY</option>
	    </select>
	</label>
	<label> SEM : 	
		<select name='SEM' required >
		    <option value="" disabled selected>Select a Sem...</option>
			<option value="1">SEM 1</option>
			<option value="2">SEM 2</option>
			<option value="3">SEM 3</option>
			<option value="4">SEM 4</option>
			<option value="5">SEM 5</option>
			<option value="6">SEM 6</option>
			<option value="7">SEM 7</option>
			<option value="8">SEM 8</option>
		</select>
	</label>
	<label>EX_YR :	
    <input type="number" name="YEAR" placeholder="YYYY" pattern="$([0-9]{4})^" required></label>
	<label>EX_PR :
	<select name='ex_pr' required>
			<option value="1">1</option>
			<option value="2">2</option>
	</select></label>
	<label>EX_RV :
	<select name='ex_rv' required>
			<option value="R">R</option>
			<option value="V">V</option>
	</select></label>
	<label>YR :
	<select name='yr' required>
			<option value="FE">FE</option>
			<option value="SE">SE</option>
			<option value="TE">TE</option>
			<option value="BE">BE</option>
	</select></label>
	<label> RKP :
	<input type="number" name="RKP"  pattern="$([0-9]{1,})^" required></label>
	<label><input type="submit" value="Export File" background-color="RED"></label>
	</div>
	

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" ){
  $ex_yr=$_POST['YEAR'];
  $ex_pr=$_POST['ex_pr'];
  $ex_rv=$_POST['ex_rv'];
  $branch=$_POST['Department'];
  $yr=$_POST['yr'];
  $sem=$_POST['SEM'];
  $rkp=$_POST['RKP'];
  $conn = mysqli_connect("localhost", "root", "","result_analysis");
  mysqli_query($conn,"TRUNCATE TABLE e_detaiils;");
  mysqli_query($conn,"INSERT into e_detaiils(ex_yr,ex_pr,ex_rv,branch,yr,sem,rkp) values($ex_yr,$ex_pr,'$ex_rv','$branch','$yr',$sem,$rkp);");  
  $command = escapeshellcmd("python Database_to_XL.py");
  $wo=shell_exec($command);
  echo "<a href='".$wo."' download>DOWNLOAD FILE</a>";
}?>
  <br>
</body>
</HTML>