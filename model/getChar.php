<?php
    session_start();
    include_once '../model/connect.php';
    $db = new Connect();
    $conn = $db->getConn();

    include_once '../model/characterMethods.php';
    $mts = new CharacterMethods($conn);
    $char = $mts->getSpecificChar($_SESSION['characterId']);

    $charInfos = [
        ['nome' => $char['nome_personagem']],
        ['vitalidade' => $char['vitalidade']],
        ['energia' => $char['energia']],
        ['forca' => $char['forca']],
        ['destreza' => $char['destreza']],
        ['inteligencia' => $char['inteligencia']],
        ['fe' => $char['fe']],
        ['sorte' => $char['sorte']],
        ['mortes' => $char['mortes']],
        ['imagem' => "../assets/classes_images/".$char['caminho']]
    ];
    header('Content-Type: application/json');
    echo json_encode(['chara' => $charInfos]);
?>