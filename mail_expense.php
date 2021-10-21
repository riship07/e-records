<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid'])==0) {
  header('location:logout.php');
  } else{
      $date=date("d");
      if($date=='01'){
          
      }
    }