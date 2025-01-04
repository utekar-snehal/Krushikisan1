<?php
session_start();
include('connect.php');

if (!isset($_SESSION['Admin'])) {
    header("location:admin_login.php");
    exit; // Add exit to prevent further execution
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'], $_GET['table'], $_GET['primary_key'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    $primary_key = $_GET['primary_key'];

    // Construct the delete query
    $delete_query = "DELETE FROM $table WHERE $primary_key = $id";

    // Execute the delete query
    if (mysqli_query($conn, $delete_query)) {
        echo "Record deleted successfully";
        // Redirect back to admin panel
        header("Location: home.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request!";
}
?>
