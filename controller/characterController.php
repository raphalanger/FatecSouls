<?php
    session_start();
    include_once '../model/dbCrudLogin.php';
    include_once '../model/characterMethods.php';
    $crud = new DatabaseFunctions();
    $conn = $crud->connect();
    $charCrud = new CharacterMethods($conn);

    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomePersonagem = $_POST['name'];
        $presentePersonagem = $_POST['gift'];
        $classePersonagem = $_POST['class'];
        $charCrud->setClass($classePersonagem);
        $charCrud->setGift($presentePersonagem);
        $charCrud->setChar($nomePersonagem);
        //echo "<p>".$nomePersonagem." ".$presentePersonagem." ".$classePersonagem."</p>";
        $sql = "SELECT vitalidade, energia, inteligencia, forca, destreza, fe, sorte, caminho FROM classes WHERE id_classe = :classId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":classId", $classePersonagem);
        if($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stats = [
                'vitalidade'   => $result['vitalidade'],
                'energia'      => $result['energia'],
                'inteligencia' => $result['inteligencia'],
                'forca'        => $result['forca'],
                'destreza'     => $result['destreza'],
                'fe'           => $result['fe'],
                'sorte'        => $result['sorte'],
                'caminho'      => $result['caminho']
            ];
        } else 
            echo 'erro ao executar query';
        try{
            $idUser = $_SESSION['id_usuario'];
            $count = $charCrud->getManyChars($idUser);
            echo "count: ".$count;
            if($count < 4) {
                $charId = $charCrud->insertChar($stats);
                if($charId)
                    echo "O personagem foi criado: ".$charId;
                else
                    echo "o personagem nao foi criado\n".$_SESSION['error'];
            } else {
                echo "ja possui muitos personagens";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else {
        echo "erro ao obter metodo do formulario";
    }
?>