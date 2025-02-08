<?php
$output = "";
$flag = "CTF{C0mm4nd_1nj3ct10n_1s_d4ng3r0us}";

if (isset($_POST['ip'])) {
    $ip = $_POST['ip'];
    // Intentionally vulnerable command injection
    $output = shell_exec("ping -c 1 " . $ip);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Tools Portal</title>
    <style>
        :root {
            --primary: #1a237e;
            --secondary: #0d47a1;
            --accent: #2962ff;
            --background: #f5f5f5;
            --success: #43a047;
            --error: #d32f2f;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background);
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem 0;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tool-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary);
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: var(--accent);
            outline: none;
        }

        button {
            background: var(--accent);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        button:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .output {
            background: #1e1e1e;
            color: #00ff00;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
            font-family: monospace;
            white-space: pre-wrap;
            display: <?php echo $output ? 'block' : 'none'; ?>;
        }

        .hint {
            text-align: center;
            color: #666;
            margin-top: 1rem;
            font-style: italic;
        }

        .tools-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .tool-item {
            background: rgba(41, 98, 255, 0.1);
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="animate">
            <h1>Network Tools Portal</h1>
            <p>Professional network diagnostics tools</p>
        </header>

        <div class="tool-card animate">
            <h2>Ping Test Tool</h2>
            <p>Enter an IP address or domain to test connectivity:</p>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="ip">IP Address / Domain:</label>
                    <input type="text" id="ip" name="ip" placeholder="e.g., 127.0.0.1" required>
                </div>
                <button type="submit">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.242-4.242 3 3 0 00-4.242 4.242z"/>
                    </svg>
                    Run Test
                </button>
            </form>

            <?php if ($output): ?>
                <div class="output animate">
                    <?php echo htmlspecialchars($output); ?>
                </div>
            <?php endif; ?>

            <div class="hint">
                <p>Try running some basic network diagnostics...</p>
            </div>
        </div>

        <div class="tool-card animate">
            <h2>Available Tools</h2>
            <div class="tools-list">
                <div class="tool-item">Ping Test</div>
                <div class="tool-item">Traceroute</div>
                <div class="tool-item">DNS Lookup</div>
                <div class="tool-item">Port Scanner</div>
            </div>
        </div>
    </div>

    <!-- Hidden flag in HTML comment -->
    <!-- Debug: Secret flag location - check /etc/flag.txt -->
</body>
</html>