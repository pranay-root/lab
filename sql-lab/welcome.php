<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

// Get the query used (for educational purposes)
$query = isset($_SESSION['query']) ? $_SESSION['query'] : 'No query available';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome - SecureBank CTF</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --success-color: #2ecc71;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            box-sizing: border-box;
        }

        .success-banner {
            background: rgba(46, 204, 113, 0.2);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            color: white;
            margin-bottom: 30px;
            text-align: center;
        }

        .content-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        h1, h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .content-box h2 {
            color: var(--primary-color);
        }

        .flag-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }

        .flag {
            font-family: monospace;
            font-size: 1.2em;
            color: var(--accent-color);
            padding: 10px;
            background: #eee;
            border-radius: 4px;
            display: inline-block;
        }

        .query-section {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid var(--accent-color);
        }

        .query-code {
            font-family: monospace;
            background: #eee;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }

        .logout-btn {
            background-color: var(--accent-color);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-banner">
            <h1>🎉 Congratulations!</h1>
            <p>You've successfully completed the SQL Injection Challenge</p>
        </div>
        
        <div class="content-box">
            <h2>Mission Accomplished</h2>
            
            <div class="flag-section">
                <h3>Here's your flag:</h3>
                <div class="flag">FLAG{SQL_MASTER_2024}</div>
            </div>
            
            <div class="query-section">
                <h3>Your Successful Query:</h3>
                <div class="query-code">
                    <?php echo htmlspecialchars($query); ?>
                </div>
                <p>Understanding what made this query work is key to learning about SQL injection vulnerabilities.</p>
            </div>
            
            <div style="text-align: center;">
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>