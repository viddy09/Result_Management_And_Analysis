<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>Dmce &copy;</title>
	</head>
	<style>
	   input [type=number]  {
	   width: 100%;
	   }
	   input [type=submit]  {
       margin-left: auto;
       margin-right: auto;	   
	   }
   table {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
	border:1px solid black;
     }
	 h2,h3,h4{
		 text-align:center;
	 }
	 th,td{
		 font-size:20px;
		 border:1px solid black;
		 text-align:center;
		 
	 }
	</style>
<body style="background-color:white;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">DMCE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="analysis.php">Main Home</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="prof1.php">Faculty Details</a>
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
	  <H4 style="text-align:center;">Analysis Page</H4><br>
	  <form method="Post" action="Batchwise.php">
	       <p>Enter Year of Batch <input type="number" name="YR" placeholder="YYYY" pattern="$([0-9]{4})^" required>
		   <select name="Dep" required>
	          <option value="" disabled selected>Select a Department...</option>
			  <option value="COMPUTER">COMPUTER</option>
			  <option value="CHEMICAL">CHEMICAL</option>
			  <option value="MECHANICAL">MECHANICAL</option>
			  <option value="CIVIL">CIVIL</option>
			  <option value="ELECTRONICS">ELECTRONICS</option>
	   </select>
       <input type="submit" value="Submit">
	  </form>
	  </body>
	  </html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
	  $Y=$_POST["YR"];
	  $D=$_POST["Dep"];
	  $conn = mysqli_connect("localhost", "root", "", "result_analysis");
	  $qry = mysqli_query($conn,"select yr,count(*) from sem_3to6 where ex_rv='R' AND rkp=1 AND branch='$D' AND sem=1 AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
      $data = mysqli_fetch_array($qry);
	  if ($data[1]>0){
		  echo "<h2>Datta Meghe College of Engineering</h2>";
		  echo "<h3>Result Analysis</h3>";
		  echo "<p style='float:right;font-size:25px;'>Date:". date('Y/m/d') ."    </p><br>";
		  echo "<hr size='8' width='100%' color='red'>";
		  for ($i=1;$i<=8;$i++){			  
			  if ($i%2==1){
				  $qr = mysqli_query($conn,"select yr,count(*) from sem_3to6 where ex_rv='R' AND rkp=1 AND branch='$D' AND sem=$i AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1));");
                  $dt = mysqli_fetch_array($qr);
				  if ($dt[1]>0){
	  
	  $qry1= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (th01='A' or th02='A' or th03='A' or th04='A' or th05='A' or th06='A' or th07='A') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $data1 = mysqli_fetch_array($qry1);
	  
	  $qry2= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE rslt='P' AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $data2 = mysqli_fetch_array($qry2);
	  
	  $qry3= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE gpa>=7.75 AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $data3 = mysqli_fetch_array($qry3);
	  
	  $qry4= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (gpa>=6.75 AND gpa<7.75) AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $data4 = mysqli_fetch_array($qry4);
	  
	  $qry5= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (gpa<6.75 AND rslt='P') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
				  $data5 = mysqli_fetch_array($qry5);
	  echo "<h4>".$dt[0]."-Sem".$i."</h4>";
	  echo "<table><tr>";
	  echo "<th>Year</th><th>Sem</th><th>Div</th><th>Tot No. of Students</th><th>Students Appeared</th><th>Tot No. of Students Passed</th>";
	  echo "<th>% of Students Passed</th><th>Tot No. of Students Failed</th><th>% of Students Failed</th><th>Tot No. of Students in Dist.</th><th>Tot No. of Students in 1st Class.</th><th>less than 60%</th></tr>";
	  echo "<tr><td>".$dt[0]."</td><td>".$i."</td><td>Overall</td><td>".$dt[1]."</td><td>".$dt[1]."</td><td>".$data2[0]."</td>";
	  $p=round(($data2[0]/$dt[1])*100,2);
	  $f=100-$p;
	  $f1=$dt[1]-$data2[0];
	  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$data3[0]."</td><td>".$data4[0]."</td><td>".$data5[0]."</td>";
	  echo "</tr></table><br>";		  
	
      echo "<h4>Subject and Division Wise Analysis</h4>";
      $q1=mysqli_query($conn,"SELECT C_ID,C_NAME,SEQUENCE FROM `course_info` WHERE SEM=$i AND GRADE_SYSTEM='CBCGS' AND BRANCH='$D' AND THEORY_MARKS is not NULL;");
      if (mysqli_num_rows($q1)>0){
      echo "<br><table><tr>";	  
	  echo "<th>Name of Faculty</th><th>Sub</th><th>Div</th><th>Tot No. of Students</th><th>Students Appeared</th><th>Tot No. of Students Passed</th>";
	  echo "<th>% of Students Passed</th><th>Tot No. of Students Failed</th><th>% of Students Failed</th><th>Tot No. of Students in Dist.</th><th>Tot No. of Students in 1st Class.</th><th>less than 60%</th></tr>";
	  while($res=mysqli_fetch_row($q1)){
		  $q2=mysqli_query($conn,"SELECT Name, Division FROM `prof_tb2` WHERE Sem=$i And Branch='$D' And Sub_id='$res[0]';");
		  if (mysqli_num_rows($q2)>0){
			  $k=0;
			  while($res2=mysqli_fetch_row($q2)){
				  if ($res2[1]=='A&B'){
					  /*$qr1= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (th01='A' or th02='A' or th03='A' or th04='A' or th05='A' or th06='A' or th07='A') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat1 = mysqli_fetch_array($qr1);*/
					  
					  $qr2= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE thg0".$res[2]."!='F' AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat2 = mysqli_fetch_array($qr2);
					  
					  $qr3= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (thg0".$res[2]."='O' or thg0".$res[2]."='A' or thg0".$res[2]."='B') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat3 = mysqli_fetch_array($qr3);
					  
					  $qr4= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (thg0".$res[2]."='C') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat4 = mysqli_fetch_array($qr4);
					  
					  $qr5= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (thg0".$res[2]."='D' or thg0".$res[2]."='E') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
				      $dat5 = mysqli_fetch_array($qr5);
					  
					  echo "<tr><td>".$res2[0]."</td><td>".$res[1]."</td><td>A&B</td><td>".$dt[1]."</td><td>".$dt[1]."</td><td>".$dat2[0]."</td>";
					  $p=round(($dat2[0]/$dt[1])*100,2);
					  $f=100-$p;
					  $f1=$dt[1]-$dat2[0];
					  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$dat3[0]."</td><td>".$dat4[0]."</td><td>".$dat5[0]."</td>";
					  echo "</tr>";	
				  }
				  if ($res2[1]=='A' ||  $res2[1]=='B'){
					  $qr89 = mysqli_query($conn,"select yr,count(*) from sem_3to6 where division='$res2[1]' and ex_rv='R' AND rkp=1 AND branch='$D' AND sem=$i AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1));");
                      $dt1 = mysqli_fetch_array($qr89);
					  
					  $qr2= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and thg0".$res[2]."!='F' AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat2 = mysqli_fetch_array($qr2);
					  
					  $qr3= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and (thg0".$res[2]."='O' or thg0".$res[2]."='A' or thg0".$res[2]."='B') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat3 = mysqli_fetch_array($qr3);
					  
					  $qr4= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and (thg0".$res[2]."='C') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat4 = mysqli_fetch_array($qr4);
					  
					  $qr5= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and (thg0".$res[2]."='D' or thg0".$res[2]."='E') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
				      $dat5 = mysqli_fetch_array($qr5);
					  
					  if ($k==0){
						  echo "<tr><td>".$res2[0]."</td><td rowspan='2'>".$res[1]."</td><td>".$res2[1]."</td><td>".$dt1[1]."</td><td>".$dt1[1]."</td><td>".$dat2[0]."</td>";
						  $p=round(($dat2[0]/$dt1[1])*100,2);
						  $f=100-$p;
						  $f1=$dt1[1]-$dat2[0];
						  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$dat3[0]."</td><td>".$dat4[0]."</td><td>".$dat5[0]."</td>";
						  echo "</tr>";	
					  	  $k=$k+1;
				  }
				  else{
					  echo "<tr><td>".$res2[0]."</td><td>".$res2[1]."</td><td>".$dt1[1]."</td><td>".$dt1[1]."</td><td>".$dat2[0]."</td>";
						  $p=round(($dat2[0]/$dt1[1])*100,2);
						  $f=100-$p;
						  $f1=$dt1[1]-$dat2[0];
						  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$dat3[0]."</td><td>".$dat4[0]."</td><td>".$dat5[0]."</td>";
				  }
				  }
				  
			  }
		  }
		  else{
		  echo '<script type="text/javascript">'; 
		 echo 'alert("Sorry NO Professor Data available");';
		 echo '</script>';
	  }
	  }
	  echo "</table><br>";
	  echo "<h4>Male Female Passing%</h4>";
	  $m=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE m_f='M'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $dtt = mysqli_fetch_array($m);
	  $m1=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE rslt='P' AND m_f='M'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $dtt1 = mysqli_fetch_array($m1);
	  $f=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE m_f='F'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $dtt2 = mysqli_fetch_array($f);
	  $f1=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE rslt='P' AND m_f='F'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
	  $dtt3 = mysqli_fetch_array($f1);
	  
      if ($dtt[0]!=0 && $dtt2[0]!=0){
	  echo "<table><tr>";
	  echo "<th>Category</th><th>Appeared</th><th>Pass</th><th>Pass %</th><th>Fail</th><th>Fail %</th></tr>";
	  $mp=round(($dtt1[0]/$dtt[0])*100,2);
	  $fmp=100-$mp;
	  $ff=$dtt[0]-$dtt1[0];
	  echo "<tr><td>Male</td><td>".$dtt[0]."</td><td>".$dtt1[0]."</td><td>".$mp."</td><td>".$ff."</td><td>".$fmp."</td></tr>";
	  $mp=round(($dtt3[0]/$dtt2[0])*100,2);
	  $fmp=100-$mp;
	  $ff=$dtt2[0]-$dtt3[0];
	  echo "<tr><td>Female</td><td>".$dtt2[0]."</td><td>".$dtt3[0]."</td><td>".$mp."</td><td>".$ff."</td><td>".$fmp."</td></tr>";
	  echo "</table><br>";
	  }
	  
	  echo "<h4>Merit List (Above 7.75 CGPA)</h4><br>";
	  echo "<table><tr><th>Rank</th><th>Seat Number</th><th>Student Name</th><th>GPA</th></tr>";
	  $mtl=mysqli_query($conn,"SELECT seat_no,name,gpa FROM `sem_3to6` WHERE ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) ) AND gpa>=7.75 ORDER BY gpa DESC ;");
	  $o=1;
	  while($resl=mysqli_fetch_row($mtl)){
		echo "<tr><td>".$o."</td><td>".$resl[0]."</td><td>".$resl[1]."</td><td>".$resl[2]."</td></tr>";
        $o=$o+1;		
	  }
	  echo "</table><br>";
	  
	  }
	  else{
		  echo '<script type="text/javascript">'; 
		 echo 'alert("Sorry NO Course Data available");';
		 echo '</script>';
	  }
	  
	  
			  $Y=$Y+1;}}
				  
				  
	if ($i%2==0){
					  $qr = mysqli_query($conn,"select yr,count(*) from sem_3to6 where ex_rv='R' AND rkp=1 AND branch='$D' AND sem=$i AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2));");
                      $dt = mysqli_fetch_array($qr);
	                 if ($dt[1]>0){
	  $qry1= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (th01='A' or th02='A' or th03='A' or th04='A' or th05='A' or th06='A' or th07='A') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2) );");
	  $data1 = mysqli_fetch_array($qry1);
	  
	  $qry2= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE rslt='P' AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2) );");
	  $data2 = mysqli_fetch_array($qry2);
	  
	  $qry3= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE gpa>=7.75 AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2) );");
	  $data3 = mysqli_fetch_array($qry3);
	  
	  $qry4= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (gpa>=6.75 AND gpa<7.75) AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2) );");
	  $data4 = mysqli_fetch_array($qry4);
	  
	  $qry5= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (gpa<6.75 AND rslt='P') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2) );");
				  $data5 = mysqli_fetch_array($qry5);				  
	  echo "<h4>".$dt[0]."-Sem".$i."</h4>";
	  echo "<table><tr>";
	  echo "<th>Year</th><th>Sem</th><th>Div</th><th>Tot No. of Students</th><th>Students Appeared</th><th>Tot No. of Students Passed</th>";
	  echo "<th>% of Students Passed</th><th>Tot No. of Students Failed</th><th>% of Students Failed</th><th>Tot No. of Students in Dist.</th><th>Tot No. of Students in 1st Class.</th><th>less than 60%</th></tr>";
	  echo "<tr><td>".$dt[0]."</td><td>".$i."</td><td>Overall</td><td>".$dt[1]."</td><td>".$dt[1]."</td><td>".$data2[0]."</td>";
	  $p=round(($data2[0]/$dt[1])*100,2);
	  $f=100-$p;
	  $f1=$dt[1]-$data2[0];
	  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$data3[0]."</td><td>".$data4[0]."</td><td>".$data5[0]."</td>";
	  echo "</tr></table><br>";				  
	  
      echo "<h4>Subject and Division Wise Analysis</h4>";
      $q1=mysqli_query($conn,"SELECT C_ID,C_NAME,SEQUENCE FROM `course_info` WHERE SEM=$i AND BRANCH='$D' AND THEORY_MARKS is not NULL;");
      if (mysqli_num_rows($q1)>0){
      echo "<br><table><tr>";	  
	  echo "<th>Name of Faculty</th><th>Sub</th><th>Div</th><th>Tot No. of Students</th><th>Students Appeared</th><th>Tot No. of Students Passed</th>";
	  echo "<th>% of Students Passed</th><th>Tot No. of Students Failed</th><th>% of Students Failed</th><th>Tot No. of Students in Dist.</th><th>Tot No. of Students in 1st Class.</th><th>less than 60%</th></tr>";
	  while($res=mysqli_fetch_row($q1)){
		  $q2=mysqli_query($conn,"SELECT Name, Division FROM `prof_tb2` WHERE Sem=$i And Branch='$D' And Sub_id='$res[0]';");
		  if (mysqli_num_rows($q2)>0){
			  $k=0;
			  while($res2=mysqli_fetch_row($q2)){
				  if ($res2[1]=='A&B'){
					  /*$qr1= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (th01='A' or th02='A' or th03='A' or th04='A' or th05='A' or th06='A' or th07='A') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y+1 AND ex_pr=1) );");
					  $dat1 = mysqli_fetch_array($qr1);*/
					  
					  $qr2= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE thg0".$res[2]."!='F' AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2) );");
					  $dat2 = mysqli_fetch_array($qr2);
					  
					  $qr3= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (thg0".$res[2]."='O' or thg0".$res[2]."='A' or thg0".$res[2]."='B') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2) );");
					  $dat3 = mysqli_fetch_array($qr3);
					  
					  $qr4= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (thg0".$res[2]."='C') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
					  $dat4 = mysqli_fetch_array($qr4);
					  
					  $qr5= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE (thg0".$res[2]."='D' or thg0".$res[2]."='E') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
				      $dat5 = mysqli_fetch_array($qr5);
					  
					  echo "<tr><td>".$res2[0]."</td><td>".$res[1]."</td><td>A&B</td><td>".$dt[1]."</td><td>".$dt[1]."</td><td>".$dat2[0]."</td>";
					  $p=round(($dat2[0]/$dt[1])*100,2);
					  $f=100-$p;
					  $f1=$dt[1]-$dat2[0];
					  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$dat3[0]."</td><td>".$dat4[0]."</td><td>".$dat5[0]."</td>";
					  echo "</tr>";	
				  }
				  if ($res2[1]=='A' ||  $res2[1]=='B'){
					  $qr90 = mysqli_query($conn,"select yr,count(*) from sem_3to6 where division='$res2[1]' and ex_rv='R' AND rkp=1 AND branch='$D' AND sem=$i AND ((ex_yr=$Y AND ex_pr=1) OR (ex_yr=$Y AND ex_pr=2));");
                      $dt2 = mysqli_fetch_array($qr90);
					  
					  $qr2= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and thg0".$res[2]."!='F' AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
					  $dat2 = mysqli_fetch_array($qr2);
					  
					  $qr3= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and (thg0".$res[2]."='O' or thg0".$res[2]."='A' or thg0".$res[2]."='B') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
					  $dat3 = mysqli_fetch_array($qr3);
					  
					  $qr4= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and (thg0".$res[2]."='C') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
					  $dat4 = mysqli_fetch_array($qr4);
					  
					  $qr5= mysqli_query($conn,"SELECT count(*) FROM `sem_3to6` WHERE division='$res2[1]' and (thg0".$res[2]."='D' or thg0".$res[2]."='E') AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
				      $dat5 = mysqli_fetch_array($qr5);
					  
					  if ($k==0){
						  echo "<tr><td>".$res2[0]."</td><td rowspan='2'>".$res[1]."</td><td>".$res2[1]."</td><td>".$dt2[1]."</td><td>".$dt2[1]."</td><td>".$dat2[0]."</td>";
						  $p=round(($dat2[0]/$dt2[1])*100,2);
						  $f=100-$p;
						  $f1=$dt2[1]-$dat2[0];
						  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$dat3[0]."</td><td>".$dat4[0]."</td><td>".$dat5[0]."</td>";
						  echo "</tr>";	
						  $k=$k+1;
				  }
				  else{
					  	  echo "<tr><td>".$res2[0]."</td><td>".$res2[1]."</td><td>".$dt2[1]."</td><td>".$dt2[1]."</td><td>".$dat2[0]."</td>";
						  $p=round(($dat2[0]/$dt2[1])*100,2);
						  $f=100-$p;
						  $f1=$dt2[1]-$dat2[0];
						  echo "<td>".$p."</td><td>".$f1."</td><td>".$f."</td><td>".$dat3[0]."</td><td>".$dat4[0]."</td><td>".$dat5[0]."</td>";
						  echo "</tr>";	

				  }
				  }
			  }
		  }
		  else{
		  echo '<script type="text/javascript">'; 
		 echo 'alert("Sorry NO Professor Data available");';
		 echo '</script>';
	  }
	  }
	  echo "</table><br>";
	  echo "<h4>Male Female Passing%</h4>";
	  $m=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE m_f='M'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
	  $dtt = mysqli_fetch_array($m);
	  $m1=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE rslt='P' AND m_f='M'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
	  $dtt1 = mysqli_fetch_array($m1);
	  $f=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE m_f='F'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
	  $dtt2 = mysqli_fetch_array($f);
	  $f1=mysqli_query($conn,"SELECT COUNT(*) FROM `sem_3to6` WHERE rslt='P' AND m_f='F'  AND ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) );");
	  $dtt3 = mysqli_fetch_array($f1);
	  if ($dtt[0]!=0 && $dtt2[0]!=0){
      echo "<table><tr>";
	  echo "<th>Category</th><th>Appeared</th><th>Pass</th><th>Pass %</th><th>Fail</th><th>Fail %</th></tr>";
	  $mp=round(($dtt1[0]/$dtt[0])*100,2);
	  $fmp=100-$mp;
	  $ff=$dtt[0]-$dtt1[0];
	  echo "<tr><td>Male</td><td>".$dtt[0]."</td><td>".$dtt1[0]."</td><td>".$mp."</td><td>".$ff."</td><td>".$fmp."</td></tr>";
	  $mp=round(($dtt3[0]/$dtt2[0])*100,2);
	  $fmp=100-$mp;
	  $ff=$dtt2[0]-$dtt3[0];
	  echo "<tr><td>Female</td><td>".$dtt2[0]."</td><td>".$dtt3[0]."</td><td>".$mp."</td><td>".$ff."</td><td>".$fmp."</td></tr>";
	  echo "</table><br>";	
	  }
	  
	  echo "<h4>Merit List (Above 7.75 CGPA)</h4><br>";
	  echo "<table><tr><th>Rank</th><th>Seat Number</th><th>Student Name</th><th>GPA</th></tr>";
	  $mtl=mysqli_query($conn,"SELECT seat_no,name,gpa FROM `sem_3to6` WHERE ex_rv='R' AND sem=$i AND rkp=1 AND branch='$D' AND ((ex_yr=$Y AND ex_pr=2) OR (ex_yr=$Y AND ex_pr=1) ) AND gpa>=7.75 ORDER BY gpa DESC ;");
	  $o=1;
	  while($resl=mysqli_fetch_row($mtl)){
		echo "<tr><td>".$o."</td><td>".$resl[0]."</td><td>".$resl[1]."</td><td>".$resl[2]."</td></tr>";
        $o=$o+1;		
	  }
	  echo "</table><br>";
	  
	  }
	  else{
		  echo '<script type="text/javascript">'; 
		 echo 'alert("Sorry NO Course Data available");';
		 echo '</script>';
	  }	  
			 
				 }}
	  
	  
	  unset($dt);
	  unset($data1);
	  unset($data2);
	  unset($data3);
	  unset($data4);
	  unset($data5);}}
	  else{
		  echo '<script type="text/javascript">'; 
		 echo 'alert("Sorry NO Data available");';
		 echo '</script>';
	  }
  }
?>