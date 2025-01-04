<?php

    session_start();

    if(isset($_POST['selected_product'])) {
        $selectedProductName = $_POST['selected_product'];
        $selectedProductImage = $_POST['selected_product_image']; 
        $selectedProductPrice = $_POST['selected_product_price'];
        $selectedProductinfo = $_POST['selected_product_info']; 
        
        $_SESSION['selected_product'] = $selectedProductName;
        $_SESSION['selected_product_image'] = $selectedProductImage;
        $_SESSION['selected_product_price'] = $selectedProductPrice; 
        $_SESSION['selected_product_info'] = $selectedProductinfo;

        header("Location: checkoutpage.php");
        exit;
    }

    include('connect.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRUSHIKISAN Crops Store</title>
    <style>
        img{
            height: 200%;
            width: 200%;
        }
        body{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header{
            background-color: #232f3e;
            color: white;
            padding: 10px;
            text-align: center;
        }
        nav{
            background-color: #333;
            overflow: hidden;
            text-align: center;
        }
        nav a{
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
        }
        .product-box {
            width: 200px;
            height:auto;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            border-radius:5%;
        }
        .product-box:hover {
            transform: scale(1.02);
            background-color: #ECECEC; 
        }
        .product-box img {

            max-width: 100%;
            height: 200px;
        }
        main{
            margin-top:5%;
        }

    </style>
</head>
<body>
    <header>
        <h1>KRUSHIKISAN Crops Store</h1>
    </header>

    <nav>
        <a href="#" onclick="showSection('grains')">Grains</a>
        <a href="#" onclick="showSection('vege')">Vegetables</a>
        <a href="#" onclick="showSection('fruits')">Fruits</a>
        <a href="#" onclick="showSection('fertilizer')">Fertilizers</a>
    </nav>

    <main>
        <section id="grains" class="product-container">
            <?php
                $sqlCommodities = "SELECT * FROM grains ORDER BY RAND()";
                $resultCommodities = $conn->query($sqlCommodities);

                if ($resultCommodities->num_rows > 0) {
                    while ($row = $resultCommodities->fetch_assoc()) {
                        echo '<form method="POST">';
                        echo '<div class="product-box">';                  
                        $image = "retailmarket/grains/$row[Grains_Image]";
                        echo "<img src='$image'>";
                        echo '<h3>' . $row["Grains_Name"] . '</h3>';
                        echo '<p>&#8377;' . $row["Grains_Price"] .'/kg</p>';
                        echo '<input type="hidden" name="selected_product" value="' . $row["Grains_Name"] . '">';
                        echo '<input type="hidden" name="selected_product_image" value="' .$image. '">';
                        echo '<input type="hidden" name="selected_product_price" value="' . $row["Grains_Price"] . '">'; // Add this line
                        echo '<input type="hidden" name="selected_product_info" value="' . $row["Grains_Info"] . '">';   
                        echo '<button type="submit">Buy Now.</button>';
                        echo '</div>';
                        echo '</form>';    
                    }
                } 
                else{
                    echo "<p>No commodities available</p>";
                }
            ?>
        </section>

        <section id="vege" class="product-container">
            <?php
                $sqlCommodities = "SELECT * FROM vegetable ORDER BY RAND()";
                $resultCommodities = $conn->query($sqlCommodities);

                if ($resultCommodities->num_rows > 0) {
                    while ($row = $resultCommodities->fetch_assoc()) {
                        echo '<form method="post">';
                        echo '<div class="product-box">';
                        $image = "retailmarket/vegetables/$row[Vege_Image]";              
                        echo "<img src='$image'>";
                        echo '<h3>' . $row["Vege_Name"] . '</h3>';
                        echo '<p>&#8377;' . $row["Vege_Price"] .'/kg</p>';
                        echo '<input type="hidden" name="selected_product" value="' . $row["Vege_Name"] . '">';
                        echo '<input type="hidden" name="selected_product_image" value="' .$image. '">';
                        echo '<input type="hidden" name="selected_product_price" value="' . $row["Vege_Price"] . '">'; // Add this line
                        echo '<input type="hidden" name="selected_product_info" value="' . $row["Vege_Info"] . '">';   
                        echo '<button type="submit">Buy Now.</button>';
                        echo '</div>';
                        echo '</form>';
                    }
                } 
                else{
                    echo "<p>No commodities available</p>";
                }
           
            ?>
        </section>

        <section id="fruits" class="product-container">
            <?php
                $sqlCommodities = "SELECT * FROM fruits ORDER BY RAND()";
                $resultCommodities = $conn->query($sqlCommodities);
                if ($resultCommodities->num_rows > 0) {
                    while ($row = $resultCommodities->fetch_assoc()) {
                        echo '<form method="post">';
                        echo '<div class="product-box">';                    
                        $image = "retailmarket/fruits/$row[Fruits_Image]";   
                        echo "<img src='$image'>";  
                        echo '<h3>' . $row["Fruits_Name"] . '</h3>';
                        echo '<p>&#8377;' . $row["Fruits_Price"] .'/kg</p>';
                        echo '<input type="hidden" name="selected_product" value="' . $row["Fruits_Name"] . '">';
                        echo '<input type="hidden" name="selected_product_image" value="' .$image . '">';
                        echo '<input type="hidden" name="selected_product_price" value="' . $row["Fruits_Price"] . '">'; // Add this line
                        echo '<input type="hidden" name="selected_product_info" value="' . $row["Fruits_Info"] . '">';   
                        echo '<button type="submit">Buy Now.</button>';
                        echo '</div>';
                        echo '</form>';              
                    }
                } 
                else{
                    echo "<p>No commodities available</p>";
                }
            ?>
        </section>

        <section id="fertilizer" class="product-container">
            <?php
                $sqlEquipment = "SELECT * FROM fertilizers ORDER BY RAND()";
                $resultEquipment = $conn->query($sqlEquipment);

                if ($resultEquipment->num_rows > 0) {
                    while ($row = $resultEquipment->fetch_assoc()) {
                        echo '<form method="post">';
                        echo '<div class="product-box">';
                        $image = "retailmarket/fertilizers/$row[Fertilizer_Image]";
                        echo "<img src='$image'>";
                        echo '<h3>' . $row["Fertilizer_Name"] . '</h3>';
                        echo '<p>&#8377;' . $row["Fertilizer_Price"] . '/kg</p>';
                        echo '<input type="hidden" name="selected_product" value="' . $row["Fertilizer_Name"] . '">';
                        echo '<input type="hidden" name="selected_product_image" value="' . $image.  '">';
                        echo '<input type="hidden" name="selected_product_price" value="' . $row["Fertilizer_Price"] . '">'; // Add this line
                        echo '<input type="hidden" name="selected_product_info" value="' . $row["Fertilizer_Info"] . '">'; 
                        echo '<button type="submit">Buy Now</button>';
                        echo '</div>';
                        echo '</form>';
                    }
                } 
                else{
                    echo "<p>No farming equipment available</p>";
                }
                $conn->close();
            ?>
        </section>

    </main>
    <script>
        function showSection(sectionId) {
            var sections = document.querySelectorAll('.product-container');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            var selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'flex';
            } else {
                console.error("Section with ID '" + sectionId + "' not found.");
            }
        }
        showSection('grains');
    </script>

</body>
</html>