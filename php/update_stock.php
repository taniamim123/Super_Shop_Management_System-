<?php

include 'db.php';

$id = $_POST['id'];

$new_stock = $_POST['new_stock'];

mysqli_query($conn,

"UPDATE products
SET stock = stock + $new_stock
WHERE id='$id'"

);

header("Location: ../inventory.php");

?>