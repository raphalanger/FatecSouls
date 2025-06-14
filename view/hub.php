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
    include_once '../model/connect.php';
    $connection = new Connect();
    $conn = $connection->getConn();
    include_once '../model/characterMethods.php';
    $methods = new CharacterMethods($conn);
    include_once '../model/dbCrudLoad.php';
    $loads = new DatabaseLoadFunctions($conn);
    $boss = $methods->getSpecificBoss(1);
    $bossWeapon = $methods->getWeapon($boss['id_arma']);
    $char = $methods->getSpecificChar($opc);
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
        <main>
            <header class="header-label">
                <a href="../controller/logoutController.php" class="headerText">Sair</a>                    
            </header>
            <div class="horizontal-display">
                <!-- this will be the division for horizontal placing -->
                <div class="char-status">
                    <!-- and this, the division for character status -->
                    <?php
                        foreach ($char as $field => $value) {
                            echo $field . $value . "\n";
                        }
                        $loads->loadClassWeapon($char['id_classe']);
                    ?>
                </div>
                <div class="game-area">
                    <div class="player-area" id="player-area">
                        <div class="player" id="player">
                            <p>This is you.</p>
                        </div>
                    </div>
                </div>
                <div class="oponent-status">
                    <!-- and last, but not least, this will be the division for oponent status -->
                    <?php 
                        echo "<div class='boss-frame'> <img class='boss-image' src='../assets/classes_images/" . $boss['imagem'] . "'></div>";
                        echo '<div class="boss-stats">';
                        foreach ($boss as $field => $value) {
                            if($field == "nome_chefe")
                                echo '<h3>'.$value.'</h3>';
                            if($field == "vida")
                                echo '<h4>Vida: '.$value.'</h4>';
                        }
                        echo '</div>';
                        echo '<div class="boss-weapon">
                                <table>
                                    <tr><td>'.$bossWeapon['nome_arma'].' :</td>
                                    <td>'.$bossWeapon['tipo'].'</tr>
                                </table>
                            </div>';
                        
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>