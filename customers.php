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
        Customer Management
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

<!-- MAIN CONTENT -->

<div class="main">

    <div class="topbar">

        <h1>
            👤 Customer Management
        </h1>

        <p>
            View all pharmacy customers
        </p>

    </div>

    <!-- SEARCH -->

    <div class="table-box">

        <input
        type="text"
        id="searchInput"
        placeholder="🔎 Search Customer..."
        onkeyup="searchCustomer()">

        <br><br>

        <!-- CUSTOMER TABLE -->

        <table id="customerTable">

            <tr>

                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>

            </tr>

            <?php

            $query = mysqli_query($conn,

            "SELECT * FROM customers
            ORDER BY id DESC"

            );

            while($row =
            mysqli_fetch_assoc($query)){

            ?>

            <tr>

                <td>
                    <?php echo $row['id']; ?>
                </td>

                <td>
                    <?php echo $row['name']; ?>
                </td>

                <td>
                    <?php echo $row['phone']; ?>
                </td>

                <td>

                    <?php

                    if(empty($row['address'])){

                        echo "N/A";

                    }else{

                        echo $row['address'];
                    }

                    ?>

                </td>

                <td>
                    <?php echo $row['created_at']; ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<!-- SEARCH SCRIPT -->

<script>

function searchCustomer(){

    let input =

    document.getElementById(
    'searchInput')

    .value.toLowerCase();

    let table =

    document.getElementById(
    'customerTable');

    let tr =
    table.getElementsByTagName('tr');

    for(let i = 1; i < tr.length; i++){

        let td =
        tr[i].getElementsByTagName('td')[1];

        if(td){

            let txtValue =

            td.textContent ||
            td.innerText;

            if(txtValue.toLowerCase()
            .indexOf(input) > -1){

                tr[i].style.display = '';

            }else{

                tr[i].style.display = 'none';
            }
        }
    }
}

</script>

</body>
</html>