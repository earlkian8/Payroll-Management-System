<?php
class Accounts
{

    private $conn;
    private $table = "accounts";


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addAccount($email, $password)
    {
        $query = "INSERT INTO " . $this->table . " (email, password) VALUES (:email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":email" => $email, ":password" => password_hash($password, PASSWORD_BCRYPT)]);
    }

    public function loginAccount($email, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":email" => $email]);
        $account = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($account && password_verify($password, $account["password"])) {
            return true;
        } else {
            return false;
        }
    }
}
?>