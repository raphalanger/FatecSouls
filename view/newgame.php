<?php
    session_start();
    if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        $_SESSION['error'] = null;
        header('Location: ../view/login.php');
        exit();
    }
    include_once '../model/dbCrudLoad.php';
    include_once '../model/dbCrudLogin.php';
    $fnc = new DatabaseFunctions();
    $model = new DatabaseLoadFunctions($fnc->connect());
    $classId = isset($_GET['idClass']) ? $_GET['idClass'] : 1;
    $model->loadFields($classId);

    $model->searchNomeArma($classId);
    $model->searchNomeArmadura($classId);
    $model->setScaling($classId);
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../view/styleView2.css">
        <script src="../view/scriptView.js"></script>
        <title>FATEC SOULS</title>
        <link rel="icon" type="image/x-icon" href="../assets/backgrounds/darkmoon.ico">
    </head>
    <body>
        <header>
            <p class="headerText">Iniciar Jogo</p>
            <div>
                <a href="../view/intermediate.php" class="headerText">Voltar</a>
                <a href="../controller/logoutController.php" class="headerText">Sair</a>                    
            </div>
        </header>
        <main>
            <form class="formChar" action="../controller/characterController.php" method="POST">
                <div class="charForm">
                    <div class="inputs">
                        <label for="name" class="generalText">Nome</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="inputs">
                        <label for="gift" class="generalText">Presente Fúnebre</label>
                        <select id="gift" name="gift" required>
                            <?php $model->getBurialGifts(); ?>
                        </select>
                    </div>
                    <div class="classAttributes">
                        <div>
                            <input readonly class="selectedClass" value=<?php echo $model->getNome(); ?>></input>
                            <input hidden name="class" value=<?php echo $classId ?>></input>
                            <?php $model->loadClassInfo($classId); ?>
                        </div>
                        <div>
                            <p style="color: white; font-family:'Optimus Princeps';"><?php echo $model->getArmadura() ?></p>
                            <table class="weaponScaling">
                                <tr><th style="color: white; font-family: 'Optimus Princeps'; font-weight: lighter; font-style: normal" colspan=3><?php echo $model->getArma() ?></th></tr>
                                <?php $model->getScaling() ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="classInfo">
                    <div class="classImage">
                        <img src="<?php echo $model->getPath(); ?>" class="imgClass" id="imgClass" name="imgClass">
                        <div class="classButtons">
                            <button class="classSelector" id="prevClass" type="button"><</button>
                            <input readonly class="selectedClass" id="selectedClass" value=<?php echo $model->getNome(); ?>></input>
                            <button class="classSelector" id="nextClass" type="button">></button>
                        </div>
                        <div>
                            <?php $model->loadClassInfo($classId); ?>
                        </div>
                    </div> 
                    <div class="classWeapon">
                        <?php $model->loadClassWeapon($classId); ?>
                    </div>
                    <div class="classArmor">
                        <?php $model->loadClassArmor($classId); ?>
                    </div>
                </div>
                <br>
                <button class="confirmChar" type="submit">CONFIRMAR</button>
            </form>
            <?php if(isset($_SESSION['error_loadclass'])): ?>
                <p class="errorLoadClass"><?php echo $_SESSION['error_loadclass'] ?></p>
            <?php endif; ?>
        </main>
    </body>
</html>