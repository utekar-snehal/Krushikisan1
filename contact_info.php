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
<body>
<div class="content">
    <div class="product_info">

    <div class="all">
        <div class="top">
        <h2 >KRUSHIKISAN</h2>
        <h3>Contact us Reports</h3>
        </div>
        <div class="date">
        <h4>Date : 03-01-2025 <br> Time : 07:32:36 PM</h4>
        </div>
        </div>
        <table>
            <tr>
                <th>Contact Id</th>
                <th>Sender Name</th>
                <th>Sender Email</th>
                <th>Message</th>
                <th>Send At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
            include('connect.php');

            $query = mysqli_query($conn, "select * from contactus");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['Contact_Id'];
            ?>
                <tr>
                    <td><?php echo $row['Contact_Id']; ?></td>
                    <td><?php echo $row['Sender_Name']; ?></td>
                    <td><?php echo $row['Sender_Email']; ?></td>
                    <td><?php echo $row['Message']; ?></td>
                    <td><?php echo $row['Submit_Time']; ?></td>
                    <td><a href="edit_row.php?id=<?php echo $id; ?>&table=contactus&primary_key=Contact_Id" class="btn btn-primary">Edit</a></td>
                    <td><a href="delete_row.php?id=<?php echo $id; ?>&table=contactus&primary_key=Contact_Id" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this row?')">Delete</a></td>
                   </tr>


            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>