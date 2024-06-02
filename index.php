<?php
   error_reporting(E_ERROR);
   if ($_POST['role']=="faculty"){
   include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $error="";
      $sid = $_POST["sid"];
      $password = mysqli_real_escape_string($db,$_POST['Password']); 
	 
      $result = mysqli_query($db,"SELECT `Prof_Name` FROM prof_tb1 WHERE `prof_iD`='$sid' and Password='$password';");
      $sname=mysqli_fetch_row($result);
      
      $count = mysqli_num_rows($result);
      
		
      if($count == 1) {
         $_SESSION['login_user'] = $sid;
         
         header("location: analysis.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
   }
else{
	include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $error="";
      $sid = $_POST["sid"];
      $password = mysqli_real_escape_string($db,$_POST['Password']); 
	 
      $result = mysqli_query($db,"SELECT `Candidate_Name` FROM logindata WHERE `GR.NO`='$sid' and DOB='$password';");
      $sname=mysqli_fetch_row($result);
      
      $count = mysqli_num_rows($result);
	  if($count == 1) {
         $_SESSION['login_user'] = $sid;
         
         header("location: student.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
}
}
?>
   
   
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>DMCE &copy;</title>
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
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>              
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
	  <div class="container"><br><br>
      <form action=" " method="post">
        <div class="container"><br><br>
           <label><b>Login Here<b></label><br><br>
		    <div class="mb-3">
         <label for="role" class="form-label">ROLE</label>
         <select class="form-control" aria-label="role" name="role" >
		 <option value="" disabled selected>Select a role...</option> 
		 <option value="student">STUDENT</option>
		 <option value="faculty">FACULTY</option>
		 </select>
       </div>
       <div class="mb-3">
         <label for="sid" class="form-label">USER ID</label>
         <input type="text" class="form-control" placeholder="USER ID" aria-label="sid" name="sid" >
       </div>
       <div class="mb-3">
         <label for="Password1" class="form-label">Password</label>
         <input type="password" class="form-control" placeholder="DOB:dd/mm/yyyy" aria-label="Password" name="Password">
       </div>
       <div class="mb-3 form-check">
         <input type="checkbox" class="form-check-input" id="exampleCheck1">
         <label class="form-check-label" for="form-check">Remember me</label>
       </div>
       <input type="submit" class="btn btn-primary" value="Submit" />
   </form><br><br>
                  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php if(isset($error)){echo $error;}	  else{echo "";}?></div>
				  </div>
      <div class="container">
      <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="1.jpeg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="2.jpeg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="3.jpeg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div><br><br>
    <footer class="container">
        <p> &copy; 2020-2021 RMAS-DMCE &#8482, INC / <a href="#">Privacy</a> / <a href="contact.html">Contact Us</a></p>
    </footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>

