<!DOCTYPE html>
<html>
<head>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
  </style>
</head>
<body>

<table>
  <thead>
    <tr>
      <th>crops </th>
      <th>price</th>
      <th>price</th>
      <!-- Add more columns as needed -->
    </tr>


    
  </thead>
  <tbody>

<?php
  // Replace these with your database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fake";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  
  $sql = "SELECT crops, price , info FROM project1";
  $result = $conn->query($sql);

  // Check if there are rows in the result
  if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["crops"]. "</td><td>" . $row["price"]. "</td><td>" . $row["price"]. "</td></tr>";
      // Add more cells if there are more columns in your table
    }
  } else {
    echo "<tr><td colspan='2'>No data found</td></tr>";
  }

  // Close connection
  $conn->close();
?>

  </tbody>
</table>

</body>
</html>