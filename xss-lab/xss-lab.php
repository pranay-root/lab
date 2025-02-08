<?php
// Store flag in PHP variable
$flag = "FLAG{xss_1s_fun_2024}";
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = isset($_POST['message']) ? $_POST['message'] : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colorful XSS Challenge</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
            box-sizing: border-box;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #4a154b;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .message-form {
            margin-bottom: 30px;
        }

        input[type="text"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #a777e3;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #6e8efb;
            box-shadow: 0 0 10px rgba(110, 142, 251, 0.3);
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #6e8efb, #a777e3);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .message-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border: 2px solid #e1e1e1;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .message-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .hint {
            text-align: center;
            color: #666;
            margin-top: 20px;
            font-style: italic;
        }

        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 XSS Challenge 🎯</h1>
        
        <div class="message-form">
            <form method="POST">
                <input type="text" name="message" placeholder="Enter your magical message here...">
                <button type="submit">Post Message ✨</button>
            </form>
        </div>

        <?php if ($message): ?>
            <div class="message-box">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="hint">
            Can you find the hidden treasure? 🗝️
        </div>
    </div>

    <script>

        function getFlag() {
            return '<?php echo $flag; ?>';
        }
    </script>
</body>
</html>