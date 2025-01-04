<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['Admin'])){
    header("location:admin_login.php");
}

include('./include/header.php');
?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin_Dashboard</title>
 
</head>

<body>
  <style>
    section {
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      margin: 20px;
      height: 150px;
      width: 50%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .content-one,.content-two {
      display: flex;
    }
  </style>

  <div class="content">

    <div class="content-one">

      <section id="drivers">
        <h2>Products</h2>
        <hr><br>
        <?php
        include('connect.php');
        $count = "select Product_Id from products";
        $count_no = mysqli_query($conn, $count);
        $row = mysqli_num_rows($count_no);
        echo "<p>$row</p>";
        ?>
      </section>

      <section id="vehicles">
        <h2>Vendors</h2>
        <hr><br>
        <?php
        include('connect.php');
        $count = "select Vendor_Id from vendors";
        $count_no = mysqli_query($conn, $count);
        $row = mysqli_num_rows($count_no);
        echo "<p>$row</p>";
        ?>
      </section>
    </div>
    <div class="content-two">
      <section id="bookings">
        <h2>Orders</h2>
        <hr><br>
        <?php
        include('connect.php');
        $count = "select Order_Id from orders";
        $count_no = mysqli_query($conn, $count);
        $row = mysqli_num_rows($count_no);
        echo "<p>$row</p>";
        ?>
      </section>

      <section id="reports">
        <h2>Monthly Earning</h2>
        <hr><br>
        <p>₹ 12,502</p>
      </section>

    </div>
  </div>
</body>

</html>