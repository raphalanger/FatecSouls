<?php
    session_start();
    if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        $_SESSION['error'] = null;
        header('Location: ../view/login.php');
        exit();
    }

    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $opc = $_POST['char'];
        $_SESSION['characterId'] = $opc;
        //echo '<h2>'.$opc.'</h2>'; // debug
    }
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/styles/gameView.css">
        <script src="../assets/scripts/scriptMovement.js"></script>
        <title>FATEC SOULS</title>
        <link rel="icon" type="image/x-icon" href="../assets/backgrounds/darkmoon.ico">
    </head>
    <body>
        <div class="player-area" id="player-area">
            <div class="player" id="player">
                <p>This is you.</p>
            </div>
        </div>
    </body>
</html>