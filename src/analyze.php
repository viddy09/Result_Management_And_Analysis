<?php
$db=mysqli_connect('localhost','root','','result_analysis');
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$sem=$_POST['sem'];
$year=$_POST['year'];
$branch=$_POST['branch'];
$Analysis_o=$_POST['analys'];
$sch=$_POST['sch'];



if(true){
	if($Analysis_o=='COURSE_WISE'){
$command = escapeshellcmd("python ap_analyze.py $sem $branch $year $sch");
shell_exec($command); 
header("Location: bars.html");
}
else
{
 $command = escapeshellcmd("python pie.py $sem $branch $year $sch");
shell_exec($command); 	
header("Location: pie.html");

}
}
else {
  echo '<script>alert("DATA DOESN`T EXIST");</script>' ;
  echo '<script>window.location.href="analysis.php"</script>';
  
     
}
?>