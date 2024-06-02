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
	 width: 100%;}
  .container { 
  height: 200px;
  position: relative;
  border: 3px solid green; }
  .center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);}
</style>
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
          </div>
        </div>
</nav><br>
	  <H4 style="text-align:center;">IMPORT TO Data-Base</H4><br>
    <form action="import_xlsx.php" method="POST" enctype="multipart/form-data">
  <div class="container">
    <div class="center">
     <p>Choose File:</p> <input type="file" name="XLS" accept=".xlsx,.csv"><label>(accept .xlsx,.csv)</label>
     <input type="submit" value="Export File" background-color="RED"><br>
	 </div>
	</div>
</form>
</div>
</body>
</html>
<?php
  error_reporting(E_ERROR| E_PARSE);
  if (isset($_FILES['XLS'])){
  $file=$_FILES['XLS'];
  if (filesize($file['tmp_name'])){
	  move_uploaded_file($file['tmp_name'],"file/"."1T00727.xlsx");
      $command = escapeshellcmd("python EXTRACTION_CSV.py");
  shell_exec($command);}}
?>