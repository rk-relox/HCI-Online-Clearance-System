<?php

    include_once("connection.php");

    connection();

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "clearance_db";

    $con = new mysqli($host, $username, $password, $database);

    if ($con->connect_error) {
      echo $con->connect_error;
    }
 ?>