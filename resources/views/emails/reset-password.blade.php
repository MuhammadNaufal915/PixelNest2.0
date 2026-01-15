<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - PixelNest</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #050505;
            color: #ffffff;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #050505;
            padding-bottom: 60px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #0f0f0f;
            border: 1px solid #1f1f1f;
            border-radius: 32px;
            margin-top: 40px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .header {
            padding: 40px 0;
            text-align: center;
            background: linear-gradient(180deg, #161616 0%, #0f0f0f 100%);
            border-bottom: 1px solid #1f1f1f;
        }
        .logo-circle {
            width: 60px;
            height: 60px;
            background-color: #ffffff;
            border-radius: 16px;
            display: inline-block;
            line-height: 60px;
            margin-bottom: 15px;
        }
        .logo-text {
            color: #000000;
            font-size: 32px;
            font-weight: 800;
        }
        .brand-name {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #ffffff;
            display: block;
        }
        .content {
            padding: 50px 40px;
            text-align: center;
        }
        h1 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: -1px;
            line-height: 1.2;
        }
        p {
            font-size: 16px;
            line-height: 1.7;
            color: #999999;
            margin-bottom: 30px;
        }
        .button-wrapper {
            margin: 40px 0;
        }
        .button {
            background-color: #ffffff;
            color: #000000 !important;
            padding: 20px 45px;
            border-radius: 18px;
            font-size: 17px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 10px 25px rgba(255,255,255,0.1);
        }
        .divider {
            height: 1px;
            background-color: #1f1f1f;
            margin: 40px 0;
        }
        .info-card {
            background-color: #161616;
            border: 1px solid #262626;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
        }
        .info-card h4 {
            margin: 0 0 10px 0;
            color: #ffffff;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .info-card p {
            margin: 0;
            font-size: 14px;
            color: #666666;
            line-height: 1.5;
        }
        .footer {
            padding: 40px;
            text-align: center;
        }
        .footer p {
            font-size: 13px;
            color: #444444;
            margin-bottom: 10px;
        }
        .social-links {
            margin-bottom: 20px;
        }
        .social-links a {
            color: #666666;
            margin: 0 10px;
            text-decoration: none;
        }
        .raw-link {
            font-size: 13px;
            color: #444444;
            word-break: break-all;
            margin-top: 20px;
        }
        .raw-link a {
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="logo-circle">
                    <span class="logo-text">P</span>
                </div>
                <span class="brand-name">PixelNest</span>
            </div>
            
            <div class="content">
                <h1>Secure password reset.</h1>
                <p>Hi {{ $name }}, we received a request to reset your password. No changes have been made yet. Click the button below to proceed.</p>
                
                <div class="button-wrapper">
                    <a href="{{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}" class="button">
                        Design a New Password
                    </a>
                </div>

                <div class="info-card">
                    <h4>Security Note</h4>
                    <p>This link is only valid for the next 60 minutes. If you didn't request this code, you can safely ignore this email.</p>
                </div>

                <div class="divider"></div>
                
                <p style="font-size: 13px; margin-bottom: 10px;">If link doesn't work, copy this to your browser:</p>
                <div class="raw-link">
                    <a href="{{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}">
                        {{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}
                    </a>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} PixelNest Collective. All rights reserved.</p>
            <p>Singapore • San Francisco • Jakarta</p>
        </div>
    </div>
</body>
</html>
