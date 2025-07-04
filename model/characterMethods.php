<?php
    include_once '../model/dbCrudLogin.php';
    include_once '../model/dbCrudLoad.php';
    $cmd = new DatabaseFunctions();
    $cmd->connect();
    
    class CharacterMethods {
        private $conn;
        public function __construct($conn) {
            $this->conn = $conn;
        }

        private $charname;
        private $userId;
        private $giftId;
        private $classId;
        private $img;

        public function setChar($name) {
            $this->charname = $name;
        }
        public function setUser($id) {
            $this->userId = $id;
        }
        public function setGift($id) {
            $this->giftId = $id;
        }
        public function setClass($id) {
            $this->classId = $id;
        }
        public function setImg($imgRec) {
            $this->img = $imgRec;
        }

        public function getChar() {
            return $this->charname;
        }
        public function getUser() {
            return $this->userId;
        }
        public function getGift() {
            return $this->giftId;
        }
        public function getClass() {
            return $this->classId;
        }
        public function getImg() {
            return "../assets/classes_images/".$this->img;
        }

        public function getManyChars($idUser) {
            $sql = "SELECT COUNT(personagens.nome_personagem) as 'qtd_prs' FROM personagens left join usuarios on usuarios.id_usuario = personagens.id_usuario where usuarios.id_usuario = :idUser group by personagens.id_usuario ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idUser', $idUser);
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $result['qtd_prs'];
                return $count;
            }
        }
        
        public function insertChar($stats) {
            $sql = "INSERT INTO personagens (id_usuario, id_classe, id_presente, nome_personagem, vida, vitalidade, energia, forca, destreza, inteligencia, fe, sorte, mortes, caminho) VALUES
            (:userId, :classId, :giftId, :charname, :vida, :vitalidade, :energia, :forca, :destreza, :inteligencia, :fe, :sorte, :mortes, :caminho)";
            $stmt = $this->conn->prepare($sql);
            $vida = $stats['vitalidade'] * 10;
            $morte = 0;
            $uid = $_SESSION['id_usuario'];
            $cid = $this->getClass();
            $gid = $this->getGift();
            $charid = $this->getChar();
            $stmt->bindParam(":userId", $uid);
            $stmt->bindParam(":classId", $cid);
            $stmt->bindParam(":giftId", $gid);
            $stmt->bindParam(":charname", $charid);
            $stmt->bindParam(":vida", $vida);
            $stmt->bindParam(":vitalidade", $stats['vitalidade']);
            $stmt->bindParam(":energia", $stats['energia']);
            $stmt->bindParam(":forca", $stats['forca']);
            $stmt->bindParam(":destreza", $stats['destreza']);
            $stmt->bindParam(":inteligencia", $stats['inteligencia']);
            $stmt->bindParam(":fe", $stats['fe']);
            $stmt->bindParam(":sorte", $stats['sorte']);
            $stmt->bindParam(":mortes", $morte);
            $stmt->bindParam(":caminho", $stats['caminho']);
            try {
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $ex) {
                $_SESSION['error'] = $ex->getMessage();
                return false;
            }
        }

        public function getCharacters() {
            $uid = $_SESSION['id_usuario'];
            $sql = "SELECT personagens.id_personagem, personagens.nome_personagem, classes.nome_classe, (personagens.vitalidade + personagens.energia + personagens.forca + personagens.destreza + personagens.fe + personagens.inteligencia + personagens.sorte) / 10 as 'nivel', personagens.mortes, personagens.caminho FROM personagens LEFT JOIN classes ON classes.id_classe = personagens.id_classe WHERE personagens.id_usuario = :userId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":userId", $uid);
            if($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row) {
                    echo '<div><form action="../view/hub.php" method="POST" class="charForm">
                        <input name="char" id="charId" hidden value="'.$row['id_personagem'].'">
                        <button class="majorChar" id="majorChar" name="val" value="loadchar">
                            <div class="character-info">
                                <p class="character-name">'.$row['nome_personagem'].'</p>
                                <p class="class-name">'.$row['nome_classe'].'</p>
                            </div>
                                <hr>
                            <div style="display: flex">
                                <div>
                                    <p>Nível: '.number_format($row['nivel'], 0).'</p>
                                    <p>Mortes: '.$row['mortes'].'</p>
                                </div>
                                <div class="right-group">
                                    <img class="miniDisplay" id="imageDisplay" src="../assets/classes_images/'.$row['caminho'].'">
                                </div>
                            </div>
                        </button>
                    </form>
                    <form method="POST" action="../controller/deleteController.php">
                        <input name="char" hidden value="'.$row['id_personagem'].'">
                        <button type="submit" name="val" value="delchar" class="delete-char">X</button>
                    </form></div>';
                }
            }
        }

        public function searchImg($id) {
            $sql = "SELECT caminho FROM personagens WHERE id_personagem = :idChar";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idChar", $id);
            if ($stmt->execute()) {
                $img = $stmt->fetch(PDO::FETCH_ASSOC);
                return $img['caminho'];
            }
        }
        public function getSpecificChar($id) {
            $sql = "SELECT id_personagem, id_usuario, id_classe, id_presente, nome_personagem AS 'Nome', vitalidade AS 'Vitalidade', vida AS 'Vida', energia AS 'Energia', forca AS 'Força', destreza AS 'Destreza', inteligencia AS 'Inteligência', fe AS 'Fé', sorte AS 'Sorte', data_criacao, mortes, caminho FROM personagens WHERE id_personagem = :idChar";            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idChar", $id);
            if ($stmt->execute())
                return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getSpecificBoss($id) {
            $sql = "SELECT * FROM chefes WHERE id_chefe = :idBoss";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idBoss", $id);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        public function getWeapon($id) {
            $sql = "SELECT * FROM armas WHERE id_arma = :idWeapon";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idWeapon", $id);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        public function getLevels($id) {
            $sql = "SELECT vitalidade as 'Vitalidade', energia as 'Energia', forca as 'Força', destreza as 'Destreza', inteligencia as 'Inteligência', fe as 'Fé', sorte as 'Sorte' FROM personagens WHERE id_personagem = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            if($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo '<table class="level-tab" id="level-tab">';
                foreach($result as $row) { 
                    foreach($row as $field => $value) {
                        echo '<tr>
                                <td><button id="stat-dec" data-stat="'.$field.'">-</button></td>
                                <td>'.$field.'</td>
                                <td id="stat-value" data-stat="'.$field.'">'.$value.'</td>
                                <td><button id="stat-inc" data-stat="'.$field.'">+</button></td>
                            </tr>';
                    }
                }
                echo '</table>';
            }
        }
        public function deleteCharacter($id) {
            $sql = "DELETE FROM personagens WHERE id_personagem = :idChar";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idChar", $id);
            try {
                return $stmt->execute();
            } catch (PDOException $ex) {
                return false;
            }
        }
    }
?>