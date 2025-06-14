<?php
    session_start();
    include_once '../model/connect.php';
    $db = new Connect();
    $conn = $db->getConn();

    include_once '../model/characterMethods.php';
    $mts = new CharacterMethods($conn);
    $img = $mts->searchImg($_SESSION['characterId']);
    $imgPath = "../assets/classes_images/" . $img;
    header('Content-Type: application/json');
    echo json_encode(['imagem' => $imgPath]);
?>