<!DOCTYPE html>
<html lang="mr">
<head>
  <meta charset="UTF-8">
  <title>Farmer Page</title>
  <style>
    /* Your existing CSS styles remain unchanged */

    .content-container {
      display: flex;
      justify-content: space-around;
    }

    .item-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      border: 1px solid #808080;
      background-color: white;
      padding: 10px;
      margin: 10px;
      width: 30%;
    }

    .crop-image,
    .equipment-image {
      width: 100%;
    }
  </style>
</head>

<body style="background-color:white; color:black;">
  <h1 style="text-align:center;">Farmer page </h1>
  <hr>

  <nav>
    <a href="#" onclick="showContent('crops')">Commodities</a>
    <a href="#" onclick="showContent('equip')">Farming Equipments</a>
    <a href="chatbox.php">Chat box</a>
  </nav>

  <div class="content-container" id="content-container">
    <?php
      // Fetch data for crops
      $sqlCrops = "SELECT crops, price, info, image FROM project1";
      $resultCrops = $conn->query($sqlCrops);

      // Display the crops
      displayContent($resultCrops, 'crops');
    ?>

    <?php
      // Fetch data for equipment
      $sqlEquipment = "SELECT equip, price, info, image FROM equipment1";
      $resultEquipment = $conn->query($sqlEquipment);

      // Display the equipment
      displayContent($resultEquipment, 'equip');
    ?>
  </div>

  <script>
    function showContent(contentType) {
      // Hide all content
      var contents = document.querySelectorAll('.content-container > div');
      contents.forEach(function(content) {
        content.style.display = "none";
      });

      // Show the selected content
      var content = document.querySelector('.' + contentType + '-container');
      content.style.display = "flex";
    }

    // Show the "Crops" content by default
    showContent('crops');
  </script>

  <?php
    function displayContent($result, $type) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="item-container ' . $type . '-container">';
        echo '<img class="' . $type . '-image" src="' . $row['image'] . '" alt="' . $row['crops/equip'] . '">';
        echo '<p>Name: ' . $row['crops/equip'] . '</p>';
        echo '<p>Price: ' . $row['price'] . '</p>';
        echo '<p>Info: ' . $row['info'] . '</p>';
        echo '</div>';
      }
    }
  ?>
</body>
</html>
