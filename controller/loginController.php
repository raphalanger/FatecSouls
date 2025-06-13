<?php
    // aqui deve vir a logica de verificacao (metodos do model + dados do view);
    session_start();
    include_once '../model/dbCrudLogin.php';
    $dbCrud = new DatabaseFunctions();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        //$email = $_POST['email'];
        $password = $_POST['password'];
        $authType = $_POST['authType'];
        // isso deve ser definido após a verificação no banco
        $conn = $dbCrud->connect();
        if($conn == null) {
            $_SESSION['error'] = "Erro ao conectar ao banco de dados";
            header('Location: ../view/login.php');
            exit();
        } else {
            if($authType == 'login') {
                $dbCrud->setFields("nome", "senha", $username, $password);
                if($dbCrud->read()) {
                    $_SESSION['authenticated'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['error'] = null;
                    header('Location: ../view/intermediate.php');
                    exit();
                } else {
                    $_SESSION['error'] = "Usuário ou senha incorretos.";
                    header('Location: ../view/login.php');
                    exit();
                }
            }
            else if($authType == 'register') {
                $dbCrud->setFields("nome", "senha", $username, $password);
                if ($dbCrud->create()) {
                    $_SESSION['authenticated'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['error'] = null;
                    header('Location: ../view/intermediate.php');
                    exit();
                } else {
                    header('Location: ../view/login.php');
                    exit();
                }
            }
        }
    }
?>