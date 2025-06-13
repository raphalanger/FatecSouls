<?php
    include_once '../model/dbCrudLogin.php';
    $crud = new DatabaseFunctions();
    $crud->connect();

    class DatabaseLoadFunctions {
        private $conn;
        private $nome;
        private $path;
        private $nomeArma;
        private $nomeArmadura;

        private $arma;
        private $classe;
        private $escala;

        private $fis;
        private $fog;
        private $mag;
        private $lou;
        private $str;
        private $dex;
        private $int;
        private $fth;
        private $lck;

        public function __construct($conn) {
            $this->conn = $conn;
        }
        
        // setters
        public function setNome($value) { 
            $this->nome = $value;
        }
        public function setArma($nome) {
            $this->nomeArma = $nome;
        }
        public function setArmadura($nome) {
            $this->nomeArmadura = $nome;
        }

        // getters
        public function getNome() {
            //echo '<input readonly class="selectedClass" id="selectedClass" name="selectedClass" value='.$this->nome.'></input>';
            return $this->nome;
        }
        public function getArma() {
            //echo '<p>'.$this->nomeArma.'</p>';
            return $this->nomeArma;
        }
        public function getArmadura() {
            //echo '<p>'.$this->nomeArmadura.'</p';
            return $this->nomeArmadura;
        }

        public function searchNomeArma($value) {
            $sql = "SELECT nome_arma FROM armas WHERE id_arma = :idArma";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idArma", $value);
            try {
                if($stmt->execute()) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $this->setArma($result ? $result['nome_arma'] : '');
                } else {
                    $_SESSION['error_loadclass'] = "Não foi possível encontrar a arma da classe";
                }
            } catch (Exception $ex) {
                $_SESSION['error_loadclass'] = $ex->getMessage();
            }
        }

        public function searchNomeArmadura($value) {
            $sql = "SELECT nome_armadura FROM armaduras WHERE id_armadura = :idArmadura";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idArmadura", $value);
            try {
                if($stmt->execute()) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $this->setArmadura($result ? $result['nome_armadura'] : '');
                } else {
                    $_SESSION['error_loadclass'] = "Não foi possível encontrar a armadura da classe";
                }
            } catch (Exception $ex) {
                $_SESSION['error_loadclass'] = $ex->getMessage();
            }
        }

        public function setPath($path) {
            $this->path = $path;
        }
        public function getPath() {
            //return "../assets/classes_images/".$this->path;
            //return $this->path;
            return "../assets/classes_images/".$this->path;
        }

        public function checkGames($idUser) {
            $sql = "SELECT COUNT(*) FROM personagens WHERE personagens.id_usuario = :idUser";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idUser', $idUser);
            if ($stmt->execute()) {
                $count = $stmt->fetchColumn();
                return $count; // menor que zero
            }
            return true;
        }

        public function loadGame($gameId) {
            // Implementar a lógica para carregar o jogo do banco de dados
            $stmt = $this->conn->prepare("SELECT * FROM personagens WHERE id_personagem = :id_personagem");
            $stmt->bindParam(":id_personagem", $gameId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function loadClassInfo($classId) {
            $sql = "SELECT vitalidade as 'Vitalidade', energia as 'Energia', inteligencia as 'Inteligência', forca as 'Força', destreza as 'Destreza', fe as 'Fé', sorte as 'Sorte' FROM classes WHERE id_classe = :id_classe;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id_classe", $classId);
            try {
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<table class='classProperties'>";
                foreach ($row as $field => $value) {
                    echo "<tr><td>".$field."</td><td>".$value."</td></tr>";
                }
                echo "</table>";
            } catch (PDOException $ex) {
                $_SESSION['error_loadclass'] = $ex->getMessage();
            }
        }

        public function loadFields($classId) {
            $sql = "SELECT nome_classe, caminho FROM classes WHERE id_classe = :id_classe";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id_classe", $classId);
            try {
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $this->setNome($row['nome_classe']);
                    $this->setPath($row['caminho']);
                }
                $_SESSION['error_loadclass'] = null;
            } catch (PDOException $ex) {
                $_SESSION['error_loadclass'] = $ex->getMessage();
            }
        }

        public function getBurialGifts() {
            $sql = 'SELECT * FROM presentes';
            $stmt = $this->conn->prepare($sql);
            try {
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    $selected = isset($_GET['idGift']) ? $_GET['idGift'] : null;
                    foreach ($result as $row) {
                        echo '<option value="'.$row['id_presente'].'"';
                        if ($selected == $row['id_presente'])
                            echo 'selected';
                        echo '>'.$row['nome_presente'].'</option>';
                    }
                } else {
                    echo '<p>Não há presentes disponíveis.</p>';
                }
            } catch (PDOException $ex) {
                $_SESSION['error_loadclass'] = $ex->getMessage();
            }
        }
        public function loadClassArmor($classId) {
            $sql = "SELECT nome_armadura, capacete as 'Capacete', peitoral as 'Peitoral', manoplas as 'Manoplas', perneiras as 'Perneiras' FROM armaduras INNER JOIN classes ON classes.id_armadura = armaduras.id_armadura WHERE classes.id_classe = :idClasse";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idClasse", $classId);
            try {
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $spanArmor = count($row) - 1;
                echo '<table class="classProperties">';
                echo '<tr><th class=classPropertiesHeader colspan="'.$spanArmor.'">Armadura</th></tr>';
                foreach($row as $field => $value) {
                    if($field == 'nome_armadura') {
                        $nomeClasse = explode(' ', trim($value));
                        $nomeArmadura = end($nomeClasse);
                        echo '<tr><td>'.$value.'</td></tr>';
                        continue;
                    }
                    echo '<tr><td>'.$field.' de '.$nomeArmadura.'</td><td>'.$value.'</td></tr>';
                }
                echo '</table>';
                $_SESSION['error'] = null;
            } catch (PDOException $ex) {
                $_SESSION['error_loadclass'] = $ex->getMessage();
            }
        }
        public function loadClassWeapon($classId) {
            $sql = "SELECT nome_arma as 'Nome', tipo as 'Tipo', dur as 'Durabilidade', dano_fis as 'Dano Físico', dano_fogo as 'Dano de Fogo', dano_mag as 'Dano Mágico', dano_louc as 'Dano de Loucura' FROM armas INNER JOIN classes ON classes.id_arma = armas.id_arma WHERE classes.id_classe = :idClasse";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idClasse", $classId);
            try {
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $spanWeapon = count($row) + 2;
                echo '<table class="classProperties">';
                echo '<tr><th class="classPropertiesHeader" colspan="'.$spanWeapon.'">Arma</th></tr>';
                foreach($row as $field => $value) {
                    if($field == 'nome_arma')
                        echo '<tr><td>'.$value.'</td></tr>';
                    echo '<tr><td>'.$field.'</td><td>'.$value.'</td></tr>';
                }
                echo '</table>';
                $_SESSION['error'] = null;
            } catch (PDOException $ex) {
                $_SESSION['error_loadclass'] = $ex->getMessage();
            }
        }
        public function setScaling($classId) {
            $sql = "SELECT armas.dano_fis, armas.dano_mag, armas.dano_fogo, armas.dano_louc FROM armas INNER JOIN classes ON armas.id_arma = classes.id_arma WHERE classes.id_classe = :idClasse";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idClasse", $classId);
            if($stmt->execute()) {
                $this->arma = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            $sql = "SELECT classes.forca, classes.destreza, classes.inteligencia, classes.fe, classes.sorte FROM classes WHERE classes.id_classe = :idClasse";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idClasse", $classId);
            if($stmt->execute()) {
                $this->classe = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            $sql = "SELECT escalas.tipo_dano, escalas.forca, escalas.destreza, escalas.inteligencia, escalas.fe, escalas.sorte FROM escalas INNER JOIN armas ON escalas.tipo_arma = armas.tipo INNER JOIN classes ON classes.id_arma = armas.id_arma WHERE classes.id_classe = :idClasse";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idClasse", $classId);
            if($stmt->execute()) {
                $this->escala = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($this->escala as $row) {
                    if($row['tipo_dano'] == 'dano_fis') {
                        $this->fis = $row['forca'] * $row['destreza'];
                    }
                    else if($row['tipo_dano'] == 'dano_fogo') {
                        $this->fog = $row['forca'] * $row['fe'];
                    }
                    else if($row['tipo_dano'] == 'dano_mag') {
                        $this->mag = $row['inteligencia'] * $row['fe'];
                    }
                    else if($row['tipo_dano'] == 'dano_louc') {
                        $this->lou = $row['destreza'] * $row['sorte'];
                    }
                }
            }
        }
        // passar o id da arma, os atributos com o que ela escala e talvez o id de escala ou letra
        // criar tabela com a escala de cada arma com cada atributo
        public function scale($arma, $classe, $atr) {
            $str = $classe['forca'];
            $dex = $classe['destreza'];
            $int = $classe['inteligencia'];
            $fth = $classe['fe'];
            $lck = $classe['sorte'];
            return $arma + ($classe * $atr);
        }
        /*
        public function getScaling() {
            $forca = $this->classe['forca'] * 0.5;
            $dex = $this->classe['destreza'] * 0.3;
            echo '<tr><td>'.$this->arma['dano_fis'].'</td><td>=></td><td>'.$this->arma['dano_fis'] + ($forca * $dex).'</td></tr>';
        }*/
        public function getScaling() {
            // Example: dano_fis, dano_fogo, dano_mag, dano_louc
            $damageTypes = [
                'dano_fis' => 'Físico',
                'dano_fogo' => 'Fogo',
                'dano_mag' => 'Mágico',
                'dano_louc' => 'Loucura'
            ];

            foreach ($damageTypes as $key => $label) {
                // Find the scaling row for this damage type
                $scalingRow = null;
                foreach ($this->escala as $row) {
                    if ($row['tipo_dano'] == $key) {
                        $scalingRow = $row;
                        break;
                    }
                }
                if (!$scalingRow) continue; // skip if not found

                // Calculate scaling value
                $base = isset($this->arma[$key]) ? $this->arma[$key] : 0;
                $scaling = 
                    $this->classe['forca']        * $scalingRow['forca'] +
                    $this->classe['destreza']     * $scalingRow['destreza'] +
                    $this->classe['inteligencia'] * $scalingRow['inteligencia'] +
                    $this->classe['fe']           * $scalingRow['fe'] +
                    $this->classe['sorte']        * $scalingRow['sorte'];

                $total = $base + $scaling;

                //echo "<tr><td>{$label}</td><td>{$base}</td><td>+</td><td>{$scaling}</td><td>=</td><td>{$total}</td></tr>";

                echo '<tr><td>'.$label.'</td><td>'.$base.'</td><td>=></td><td>'.number_format($total, 1).'</td></tr>';
            }
        }
    }
?>