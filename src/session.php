<?php
   include('config.php');
   error_reporting(E_ERROR);
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $sql="select `GR.NO` from logindata where `GR.NO` = '$user_check' ";
   $result = $db -> Query($sql);
   
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
   $login_session = $row['GR.NO'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>