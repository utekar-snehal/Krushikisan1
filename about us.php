<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT US</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        .square{
            border:3px solid #333;
            margin-left:10%;
            margin-right:10%;  
            border-radius:2%;
        }

        h2, p {
            text-align: center;
        }
        h1{
            font-size:300%;
        }

        #mission-section {
            background-color: #f5f5f5;
            padding: 20px;
        }

        #why-us-section {
            margin-top: 20px;
            padding: 20px;
        }
        #feedback1{
            margin-top: 20px;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>KRUSHIKISAN</h1>
<div  class="square">
<div style="margin:5%;">
    <h1><u>About Us</u></h1>
    <h2>Our Vision</h2>
    <p>At KrushiKisan, we envision a world where the agricultural landscape is seamlessly intertwined with cutting-edge technology. Our vision is to create a digital hub that empowers farmers and stakeholders, transforming the way they engage with information, markets, and each other.</p>

    <h2>Who We Are</h2>
    <p>We are a dedicated team of agricultural enthusiasts, technologists, and visionaries committed to bridging the gap between tradition and innovation. Our diverse backgrounds converge to cultivate a platform that not only meets the needs of today's agricultural community but also plants the seeds for a resilient and connected tomorrow.</p>

    <h2>Mission Statement</h2>
    <p>Our mission is simple yet profound – to empower farmers and agricultural stakeholders through accessible technology. We strive to provide a digital space where information flows freely, transactions occur seamlessly, and sustainable practices blossom. KrushiKisan is more than a platform; it's a mission to nurture growth, foster collaboration, and cultivate a sustainable future for agriculture.</p>

    <div id="mission-section">
        <h2>Why KrushiKisan?</h2>
        <ul>
            <li><strong>Innovative Solutions:</strong> We harness the power of technology to bring you innovative solutions tailored to the unique challenges of agriculture.</li>
            <li><strong>Community-Centric Approach:</strong> Our platform is designed with you in mind. We prioritize the needs of farmers, buyers, and sellers, fostering a sense of community and collaboration.</li>
            <li><strong>Data-Driven Decision Making:</strong> Access real-time data on crop prices, market trends, and more, empowering you to make informed decisions for your agricultural endeavors.</li>
            <li><strong>Sustainability at Heart:</strong> We advocate for sustainable agriculture. KrushiKisan is not just a platform for transactions; it's a commitment to practices that ensure the longevity and health of our agricultural ecosystems.</li>
        </ul>
    </div>

    <div id="why-us-section">
        <h2>Join Us in Cultivating Change</h2>
        <p>Whether you're a farmer looking for market insights or a buyer seeking quality produce, KrushiKisan invites you to join us on this journey of cultivation, innovation, and connectivity. Together, let's sow the seeds of a digital agricultural revolution!</p>
    </div>
    <hr>
  
    <div id="feedback1">
        <h2>Provide Feedback </h2>

        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input id="feedback" name="feedback" placeholder="Enter your feedback here..." required></input>
            <br><br>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>

    <p>KrushiKisan - Where Agriculture Thrives, Technology Connects, and Innovation Blossoms.</p>
</div>
</div>

<?php
// Start session
session_start();

// Include database connection
include('connect.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user's ID and username are set in session
    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];

        $feedback = $_POST["feedback"];

        // Prepare SQL statement to insert feedback into the database
        $sql = "INSERT INTO feedback (User_Id, Sender_Name, Feedback_Message) VALUES ('$user_id','$username','$feedback')";
        $result = mysqli_query($conn , $sql);
    
        if ($result==1) {
            echo '<script>alert("Feedback submitted successfully.");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    
    } else {

        echo '<script>alert("First Sign in then Give Feedback ..");</script>';

    }
}
?>

</body>
</html>
