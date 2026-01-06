<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کد بازیابی رمز عبور</title>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
        }
        .content {
            padding: 50px 40px;
            text-align: center;
        }
        .content p {
            font-size: 18px;
            line-height: 1.8;
            margin: 20px 0;
        }
        .code-box {
            background: #eff6ff;
            border: 2px dashed #3b82f6;
            border-radius: 16px;
            padding: 30px;
            margin: 40px auto;
            max-width: 300px;
            font-size: 48px;
            font-weight: 700;
            letter-spacing: 15px;
            color: #1e40af;
        }
        .footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
        .footer a {
            color: #3b82f6;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>بازیابی رمز عبور</h1>
    </div>
    <div class="content">
        <p>سلام کاربر عزیز!</p>
        <p>درخواست بازیابی رمز عبور برای حساب شما دریافت شد.</p>
        <p>کد زیر را در صفحه بازیابی وارد کنید:</p>
        <div class="code-box">{{ $code }}</div>
        <p><strong>این کد تا ۱۵ دقیقه معتبر است.</strong></p>
        <p>اگر شما این درخواست را انجام نداده‌اید، این پیام را نادیده بگیرید.</p>
    </div>
    <div class="footer">
        <p>با تشکر از اعتماد شما<br>
            تیم <strong>سیستم امانت‌دهی کالا</strong></p>
        <p><a href="{{ url('/') }}">{{ url('/') }}</a></p>
    </div>
</div>
</body>
</html>
