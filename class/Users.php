<?php

    class Users{
        private $conn;
        private $table = "users";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getUserById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE user_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addUser($email, $password){
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            
            $query = "INSERT INTO " . $this->table . " (email, password_hash) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":email" => $email, ":password" => $hashed_password]);
        }

        public function updateUser($id, $email, $password){
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            
            $query = "UPDATE " . $this->table . " SET email = :email, password_hash = :password WHERE user_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id, ":email" => $email, ":password" => $hashed_password]);
        }

        public function deleteUser($id){
            $query = "DELETE FROM " . $this->table . " WHERE user_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }

        public function login($email, $password){
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":email" => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($user && password_verify($password, $user['password_hash'])){
            return $user;
            }
            return false;
        }


    

        
    }
?>