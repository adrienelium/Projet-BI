<?php

public class Connector {
    
    var $connexion;

    public function init($host,$user,$pass,$port)
    {
        $this->connexion = new mysqli($host, $user, $pass, $user, $port);
        if ($this->connexion->connect_errno) {
            echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }
    
    public function req($requete)
    {
        if (!$this->connexion->query($requete)) {
            echo "Echec lors de l'éxécution de la requete : (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }
}
