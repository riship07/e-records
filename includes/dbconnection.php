<?php
$con=mysqli_connect("mysql8", "devuser", "devpass", "test_db");

if(mysqli_connect_error()){
  echo "Connection Fail".mysqli_connect_error();
}

  ?>