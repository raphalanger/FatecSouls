<?php
    class DatabaseFunctions {
        private $host;
        private $user;
        private $passwd;
        private $db;
        private $conn;

        private $table;
        private $field;

        private $fieldToInsert1;
        private $fieldToInsert2;
        private $fieldValue1;
        private $fieldValue2;

        // a funcao __construct() é chamada automaticamente
        // e inicializa os atributos da classe
        public function __construct() {
            $this->host = "localhost";
            $this->user = "root";
            $this->passwd = "";
            $this->db = "fatec_souls";
        }

        public function connect() {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8",$this->user, $this->passwd);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            }
            catch (PDOException $e) {
                $_SESSION['errorDb'] = "Connection failed: " . $e->getMessage();
                return null;
            }
        }

        public function create() {
            $query = "SELECT nome FROM usuarios LIMIT 1";
            $stmt = $this->conn->prepare($query);
            try {
                $stmt->execute();
                if ($stmt->rowCount() < 0) {
                    $_SESSION['error'] = "Este nome de usuário já está em uso.";
                    return false;
                } else {
                    $query = "INSERT INTO usuarios ({$this->fieldToInsert1}, {$this->fieldToInsert2}) VALUES (:fieldValue1, :fieldValue2);";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":fieldValue1", $this->fieldValue1);
                    $stmt->bindParam(":fieldValue2", $this->fieldValue2);
                
                    try {
                        if ($stmt->execute()) {
                            $_SESSION["error"] = null;
                            $_SESSION["id_usuario"] = $this->conn->lastInsertId();
                            return true;
                        }
                    } catch (PDOException $e) {
                        $_SESSION["error"] = "Erro no Banco: ".$e->getMessage()."'.";
                    }
                }
            } catch (PDOException $e) {
                $_SESSION["error"] = "Erro no Banco: '". $e->getMessage() ."'.";
            }
        }

        public function read() {
            $sql = "SELECT id_usuario FROM usuarios WHERE nome = :fieldValue AND senha = :fieldValue2 LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":fieldValue", $this->fieldValue1);
            $stmt->bindParam(":fieldValue2", $this->fieldValue2);
            try {
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['id_usuario'] = $result['id_usuario'];
                    return $result;
                } else {
                    $_SESSION["error"] = "Usuário não encontrado.";
                    return null;
                }
            } catch (PDOException $e) {
                $_SESSION["error"] = "Erro no Banco: '". $e->getMessage() ."'.";
                return null;
            }
        }

        public function update() {
        }

        public function delete() {
        }

        public function setFields($field1, $field2, $fieldValue1, $fieldValue2) {
            $this->fieldToInsert1 = $field1;
            $this->fieldToInsert2 = $field2;
            $this->fieldValue1 = $fieldValue1;
            $this->fieldValue2 = $fieldValue2;
        }
        
        public function verifyLogin() {
            if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
                return true;
            } else {
                return false;
            }
        }

        public function getConn() {
                return $this->conn;
            }
    }
?>