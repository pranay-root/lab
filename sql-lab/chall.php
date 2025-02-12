<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$db_host = 'localhost';
$db_user = 'u200076004_cyber';
$db_pass = 'watchdogs1@Ap';
$db_name = 'u200076004_ctf';

$message = '';

// Connect to database
try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            $message = "Login failed!";
        }
    }
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CTF SQL Injection Challenge</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        button:hover {
            background: #2980b9;
        }
        
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .hint {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #3498db;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>SecureBank Login</h2>
        
        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        
        <div class="hint">
            <strong>Hint:</strong> Sometimes the simplest SQL tricks are the most effective.
        </div>
    </div>
</body>
</html>