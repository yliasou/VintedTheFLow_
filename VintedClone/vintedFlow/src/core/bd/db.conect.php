<?php

class DB
{
    private $host = 'localhost';
    private $dbname = 'chatapp';
    private $user = 'root';
    private $pwd = '';
    public $bdd;

    public function __construct($host= null, $dbname= null, $user= null, $mdp= null)
    {
        if($host!=null && $dbname!=null && $user!= null && $mdp!= null){
            $this->host = $host;
            $this->dbname = $dbname;
            $this->user = $user;
            $this->pwd = $mdp;
        }

        try {
            $this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->pwd, array(
                                                                                                                   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                                                                                                                   PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING 
                                                                                                                ));
        } catch (Exception $e) {
            die('<h1>Erreur de connexion à la base de donnée!</h1>'.$e->getMessage());
        }
    }

    public function query($sql, $data= array())
    {
        $req = $this->bdd->prepare("$sql");
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($sql, $data= array())
    {
        $req = $this->bdd->prepare("$sql");
        $req->execute($data);
        return "Add Success";
    }

    public function update($sql, $data= array())
    {
        $req = $this->bdd->prepare("$sql");
        $req->execute($data);
        return "Update Success";
    }

    public function delete($sql, $data= array())
    {
        $req = $this->bdd->prepare("$sql");
        $req->execute($data);
        return "Detete succuss";
    }

    
}