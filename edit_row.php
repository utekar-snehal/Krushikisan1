<?php
session_start();
include('connect.php');

if(!isset($_SESSION['Admin'])){
    header("location:admin_login.php");
    exit; // Add exit to prevent further execution
}

if(isset($_GET['id']) && isset($_GET['table']) && isset($_GET['primary_key'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    $primary_key = $_GET['primary_key'];

    // Fetch the row from the specified table
    $query = mysqli_query($conn, "SELECT * FROM $table WHERE $primary_key = $id");
    
    // Check if row is fetched successfully and not empty
    if($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    } else {
        echo "Row not found!";
        exit; // Exit if row is not found
    }
} else {
    echo "Invalid request!";
    exit; // Exit if request is invalid
}
?>

<html>
<head>
    
<link rel="stylesheet" href="admin_panel.css">
</head>
<body>
    
  <div class="addproduct">
  <h2>Edit Selected Product Here ..</h2><br>

<form action="update_row.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="table" value="<?php echo $table; ?>">
    <input type="hidden" name="primary_key" value="<?php echo $primary_key; ?>">
    <table>
        <?php foreach ($row as $key => $value) { ?>
            <tr>
                <td><label><?php echo $key; ?></label></td>
                <td><input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>"></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2"><button type="submit" value="Update">Update</button></td>
        </tr>
    </table>
</form>
</div>
</div>
</body>
</html>