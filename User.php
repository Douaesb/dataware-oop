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

        public function setUsername($username) {
            $this->username = $username;
        }
    
        // Getter for username
        public function getUsername() {
            return $this->username;
        }
    
        // Setter for surname
        public function setSurname($surname) {
            $this->surname = $surname;
        }
    
        // Getter for surname
        public function getSurname() {
            return $this->surname;
        }
    
        // Setter for email
        public function setEmail($email) {
            $this->email = $email;
        }
    
        // Getter for email
        public function getEmail() {
            return $this->email;
        }
    
        // Setter for password
        public function setPassword($password) {
            $this->password = $password;
        }
    
        // Getter for password
        public function getPassword() {
            return $this->password;
        }
    
        // Setter for tel
        public function setTel($tel) {
            $this->tel = $tel;
        }
    
        // Getter for tel
        public function getTel() {
            return $this->tel;
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

    public function logout()
    {
        // Start the session
        session_start();

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header("Location: login.php");
        exit();
    }
    
    
}




