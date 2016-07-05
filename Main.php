<?php

require('Connector.php');

use Connector as Connect;

class Main {
    
    var $nomServeur; // Indique quel génération choisir : fab ; prepa ; admin ; cond
    
    var $host;
    var $user;
    var $pass;
    var $port;
    
    var $connector;
    
    var $nbCmd;

    public function __construct($host,$user,$pass,$port)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
        
        // Parametrage de génération
        $this->nbCmd = 1000;
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
    
    private function Fabrication()
    {
        echo 'Lancement de la fabrication';
    }
    
    private function Preparation()
    {
        echo 'Lancement de la préparation';
    }
    
    private function Administratif()
    {
        echo 'Lancement de la administratif';
        
        // Produits et pièces
        $idpiece = 1;
        
        for ($i = 1; $i <= 200; $i++)
        {
            $nbPieces = rand(2,4);
            
            $idProd = $i;
            $ref = 'PROD000'.$i;
            $desc = 'Riche, belle, spirituelle, et alors elle était replongée dans un de mes rêves : un mur haut et fragile, que le rassemblement était dispersé, et de souper - '.$i;
            $prix = rand(20,30) + 100*$nbPieces;
            $remise = 0;
            
            $this->connector->req("INSERT INTO Produit (Id_produit, Reference_produit,Description_produit,Prix_catalogue,Remise) VALUES ('".$idProd."', '".$ref."', '".$desc."', '".$prix."', '".$remise."')");
                        
            for($e = 0 ; $e < $nbPieces ; $e++)
            {
                $refpiece = 'PIEC000'.$idpiece;
                $descPiece = 'Seul le désert était recréé. Signalez-vous avec votre clé, nous viendrons dimanche - '.$idpiece;
                $prixPiece = rand(5,10);
                $prixFabrication = rand(2,6);
                
                $this->connector->req("INSERT INTO Piece (Id_piece, Reference_piece,Description_piece,Prix_unite,Prix_fabrication) VALUES ('".$idpiece."', '".$ref."', '".$desc."', '".$prix."', '".$remise."')");
                
                $this->connector->req("INSERT INTO Avoir (Id_produit, Id_piece) VALUES ('".$idProd."', '".$idpiece."')");
                
                $idpiece++;
            }
        }
    }
    
    private function Expedition()
    {
        echo 'Lancement de la expedition';
        
        $this->connector->req("INSERT INTO Type_expedition (Nom_type_expedition) VALUES ('Avions')");
        $this->connector->req("INSERT INTO Type_expedition (Nom_type_expedition) VALUES ('Semi-remorques')");
        $this->connector->req("INSERT INTO Type_expedition (Nom_type_expedition) VALUES ('Bateaux)");
        
        $tabtype = $this->connector->req('SELECT * FROM Type_expedition');
        $types = array();
        foreach ($tabtype as $lignetype)
        {
            array_push($types,$lignetype['Id_type']);
        }
        
        $adminbase = new Connect();
        $adminbase->init('192.168.0.128','root','exia2016',3306);
        
        $tab = $adminbase->req('SELECT Num_cmd,Date_livraison,Prix_commande FROM Commandes');
        
        foreach ($tab as $lignes) {
            
            $date = new DateTime($lignes['Date_livraison']);
            $intervalle = new DateInterval('P2D');
            $date->sub($intervalle);
            
            if (rand(0,1) == 0)
                $typepalette = 'Avion';
            else
                $typepalette = 'Europe';
            
            $numCmd = $lignes['Num_cmd'];
            
            $tempPrevu = rand(1,3); 
            
            $tempReel = rand(1,3); 
            
            $tir = rand(0,$types->lenght());
            $id_Type = $types[$tir];
            
            $this->connector->req("INSERT INTO Expedition (Date_expedition, Type_palette,Num_cmd,Temps_prevu,Temps_reel) VALUES ('".$date->format('Y-m-d H:i:s')."', '".$typepalette."', '".$numCmd."', '".$tempPrevu."', '".$tempReel."', '".$id_Type."')");
            
        }
    }
}
