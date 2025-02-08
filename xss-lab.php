<?php
// Hidden flag in PHP variable
$flag = "FLAG{xss_1s_fun_2024}";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    
    // If specific JavaScript is executed, set a flag_visible cookie
    if (isset($_POST['flag_check']) && $_POST['flag_check'] === 'correct_value') {
        setcookie('flag_visible', 'true', time() + 3600, '/');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Message Board</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .message-box {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border: 1px solid #ddd;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
        }
        button {
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Message Board</h1>
    
    <form method="POST">
        <input type="text" name="message" placeholder="Enter your message">
        <button type="submit">Post</button>
    </form>

    <?php if (isset($message)): ?>
        <div class="message-box">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <script>
        function checkFlag() {
            if (typeof specialValue !== 'undefined' && specialValue === '1337') {
                let form = document.createElement('form');
                form.method = 'POST';
                let input = document.createElement('input');
                input.name = 'flag_check';
                input.value = 'correct_value';
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <?php
    // Only show flag if the correct cookie is set
    if (isset($_COOKIE['flag_visible']) && $_COOKIE['flag_visible'] === 'true') {
        echo "<div class='message-box'>Congratulations! Here's your flag: " . $flag . "</div>";
    }
    ?>
</body>
</html>