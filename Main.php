<?php

require('Connector.php');

use Connector as Connect;

public class Main {
    
    var $nomServeur; // Indique quel génération choisir : fab ; prepa ; admin ; cond
    
    var $host;
    var $user;
    var $pass;
    var $port;
    
    var $connector;

    public function __construct($host,$user,$pass,$port)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
    }
    
    public function init($nomServeur)
    {
        $this->nomServeur = $nomServeur;
        
        $this->connector = new Connect();
        $this->connector->init($this->host,$this->user,$this->pass,$this->port);
        
    }
    
    public function start()
    {
        if ($this->connector == null)
            return false;
        
        switch($this->nomServeur)
        {
            case 'fabrication':
                $this->Fabrication();
                break;
            case 'preparation':
                $this->Preparation();
                break;
            case 'administratif': 
                $this->Administratif();
                break;
            case 'expedition':
                $this->Expedition();
        }
        
        return true;
    }
}
