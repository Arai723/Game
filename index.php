<?php
header('ngrok-skip-browser-warning: true');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>739ea849 Phontanasak Kamfak Rock Paper Scissors</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 60px auto; background: #f5f5f5; color: #333; text-align: center; }
        h1 { color: #2c3e50; }
        a { display: inline-block; margin: 10px; padding: 10px 24px; background: #2c3e50; color: #fff; border-radius: 6px; text-decoration: none; }
        a:hover { background: #34495e; }
    </style>
</head>
<body>
    <h1>Rock Paper Scissors</h1>
    <p>by Phontanasak Kamfak</p>
    <?php if ( isset($_SESSION['name']) ): ?>
        <p>Welcome back, <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong>!</p>
        <a href="game.php?name=<?php echo urlencode($_SESSION['name']); ?>">Play Game</a>
    <?php else: ?>
        <p>Please log in to play.</p>
        <a href="login.php">Please Log In</a>
    <?php endif; ?>
</body>
</html>