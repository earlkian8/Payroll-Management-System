<?php
    class PayHead{
        private $conn;
        private $table = "pay_head";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getPayHeadById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE pay_head_id =  :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getAllPayHead(){
            $query = "SELECT * FROM " . $this->table . " ORDER BY pay_head_id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addPayHead($name, $description, $type){
            $query = "INSERT INTO " . $this->table . " (name, description, type) VALUES (:name, :description, :type)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":description" => $description, ":type" => $type]);
        }

        public function updatePayHead($id, $name, $description, $type){
            $query = "UPDATE " . $this->table . " SET name = :name, description = :description, type = :type WHERE pay_head_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id, ":name" => $name, ":description" => $description, ":type" => $type]);
        }

        public function deletePayHead($id){
            $query = "DELETE FROM " . $this->table . " WHERE pay_head_id = :id";
            $stmt =  $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>