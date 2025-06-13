<?php 
    session_start();
    $_SESSION['error'] = null;
    include_once '../model/dbCrudLogin.php';
    $red = new DatabaseFunctions();
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
                <button type="submit" name="jogar" class="outdoorButton">jogar</button>
            </form>
        </div>
        <?php 
            if(isset($_POST['jogar']) && $_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $res = $red->verifyLogin();
                if($res) {
                    header('Location: ../view/intermediate.php');
                    exit;
                }
                else {
                    header('Location: ../view/login.php');
                    exit;
                }
            }
        ?>
    </body>
</html>