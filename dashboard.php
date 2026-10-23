<?php
session_start();

include 'php/db.php';

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
}

/* TOTAL PRODUCTS */

$product =
mysqli_query($conn,
"SELECT COUNT(*) AS totalproducts
FROM products");

$productData =
mysqli_fetch_assoc($product);

/* TOTAL SALES */

$sales =
mysqli_query($conn,
"SELECT SUM(total) AS totalsales
FROM sales");

$salesData =
mysqli_fetch_assoc($sales);

/* LOW STOCK */

$lowstock =
mysqli_query($conn,
"SELECT COUNT(*) AS lowstock
FROM products
WHERE stock < 10");

$lowData =
mysqli_fetch_assoc($lowstock);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Modern Dashboard</title>

    <link rel="stylesheet"
    href="css/style.css">

    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
    rel="stylesheet">

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">

        💊 Sotota  Pharmacy

    </div>

    <ul>

        <li>
            <a href="dashboard.php">
            🏠 Dashboard
            </a>
        </li>

        <li>
            <a href="inventory.php">
            📦 Inventory
            </a>
        </li>

        <li>
            <a href="billing.php">
            🧾 Billing
            </a>
        </li>

        <li>
            <a href="customers.php">
            👤 Customers
            </a>
        </li>

        <li>
            <a href="history.php">
            📜 Sales History
            </a>
        </li>

        <li>
            <a href="logout.php">
            🚪 Logout
            </a>
        </li>

    </ul>

</div>

<!-- MAIN -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <h1>
            Welcome Admin 👋
        </h1>

        <p>
            Pharmacy Management Dashboard
        </p>

    </div>

    <!-- CARDS -->

    <div class="card-container">

        <div class="dashboard-card">

            <h2>
                📦 Products
            </h2>

            <h1>
                <?php
                echo $productData['totalproducts'];
                ?>
            </h1>

        </div>

        <div class="dashboard-card">

            <h2>
                💰 Total Sales
            </h2>

            <h1>
                ৳
                <?php
                echo $salesData['totalsales'];
                ?>
            </h1>

        </div>

        <div class="dashboard-card">

            <h2>
                ⚠ Low Stock
            </h2>

            <h1>
                <?php
                echo $lowData['lowstock'];
                ?>
            </h1>

        </div>

    </div>

    <!-- ALERT -->

    <div class="alert-box">

        ⚠ Medicines below 10 stock need refill.

    </div>

    <!-- RECENT SALES -->

    <div class="table-box">

        <h2>
            Recent Sales
        </h2>

        <table>

            <tr>

                <th>Invoice</th>
                <th>Customer</th>
                <th>Medicine</th>
                <th>Total</th>
                <th>Date</th>

            </tr>

            <?php

            $history =
            mysqli_query($conn,

            "SELECT * FROM sales
            ORDER BY id DESC
            LIMIT 5"

            );

            while($row =
            mysqli_fetch_assoc($history)){

            ?>

            <tr>

                <td>
                    <?php echo $row['invoice_no']; ?>
                </td>

                <td>
                    <?php echo $row['customer_name']; ?>
                </td>

                <td>
                    <?php echo $row['medicine_name']; ?>
                </td>

                <td>
                    ৳ <?php echo $row['total']; ?>
                </td>

                <td>
                    <?php echo $row['billing_date']; ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>