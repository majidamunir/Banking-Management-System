<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            overflow: hidden;
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
        }
        .email-body h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .email-body p {
            margin: 0 0 15px;
        }
        .email-body .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .email-footer {
            background-color: #f1f1f1;
            color: #666;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Loan Approved</h1>
    </div>
    <div class="email-body">
        <p>Dear {{ $loan->user->name }},</p>
        <p>Congratulations! Your loan request of ${{ $loan->amount }} has been approved.</p>
        <p><strong>Loan Details:</strong></p>
        <ul>
            <li><strong>Amount:</strong> ${{ $loan->amount }}</li>
            <li><strong>Interest Rate:</strong> {{ $loan->interest_rate }}%</li>
            <li><strong>Start Date:</strong> {{ $loan->start_date }}</li>
            <li><strong>End Date:</strong> {{ $loan->end_date }}</li>
        </ul>
        <p>Thank you for choosing our services. If you have any questions, feel free to contact us.</p>
        <a href="{{ route('loans.show', $loan->id) }}" class="button">View Loan Details</a>
    </div>
    <div class="email-footer">
        <p>&copy; 2024 Banking System. All Rights Reserved.</p>
    </div>
</div>
</body>
</html>
