<?php
    session_start();
    include_once '../model/dbCrud.php';
    // Limpa todos os dados da sessão e destrói a sessão
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    header("Location: ../view/index.php");
    exit;
?>