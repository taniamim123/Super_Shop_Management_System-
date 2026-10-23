<?php

include 'db.php';

$name = $_POST['name'];

$category = $_POST['category'];

$price = $_POST['price'];

$stock = $_POST['stock'];

$expiry_date = $_POST['expiry_date'];

$sql = "INSERT INTO products
(name,category,price,stock,expiry_date)

VALUES
('$name','$category',
'$price','$stock','$expiry_date')";

mysqli_query($conn,$sql);

header("Location: ../inventory.php");

?>