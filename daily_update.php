<?php

session_start();
include('connect.php');

if (!isset($_SESSION['Admin'])) {
    header("location:admin_login.php");
    exit; // Add exit to prevent further execution
}
include('include/header.php');
?>
<html>
<head>
<link rel="stylesheet" href="admin_panel.css">
<style>
    table,th,td {
        border: 1px solid black;
    }
    tr:hover{
        background-color:grey;

    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }
    button:hover{
        transform: scale(1.02);
    }

</style>
</head>

<body>

<div class="content">
    <div class="product_info">
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['daily_rate'] as $product_id => $daily_rate) {
        $product_id = intval($product_id);
        $daily_rate = !empty($daily_rate) ? floatval($daily_rate) : null;

        // If daily rate is not filled, consider previous data
        if ($daily_rate === null) {
            continue; // Skip to the next product
        }

        // Use proper validation and sanitization before updating the database
        $sql = "UPDATE products SET Product_Price = $daily_rate WHERE Product_Id = $product_id";

        if ($conn->query($sql) !== TRUE) {
            echo "Error updating daily rate: " . $conn->error;
            // Handle the error as needed
        }
    }

    echo '<script> alert ("Rates Updated successfully ..!") ;</script>';
}

$result = $conn->query("SELECT * FROM products");
echo "<h2>Update Daily Products Rates here  </h2>";
echo '<table> <tr>';
echo '<th> Product Name </th>';
echo '<th> Product category </th>';
echo '<th>  Product Previous Price</th> ';
echo '<th>  Product Todays Price</th> </tr>';


if ($result->num_rows > 0) {
    echo "<form method='post'>";
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td>". $row["Product_Name"] . "</td>";
        echo "<td>". $row["Product_Category"] . "</td>";
        echo "<td>" . $row["Product_Price"] . "</td>";

        echo "<td> <input type='number' name='daily_rate[" . $row["Product_Id"] . "]' placeholder='Enter todays rate'></td>";
        echo '</tr>';
    }
    echo "<button> Update Rates</button>";
    echo "</form>";
} else {
    echo "There are no Products Available";
}

echo '</div></div>';

$conn->close();
?>
</div>
</div>
</body>
</html>