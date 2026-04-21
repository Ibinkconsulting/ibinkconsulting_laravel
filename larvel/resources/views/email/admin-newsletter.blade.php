<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Newsletter Subscriber</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 20px;
    }
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .header {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
    }
    .subscriber-details {
      font-size: 16px;
      line-height: 1.5;
      color: #555;
      margin: 20px 0;
    }
    .subscriber-details table {
      width: 100%;
      border-collapse: collapse;
    }
    .subscriber-details th,
    .subscriber-details td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }
    .subscriber-details th {
      font-weight: bold;
      width: 30%;
      color: #333;
    }
    .footer {
      text-align: center;
      font-size: 14px;
      color: #aaa;
      margin-top: 20px;
    }
    .action-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #ff6f61;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">New Newsletter Subscriber</div>
    <div class="subscriber-details">
      <p>Hello Admin,</p>
      <p>A new user has subscribed to the newsletter. Here are the details:</p>
      <table>
        <tr>
          <th>Email</th>
          <td>{{ $subscriber->email }}</td>
        </tr>
        <tr>
          <th>Subscribed At</th>
          <td>{{ $subscriber->subscribed_at?->format('M d, Y H:i') ?? 'Just now' }}</td>
        </tr>
      </table>
    </div>
    <div class="footer">
      Thank you for your attention.<br>
    </div>
  </div>
</body>
</html>