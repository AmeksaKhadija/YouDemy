<?php

class RoleModel
{
    private $conn;
    private $id;
    private $role_name;
    private $role_description;


    public function __construct()
    {
        $this->conn = new Connection();
    }



    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRoleName($role_name)
    {
        $this->role_name = $role_name;
    }

    public function setDescription($description)
    {
        $this->role_description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRoleName()
    {
        return $this->role_name;
    }

    public function getDescription()
    {
        return $this->role_description;
    }

    public function findRoleByName($rolename)
    {
        $query = "SELECT * FROM roles WHERE role_name = :role_name";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->bindParam(':role_name', $rolename, PDO::PARAM_STR);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $result = $stmt->fetch();

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
}
