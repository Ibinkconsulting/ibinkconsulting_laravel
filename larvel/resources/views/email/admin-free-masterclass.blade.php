<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Free Masterclass Request</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 32px 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 32px 28px;
            color: #333;
            line-height: 1.6;
            font-size: 16px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
        }
        .details-table th,
        .details-table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .details-table th {
            background: #f9fafb;
            font-weight: 600;
            width: 35%;
            color: #1f2937;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .button {
            display: inline-block;
            margin-top: 16px;
            padding: 12px 28px;
            background: #6366f1;
            color: white !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
        }
        .button:hover {
            background: #4f46e5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Free Masterclass Request</h1>
        </div>

        <div class="content">
            <p>Hello Admin,</p>
            <p>A new user has requested access to the <strong>Free Masterclass</strong>. Here are the details:</p>

            <table class="details-table">
                <tr>
                    <th>Name</th>
                    <td>{{ $free_masterclass->name ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $free_masterclass->email }}</td>
                </tr>
            </table>

            <p>You can contact the user directly or manage this request from the admin panel.</p>

        </div>

        <div class="footer">
            © {{ date('Y') }} IBink Consulting<br>
        </div>
    </div>
</body>
</html>