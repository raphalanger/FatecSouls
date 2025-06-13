<?php
    session_start();
    if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        $_SESSION['error'] = null;
        header('Location: ../view/login.php');
        exit();
    }
    include_once '../model/connect.php';
    include_once '../model/characterMethods.php';
    $db = new Connect();
    $conn = $db->getConn();
    $char = new CharacterMethods($conn);
    
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/styles/loadGame.css">
        <script src="../view/scriptView.js"></script>
        <title>FATEC SOULS</title>
        <link rel="icon" type="image/x-icon" href="../assets/backgrounds/darkmoon.ico">
    </head>
    <body>
        <header class="headerLabel">
            <p class="headerText">Carregar Jogo</p>
            <div>
                <a href="../view/intermediate.php" class="headerText">Voltar</a>
                <a href="../controller/logoutController.php" class="headerText">Sair</a>                    
            </div>
        </header>
        <main>
            <?php if(isset($_SERVER['error'])): ?> <p class="errorLog"><?php echo $_SERVER['error'] ?></p> <?php endif ?>
            <?php $char->getCharacters() ?>
        </main>
    </body>
</html>