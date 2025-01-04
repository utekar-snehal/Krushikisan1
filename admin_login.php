<?php
session_start(); 
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_panel.css">
</head>

<body style="background-color:aqua;">  
            <div class="login">

            <div class="login-container">
                <h2>Admin Login</h2>
                <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="email">email:</label>
                    <input type="email" name="email" id="email" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit" name="submit">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
include('connect.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "select * from admin where Admin_Email='$email' AND Admin_Password='$password'");
    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            $row = $query->fetch_assoc();
            $_SESSION['Admin']  = $row['Admin_Id'];
            header('location:home.php');
        } else {
            echo "<script> alert('Try Again , Email & Password is not matched...!')</script>";
        }
    }
}
?>