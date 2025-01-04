<?php
include('connect.php');

session_start();

if (isset($_GET['category'])) {
    $_SESSION['selected_category'] = $_GET['category'];
} else {

    $_SESSION['selected_category'] = 'All';
}

if(isset($_POST['selected_product'])) {
    $selectedProductName = $_POST['selected_product'];
    $selectedProductImage = $_POST['selected_product_image'];
    $selectedProductPrice = $_POST['selected_product_price'];
    $selectedProductinfo = $_POST['selected_product_info']; 
    $selectedtype = $_POST['type'];

    $_SESSION['selected_product'] = $selectedProductName;
    $_SESSION['selected_product_image'] = $selectedProductImage;
    $_SESSION['selected_product_price'] = $selectedProductPrice; 
    $_SESSION['selected_product_info'] = $selectedProductinfo;
    $_SESSION['type'] = $selectedtype;

    header("Location:farmercropsinfo.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRUSHIKISAN Crops Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header{
            background-color: #232f3e;
            color: white;
            padding: 10px;
            text-align: center;
        }
        nav {
            background-color: #333;
            overflow: hidden;
            text-align: center;
        }
        nav a {
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
        nav a.active {
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
            display: flex;
            width: 600px;
            height: auto;
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            margin-left: 10%;
            margin-right: 10%;
        }
        .product-box img {
            width: auto;
            height: 100px;
            margin-left: 2%;
            text-align:center;

        }
 
        .product-info {
            flex: 1;
            padding: 5px 50px;
            text-align:center;
            margin-right:2px;
        }
        .product-box:hover {
            transform: scale(1.02);
            background-color: #ECECEC; 
        }
        main {
            margin-top: 5%;
        }
        main input{
            width:40%;
            height:40px;
            border: 3px solid grey;
            border-radius:5%;
            margin-bottom:5%;
            text-align:left;
            margin-left:10%;
            font-size:15px;
        }
        .search{
            width:10%;
            height:40px;
            border: 3px solid grey;
            border-radius:5%;
            margin-bottom:5%;
            text-align:center;
            font-size:15px;

        }
        .product-box button {
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
        <h1>KRUSHIKISAN Wholesale Market</h1>
    </header>

    <nav>
        <a href="?category=All" <?php echo ($_SESSION['selected_category'] == 'All') ? 'class="active"' : ''; ?>>All</a>
        <a href="?category=Grains" <?php echo ($_SESSION['selected_category'] == 'Grains') ? 'class="active"' : ''; ?>>Grains</a>
        <a href="?category=Vegetable" <?php echo ($_SESSION['selected_category'] == 'Vegetable') ? 'class="active"' : ''; ?>>Vegetable</a>
        <a href="?category=Fruits" <?php echo ($_SESSION['selected_category'] == 'Fruits') ? 'class="active"' : ''; ?>>Fruits</a>
        <a href="chatbox.php" <?php echo ($_SESSION['selected_category'] == 'chatbox') ? 'class="active"' : ''; ?>>Farmers Community</a>
    </nav>
    <main> 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <input type="text" name="s" placeholder=" Q Search Your Products Here .....">
        <button class="search" id="" >Search</button>
        </form>
        
        <section class="product-container">
            <?php   
                $search = isset($_GET['s']) ? $_GET['s'] : '';

                if ($_SESSION['selected_category'] != 'All') {
                    $selectedCategory = $_SESSION['selected_category'];
                    $sqlCommodities = "SELECT * FROM products WHERE Product_Category = '$selectedCategory'";
                } else {
                    $sqlCommodities = "SELECT * FROM products  WHERE Product_Category <> 'Fertilizers'";
                }
                
                if(!empty($search)){
                $sqlCommodities .= "And Product_Name Like '%$search%'";
                $resultCommodities = $conn->query($sqlCommodities);
                }
                else{
                $sqlCommodities.= " ORDER BY RAND()";
                $resultCommodities = $conn->query($sqlCommodities);
                }

                if ($resultCommodities->num_rows > 0) {
                    while ($row = $resultCommodities->fetch_assoc()) {
                        echo '<form method="post">';
                        echo '<div class="product-box">';
                        $image = "products/$row[Product_Img]";
                        echo "<img src='$image'>";
                        echo '<div class="product-info">';
                        echo '<h3 class:block;">' . $row["Product_Name"] . '</h3>';
                        $factor = 80;
                        $db_price =  $row["Product_Price"] ;
                        $ok_price = $factor * $db_price ;
                        echo '<p id="right">&#8377;' .$ok_price  .'/Quintal</p>';
                        echo '<input type="hidden" name="selected_product" value="' . $row["Product_Name"] . '">';
                        echo '<input type="hidden" name="selected_product_image" value="' . $image . '">';
                        echo '<input type="hidden" name="selected_product_price" value="' .$ok_price. '">'; 
                        echo '<input type="hidden" name="selected_product_info" value="' . $row["Product_Info"] . '">';   
                        echo '<button type="submit">Show Stock >></button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</form>';    
                    }
                }
                else{
                    echo "$search  is not available";
                }
            ?>     
        </section>
    
    </main>
            
    <script>
        var categoryLinks = document.querySelectorAll('nav a');
        categoryLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                categoryLinks.forEach(function (otherLink) {
                    otherLink.classList.remove('active');
                });
                link.classList.add('active');
            });
        });
    </script>
</body>
</html>
