<?php
    include_once '../model/connect.php';
    $conn = new Connect;
    include_once '../model/characterMethods.php';
    $method = new CharacterMethods($conn->getConn());
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['char'];
        $val = $_POST['val'];
        echo $id.' '.$val;
        $method->deleteCharacter($id);
        header('Location: ../view/loadgame.php');
    }
?>