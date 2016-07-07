<?php

class Connector {
    
    var $connexion;

    public function init($host,$user,$pass,$port)
    {
        $this->connexion = new mysqli($host, $user, $pass, $user);
        if ($this->connexion->connect_errno) {
            echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit();
        }
    }
    
    public function req($requete)
    {
        $result = $this->connexion->query($requete);
        
        if (gettype($result) != "boolean")
            return $result->fetch_all();    
        
    }
}
