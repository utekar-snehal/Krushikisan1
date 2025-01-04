<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment Gateway</title>
    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AdljV_N6zYVhqbUhhP3p07UnbGiEG24ze55ooXgxvIvgATldFezwzw-jfFA_mvJETvu4NQIgqshNGSr9&currency=USD"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .payment-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            padding: 20px;
            text-align: center;
        }
        .payment-container h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #007bff;
        }
        .payment-container p {
            font-size: 1rem;
            margin-bottom: 30px;
            color: #555;
        }
        #paypal-button-container {
            margin-top: 20px;
        }
        .success-message, .error-message {
            display: none;
            font-size: 1rem;
            margin-top: 20px;
        }
        .success-message {
            color: #28a745;
        }
        .error-message {
            color: #dc3545;
        }
        .error-details {
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Secure Payment</h1>
        <p>Complete your payment of $10.00 (USD) using PayPal.</p>
        <div id="paypal-button-container"></div>
        <div class="success-message" id="success-message">
            <h3>Payment Successful!</h3>
            <p>Thank you for your payment. Your transaction ID is <span id="transaction-id"></span>.</p>
        </div>
        <div class="error-message" id="error-message">
            <p>Oops! Something went wrong during the payment process. Please try again.</p>
            <div class="error-details" id="error-details"></div>
        </div>
    </div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '1.00',  // Payment amount
                            currency_code: 'USD'  // Currency code changed to USD
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    document.getElementById('success-message').style.display = 'block';
                    document.getElementById('transaction-id').innerText = details.id;
                    console.log('Transaction Successful:', details);
                });
            },
            onError: function(err) {
                document.getElementById('error-message').style.display = 'block';
                document.getElementById('error-details').innerText = `Error: ${err.message || "Unknown error occurred"}`;
                console.error('PayPal Error:', err);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
