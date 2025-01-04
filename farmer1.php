<!DOCTYPE html>
<html lang="mr">
<head>
  <meta charset="UTF-8">
  <title>Farmer Page</title>
  <style>

td{

  margin:5%;
}

div{
    text-align: center;
}

div a{
    color: white;
}

table {
  border-collapse: collapse;
width:70%;
height:30%;
}

tr{
  border: solid thin #808080;
 text-align:center;
background-color:white;
}



nav{
background-color:rgb(37, 129, 32);
color:white;
text-align:center;
margin-top:2%;
margin-bottom:2%;
padding:0.5%;
}

nav a{
margin:5%;
padding:0.5%;
color: azure;
}


nav a:hover {
  background-color: #083203;
}
</style>
</head>


<body style="background-color:white; color:black;">
  <h1 style="text-align:center;">Farmer page </h1>
<hr>





  <nav>
    <a href="#" onclick="showTable('crops')">Commodities</a>
    <a href="#" onclick="showTable('equip')">Farming Equipments</a>
    <a href="chatbox.php" >Chat box</a>

  </nav>

 
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

  // Fetch data for crops
  $sqlCrops = "SELECT crops, price, info FROM project1";
  $resultCrops = $conn->query($sqlCrops);

  // Fetch data for equipment
  $sqlEquipment = "SELECT equip, price, info FROM equipment1";
  $resultEquipment = $conn->query($sqlEquipment);

  // Display the tables
  displayTable($resultCrops, 'crops');
  displayTable($resultEquipment, 'equip');

  // Close connection
  $conn->close();

  // Function to display the table
  function displayTable($result, $tableName)
  {
    echo "<table id='$tableName' style='display:none; margin-left: 15%;'>";
    echo "<tr><th>" . ucfirst($tableName) . "</th><th>price</th><th>info</th></tr>";

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row[$tableName] . "</td><td>" . $row["price"] . "</td><td>" . $row["info"] . "</td></tr>";
      }
    } else {
      echo "<tr><td colspan='3'>No $tableName data found</td></tr>";
    }

    echo "</table>";
  }
  ?>



<script>
    function showTable(tableId) {
      // Hide all tables
      var tables = document.getElementsByTagName("table");
      for (var i = 0; i < tables.length; i++) {
        tables[i].style.display = "none";
      }

      // Show the selected table
      var table = document.getElementById(tableId);
      table.style.display = "table";
    }

    // Show the "Crops" table by default
    var cropsTable = document.getElementById("crops");
    cropsTable.style.display = "table";

  </script>


</body>
</html>
