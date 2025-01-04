<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> AGROINSIGHT HUB </title>
    <style>

   
         .square{
            width: 30%; /* Adjust the width as needed */
            height: 30%; /* Same as width to make it a square */
            background-color: white; /* Background color */
            color: black; /* Text color */
            text-align:center;
            font-size: 20px; /* Font size */
            cursor: pointer; /* Cursor style */
            position: relative;
            display:inline-block; /* Use flexbox */
            flex-direction: column; /* Stack content vertically */
            justify-content: center; /* Center text-block vertically */
            align-items: center; /* Center text horizontally */
            border:2px solid black; 
            border-radius: 25px;
            box-shadow: 8px 8px 5px rgb(85, 85, 85);
            overflow: hidden;
            margin: 3%;
     
        }
        .square:hover {
            background-color: #8ddd0d;
            transform: scale(1.02);
        }
      
       .square img{
              width: 100%;
              height: 100%;
              object-fit:cover;
              margin-top:10%;    
       }
       
       .square h1{
        font-size:130%;
       }


        body{
            padding: 0;
            background-image: url("l3.jpg");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: #fff;

        }
         
        header {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;

        }

        nav a:hover {
            background-color: #555;
        }

        .content {
            padding: 50px;
            text-align: center;
        }



    </style>
</head>
<body>
    <header>
        <h1 style="font-size:300%;">KrushiKisan</h1>
    </header>



    <nav>
        <a href="signup.php">Create account</a>
        <a href="about us.php">About us</a>
        <a href="">Contact</a>
        <a href="myprofile.php">My Profile</a>

    </nav>



    <div class="content">

       <a  href="farmer.php"> 
        <div  class="square" >
              <img src="5.jpg" >
              <h1><b>Farmer</b></h1>
       </div>
       </a>

       <a  href="customer.php">
       <div  class="square">
            <img src="3.jpg">
            <h1><b>Retail Store</b></h1>
        </div>
       </a>

    <footer style="text-align: center;">
        &copy; 2023 Your Crop Market. All rights reserved.
    </footer>


</body>
</html>