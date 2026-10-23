<?php
session_start();

include 'php/db.php';

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    exit();
}

$invoice =
"INV-" . rand(1000,9999);
?>

<!DOCTYPE html>
<html>

<head>

    <title>
        Billing System
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
            🧾 Billing System
        </h1>

        <p>
            Generate medicine invoices quickly
        </p>

    </div>

    <!-- BILLING BOX -->

    <div class="billing-container">

        <!-- LEFT SIDE -->

        <div class="billing-form">

            <h2>
                💊 Create Invoice
            </h2>

            <form
            action="php/save_bill.php"
            method="POST">

                <input
                type="hidden"
                name="invoice_no"
                value="<?php echo $invoice; ?>">

                <!-- CUSTOMER -->

                <div class="grid">

                    <input
                    type="text"
                    name="customer_name"
                    placeholder="Customer Name"
                    required>

                    <input
                    type="text"
                    name="customer_phone"
                    placeholder="Customer Phone"
                    required>

                </div>

                <!-- MEDICINE -->

                <label>
                    Select Medicine
                </label>

                <select
                name="medicine_name"
                id="medicine"
                required>

                    <option value="">
                        Choose Medicine
                    </option>

                    <?php

                    $query =
                    mysqli_query($conn,

                    "SELECT * FROM products"

                    );

                    while($row =
                    mysqli_fetch_assoc($query)){

                    ?>

                    <option

                    value="<?php echo $row['name']; ?>"

                    data-price="<?php echo $row['price']; ?>"

                    data-stock="<?php echo $row['stock']; ?>">

                    <?php echo $row['name']; ?>

                    (Stock:
                    <?php echo $row['stock']; ?>)

                    </option>

                    <?php } ?>

                </select>

                <!-- BILL DETAILS -->

                <div class="grid">

                    <input
                    type="number"
                    id="price"
                    name="price"
                    placeholder="Price"
                    readonly>

                    <input
                    type="number"
                    id="available_stock"
                    placeholder="Available Stock"
                    readonly>

                    <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    placeholder="Quantity"
                    required>

                    <input
                    type="number"
                    id="total"
                    name="total"
                    placeholder="Total"
                    readonly>

                </div>

                <button type="submit">

                    Generate Bill

                </button>

            </form>

        </div>

        <!-- RIGHT SIDE -->

        <div class="invoice-preview">

            <h2>
                🧾 Invoice Preview
            </h2>

            <div class="invoice-card">

                <p>
                    <strong>Invoice:</strong>
                    <?php echo $invoice; ?>
                </p>

                <p>
                    <strong>Date:</strong>

                    <?php
                    echo date("d M Y");
                    ?>
                </p>

                <hr>

                <div class="preview-row">

                    <span>Medicine</span>

                    <span id="previewMedicine">
                        --
                    </span>

                </div>

                <div class="preview-row">

                    <span>Quantity</span>

                    <span id="previewQty">
                        --
                    </span>

                </div>

                <div class="preview-row">

                    <span>Price</span>

                    <span id="previewPrice">
                        --
                    </span>

                </div>

                <hr>

                <div class="preview-total">

                    <span>Total</span>

                    <span id="previewTotal">
                        ৳0
                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- RECENT SALES -->

    <div class="table-box">

        <h2>
            📜 Recent Bills
        </h2>

        <table>

            <tr>

                <th>Invoice</th>
                <th>Customer</th>
                <th>Medicine</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date</th>

            </tr>

            <?php

            $sales =
            mysqli_query($conn,

            "SELECT * FROM sales
            ORDER BY id DESC
            LIMIT 5"

            );

            while($bill =
            mysqli_fetch_assoc($sales)){

            ?>

            <tr>

                <td>
                    <?php echo $bill['invoice_no']; ?>
                </td>

                <td>
                    <?php echo $bill['customer_name']; ?>
                </td>

                <td>
                    <?php echo $bill['medicine_name']; ?>
                </td>

                <td>
                    <?php echo $bill['quantity']; ?>
                </td>

                <td>
                    ৳ <?php echo $bill['total']; ?>
                </td>

                <td>
                    <?php echo $bill['billing_date']; ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<!-- SCRIPT -->

<script>

let medicine =
document.getElementById('medicine');

let quantity =
document.getElementById('quantity');

let price =
document.getElementById('price');

let stock =
document.getElementById(
'available_stock');

let total =
document.getElementById('total');

/* PREVIEW */

let previewMedicine =
document.getElementById(
'previewMedicine');

let previewQty =
document.getElementById(
'previewQty');

let previewPrice =
document.getElementById(
'previewPrice');

let previewTotal =
document.getElementById(
'previewTotal');

/* MEDICINE CHANGE */

medicine.addEventListener(
'change',

function(){

    let selected =
    medicine.options[
    medicine.selectedIndex];

    let medicinePrice =
    selected.getAttribute(
    'data-price');

    let medicineStock =
    selected.getAttribute(
    'data-stock');

    price.value =
    medicinePrice;

    stock.value =
    medicineStock;

    previewMedicine.innerHTML =
    medicine.value;

    previewPrice.innerHTML =
    "৳ " + medicinePrice;

    calculateTotal();
});

/* QUANTITY */

quantity.addEventListener(
'keyup',
calculateTotal);

/* TOTAL */

function calculateTotal(){

    let p =
    parseFloat(price.value) || 0;

    let q =
    parseFloat(quantity.value) || 0;

    let s =
    parseFloat(stock.value) || 0;

    if(q > s){

        alert(
        'Not Enough Stock!'
        );

        quantity.value = '';

        total.value = '';

        return;
    }

    let finalTotal = p * q;

    total.value = finalTotal;

    previewQty.innerHTML =
    q;

    previewTotal.innerHTML =
    "৳ " + finalTotal;
}

</script>

</body>
</html>