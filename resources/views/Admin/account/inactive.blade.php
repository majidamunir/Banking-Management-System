<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account Request Has Been Rejected</title>
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

        .highlight {
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Your Account Request Has Been Rejected</h1>
    </div>
    <div class="content">
        <p>Dear {{ $account->user->name }},</p>
        <p>We regret to inform you that your request to create a <span class="highlight">{{ $account->account_type }}</span> account has been rejected.</p>
        <p>This decision may have been influenced by various factors, including but not limited to our current account policy, verification issues, or incomplete documentation. We understand this news may be disappointing, and we want to assure you that we review all requests thoroughly to ensure compliance with our standards.</p>
        <p>If you believe this decision was made in error or if you have any further questions regarding the rejection, please do not hesitate to reach out to our support team. We are here to assist you and provide any clarification you may need.</p>
        <p>Thank you for your understanding and cooperation. We value your interest in our services and encourage you to contact us for any further assistance or to discuss possible next steps.</p>
    </div>
    <div class="footer">
        <p>&copy; Banking System Management. All rights reserved.</p>
    </div>
</div>
</body>

</html>
