<?php
    session_start();
    if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        header('Location: ../view/home.php');
        exit();
    }
?>
<!DOCTYPE html>
    <head>
        <meta lang="pt-br">
        <link rel="stylesheet" href="styleView.css">
        <script src="scriptView.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <title>FATEC SOULS</title>
        <link rel="icon" type="image/x-icon" href="../assets/backgrounds/darkmoon.ico">
    </head>
    <body>
        <div class="container">
            <p class="outdoor">FATEC SOULS</p>
            <?php if (isset($_SESSION['error'])): ?>
                <p class="error"><?php echo $_SESSION['error']; ?></p>
            <?php endif; ?>
            <form action="../controller/loginController.php" method="POST">
                <div class="textbox">
                    <input type="text" placeholder="Usuário" name="username" required>
                    <br>
                    <div class="pwd-container">
                        <input type="password" placeholder="Senha" name="password" id="pwd" required>
                        <button type=button class="pwd_btn" id="pwd_btn">🎇</button>
                    </div>
                </div>
                <p class="fakelink" id="fakelink">Não possuo uma conta.</p>
                <input type="hidden" name="authType" id="authType" value="login">
                <button type="submit" class="next_btn">AVANÇAR</button>
            </form>
        </div>
    </body>
</html>