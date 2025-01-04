<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders</title>
  <style>
    /* Some basic CSS for styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      text-align: center;
    }
    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 0 20px;
    }
    .order {
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 20px;
    }
    .order-header {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .order-details {
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <header>
    <h1>My Orders</h1>
  </header>

  <div class="container">
    <div class="order">
      <div class="order-header">Order #123456</div>
      <div class="order-details">
        <p>Product: Lorem ipsum dolor sit amet</p>
        <p>Price: $20.00</p>
        <p>Quantity: 2</p>
        <p>Total: $40.00</p>
        <p>Status: Shipped</p>
      </div>
    </div>

    <div class="order">
      <div class="order-header">Order #789012</div>
      <div class="order-details">
        <p>Product: Consectetur adipiscing elit</p>
        <p>Price: $30.00</p>
        <p>Quantity: 1</p>
        <p>Total: $30.00</p>
        <p>Status: Processing</p>
      </div>
    </div>
  </div>

</body>
</html>
