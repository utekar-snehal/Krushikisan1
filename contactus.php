<?php
// Include database connection
include('connect.php');

// Initialize an error message variable
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input and sanitize
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Validate input
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "All fields are required!";
    } else {
        // Prepare SQL statement
        $sql = "INSERT INTO Contactus (Sender_Name, Sender_Email, Message) VALUES (?, ?, ?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute the statement
        if ($stmt->execute()) {
            $error_message = "Message submitted successfully.";
        } else {
            $error_message = "Error submitting message.";
        }

        // Close statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .card {
            border: 2px solid #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }
        label, input{
            font-size:150%;
            margin-bottom:10%;
            margin-top:10%;
        }

        button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }
        button:hover{
            transform: scale(1.02);
        }

    </style>
    
</head>
<body>
<h1>KRUSHIKISAN</h1><hr>
    <div class="container">
        <h2 class="mt-4">Contact Us</h2>
        <div class="card">
            <p id="error-message" class="text-danger"><?php echo $error_message; ?></p>
            <form id="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <input class="form-control" id="message" name="message" rows="4" required></input>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>
