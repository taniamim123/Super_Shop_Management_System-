<?php
include 'php/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="main-content">

    <h1>Medicine Products</h1>

    <form action="php/add_product.php" method="POST">

        <input type="text" name="name" placeholder="Medicine Name" required>

        <input type="text" name="category" placeholder="Category" required>

        <input type="number" name="price" placeholder="Price" required>

        <input type="number" name="stock" placeholder="Stock" required>

        <input type="date" name="expiry_date" required>

        <button type="submit">Add Product</button>

    </form>

    <br>

    <input type="text" id="searchInput" placeholder="Search Product" onkeyup="searchMedicine()">

    <table id="medicineTable">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>

        <?php

        $query = mysqli_query($conn,"SELECT * FROM products");

        while($row = mysqli_fetch_assoc($query)){
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td>
                <a href="php/delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

<script src="js/app.js"></script>
</body>
</html>