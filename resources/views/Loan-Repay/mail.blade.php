<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Submission Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 24px;
        }
        p {
            color: #555555;
            line-height: 1.6;
            font-size: 16px;
        }
        .highlight {
            color: #d9534f;
            font-weight: bold;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 12px 24px;
            background-color: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .button:hover {
            background-color: #4cae4c;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body>
<div class="email-container">
    <h1>Loan Submission</h1>
    <p>Dear <span class="highlight">Customer</span>,</p>
    <p>This is a reminder that you have a loan submission deadline coming up for the amount of <span class="highlight">${{ $loanAmount }}</span>. The deadline is on <span class="highlight">{{ $endDate }}</span>.</p>
    <p>Please make sure to submit your loan on time to avoid any late fees or penalties.</p>

    <p>Thank you!</p>
    <div class="footer">
        <p>&copy; 2024 Banking Management System. All Rights Reserved.</p>
    </div>
</div>
</body>
</html>

