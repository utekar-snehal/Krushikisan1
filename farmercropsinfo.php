<?php
    include('connect.php');
    session_start();
    $message = "";

    if (!isset($_SESSION['selected_product'])) {
        header("Location: farmerpage.php");
        exit;
    }
    $User_Id = $_SESSION['user_id']; 
    $selectedProductImage = $_SESSION['selected_product_image'];
    $selectedProductName = $_SESSION['selected_product'];
    $selectedProductPrice = $_SESSION['selected_product_price'];
    $selectedProductinfo = $_SESSION['selected_product_info'];
    $selectedtype = $_SESSION['type'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $VendorName = $_POST['Vendor_Name'];
        $VendorPhone = $_POST['Vendor_Phone'];
        $VendorEmail = $_POST['Vendor_Email'];
        $VendorAddress = $_POST['Vendor_Address'];
        $VendorStock = $_POST['Stock_amount'];
        $VendorPincode = $_POST['Vendor_Pincode'];
        $total = $VendorStock * $selectedProductPrice ;


        $insertQuery = "INSERT INTO vendors (Vendor_Id ,Vendor_Name, Vendor_Email,Vendor_Phone,Vendor_Address, Vendor_Pincode , Crops_Name , Stock_Quantity_in_qt ,Crops_Price, Total_Price_Of_Stock ) VALUES ('$User_Id','$VendorName', '$VendorEmail', '$VendorPhone', '$VendorAddress','$VendorPincode', '$selectedProductName','$VendorStock','$selectedProductPrice' ,'$total')";

        if ($conn->query($insertQuery) === TRUE) {
            echo '<script>alert("Your Stock Is Successfully Uploaded On Our KRUSHIKISAN  .");</script>';
        } 
        else {
            echo '<script>alert("Please Reupload Your Details  or Again After Some Time");</script>';
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            align-item:center;
        }
        header {
            background-color: #232f3e;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .product-details {
            width: 70%;
            background-color: white; 
            color: black; 
            text-align:center;
            font-size: 20px; 
            cursor: pointer; 
            position: relative;
            display:inline-block;
            flex-direction: column; 
            justify-content: center;
            align-items: center; 
            border:1px solid black; 
            border-radius: 25px;
            overflow: hidden;
            margin-left: 15%;          
            margin-right: 15%;      
            padding:2%;
        }
        .product-details img {
            max-width: 300px;
            height: auto;
            border:5px solid black;
            border-radius:5%;
            margin-top:5%;
        }
        .product-details img:hover {
            transform: scale(1.2);
            background-color: #ECECEC; 
        }

        input{
            width:70%;
            height:30px;
            margin-bottom:10%;
            text-align:center;
            font-size:100%;
        }
        h5{
            text-align:right;
        }
        button {
        width: 25%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Checkout</h1>
    </header>
    <h2 style="font-size:200%; text-align:center;">Selected</h2>
    <h3><?php echo $selectedtype; ?></h3>
    <div class="product-details">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">   
        <h1>Product Details</h1>
        <img src="<?php echo $selectedProductImage; ?>" alt="<?php echo $selectedProductName; ?>">
        <h3><?php echo $selectedProductName; ?></h3>
        <p>Price: &#8377;<?php echo $selectedProductPrice . "/Quintal"; ?></p>
        <p><?php echo $selectedProductinfo; ?></p>
        <input type="hidden" name="selected_product" value="<?php echo $selectedProductName; ?>">
        <input type="hidden" name="selected_product_price" value="<?php echo $selectedProductPrice ; ?>">   
        <h1>Fill Your Details</h1><br>
        <input type="number" id="number" name="Stock_amount" placeholder="<Enter Stock Amount>" required> 
        <input type="username" id="username" name="Vendor_Name" placeholder="Enter full name" required>
        <input type="phone" id="phone" name="Vendor_Phone" placeholder="Phone Number :" required>
        <input type="email" id="email" name="Vendor_Email" placeholder="Email id :" required>
        <input type="add" id="add" name="Vendor_Address" placeholder="Address :" required> 
        <input type="number" id="pin" name="Vendor_Pincode"  placeholder="Pincode:" required> <br>
        <button value="Submit" type="submit">Submit </button>
        </form>
    </div>
</body>
</html>