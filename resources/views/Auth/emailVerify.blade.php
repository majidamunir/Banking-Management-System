<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #13149f;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin: 20px 0;
            line-height: 1.6;
        }
        .content p {
            margin: 0 0 10px;
        }
        .footer {
            text-align: center;
            font-size: 0.875rem;
            color: #6c757d;
            padding: 10px 0;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Registration Successful</h1>
    </div>
    <div class="content">
        <p>Dear {{ $name }},</p>
        <p>Thank you for registering with us. Your account has been successfully created.</p>
        <p>You can now log in to access your dashboard and start using our services.</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} Banking System. All Rights Reserved.</p>
    </div>
</div>
</body>
</html>
