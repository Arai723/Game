<?php
header('ngrok-skip-browser-warning: true');
session_start();

// Salt และ stored hash ตามที่ spec กำหนด
$salt        = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
$error       = '';

if ( isset($_POST['who']) ) {
    $who  = trim($_POST['who']);
    $pass = trim($_POST['pass']);

    if ( strlen($who) < 1 || strlen($pass) < 1 ) {
        $error = "User name and password are required";
    } else {
        $check = hash('md5', $salt . $pass);
        if ( $check === $stored_hash ) {
            $_SESSION['name'] = $who;
            header("Location: game.php?name=" . urlencode($who));
            return;
        } else {
            $error = "Incorrect password";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>739ea849 Phontanasak Kamfak Rock Paper Scissors - Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 420px; margin: 60px auto; background: #f5f5f5; color: #333; }
        h1 { color: #2c3e50; }
        input[type=text], input[type=password] { width: 100%; padding: 10px; margin: 8px 0; border: 2px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 15px; }
        input[type=submit] { width: 100%; padding: 10px; background: #2c3e50; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; margin-top: 8px; }
        input[type=submit]:hover { background: #34495e; }
        .error { background: #fdecea; color: #c0392b; padding: 10px; border-radius: 6px; margin-bottom: 12px; border-left: 4px solid #e74c3c; }
        label { font-weight: bold; color: #555; font-size: 14px; }
    </style>
</head>
<body>
    <h1>Login</h1>
    <?php if ( $error ): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <label>Name:</label>
        <input type="text" name="who">
        <label>Password:</label>
        <input type="password" name="pass">
        <input type="submit" value="Log In">
    </form>
</body>
</html>