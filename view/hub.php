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
        <script src="../assets/scripts/upgradingMechanics.js"></script>
        <script src="../assets/scripts/scriptMovement.js"></script>
        <script src="../assets/scripts/turnSwitch.js"></script>
        <title>FATEC SOULS</title>
        <link rel="icon" type="image/x-icon" href="../assets/backgrounds/darkmoon.ico">
    </head>
    <body>
        <main>
            <header class="header-label">
                <a href="../controller/logoutController.php" class="headerText" id="leave">Sair</a>                    
            </header>
            <div class="horizontal-display">
                <!-- this will be the division for horizontal placing -->
                <div class="char-status">
                    <!-- and this, the division for character status -->
                    <?php
                        echo '<div class="player-status">';
                        echo '<img class="player-image" src="../assets/classes_images/'.$char['caminho'].'">';
                        echo '<table class="player-table">';
                        foreach ($char as $field => $value) {
                            if(
                                $field == 'caminho' ||
                                $field == 'id_personagem' ||
                                $field == 'id_usuario' ||
                                $field == 'id_classe' ||
                                $field == 'id_presente' ||
                                $field == 'data_criacao' ||
                                $field == 'mortes'
                            ) {
                                continue;
                            } 
                            if($field == 'nome_personagem') {
                                echo '<tr><td>Nome: </td<td>'.$value.'</td></tr>';
                                continue;
                            }
                            echo '<tr><td>'.$field.':</td><td class="main-stat" data-stat="'.$field.'">'.$value.'</td></tr>';
                        }
                        echo '</table>';
                        $loads->loadClassWeapon($char['id_classe']);
                        echo '</div>';
                    ?>
                </div>
                <div class="game-area">
                    <div id="dialog-overlay" class="dialog-overlay" style="display:none;">
                        <div class="dialog-box">
                            <span id="dialog-close" class="dialog-close" hidden>&times;</span>
                            <div id="dialog-content" class="dialog-content"></div>
                        </div>
                    </div>
                    <div id="upgrade-overlay" class="upgrade-overlay">
                        <div id="upgrade-box" class="upgrade-box">
                            <p>Almas em posse: <span id="soul-balance" class="soul-balance">0</span>
                            <p>Custo em Almas: <span id="soul-cost" class="soul-cost">0</span></p>
                            <?php $methods->getLevels($_SESSION['characterId']) ?>
                            <button id="set-upgrade" class="set-upgrade">Confirmar</button>
                        </div>
                    </div>
                    <div id="damage-tab" class="damage-tab">
                        <div id="damage-bar" class="damage-bar"></div>
                        <div id="damage-pointer" class="damage-pointer"></div>
                    </div>
                    <div class="player-area" id="player-area">
                        <div class="player" id="player">
                            <p>This is you.</p>
                        </div>

                        <div class="player-actions" id="player-actions">
                            <p>Atacar</p>
                            <p>Item</p>
                            <p>Ação</p>
                            <p style="text-decoration: dashed">Fugir</p>
                        </div>
                        <div class="status-bars">
                            <div class="lifebar-container" id="lifebar-container">
                                <div class="lifebar" id="lifebar"></div>
                            </div>
                            <div class="stamina-container" id="stamina-container">
                                <div class="stamina" id="stamina"></div>
                            </div>
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