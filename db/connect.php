<?php
$con = new mysqli("localhost", "root", "", "dvn_cellphones");
// Check connection
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
mysqli_set_charset($con, "utf8");
session_start();
