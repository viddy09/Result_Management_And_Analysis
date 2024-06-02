<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>DMCE &copy;&#8482</title>
	</head>
<style>
	body
	{
	margin: 0;
	padding: 0;
	background: url('2.jpeg') no-repeat center fixed;
	background-size: cover;
	font-family: sans-serif;}

	input [type=number]  {
	   width: 100%;
	   }
    input [type=file]  {
       float:center;	   
	   }
	table {
	text-align:center;
	height:60%;
    width: 100%;
	border: 4px solid #ddd;"
    margin-left: auto;
     }
	.loginbox {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			width: 400px;
			height: 450px;
			box-sizing: border-box;
			padding: 70px 40px;
			background: rgba(0, 0, 0, 0.5);
		}
	.loginbox p
	{
		margin: 0;
		padding: 0;
		font-weight: bold;
		color: #fff;
	}
	.loginbox input
	{
		width: 100%;
		margin-bottom: 20px;	
	}
	.loginbox input[type="submit"]
	{
		border: none;
		outline: none;
		height: 40px;
		color: #eee;
		font-size: 16px;
		background-color: #ff8c00;
		cursor: pointer;
			
	}
	.loginbox input[type="submit"]:hower
	{
		background: #ffc107;		
		color: #fff;
	}
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
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
            
			<li class="nav-item">
      <a href="logout.php" class="btn btn-danger" role="button" button type="button">Sign Out</a>
			</li>
          </div>
        </div>
    </div>
	</nav> 
	<div class="loginbox">
<form action="analyze.php" method="POST">
		<p> BRANCH : 	
		<select name='branch' id="">
      <option value="COMPUTER">Computer</option>
      <option value="INFORMATION TECHNOLOGY">IT</option>
      <option value="MECHANICAL">Mech</option>
      <option value="CIVIL">Civil</option>
      <option value="ELECTRONICS">Extc</option>
      <option value="CHEMICAL">Ele</option>
    </select> </p><br>
    	<p> SEMESTER : 	
		<select name='sem'>
			<option value="1">SEM 1</option>
			<option value="2">SEM 2</option>
			<option value="3">SEM 3</option>
			<option value="4">SEM 4</option>
			<option value="5">SEM 5</option>
			<option value="6">SEM 6</option>
			<option value="7">SEM 7</option>
			<option value="8">SEM 8</option>
		</select></p><br>
		<p> SCHEME_VER : 	
		<select name='sch'>
			<option value="R-2016">R-2016</option>
			<option value="R-2020">R-2020</option>
		</select></p><br>	
		<p> YEAR : 
    <select name='year'>
      <option value="2015">2015</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
	  <option value="2021">2021</option>
	  <option value="2022">2022</option>
	  <option value="2023">2023</option>
    </select> </p><br>
			<p> ANALYSIS : 
    <select name='analys'>
    <option value="COURSE_WISE">COURSE-WISE</option>
	<option value="POINTER_WISE">Overall</option>
	</select> </p><br><br>
    <input type="submit" value="Analysis"><br>
	</div>
</body>
</html>
