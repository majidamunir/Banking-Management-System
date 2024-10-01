<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Request Rejected</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Loan Request Rejected</h1>
    </div>
    <div class="content">
        <p>Dear {{ $loan->user->name }},</p>
        <p>We regret to inform you that your loan request for an amount of ${{ number_format($loan->amount, 2) }} has been rejected.</p>
        <p>If you have any questions or need further assistance, please contact our support team.</p>
        <p>Thank you for your understanding.</p>
    </div>
    <div class="footer">
        <p>Best Regards, Banking System</p>
    </div>
</div>
</body>
</html>
