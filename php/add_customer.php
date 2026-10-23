<?php

include 'db.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "INSERT INTO customers(name,phone,address)
VALUES('$name','$phone','$address')";

mysqli_query($conn,$sql);

header("Location: ../customers.php");

?>