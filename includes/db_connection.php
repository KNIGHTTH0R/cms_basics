<?php
  // 1. Create a database connection
define("DB_SERVER","localhost");
define("DB_PASS","root");
define("DB_NAME","leoSoft");
define("DB_USER","root");


$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Test if connection occurred.

if(mysqli_connect_errno()) {
    echo "connection succesfull" & die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }

?>