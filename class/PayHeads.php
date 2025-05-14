<?php
    class PayHeads {
        private $conn;
        private $table = "pay_heads";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllPayHeads($userId){
            $query = "SELECT * FROM " . $this->table . " WHERE user_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getPayHeadById($payHeadId, $userId){
            $query = "SELECT * FROM " . $this->table . " WHERE pay_head_id = :payHeadId AND user_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':payHeadId' => $payHeadId, ":userId" => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addPayHead($userId, $name, $description, $type){
            $query = "INSERT INTO pay_heads (user_id, name, description, type) VALUES (:userId, :name, :description, :type)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId, ":name" => $name, ":description" => $description, ":type" => $type]);
        }

        public function updatePayHead($payHeadId, $userId, $name, $description, $type){
            $query = "UPDATE " . $this->table . " SET name = :name, description = :description, type = :type WHERE pay_head_id = :payHeadId AND user_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":payHeadId" => $payHeadId, ":userId" => $userId, ":name" => $name, ":description" => $description, ":type" => $type]);
        }

        public function deletePayHead($payHeadId){
            $query = "DELETE FROM " . $this->table . " WHERE pay_head_id = :payHeadId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":payHeadId" => $payHeadId]);
        }
    }
?>