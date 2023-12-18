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
}
