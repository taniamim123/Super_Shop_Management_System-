<?php

include 'db.php';

/* FORM DATA */

$invoice_no =
$_POST['invoice_no'];

$customer_name =
$_POST['customer_name'];

$customer_phone =
$_POST['customer_phone'];

$medicine_name =
$_POST['medicine_name'];

$price =
$_POST['price'];

$quantity =
$_POST['quantity'];

$total =
$_POST['total'];

/* CHECK PRODUCT */

$check =
mysqli_query($conn,

"SELECT * FROM products
WHERE name='$medicine_name'"

);

$product =
mysqli_fetch_assoc($check);

$current_stock =
$product['stock'];

/* VALIDATE STOCK */

if($quantity > $current_stock){

    echo "

    <script>

    alert('Not Enough Stock');

    window.location='../billing.php';

    </script>

    ";

    exit();
}

/* SAVE BILL */

$sql = "INSERT INTO sales

(invoice_no,
customer_name,
medicine_name,
quantity,
price,
total)

VALUES

('$invoice_no',
'$customer_name',
'$medicine_name',
'$quantity',
'$price',
'$total')";

mysqli_query($conn,$sql);

/* UPDATE STOCK */

$new_stock =
$current_stock - $quantity;

mysqli_query($conn,

"UPDATE products

SET stock='$new_stock'

WHERE name='$medicine_name'"

);

/* CHECK CUSTOMER */

$customerCheck =
mysqli_query($conn,

"SELECT * FROM customers
WHERE phone='$customer_phone'"

);

/* AUTO ADD CUSTOMER */

if(mysqli_num_rows($customerCheck)
== 0){

    mysqli_query($conn,

    "INSERT INTO customers
    (name,phone)

    VALUES

    ('$customer_name',
    '$customer_phone')"

    );
}

/* SUCCESS */

echo "

<script>

alert('Bill Generated Successfully');

window.location='../billing.php';

</script>

";

?>