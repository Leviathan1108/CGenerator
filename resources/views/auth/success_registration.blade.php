
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #FFFFFF;
            font-family: 'Inter', sans-serif;
        }
        .container {
            position: relative;
            width: 1440px;
            height: 1024px;
            background: #FFFFFF;
        }
        .left-panel {
            position: absolute;
            width: 573px;
            height: 941px;
            left: 54px;
            top: 42px;
            background: #232E66;
            border-radius: 20px;
        }
        .right-panel {
            position: absolute;
            width: 752px;
            height: 941px;
            left: 637px;
            top: 42px;
            background: #FFFFFF;
            border: 1px solid #59666E;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }
        .checkmark {
            width: 119px;
            height: 119px;
            background: #B1CC33;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: #FFFFFF;
        }
        .title {
            font-weight: 800;
            font-size: 40px;
            color: #0279CE;
            margin-top: 30px;
        }
        .message {
            font-weight: 400;
            font-size: 24px;
            color: #000000;
            margin-top: 20px;
            width: 714px;
        }
        .button {
            width: 463px;
            height: 56px;
            margin-top: 20px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
        }
        .login-btn {
            background: #FBB041;
            border: 1px solid #FBB041;
            color: #000000;
        }
        .home-btn {
            background: #FFFFFF;
            border: 1px solid #FBB041;
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel"></div>
        <div class="right-panel">
            <div class="checkmark">✔</div>
            <div class="title">Registration Successful!</div>
            <div class="message">
                Your account has been created successfully. A confirmation email has been sent to your email address.
            </div>
            <a href="#" class="button login-btn">Log in to your account</a>
            <a href="#" class="button home-btn">Back to Home</a>
        </div>
    </div>
</body>
</html>