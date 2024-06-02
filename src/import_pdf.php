<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>Dmce &copy;</title></head>
	<style>
	   input [type=number]  {
	   width: 80%;
	   }
	   input [type=file]  {
       float:center;	   
	   }
	   input [type=submit]  {
         float:center; 
	   }
   table {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
	cell-padding: 1px;
     }
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
                <a class="nav-link" href="Course.php">Course_Schema</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="analysis.php">Main</a>
              </li>
            </ul>
          </div>
        </div>
    </nav><br>
	<H4 style="text-align:center;">IMPORT TO Data-Base</H4><br>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
<table>
	<tr>
	 <td>
        <p> Select File: <input type="file" name="PDF" accept=".pdf"><Label>(only .pdf)</Label></td></tr><tr><td>
		
		<label> BRANCH : 	
		<select name="Department" required>
	          <option value="" disabled selected>Select a Department...</option>
			  <option value="COMPUTER">COMPUTER</option>
			  <option value="CHEMICAL">CHEMICAL</option>
			  <option value="MECHANICAL">MECHANICAL</option>
			  <option value="CIVIL">CIVIL</option>
			  <option value="ELECTRONICS">ELECTRONICS</option>
			  <option value="IT">INFORMATION TECHNOLOGY</option>
		</select></label></td><td>
    	<label> SEM : 	
		<select name='SEM' required >
		    <option value="" disabled selected>Select a Sem...</option>
			<option value=1>SEM 1</option>
			<option value=2>SEM 2</option>
			<option value=3>SEM 3</option>
			<option value=4>SEM 4</option>
			<option value=5>SEM 5</option>
			<option value=6>SEM 6</option>
			<option value=7>SEM 7</option>
			<option value=8>SEM 8</option>
		</select></label></td><td>
		<label> EX_YR :	
    <input type="number" name="YEAR" placeholder="YYYY" pattern="$([0-9]{4})^" required></label></td><td>
	<label>EX_PR :
	<select name='ex_pr' required>
			<option value=1>1</option>
			<option value=2>2</option>
	</select></label></td><td>
	<label>EX_RV :
	<select name='ex_rv' required>
			<option value="R">R</option>
			<option value="V">V</option>
	</select></label></td><td>
	<label>YR :
	<select name='yr' required>
			<option value="FE">FE</option>
			<option value="SE">SE</option>
			<option value="TE">TE</option>
			<option value="BE">BE</option>
	</select></label></td><td>
	<label> RKP :
	<input type="number" name="RKP"  pattern="$([0-9]{1,})^" required></label></td></tr><tr><td>
	<label> SCHEME_ver :
	<input type="text" name="schemever" placeholder="EX:R-2016" pattern="([A-Z]{1}[\-]{1}[0-9]{4})" required></label></td><td>
	<label> GZT_ST  :
	<input type="number" name="gz" placeholder="" pattern="$([0-9]{1,})^" required></label></td><td>
	<label> Length of Seat_Num :	
    <input type="number" name="Seat_Num" pattern="$([0-9]{1,20})^" required></label></td><td>
	<label> GDS :
	<select name='GDS' required>
			<option value="CBCGS">CBCGS</option>
			<option value="CBSGS">CBSGS</option>
	</select></label></td></tr><tr><td><br>
	<input type="submit" value="Export File" background-color="RED">
	 </td>
	</tr>
</table>
	</div>
</body>
</html>