<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['Admin'])){
    header("location:admin_login.php");
}
?>

<?php
include('include/header.php');
error_reporting(0);
?>
<html>
    <head>
<link rel="stylesheet" href="admin_panel.css">

<style>
    table, th , td{
    border:1px solid black;
    </style>        
}

</style>
</head>
</body>
<div class="content">
    <div class="product_info">
    <div class="all">
        <div class="top">
        <h2 >KRUSHIKISAN</h2>
        <h3>Feedback Reports</h3>
        </div>
        <div class="date">
        <h4>Date : 03-01-2025 <br> Time : 07:18:20 PM</h4>
        </div>
        </div>
        <table>
            <tr>
                <th>Feedback Id</th>
                <th>User Id</th>
                <th>Feedback Message</th>
                <th>Time of feedback</th>
            </tr>

            <?php
            include('connect.php');

            $query = mysqli_query($conn, "select * from feedback");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['Feedback_Id'];
            ?>
                <tr>
                    <td><?php echo $row['Feedback_Id']; ?></td>
                    <td><?php echo $row['User_Id']; ?></td>
                    <td><?php echo $row['Feedback_Message']; ?></td>
                    <td><?php echo $row['Time_Of_Feedback']; ?></td>
     </tr>


            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>