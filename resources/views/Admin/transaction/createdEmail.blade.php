<!DOCTYPE html>
<html>
<head>
    <title>Your Transaction has been Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333333;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            padding: 20px;
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .email-content {
            padding: 20px;
        }
        .email-content p {
            margin: 0 0 10px;
        }
        .email-content ul {
            list-style-type: none;
            padding: 0;
        }
        .email-content ul li {
            padding: 5px 0;
        }
        .email-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>Your Transaction has been Created</h2>
    </div>
    <div class="email-content">
        <p>Hello <strong>{{ $transaction->account->user->name }}</strong>,</p>
        <p>Your Transaction Has Been Successfully Created.</p>
        <p><strong>Transaction Details:</strong></p>
        <ul>
            <li><strong>Amount:</strong> {{ $transactionAmount }}</li>
            <li><strong>Type:</strong> {{ $transactionType }}</li>
            <li><strong>Date:</strong> {{ $transactionDate }}</li>
        </ul>
        <p>Thank You For Banking With Us!</p>
    </div>
    <div class="email-footer">
        <p>&copy; 2024 Banking System. All Rights Reserved.</p>
    </div>
</div>
</body>
</html>
