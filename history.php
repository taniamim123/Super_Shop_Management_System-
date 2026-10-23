<?php
session_start();

include 'php/db.php';

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>
        Purchase History
    </title>

    <link
    rel="stylesheet"
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

        💊 Pharmacy

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
                📜 Purchase History
            </a>
        </li>

        <li>
            <a href="logout.php">
                🚪 Logout
            </a>
        </li>

    </ul>

</div>

<!-- MAIN CONTENT -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <h1>
            📜 Purchase History
        </h1>

        <p>
            View all medicine sales records
        </p>

    </div>

    <!-- TABLE -->

    <div class="table-box">

        <button onclick="window.print()">

            🖨 Print Report

        </button>

        <br><br>

        <table id="historyTable">

            <tr>

                <th>Invoice</th>
                <th>Customer</th>
                <th>Medicine</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Date</th>

            </tr>

            <?php

            $query = mysqli_query($conn,

            "SELECT * FROM sales
            ORDER BY id DESC"

            );

            while($row =
            mysqli_fetch_assoc($query)){

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
                    <?php echo $row['quantity']; ?>
                </td>

                <td>
                    ৳ <?php echo $row['price']; ?>
                </td>

                <td>
                    ৳ <?php echo $row['total']; ?>
                </td>

                <td>

                    <?php

                    if(isset($row['billing_date'])){

                        echo $row['billing_date'];

                    }else{

                        echo "No Date";
                    }

                    ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>