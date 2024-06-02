<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>DMCE</title>
	</head>
   <style>
   </style>
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
                <a class="nav-link active" aria-current="page" href="add.php">Add Course</a>
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
	  </div>
	  <H2 style="text-align:center;">Course Schema</H2>
	  <br>
	  <form action="Course.php" method="POST">
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
	</BODY>
</HTML>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST" || $_GET ){
	   if (empty($_POST["Sem"]) && empty($_POST["Department"]) && count($_GET)==0){
		    if (empty($_POST["Sem"]))
			 { echo "Please select the SEMESTER.." ; }
			else
			 { echo "Please select the DEPARTMENT.." ;}
	  }
	   else{
		$host    = "localhost";
		$user    = "root";
		$pass    = "";
		$db_name = "result_analysis";
		$connection = mysqli_connect($host, $user, $pass, $db_name);
        if(mysqli_connect_errno()){
			die("connection failed: "
				. mysqli_connect_error()
				. " (" . mysqli_connect_errno()
				. ")");
		   }
		
        error_reporting(E_ERROR | E_PARSE);
		if ( ($_POST["Sem"] && empty($_POST["Department"])) || ($_POST["Department"] && empty($_POST["Sem"])) ){
			if ($_POST["Sem"] && empty($_POST["Department"])){
		       $s=$_POST["Sem"];
               $result = mysqli_query($connection,"SELECT * FROM course_info where SEM='$s'");}
		    else{
			   $d=$_POST["Department"];
		$result = mysqli_query($connection,"SELECT * FROM course_info where BRANCH='$d'");}}
        if ($_POST["Sem"] && ($_POST["Department"])){
			$s=$_POST["Sem"];
			$d=$_POST["Department"];
            $result = mysqli_query($connection,"SELECT * FROM course_info where SEM='$s' && BRANCH='$d'");
		}
        if ($_GET['Sem'] || $_GET['Department']){
           $s=$_GET['Sem'];
           $d=$_GET['Department'];
           $result = mysqli_query($connection,"SELECT * FROM course_info where SEM='$s' && BRANCH='$d'");
		}		   
        $all_property = array();
        echo '<table  style="text-align:center;width:100%;border: 4px solid #ddd;">
        <tr  style="background-color:DBEAED;border: 1px solid #ddd;padding: 4px;">';  //initialize table tag
			while ($property = mysqli_fetch_field($result)) {
				echo '<td><b>' . $property->name . '</b></td>';  //get field name for header
				array_push($all_property, $property->name);  //save those to array
			}
			echo '<td><b>Delete</b></td>';
			echo '<td><b>Edit</b></td>';
			echo '</tr>'; //end tr tag

//showing all data
			while ($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				foreach ($all_property as $item) {
					echo '<td>' . $row[$item] . '</td>'; //get items using property value
				}
				echo "<td><a href='delete.php?id=".$row['C_ID']."'>Delete</a></td>";
                echo "<td><a href='Edit.php?id=".$row['C_ID']."'>Edit</a></td>";
				echo '</tr>'; 
			}
			echo "</table>";	
	   }
   }
  
	   
?>