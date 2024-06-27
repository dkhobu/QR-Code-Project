<?php

    $servername = "sql300.infinityfree.com";
    $username = "if0_36585469";
    $password = "cXw3V442b4hlD2h";
    $database = "if0_36585469_majorproject";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>
