
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>DMCE</title>
<style>
  #students {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#students td, #students th {
  border: 1px solid #ddd;
  padding: 8px;
}

#students tr:nth-child(even){background-color: #f2f2f2;}

#students tr:hover {background-color: #ddd;}

#students th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: #27AE60;
  color: white;
}
 table {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
	border:1px solid black;
     }
	 th,td{
		 font-size:20px;
		 border:1px solid black;
		 text-align:center;
		 
	 }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">DMCE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
           
			<li class="nav-item">
      <a href="logout.php" class="btn btn-danger" role="button" button type="button">Sign Out</a>
			</li>
          </div>
        </div>
      </nav>
  <?php
     
     $conn = mysqli_connect("localhost", "root", "","result_analysis");
	 $login_ses=$_GET['id'];
     $result= mysqli_query($conn,"select * from `logindata` where `Candidate_Name`='$login_ses';");
	 $sname=mysqli_fetch_row($result);
	 $login_session=$sname[2];
	  ?>
	<h2 style="color:blue;">Welcome, <?php echo $sname[3];?></h2>
	<p style="margin:1px;width:100%"><H3 style="color:white;background-color:blue;height:30px">Student Personal Information <?php /*echo $login_session;*/?></H3></p>
	<table id='students'">
	<tr> 
	   <td> Student ID :<?php echo $sname[2];?></td>
	   <td> Branch :<?php echo $sname[33];?></td>
	</tr>
	<tr>
	   <td> Name :<?php echo $sname[3];?></td>
	</tr>
	<tr>
	   <td> Gender :<?php echo $sname[6];?></td>
	   <td> Date of Birth :<?php echo $sname[7];?></td>
	</tr>
	<tr>
	   <td> Email-ID: <?php echo $sname[17];?></td>
	   <td> Category: <?php echo $sname[21];?></td>
	</tr></table>
	<table style="border:2px solid black;width:100%">
	<ul>
    <tr>
	<td style="margin:1px"><H3 style="color:white;background-color:blue;height:30px">Examination Details </H3></td>
    </tr>
	<?php
	
	$b=explode(' ',$sname[33]);
	$tp="";
	$iop=0;
	$iop2=0;
	for($i=1;$i<=8;$i++){
	 $rs= mysqli_query($conn,"select * from `sem_3to6` where (`stdid`='$login_session' or name='$sname[3]') AND sem=$i AND branch='$b[0]' ;");
	 while($sn=mysqli_fetch_row($rs)){
	echo "<br><tr><td>Semester$i:(schemever:$sn[0])</td></tr><tr><td><table id='students'>";
	 $rs2="<tr><th>YR-PR-RV</th><th>Seat No</th>";
	 $rs3="<tr><td>$sn[1]-$sn[2]-$sn[3]</td><td>$sn[9]</td>";
	 $rs4="<tr><td colspan='2'></td>";
	 $k=0;
	 $j=16;
	 $rs5=mysqli_query($conn,"select C_NAME,THEORY_MARKS,IA_MARKS,TW_MARKS,PRACT_MARKS,ORAL_MARKS FROM `course_info` where SEM=$i AND GRADE_SYSTEM='CBCGS';");
	 while($k<mysqli_num_rows($rs5)){
		 $k=$k+1;
	 $rs1=mysqli_query($conn,"select C_NAME,THEORY_MARKS,IA_MARKS,TW_MARKS,PRACT_MARKS,ORAL_MARKS FROM `course_info` where SEM=$i AND GRADE_SYSTEM='CBCGS' AND `SEQUENCE`=$k;");
	 while ($sn1=mysqli_fetch_row($rs1)){
		if (!empty($sn1[1]) && !empty($sn1[2]) && !empty($sn1[3]) && !empty($sn1[4]) && $sn1[5]=='' ){
		   $rs2.="<th colspan='4'>$sn1[0]</th>";
		   $rs4.="<td>TH</td><td>IA</td><td>TW</td><td>PR</td>";
		   $rs3.="<td>".$sn[$j]."</td><td>".$sn[$j+2]."</td><td>".$sn[$j+9]."</td><td>".$sn[$j+11]."</td>";  	
		}
		if (!empty($sn1[1]) && !empty($sn1[2]) && !empty($sn1[3]) && !empty($sn1[5]) && $sn1[4]=='' ){
		   $rs2.="<th colspan='4'>$sn1[0]</th>";
		   $rs4.="<td>TH</td><td>IA</td><td>TW</td><td>OR</td>";
		   $rs3.="<td>".$sn[$j]."</td><td>".$sn[$j+2]."</td><td>".$sn[$j+9]."</td><td>".$sn[$j+13]."</td>";  	
		}
		if (!empty($sn1[1]) && !empty($sn1[2]) && !empty($sn1[3]) && empty($sn1[5]) && empty($sn1[4])){
		   $rs2.="<th colspan='3'>$sn1[0]</th>";
		   $rs4.="<td>TH</td><td>IA</td><td>TW</td>";
		   $rs3.="<td>".$sn[$j]."</td><td>".$sn[$j+2]."</td><td>".$sn[$j+9]."</td>";  	
		}
		if (!empty($sn1[1]) && !empty($sn1[2]) && empty($sn1[3]) && empty($sn1[5]) && empty($sn1[4])){
		   $rs2.="<th colspan='2'>$sn1[0]</th>";
		   $rs4.="<td>TH</td><td>IA</td>";
		   $rs3.="<td>".$sn[$j]."</td><td>".$sn[$j+2]."</td>";  	
		}
		if (!empty($sn1[3]) && !empty($sn1[4]) && empty($sn1[1]) && empty($sn1[2]) && empty($sn1[5])){
		   $rs2.="<th colspan='2'>$sn1[0]</th>";
		   $rs4.="<td>TW</td><td>PR</td>";
		   $rs3.="<td>".$sn[$j+9]."</td><td>".$sn[$j+11]."</td>";  	
		}
		if (!empty($sn1[3]) && !empty($sn1[5]) && empty($sn1[1]) && empty($sn1[2]) && empty($sn1[4])){
		   $rs2.="<th colspan='2'>$sn1[0]</th>";
		   $rs4.="<td>TW</td><td>OR</td>";
		   $rs3.="<td>".$sn[$j+9]."</td><td>".$sn[$j+13]."</td>";  	
		}
		if (!empty($sn1[3]) && empty($sn1[5]) && empty($sn1[1]) && empty($sn1[2]) && empty($sn1[4])){
		   $rs2.="<th colspan='1'>$sn1[0]</th>";
		   $rs4.="<td>TW</td>";
		   $rs3.="<td>".$sn[$j+9]."</td>";  	
		}
		if (empty($sn1[3]) && empty($sn1[5]) && empty($sn1[1]) && empty($sn1[2]) && !empty($sn1[4])){
		   $rs2.="<th colspan='1'>$sn1[0]</th>";
		   $rs4.="<td>PR</td>";
		   $rs3.="<td>".$sn[$j+11]."</td>";  	
		}
		if (empty($sn1[3]) && !empty($sn1[5]) && empty($sn1[1]) && empty($sn1[2]) && empty($sn1[4])){
		   $rs2.="<th colspan='1'>$sn1[0]</th>";
		   $rs4.="<td>OR</td>";
		   $rs3.="<td>".$sn[$j+11]."</td>";  	
		}
		$j=$j+20;
		$iop=1;
		
		
	}
	 }
		$rs2.="<td>Rslt</td></tr>";
		$rs4.="<td></td></tr>";
		if ($sn[239]=='P'){
			$rs3.="<td>Pass($sn[238])</td></tr>";
		}
		else{
			$rs3.="<td>Fail($sn[238])</td></tr>";
		}
		
		echo $rs2;
		echo $rs4;
		echo $rs3;
		echo "</tr></table>";
		
		if ($sn[239]=='F'){
		   $sn[238]=4;}
		if ($sn[7]==1 && $iop==1 && $sn[3]=='R'){
		$tp .= strval($sn[238])." ";
			$iop2=$iop2+1;
		$iop=0;}
		}
		
		unset($sn);
	}
	echo "</table>";
	if ($iop2==6){
	$command = escapeshellcmd("python predict.py $tp");
		$pt=shell_exec($command);
		$arr=json_decode($pt);
		echo "<p style='margin:1px;width:100%;text-align:center;'><H3 style='color:white;background-color:blue;height:30px;text-align:center;'>Prediction Analysis</H3></p>";
        echo "<table >";
        echo "<tr><th>Model</th><th>SVM</th><th>Logistic Regression</th><th>Naive Bayes</th><th>KNN</th><th>Random Forest</th></tr>";
        echo "<tr><th>Accuracy</th><td>44.25%</td><td>41.5%</td><td>40%</td><td>34.5%</td><td>29.5% - 34%</td></tr>";
        echo "<tr><th>Prediction</th><td>$arr[4]</td><td>$arr[1]</td><td>$arr[3]</td><td>$arr[0]</td><td>$arr[2]</td></tr>";
        echo "</table>";		
	}
	?>
  </body>
  </html>