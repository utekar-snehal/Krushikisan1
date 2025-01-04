<?php
include('connect.php');

if($_SERVER["REQUEST_METHOD"]== "POST"){

    $Email = $_POST["Email"];
    $Password = $_POST["Password"];


    $sql = "SELECT * FROM signup WHERE Email ='$Email' AND Password = '$Password'";
    $result=$conn->query($sql);


    if($result->num_rows==1)

{
    echo"login successful";
     header("Location:home page.php");
     exit();
}
else{
    echo"invalid username or password";
}

}

$conn->close();

?>