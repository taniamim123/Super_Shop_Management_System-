<?php

include 'php/db.php';

$newpassword = $_POST['newpassword'];

mysqli_query($conn,

"UPDATE admin
SET password='$newpassword'
WHERE id='1'");

echo "Password Changed";

?>