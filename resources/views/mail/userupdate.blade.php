<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Data Updated</title>
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.4;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .emoji {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .message {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        .body {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: left;
        }

        .cta {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FFD60A;
            color: #000000;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .support {
            font-size: 14px;
            color: #999999;
            margin-top: 20px;
        }

        .highlight {
            font-weight: bold;
            color: #FF4500;
        }

        .image-section {
            margin-top: 30px;
            text-align: center;
        }

        .image-section img {
            height:250px;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
         <img src="https://github.com/Mr-Yash-beldar/SE-Practical/blob/main/security-image.png?raw=true" height="260px" alt="Security Update" border="0">
        <div class="emoji">🔒</div>
        <div class="message">{{$maildata['message']}}</div>
        <div class="body">
            <p>Dear <b>{{$maildata['username']  }}</b>,</p>
            <p>We're writing to let you know that your user data has been successfully updated. Your <strong>name</strong> and <strong>password</strong> have been changed. 🛠️</p>
            <p>If you didn't request this change, please contact us immediately to secure your account.</p>
        </div>
        <div class="image-section">
            <img src="https://github.com/Mr-Yash-beldar/SE-Practical/blob/main/thank-you-passvoult.png?raw=true"  width="300" alt="Thank You">
        </div>
        <div class="support">If you have any questions or need assistance, feel free to reach out to us at <a href="mailto:yashodipbeldar@gmail.com">Pass Voult Support</a>. We're here to help! 😊</div>
        <img style="margin-top: 10px;" src="https://github.com/Mr-Yash-beldar/SE-Practical/blob/main/logo.png?raw=true" alt="Code Slayers" border="0" height="120" width="210">
        <p style="font-weight: 400; font-size: 10px;">Developed By Team Code Slayers</p>
    </div>
</body>

</html>
