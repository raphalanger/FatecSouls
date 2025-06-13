<?php 
    session_start();
    if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        $_SESSION['error'] = null;
        header('Location: ../view/login.php');
        exit();
    }
    include_once '../model/dbCrudLogin.php';
    $red = new DatabaseFunctions();
    $red->connect();

    include_once '../model/dbCrudLoad.php';
    $mtds = new DatabaseLoadFunctions($red->getConn());
    $load = $mtds->checkGames($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleView.css">
        <script src="scriptView.js"></script>
        <title>FATEC SOULS</title>
        <link rel="icon" type="image/x-icon" href="../assets/backgrounds/darkmoon.ico">
    </head>
    <body>
        <div class="container">
            <p class="outdoor">FATEC SOULS</p>
            <form method="POST">
                <button type="submit" name="iniciar" class="simpleButton" <?php if($load == 4): ?> disabled <?php endif ?>>Iniciar Jogo</button><br>
                <button type="submit" name="carregar" class="simpleButton" <?php if ($load == 0): ?> disabled <?php endif ?>>Carregar Jogo</button><br>
                <button type="submit" name="sair" class="simpleButton">Sair</button><br>
            </form>
            <?php if(isset($_SESSION['error']))
            echo "<p style='color: red; font-family: 'Optimus Princeps';>".$_SESSION['error']."</p>"; ?>
        </div>

        <?php
            if(isset($_POST['iniciar'])) {
                // ir pra outra pagina 
                // criar personagem
                header('Location: ../view/newgame.php');
                exit;
            }
            else if(isset($_POST['carregar'])) {
                // ir pra outra pagina
                // exibir os saves
                header('Location: ../view/loadgame.php');
                exit;

            } else if(isset($_POST['sair'])) {
                // logout simples
                header('Location: ../controller/logoutController.php');
                exit;
            }
        ?>
    </body>
</html>