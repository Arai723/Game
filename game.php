<?php
header('ngrok-skip-browser-warning: true');
session_start();

// ตรวจสอบว่า login แล้วหรือยัง (เช็ค session)
if ( !isset($_SESSION['name']) ) {
    die("Name parameter missing");
}

$name  = $_SESSION['name'];
$names = array('Rock', 'Paper', 'Scissors');

// Logout
if ( isset($_POST['logout']) ) {
    session_destroy();
    header('Location: index.php');
    return;
}

// Computer random
$computer = rand(0, 2);
$human    = isset($_POST['human']) ? $_POST['human'] + 0 : -1;

function check($computer, $human) {
    if ( $human == $computer ) {
        return "Tie";
    } else if ( ($human == 0 && $computer == 1) ||
                ($human == 1 && $computer == 2) ||
                ($human == 2 && $computer == 0) ) {
        return "You Lose";
    } else {
        return "You Win";
    }
}

$result = ($human >= 0 && $human <= 2) ? check($computer, $human) : "";
$isTest = ($human == 3);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> 739ea849 Phontanasak Kamfak Rock Paper Scissors - Game</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 520px; margin: 40px auto; background: #f5f5f5; color: #333; }
        h1 { color: #2c3e50; }
        select, input[type=submit] { padding: 8px 14px; font-size: 15px; border-radius: 6px; border: 2px solid #ccc; margin: 6px 4px; cursor: pointer; }
        input[type=submit] { background: #2c3e50; color: #fff; border: none; }
        input[type=submit]:hover { background: #34495e; }
        .logout-btn { background: #e74c3c !important; }
        .result { padding: 14px 18px; border-radius: 8px; font-size: 18px; font-weight: bold; margin: 16px 0; background: #fff; border-left: 5px solid #3498db; }
        pre { background: #2c3e50; color: #2ecc71; padding: 16px; border-radius: 8px; font-size: 13px; line-height: 1.8; }
    </style>
</head>
<body>
    <h1>Rock Paper Scissors</h1>
    <p>Welcome, <strong><?php echo htmlspecialchars($name); ?></strong></p>

    <form method="POST" action="game.php">
        <select name="human">
            <option value="0">Rock</option>
            <option value="1">Paper</option>
            <option value="2">Scissors</option>
            <option value="3">Test</option>
        </select>
        <input type="submit" value="Play">
        <input type="submit" name="logout" value="Logout" class="logout-btn">
    </form>

    <?php if ( $isTest ): ?>
        <h3>Test Results:</h3>
        <pre><?php
        for ( $c = 0; $c < 3; $c++ ) {
            for ( $h = 0; $h < 3; $h++ ) {
                $r = check($c, $h);
                print "Human={$names[$h]} Computer={$names[$c]} Result=$r\n";
            }
        }
        ?></pre>

    <?php elseif ( $result !== "" ): ?>
        <div class="result">
            Your Play=<?php echo $names[$human]; ?> Computer Play=<?php echo $names[$computer]; ?> Result=<?php echo $result; ?>
        </div>
    <?php endif; ?>

</body>
</html>