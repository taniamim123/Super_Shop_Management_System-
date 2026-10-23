<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "pharmacy"
);

if(!$conn){
    die("Database Connection Failed");
}

?>