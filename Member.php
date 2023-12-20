<?php
class Member extends User
{
    protected $equipes;


    public function displayMem()
    {
        $sql = "SELECT id,email FROM utilisateur where role='membre'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function nameuser($id)
    {
        $sql = "SELECT nom FROM utilisateur WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MemProjects($id)
    {
        $sql = "SELECT projet.id_pro, projet.nom_pro, projet.descrp_pro
        FROM utilisateur
        JOIN equipe ON utilisateur.equipe = equipe.id_equipe
        JOIN projet ON equipe.id_pro = projet.id_pro
        WHERE utilisateur.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MemSquad($id)
    {
        $sql = "SELECT equipe.id_equipe, equipe.nom_equipe, equipe.date_creation
        FROM utilisateur
        JOIN equipe ON utilisateur.equipe = equipe.id_equipe
        WHERE utilisateur.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
