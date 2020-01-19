<?php

$conn = new mysqli('localhost', 'root', '', 'pickmeup');
if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: (' . $conn->connect_errno . ') ' . $mysqli->connect_error;
}
?>
