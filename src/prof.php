<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>Dmce &copy;</title>
<style>
 table,tr,td{cell-spacing:3px;}
 th{text-align:center;
    margin:5px;}
 input[type=text],select{width:100%;
 padding: 4px 5px;}
</style>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
function add_row()
{
 $rowno=$("#prof_info tr").length;
 $rowno=$rowno+1;
 $("#prof_info tr:last").after("<tr id='row"+$rowno+"'><td><input type='text' name='P_N[]'></td><td><input type='text' name='C_ID[]' ></td><td><select name='D[]' required><option value='' disabled selected>Select an Division...</option><option value='A'>A</option><option value='B'>B</option><option value='A&B'>A & B</option></select></td><td><select name='S[]' required><option value='' disabled selected>Select a SEM...</option><option value='1'>SEM I</option><option value='2'>SEM II</option><option value='3'>SEM III</option><option value='4'>SEM IV</option><option value='5'>SEM V</option><option value='6'>SEM VI</option><option value='7'>SEM VII</option><option value='8'>SEM VIII</option></select></td><td><select name='Dep[]' required><option value='' disabled selected>Select a Department...</option><option value='COMPUTER'>COMPUTER</option><option value='CHEMICAL'>CHEMICAL</option><option value='MECHANICAL'>MECHANICAL</option><option value='CIVIL'>CIVIL</option><option value='ELECTRONICS'>ELECTRONICS</option></select></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
}
function delete_row(rowno)
{
 $('#'+rowno).remove();
}
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
	  <H2 style="text-align:center;">Add Professor Here</H2><br>
 <form method="post" action="prof.php">
	  <table style="width:100%" id="prof_info">
	  <tr>
		 <th><b>Professor Name</b></th>
		 <th><b>Course_ID</b></th>
		 <th><b>Division</b></th>
		 <th><b>Sem</b></th>
		 <th><b>Branch</b></th>
		 
      </tr>
	  <tr>
	  <td><input type="text" name="P_N[]"  required></td>
	  <td><input type="text" name="C_ID[]" required></td>
	  <td><select name="D[]" required>
	  <option value="" disabled selected>Select an Division...</option>
			  <option value="A">A</option>
			  <option value="B">B</option>
			  <option value="A&B">A & B</option></select></td>
	  <td><select name="S[]" required>
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
	  <td><select name="Dep[]" required>
	          <option value="" disabled selected>Select a Department...</option>
			  <option value="COMPUTER">COMPUTER</option>
			  <option value="CHEMICAL">CHEMICAL</option>
			  <option value="MECHANICAL">MECHANICAL</option>
			  <option value="CIVIL">CIVIL</option>
			  <option value="ELECTRONICS">ELECTRONICS</option>
	   </select></td>
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
<?PHP
/*<td><select name='D[]'><option value='' disabled selected>Select an Division...</option><option value='A'>A</option><option value='B'>B</option></select></td><td><select name='S[]'><option value='' disabled selected>Select a SEM...</option><option value='1'>SEM I</option><option value='2'>SEM II</option><option value='3'>SEM III</option><option value='4'>SEM IV</option><option value='5'>SEM V</option><option value='6'>SEM VI</option><option value='7'>SEM VII</option><option value='8'>SEM VIII</option></select></td><td><select name='Dep[]'><option value='' disabled selected>Select a Department...</option><option value='COMPUTER'>COMPUTER</option><option value='CHEMICAL'>CHEMICAL</option><option value='MECHANICAL'>MECHANICAL</option><option value='CIVIL'>CIVIL</option><option value='ELECTRONICS'>ELECTRONICS</option></select></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
}*/
if(isset($_POST['submit_row']))
{
 $PN=$_POST['P_N'];
 $CID=$_POST['C_ID'];
 $D=$_POST['D'];
 $S=$_POST['S'];
 $DEP=$_POST['Dep'];
 $k=-1;
 $j=1;
 $conn = mysqli_connect("localhost", "root", "","result_analysis");	 
 for($i=0;$i<count($PN);$i++)
 {
   mysqli_query($conn,"INSERT into prof_tb2 values('$PN[$i]','$CID[$i]','$D[$i]',$S[$i],'$DEP[$i]');");
   $k=$k+1;  
 }
 if($k!=-1){
	  echo '<script>alert("'.($k+$j).' Records are inserted Successfully");</script>';
 }
}
?>