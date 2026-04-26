<?php
header('ngrok-skip-browser-warning: true');
session_start();

$salt   = "XyZzy12*&";
$stored = sha1($salt . "1234"); // password คือ 1234
$error  = "";

if ( isset($_POST['name']) && isset($_POST['password']) ) {
    $name     = trim($_POST['name']);
    $password = trim($_POST['password']);

    if ( strlen($name) < 1 || strlen($password) < 1 ) {
        $error = "Email and password are required";
    } else {
        $check = sha1($salt . $password);
        if ( $check === $stored ) {
            $_SESSION['name'] = $name;
            header("Location: game.php?name=" . urlencode($name));
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
    <title>739ea849 Phontanasak Kamfak Rock Paper Scissors</title>
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
        <label>Name/Email:</label>
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        <label>Password:</label>
        <input type="password" name="password">
        <input type="submit" value="Log In">
    </form>
    <p style="font-size:13px; color:#999; margin-top:16px;">Password hint: 1234</p>
</body>
</html>