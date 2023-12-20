<?php
class ScrumMaster extends User
{
    public function displaySquads()
    {
        $sql = "SELECT * FROM equipe  where nom_equipe <> 'none'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displaySquadPro()
    {
        $sql = "SELECT * FROM equipe inner join  projet  on equipe.id_pro = projet.id_pro  where nom_pro <> 'none'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displayEqpMem()
    {
        $sql = "SELECT * FROM utilisateur 
        INNER JOIN equipe ON utilisateur.equipe = equipe.id_equipe 
        WHERE utilisateur.role = 'membre' and nom_equipe <> 'none'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function FiltrerEqpMem($selectedTeamId)
    {
        $sql = "SELECT * FROM utilisateur 
        INNER JOIN equipe ON utilisateur.equipe = equipe.id_equipe 
        WHERE utilisateur.role = 'membre' AND equipe.id_equipe = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $selectedTeamId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSquad($nom_equipe, $date_creation)
    {
        $sql = "INSERT INTO equipe (nom_equipe, date_creation)  VALUES (:nom_equipe, :date_creation)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom_equipe', $nom_equipe);
        $stmt->bindParam(':date_creation', $date_creation);
        return $stmt->execute();
    }


    public function getSquad($ideqp)
    {
        $sql = "SELECT * FROM equipe WHERE id_equipe=:ideqp";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":ideqp", $ideqp);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        return $project;
    }


    public function editSquad($id_equipe, $nom_equipe, $date_creation)
    {
        $sql = "UPDATE equipe SET nom_equipe=:nom_equipe, date_creation=:date_creation WHERE id_equipe=:id_equipe";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_equipe', $id_equipe);
        $stmt->bindParam(':nom_equipe', $nom_equipe);
        $stmt->bindParam(':date_creation', $date_creation);
        return $stmt->execute();
    }



    public function deleteSquad($id_equipe)
    {
        $sql = "DELETE FROM equipe WHERE id_equipe = :id_equipe";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_equipe', $id_equipe);
        return $stmt->execute();
    }

    public function AssignEqpToPro($idpro, $ideqp)
    {
        $sql = "UPDATE equipe
        SET id_pro = :id_pro
        WHERE id_equipe = :id_equipe";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_pro', $idpro);
        $stmt->bindParam(':id_equipe', $ideqp);
        return $stmt->execute();
    }

    public function RmEqpPro($id)
    {
        $sql = "UPDATE equipe
        SET id_pro = '1'
        WHERE id_equipe =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


    public function AddMemToEqp($id, $ideqp)
    {
        $sql = "SELECT id_pro FROM equipe WHERE id_equipe = :ideqp";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":ideqp", $ideqp);
        $stmt->execute();
        $equipe = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_projet = $equipe['id_pro'];

        $updateQuery = "UPDATE utilisateur
                        SET equipe = :idequipe, projet = :idprojet
                        WHERE id = :idutilisateur";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(":idequipe", $ideqp);
        $stmt->bindParam(":idprojet", $id_projet);
        $stmt->bindParam(":idutilisateur", $id);
        return $stmt->execute();
    }

    public function deleteMemEqp($id)
    {
        $sql = "UPDATE utilisateur
            SET equipe = null, projet = null
            WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
