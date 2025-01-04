<?php
// Include database connection
include('connect.php');

// Start PHP session
session_start();

// Initialize an error message variable
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    // Retrieve and sanitize user input
    $username = $_SESSION['username'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Prepare SQL statement to insert message into the database
    $sql = "INSERT INTO chatbox (Sender_Name, Chat_Message) VALUES ('$username ','$message ')";
    


    // Execute the statement
    if ($conn->query($sql) === TRUE) {
        // Message successfully inserted into the database
        echo json_encode(["status" => "success", "message" => "Message sent successfully"]);
        exit(); // Stop further execution
    } else {
        // Error inserting into the database
        echo json_encode(["status" => "error", "message" => "Error sending message"]);
        exit(); // Stop further execution
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers Community Chat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
            background-image: url('a123.jpg');
        }

        #live-chat {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        #messageOutput {
            list-style-type: none;
            padding: 0;
            margin: 0;
            overflow-y: scroll;
            flex-grow: 1;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            max-height: 400px;
            background-color: white;
        }

        #container,
        #live-chat {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid black;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        #messageInput,
        #messageOutput {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        button {
            padding: 10px;
            margin-top: 5px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


    .message-container {
        width: 100%;
        box-sizing: border-box;
        margin: 10px 0;
        overflow: hidden;
    }

    .user-message {
        text-align: right;
    }

    .other-message {
        text-align: left;
    }
</style>
</head>

<body>
    <div id="live-chat">
        <h1>Live Chat</h1>
        <div id="messageOutput">
            <?php
            include('connect.php');

            $query = "SELECT * FROM chatbox";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $message = htmlspecialchars($row['Chat_Message']); // Prevent XSS
                    $username = htmlspecialchars($row['Sender_Name']); // Prevent XSS

                    $isCurrentUser = ($username === $_SESSION['username']);

                    $class = $isCurrentUser ? 'user-message' : 'other-message';
                    echo "<div class='message-container $class'>$username: $message</div>";
                }
            }
            ?>
        </div>
        <div id="container">
            <input id="messageInput" name="message" placeholder="Type your message...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        // JavaScript code for sending messages via AJAX
        const messageOutput = document.getElementById('messageOutput');
        const messageInput = document.getElementById('messageInput');

        function appendMessage(message, isUserMessage) {
            const messageElement = document.createElement('div');
            messageElement.textContent = message;
            messageElement.classList.add(isUserMessage ? 'user-message' : 'other-message');
            messageOutput.appendChild(messageElement);

            messageOutput.scrollTop = messageOutput.scrollHeight;
        }

        function sendMessage() {
            const messageText = messageInput.value.trim();

            if (messageText !== '') {
                // Send the message to the server using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        const response = JSON.parse(xhr.responseText);

                        // Display success or error message
                        if (response.status === 'success') {
                            console.log(response.message);
                            // Append the user message locally
                            appendMessage('<?php echo htmlspecialchars($_SESSION['username']); ?>: ' + messageText, true);
                            // Clear the input field
                            messageInput.value = '';
                        } else {
                            console.error(response.message);
                            // Handle error case here
                        }
                    }
                };

                const params = `message=${encodeURIComponent(messageText)}`;
                xhr.send(params);
            }
        }

        // Event listener for pressing Enter key to send message
        messageInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>

</html>
