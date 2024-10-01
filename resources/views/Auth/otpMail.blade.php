<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #13149f;
            color: #fff;
            padding: 15px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #13149f;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Your OTP Code</h1>
    </div>
    <div class="email-body">
        <p>Your OTP Code is:</p>
        <p class="otp-code">{{ $otp }}</p>
        <p>The code is valid for 10 minutes.</p>
    </div>
    <div class="footer">
        <p>Thank you For Using Our Service.</p>
    </div>
</div>
</body>
</html>
