<?php
session_start();
include('connect.php');

if (!isset($_SESSION['Admin'])) {
    header("location:admin_login.php");
    exit; // Add exit to prevent further execution
}
include('./include/header.php');
?>

<html>
  <head>
<link rel="stylesheet" href="admin_panel.css">


</head>
</body>
<div class="content">
  <div class="addproduct">
  <div class="all">
        <div class="top">
        <h2 >KRUSHIKISAN</h2>
        <h3>Add Products Reports</h3>
        </div>
        <div class="date">
        <h4>Date : 30-12-2024 <br> Time : 05:34:36 PM</h4>
        </div>
        </div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype ="multipart/form-data">
      <h2>Add Product with details</h2><br>
      <label for="">Product Name</label>
      <input type="text" name="name"><br>
      <label for="">Product Image</label>
      <input type="file" name="image" accept="image/*" required><br>
      <label for="">Product Category</label>
      <input type="text" name="product_cate"><br>
      <label for="">Product Information</label>
      <input type="text" name="product_info"><br>
      <label for="">Product Price</label>
      <input type="number" name="product_price"><br>
      <label for="">Product Available quanity(in kg)</label>
      <input type="number" name="product_quantity"><br>
      <label for="">Product Created At</label>
      <input type="date" name="product_mfg"><br>
      <label for="">Product Marathi Name</label>
      <input type="text" name="product_marathi_name"><br>
      <br>
      <br>
      <button type="reset">reset</button>
      <button type="submit" name="submit">Add Product</button>
    </form>
  </div>
</div>

</body>

<?php
include('connect.php');
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $uploadFileName = basename($_FILES["image"]["name"]);
  $cate = $_POST['product_cate'];
  $info = $_POST['product_info'];
  $price = $_POST['product_price'];
  $quantity = $_POST['product_quantity'];
  $mfg = $_POST['product_mfg'];
  $marathi = $_POST['product_marathi_name'];


  $uploaddirectory= 'products/';

  $uploadFile = $uploaddirectory . $uploadFileName;

  if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)){

    $imageName = $_FILES['image']['name'];

    try{

      
        $query1 = mysqli_query($conn, "INSERT INTO `products`(`Product_Name`, `Product_Img`, `Product_Category`, `Product_Info`, `Product_Price`, `Product_Quantity_Available`, `Product_Created_At`, `Product_Marathi_Name`) 
        VALUES ('$name','$uploadFileName','$cate','$info','$price','$quantity','$mfg','$marathi')");
        if ($query1) {
          echo "<script>alert('data saved  Sucessfull...!')</script>";
        } 
        else {
          echo "<script>alert('Try Again...!')</script>";
        }
      } 
    catch(PDOException $e){
        echo 'Databse error :' . $e->getmessage();
    }
  }else{
      echo 'Echo uploading Image .';
    }
  }


?>