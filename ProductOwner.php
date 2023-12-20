<?php 
class ProductOwner extends User
{
    protected $conn;

    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function addProject($name, $descrp)
    {
        $project = new Projet($this->conn);
        $project->setNomPro($name);
        $project->setDescrpPro($descrp);
        return $project->addProject();
    }

    public function editProject($idpro, $name, $descrp)
    {
        $project = new Projet($this->conn);
        $project->setIdPro($idpro);
        $project->setNomPro($name);
        $project->setDescrpPro($descrp);
        return $project->editProject();
    }

    public function deleteProject($idpro)
    {
        $project = new Projet($this->conn);
        $project->setIdPro($idpro);
        return $project->deleteProject();
    }
    

    public function AssignScrum($role, $idpro, $id)
    {
        $sql = "UPDATE utilisateur SET  role = :role, projet = :idpro WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':role',$role);
        $stmt->bindParam(':idpro',$idpro);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }

    public function RmScrum($id){
        $sql = "UPDATE utilisateur SET role = 'membre' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}



    
  

