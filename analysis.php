<?php
include("session.php");
error_reporting(E_ERROR);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>DMCE</title>
	<style>
	.search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
	</style>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
		$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());

		window.location="student_search.php?id="+$(this).text();
				
		
    });
});
</script>
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
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Faculty
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="prof.php">Add Faculty</a></li>
                <li><a class="dropdown-item" href="prof1.php">Faculty Details</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  course
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="Course.php">Course Schema</a></li>
                  <li><a class="dropdown-item" href="add.php">Add Course</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="import.php">Import Data</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
			<div class="search-box">
        <input type="text" autocomplete="off" placeholder="Enter Student Name..." />
        <div class="result"></div>
			</div>
			<li class="nav-item">
      <a href="logout.php" class="btn btn-danger" role="button" button type="button">Sign Out</a>
			</li>
          </div>
        </div>
      </nav>
   <div class="cointainer my-4">
        <div class="row mb-2">
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-danger">Import</strong>
                  <h3 class="mb-0">File Can Be Import Using Following Link</h3>
                  <p class="card-text mb-auto">This Option Is Useful To Import & Convert Pdf As Well As Excel File In To Text Format That Can Store In Data-Base.</p>
                  <a href="import.php" class="stretched-link">Click Here for File Import</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img class="bd-placeholder-img" width="200" height="250" src="4.jpeg" alt="">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-danger">Export</strong>
                  <h3 class="mb-0">File Can Be Exported Using Following Link</h3>
                  <p class="mb-auto">This Option Is Useful For Export Data From Data-Base As Per Our Requirement With Some Of Useful And Required Data.</p>
                  <a href="Exp.php" class="stretched-link">Click Here For File Export</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                  <img class="bd-placeholder-img" width="200" height="250" src="5.jpeg" alt="">
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="cointainer my-4">
        <div class="row mb-2">
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-danger">Analysis</strong>
                  <h3 class="mb-0">Analysis Can Be Done Using Following Link</h3>
                  <p class="card-text mb-auto">This Option Enables To User Analyse Data That Stored In Data-Base As Per Requirement.</p>
                  <a href="Batchwise.php" class="stretched-link">Click Here For Analysis</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img class="bd-placeholder-img" width="200" height="250" src="1.jpeg" alt="">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-danger">Visualization</strong>
                  <h3 class="mb-0">Visualization Can Be Done Using Following Link</h3>
                  <p class="mb-auto">This Option Enables User To Visualize Data By Pi-Charts & H-Bar Visualization Techniques.</p>
                  <a href="visualize.php" class="stretched-link">Click Here For Visualization</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                  <img class="bd-placeholder-img" width="200" height="250" src="2.jpeg" alt="">
                </div>
              </div>
            </div>
          </div>
    </div>
    <footer class="container">
        <p>Copy Rights 2020-2021 RMAS-DMCE, INC / <a href="#">Privacy</a> / <a href="contact.html">Contact Us</a></p>
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