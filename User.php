<?php
class User{
    protected $conn;
    protected $username;
    protected $surname;
    protected $email;
    protected $password;
    protected $tel;
    

        public function __construct($db)
        {
            $this->conn = $db;
        }
        
    public function register($username, $surname, $email, $password, $tel) {

        $emailCheckQuery = "SELECT COUNT(*) FROM utilisateur WHERE email=:email";
        $emailCheckStmt = $this->conn->prepare($emailCheckQuery);
        $emailCheckStmt->bindParam(":email", $email);
        $emailCheckStmt->execute();
        $emailCount = $emailCheckStmt->fetchColumn();
    
        if ($emailCount > 0) {
            return "L'email existe déjà.";
        }


        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO `utilisateur` (nom, prenom, email, pass, tel, statut, role)
                  VALUES (:username, :surname, :email, :password, :tel, 'active', 'membre')";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $passwordHash);
        $stmt->bindParam(":tel", $tel);        
        
        $stmt->execute();
        return $stmt;
    }


    public function login($email, $password) {
        $query = "SELECT id, role, pass FROM utilisateur WHERE email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);

        if ($result && password_verify($password, $result['pass'])) {
            session_start();
            $_SESSION['id'] = $result['id'];
    
            switch ($result['role']) {
                case 'membre':
                    $_SESSION['email'] = $email;
                    header("Location: dashboardm.php");
                    exit();
                case 'ProductOwner':
                    $_SESSION['email'] = $email;    
                    header("Location: dashboardp.php");
                    exit();
                case 'ScrumMaster':
                    $_SESSION['email'] = $email;
                    header("Location: dashboards.php");
                    exit();
            }
        } else {
            return "L'email ou le mot de passe est incorrect.";
        }
    }
    
    
}




