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
        Inventory Management
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

<!-- MAIN -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <h1>
            📦 Inventory Management
        </h1>

        <p>
            Manage medicine stock efficiently
        </p>

    </div>

    <!-- INVENTORY STATS -->

    <div class="card-container">

        <?php

        $total =
        mysqli_query($conn,

        "SELECT COUNT(*) AS totalmedicine
        FROM products"

        );

        $totalData =
        mysqli_fetch_assoc($total);

        $low =
        mysqli_query($conn,

        "SELECT COUNT(*) AS lowstock
        FROM products
        WHERE stock < 10"

        );

        $lowData =
        mysqli_fetch_assoc($low);

        ?>

        <div class="dashboard-card">

            <h2>
                💊 Total Medicines
            </h2>

            <h1>
                <?php
                echo $totalData['totalmedicine'];
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

    <!-- ADD MEDICINE -->

    <div class="form-box">

        <h2>
            ➕ Add New Medicine
        </h2>

        <form
        action="php/add_inventory.php"
        method="POST">

            <div class="grid">

                <input
                type="text"
                name="name"
                placeholder="Medicine Name"
                required>

                <input
                type="text"
                name="category"
                placeholder="Category"
                required>

                <input
                type="number"
                name="price"
                placeholder="Price"
                required>

                <input
                type="number"
                name="stock"
                placeholder="Stock"
                required>

                <input
                type="date"
                name="expiry_date"
                required>

            </div>

            <button type="submit">

                Add Medicine

            </button>

        </form>

    </div>

    <!-- SEARCH -->

    <div class="search-box">

        <input
        type="text"
        id="searchInput"
        placeholder="🔎 Search Medicine..."
        onkeyup="searchMedicine()">

    </div>

    <!-- INVENTORY TABLE -->

    <div class="table-box">

        <table id="medicineTable">

            <tr>

                <th>ID</th>
                <th>Medicine</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Expiry</th>
                <th>Status</th>
                <th>Update</th>
                <th>Delete</th>

            </tr>

            <?php

            $query =
            mysqli_query($conn,

            "SELECT * FROM products
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
                    <?php echo $row['category']; ?>
                </td>

                <td>
                    ৳ <?php echo $row['price']; ?>
                </td>

                <td>
                    <?php echo $row['stock']; ?>
                </td>

                <td>
                    <?php echo $row['expiry_date']; ?>
                </td>

                <td>

                    <?php

                    if($row['stock'] < 10){

                        echo "
                        <span class='low-stock'>
                        Low Stock
                        </span>
                        ";

                    }else{

                        echo "
                        <span class='in-stock'>
                        In Stock
                        </span>
                        ";
                    }

                    ?>

                </td>

                <td>

                    <form
                    action='php/update_stock.php'
                    method='POST'
                    class='stock-form'>

                        <input
                        type='hidden'
                        name='id'
                        value='<?php echo $row['id']; ?>'>

                        <input
                        type='number'
                        name='new_stock'
                        placeholder='Qty'
                        required>

                        <button type='submit'>

                            Update

                        </button>

                    </form>

                </td>

                <td>

                    <a
                    class='delete-btn'
                    href='php/delete_product.php?id=<?php echo $row['id']; ?>'>

                    Delete

                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<!-- SEARCH SCRIPT -->

<script>

function searchMedicine(){

    let input =

    document.getElementById(
    'searchInput')

    .value.toLowerCase();

    let table =

    document.getElementById(
    'medicineTable');

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