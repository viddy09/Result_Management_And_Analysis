<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>DMCE</title>
	</head>
<style>
 table,tr, td{cell-spacing:3px;}
 th{text-align:center;
    margin:5px;}
 input[type=text]{width:100%;
 padding: 4px 5px;}
</style>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
function add_row()
{
 $rowno=$("#course_info tr").length;
 $rowno=$rowno+1;
 $("#course_info tr:last").after("<tr id='row"+$rowno+"'><td><input type='text' name='Course_ID[]' ></td><td><input type='text' name='Course_name[]' ></td><td><input type='text' name='TH_M[]' ></td><td><input type='text' name='IA_M[]' ></td><td><input type='text' name='TH_C[]' ></td><td><input type='text' name='TW_M[]' ></td><td><input type='text' name='P_M[]'></td><td><input type='text' name='O_M[]'></td><td><input type='text' name='PO_C[]' ></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"');></td></tr>");
}
function delete_row(rowno)
{
 $('#'+rowno).remove();
}
</script>

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
                <a class="nav-link active" aria-current="page" href="analysis.php">Main Home</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="course.php">Course Schema</a>
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
      </nav> <br><br>
	  <H2 style="text-align:center;">Add Course Schema</H2>
<div>
 <form method="post" action="add.php">
      <p><b>Note: Keep Empty If Not Applicable</b></p>
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
	   <select name="Sch" required>
	      <option value="" disabled selected>Select an Grade System...</option>
			  <option value="CBCGS">CBCGS</option>
			  <option value="CBSGS">CBSGS</option>
       </select>			  
  <div>	  
<table id="course_info" width="100%">
   <br>
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
  </tr>   
<tr id="row1">
  <td><input type="text" name="Course_ID[]"  required></td>
  <td><input type="text" name="Course_name[]"  required></td>
  <td><input type="text" name="TH_M[]" ></td>
	<td><input type="text" name="IA_M[]" ></td>
	<td><input type="text" name="TH_C[]" ></td>
	<td><input type="text" name="TW_M[]" ></td>
	<td><input type="text" name="P_M[]" ></td>
	<td><input type="text" name="O_M[]" ></td>
	<td><input type="text" name="PO_C[]" ></td>
</tr>
</table>
  <br>
  <div>
  <input type="button" onclick="add_row();" value="ADD ROW">
  <input type="submit" name="submit_row" value="SUBMIT">
 </form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit_row']))
{
	if (empty($_POST["Sem"]) || empty($_POST["Department"])){
		    if (empty($_POST["Sem"]))
			 { echo "Please select the SEMESTER.." ; }
			else
			 { echo "Please select the DEPARTMENT.." ;}
	}
		 else {
 $conn = mysqli_connect("localhost", "root", "","result_analysis");	 
 $S=$_POST["Sem"];
 $D=$_POST["Department"];
 $C=$_POST['Course_ID'];
 $CN=$_POST['Course_name'];
 $THM=$_POST['TH_M'];
 $IAM=$_POST['IA_M'];
 $THC=$_POST['TH_C'];
 $TWM=$_POST['TW_M'];
 $P=$_POST['P_M'];
 $O=$_POST['O_M'];
 $POC=$_POST['PO_C'];
 $GS=$_POST['Sch'];
 $dt=date("Y-m-d");
 $j=1;
 $k=-1;
 for($i=0;$i<count($C);$i++)
 { 
  if ((($THM[$i]!="" && $THM[$i]!="0") && ($THC[$i]!="" && $THC[$i]!="0")) || ($THM[$i]=="" && $THC[$i]=="")){
		 if (((($P[$i]!="" && $P[$i]!="0" && $O[$i] =="" ) || ($O[$i]!="" && $O[$i]!="0" && $P[$i]=="") || ($TWM[$i]!="" && $TWM[$i]!="0" && $P[$i]=="" && $O[$i]=="")) && ($POC[$i]!='' && $POC[$i]!='0')) || ($P[$i]=="" && $O[$i]=="" && $POC[$i]=="")){
   $THM[$i] = !empty($THM[$i]) ? "'$THM[$i]'" : "NULL";
   $IAM[$i] = !empty($IAM[$i]) ? "'$IAM[$i]'" : "NULL";
   $THC[$i] = !empty($THC[$i]) ? "'$THC[$i]'" : "NULL";
   $TWM[$i] = !empty($TWM[$i]) ? "'$TWM[$i]'" : "NULL";
   $P[$i] = !empty($P[$i]) ? "'$P[$i]'" : "NULL";
   $O[$i] = !empty($O[$i]) ? "'$O[$i]'" : "NULL";
   $POC[$i] = !empty($POC[$i]) ? "'$POC[$i]'" : "NULL";
   mysqli_query($conn,"INSERT into course_info values('$C[$i]','$CN[$i]',$THM[$i],$IAM[$i],$THC[$i],$TWM[$i],$P[$i],$O[$i],$POC[$i],$i+1,'$GS','$S','$D','$dt');");
   $k=$k+1; 
 }
  else{
	  echo nl2br("\nRow :".($i+$j)." i.e. ".$C[$i]." Please enter the valid Marks1 Scheme");
   }
 }
 else{
	  echo nl2br("\nRow :".($i+$j)." i.e. ".$C[$i]." Please enter the valid Marks Scheme");
   }
 }
  if($k!=-1){
	  echo '<script>alert("'.($k+$j).' Records are inserted Successfully");</script>';
 }
}
}
?>
