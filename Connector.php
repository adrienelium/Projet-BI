<?php

class Connector {
    
    var $connexion;

    public function init($host,$user,$pass,$port)
    {
        $this->connexion = new mysqli($host, $user, $pass, $user);
        if ($this->connexion->connect_errno) {
            echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }
    
    public function req($requete)
    {
        $result = $this->connexion->query($requete);
       
        return $result->fetch_all();         
    }
}
