<?php
class Projet
{
    private $conn;
    private $id_pro;
    private $nom_pro;
    private $descrp_pro;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function setIdPro($id_pro)
    {
        $this->id_pro = $id_pro;
    }

    public function setNomPro($nom_pro)
    {
        $this->nom_pro = $nom_pro;
    }

    public function setDescrpPro($descrp_pro)
    {
        $this->descrp_pro = $descrp_pro;
    }

    public function getIdPro()
    {
        return $this->id_pro;
    }

    public function getNomPro()
    {
        return $this->nom_pro;
    }

    public function getDescrpPro()
    {
        return $this->descrp_pro;
    }


    public function displayProjects()
    {
        $sql = "SELECT * FROM projet WHERE nom_pro <> 'none'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProject($idpro)
    {
        $sql = "SELECT * FROM projet WHERE id_pro = :id_pro";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_pro", $idpro);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        return $project;
    }

    public function addProject()
    {
        $sql = "INSERT INTO projet (nom_pro, descrp_pro) VALUES (:nom_pro, :descrp_pro)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom_pro', $this->nom_pro);
        $stmt->bindParam(':descrp_pro', $this->descrp_pro);
        return $stmt->execute();
    }

    public function editProject()
    {
        $sql = "UPDATE projet SET nom_pro = :nom_pro, descrp_pro = :descrp_pro WHERE id_pro = :id_pro";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_pro', $this->id_pro);
        $stmt->bindParam(':nom_pro', $this->nom_pro);
        $stmt->bindParam(':descrp_pro', $this->descrp_pro);
        return $stmt->execute();
    }

    public function deleteProject()
    {
        $sql = "DELETE FROM projet WHERE id_pro = :id_pro";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_pro', $this->id_pro);
        return $stmt->execute();
    }

    public function DisplayScrum()
    {
        $sql = "SELECT * FROM projet inner join  utilisateur  on utilisateur.projet = projet.id_pro and utilisateur.role = 'ScrumMaster'  and nom_pro <> 'none' ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    





}
