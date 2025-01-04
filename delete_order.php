<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    $k = "SELECT * FROM orders WHERE Order_Id = '$order_id'";
    $result2 = $conn->query($k);

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $pn = $row['Product_Name'];
        $cn = $row['Customer_Name'];
        $pp = $row['Product_Price'];
        $pq = $row['Product_Quantity'];
        $sc = $row['Shipping_Charges'];
        $t = $row['Product_Price'] * $row['Product_Quantity'];


        $add = "INSERT INTO order_cancellation_table (Order_Id,Product_Name, Customer_Name , Product_Price , Product_Quantity , Shipping_Charges,Total) VALUES ('$order_id', '$pn','$cn','$pp','$pq','$sc','$t')";
        $conn->query($add);

        $query1 = "DELETE FROM orders WHERE Order_Id = ?";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param("s", $order_id);

        if ($stmt->execute()) {
            echo '<script>alert("Order cancelled successfully.");</script>';
        } else {
            echo "Error cancelling order: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Order not found.";
    }
} else {
    echo "Invalid request.";
}
?>
