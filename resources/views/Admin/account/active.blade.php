<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account Has Been Activated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
        }

        .footer {
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Your Account Has Been Activated</h1>
    </div>
    <div class="content">
        <p>Dear {{ $account->user->name }},</p>
        <p>Your account with the type <strong>{{ $account->account_type }}</strong> has been successfully activated.</p>
        <p>Thank you for using our services.</p>
    </div>
    <div class="footer">
        <p>&copy; Banking System Management. All Rights Reserved.</p>
    </div>
</div>
</body>

</html>
