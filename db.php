<?php
$conn = new mysqli("localhost", "root", "", "voting_system");
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>