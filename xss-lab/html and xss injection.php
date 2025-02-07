<?php
// Store the flag in a PHP variable - not visible in source
$hidden_flag = "second_flag{xss_protection_bypassed}";

// Function to reveal flag - only called through XSS
function getFlag() {
    global $hidden_flag;
    return $hidden_flag;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SecureChat Pro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #818cf8;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: var(--bg-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 2rem auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }

        .logo {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .message-board {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            margin: 1.5rem 0;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4b5563;
            font-weight: 500;
        }

        input, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--secondary-color);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        button:hover {
            background: #4338ca;
            transform: translateY(-1px);
        }

        .message {
            background: #f8fafc;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
            border-left: 4px solid var(--secondary-color);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message strong {
            color: var(--primary-color);
        }

        .error {
            color: #ef4444;
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        .debug-info {
            display: none;
        }

        .beta-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }

        .security-info {
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Hidden feature hint */
        .source-hint {
            font-size: 0;
            width: 1px;
            height: 1px;
            display: inline-block;
            overflow: hidden;
            position: absolute;
            border-width: 0;
        }
        .debug-info {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h1>SecureChat Pro <span class="beta-badge">BETA</span></h1>
            <!-- first_flag{inspector_tools_master} -->
        </div>

        <div class="message-board">
            <div class="input-group">
                <label for="username">
                    <i class="fas fa-user"></i> Username
                </label>
                <input type="text" id="username" placeholder="Enter your username">
            </div>
            
            <div class="input-group">
                <label for="message">
                    <i class="fas fa-comment"></i> Message
                </label>
                <textarea id="message" placeholder="Share your thoughts securely..."></textarea>
            </div>
            
            <div class="error" id="error"></div>
            
            <button onclick="postMessage()">
                <i class="fas fa-paper-plane"></i>
                Send Message
            </button>
            
            <div id="messages"></div>
        </div>

        <div class="security-info">
            <i class="fas fa-lock"></i>
            Secured with Advanced Protection™
        </div>

        <div id="flag-container" class="debug-info"></div>
    </div>

    <script>
        function postMessage() {
            let username = document.getElementById('username').value;
            let message = document.getElementById('message').value;
            let error = document.getElementById('error');
            
            // "Security" checks
            if(username.toLowerCase().includes('script')) {
                error.textContent = "⚠️ Username cannot contain 'script' for security reasons";
                return;
            }
            
            if(message.length < 1) {
                error.textContent = "⚠️ Message cannot be empty";
                return;
            }
            
            // Vulnerable message creation
            let messageHTML = `
                <div class="message">
                    <strong>${username}</strong>: ${message}
                </div>
            `;
            
            document.getElementById('messages').innerHTML += messageHTML;
            
            // Clear inputs
            document.getElementById('username').value = '';
            document.getElementById('message').value = '';
            error.textContent = '';
        }

        // Modified debugMode function to fetch flag via AJAX
        function debugMode(key) {
            if(key === 'superadmin') {
                // Make AJAX request to get flag
                fetch('get_flag.php')
                    .then(response => response.text())
                    .then(flag => {
                        document.getElementById('flag-container').style.display = 'block';
                        document.getElementById('flag-container').textContent = flag;
                    });
            }
        }
    </script>
</body>
</html>