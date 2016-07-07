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
        
        $adminbase = new Connect();
        $adminbase->init('192.168.0.101','root','exia2016',3306);
        
        $tab = $adminbase->req("SELECT * FROM Commandes");
        //print_r($tab);
        
        foreach($tab as $ligne)
        {
            $idFab = $ligne[0];
            
            $str = "INSERT INTO Fabrication (Id_fabrication,Temps_fabrication,Date_fabrication,Num_cmd) VALUES ('".$idFab."','".rand(1,3)."','".$ligne[2]."','".$ligne[1]."')";
            //echo $str;
            $this->connector->req($str);
            
            $tabtempspe = $adminbase->req("SELECT * FROM Commander_piece NATURAL JOIN Piece WHERE Id_commande = '".$ligne[1]."'");
            
            if (count($tabtempspe) == 0)
            {
                $tabtemp = array();
                
                
                $str = "SELECT * FROM Ligne WHERE Id_commande = '".$ligne[1]."'";
                $tabtemp2 = $adminbase->req($str);
                //echo $str;
                //print_r($tabtemp2);
                //exit;
                foreach($tabtemp2 as $value)
                {
                    $res = $adminbase->req("SELECT * FROM Avoir NATURAL JOIN Piece WHERE Id_produit = '".$value[1]."'");
                    
                    foreach($res as $value2)
                    {
                        array_push($tabtemp,$value2);
                    }
                    
                }
                
            }
            else
            {
                $tabtemp = array();
                // CODER ICI la prise de ligne de la tabl piece, puis mettre les lignes dans tabtemps
                foreach($tabtempspe as $value3)
                {
                    array_push($tabtemp,$value3);
                }
            }
            
            foreach($tabtemp as $ligne4)
            {
                $str = "INSERT INTO piece_a_fabrique (Reference_piece,Description_piece,Prix_unite,Date_debut_fabrication,Temps_prevu,Temps_reel,Fin_machine_fabrication_A,Fin_machine_fabrication_B,Fin_machine_fabrication_C,Id_fabrication) VALUES ('".$ligne4[2]."','".$ligne4[3]."','".$ligne4[4]."','".$ligne[2]."','".rand(1,3)."','".rand(1,3)."','".rand(0,1)."','0','0','".$idFab."')";
                
                //echo $str;
                
                $this->connector->req($str); 
         
            }
            
            if ($idFab < 30)
            {
                if (rand(1,50000) == 1)
                {
                    $idEventvent = $idFab;
                    $date = new DateTime();
                    
                    $machine = rand(1,8);
                    
                    switch ($machine)
                    {
                        case 1:
                            $this->connector->req("INSERT INTO Evenement_fabrication (Id_event_fabrication,Date_event_fabrication,Panne_machine_A_fabrication,Panne_machine_B_fabrication,Panne_machine_C_fabrication,Maintenance_machine_A_fabrication,Maintenance_machine_B_fabrication,Maintenance_machine_C_fabrication) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'1','0','0','0','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_fabrication (Id_fabrication,Id_event_fabrication) VALUES ('".$idFab."','".$idEventvent."'");
                            
                            break;
                        case 2:
                            $this->connector->req("INSERT INTO Evenement_fabrication (Id_event_fabrication,Date_event_fabrication,Panne_machine_A_fabrication,Panne_machine_B_fabrication,Panne_machine_C_fabrication,Maintenance_machine_A_fabrication,Maintenance_machine_B_fabrication,Maintenance_machine_C_fabrication) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','1','0','0','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_fabrication (Id_fabrication,Id_event_fabrication) VALUES ('".$idFab."','".$idEventvent."'");
                            
                            break;
                        case 3:
                            $this->connector->req("INSERT INTO Evenement_fabrication (Id_event_fabrication,Date_event_fabrication,Panne_machine_A_fabrication,Panne_machine_B_fabrication,Panne_machine_C_fabrication,Maintenance_machine_A_fabrication,Maintenance_machine_B_fabrication,Maintenance_machine_C_fabrication) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','0','1','0','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_fabrication (Id_fabrication,Id_event_fabrication) VALUES ('".$idFab."','".$idEventvent."'");
                            
                            break;
                        case 4:
                            $this->connector->req("INSERT INTO Evenement_fabrication (Id_event_fabrication,Date_event_fabrication,Panne_machine_A_fabrication,Panne_machine_B_fabrication,Panne_machine_C_fabrication,Maintenance_machine_A_fabrication,Maintenance_machine_B_fabrication,Maintenance_machine_C_fabrication) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','0','0','1','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_fabrication (Id_fabrication,Id_event_fabrication) VALUES ('".$idFab."','".$idEventvent."'");
                            
                            break;
                        case 5:
                            $this->connector->req("INSERT INTO Evenement_fabrication (Id_event_fabrication,Date_event_fabrication,Panne_machine_A_fabrication,Panne_machine_B_fabrication,Panne_machine_C_fabrication,Maintenance_machine_A_fabrication,Maintenance_machine_B_fabrication,Maintenance_machine_C_fabrication) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','0','0','0','1','0')");
                            
                            $this->connector->req("INSERT INTO Event_fabrication (Id_fabrication,Id_event_fabrication) VALUES ('".$idFab."','".$idEventvent."'");
                            
                            break;
                        case 6:
                            $this->connector->req("INSERT INTO Evenement_fabrication (Id_event_fabrication,Date_event_fabrication,Panne_machine_A_fabrication,Panne_machine_B_fabrication,Panne_machine_C_fabrication,Maintenance_machine_A_fabrication,Maintenance_machine_B_fabrication,Maintenance_machine_C_fabrication) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','0','0','0','0','1')");
                            
                            $this->connector->req("INSERT INTO Event_fabrication (Id_fabrication,Id_event_fabrication) VALUES ('".$idFab."','".$idEventvent."'");
                            
                            break; 
                    }
                }
            }
               
            
            
        }
    }
    
    private function Preparation()
    {
        echo 'Lancement de la préparation';
        
        $adminbase = new Connect();
        $adminbase->init('192.168.0.101','root','exia2016',3306);
        
        $tab = $adminbase->req("SELECT * FROM Commandes");
        
        foreach($tab as $ligne)
        {
            $idCondi = $ligne[0];
            $dateCondi = $ligne[3];
            $tempsCondi = rand(1,2);
            $numCmd = $ligne[1];
            
            $this->connector->req("INSERT INTO Conditionnement (Id_conditionement, Date_conditionement,Temps_conditionement,Num_cmd) VALUES ('".$idCondi."', '".$dateCondi."', '".$tempsCondi."', '".$numCmd."')");
            
            // roduits
            $tabspe = $adminbase->req("SELECT * FROM Ligne NATURAL JOIN Produit WHERE Id_commande = '".$ligne[0]."'");
            
            foreach($tabspe as $value)
            {
                $ref = $value[3];
                $desc = $value[4];
                $prix = $value[1];
                $dateDeb = $dateCondi;
                $tempsPrevu = rand(1,2);
                $tempsReel = rand(1,3);
                
                $finMachineA = rand(0,1);
                $finMachineB = 0;
                $finMachineC = 0;
                
                $this->connector->req("INSERT INTO Produit_a_conditionner (Reference_produit_a_conditione,Description_produit_a_conditione,Prix_produit_a_conditione,Date_debut_conditionnement,Temps_prevu,Temps_reel,Fin_machine_conditionnement_A,Fin_machine_conditionnement_B,Fin_machine_conditionnement_C,Id_conditionement) VALUES ('".$ref."', '".$desc."', '".$prix."', '".$dateDeb."', '".$tempsPrevu."', '".$tempsReel."', '".$finMachineA."', '".$finMachineB."', '".$finMachineC."', '".$idCondi."')");
            }
            
            
            // Pièce ----------
            $tabspe = $adminbase->req("SELECT * FROM Commander_piece NATURAL JOIN Piece WHERE Id_commande = '".$ligne[0]."'");
            
            foreach($tabspe as $value)
            {
                $ref = $value[3];
                $desc = $value[4];
                $prix = $value[1];
                
                $str = "INSERT INTO Piece_a_conditione (Reference_piece_a_conditione,Description_piece_a_conditione,Prix_unite_a_conditione,Id_conditionement) VALUES ('".$ref."', '".$desc."', '".$prix."', '".$idCondi."')";
                
                $this->connector->req($str);
                
                //echo '<br>'.$str;
            }
            
            
            
            if ($idCondi < 30)
            {
                if (rand(1,25000) == 1)
                {
                    $idEventvent = $idCondi;
                    $date = new DateTime();
                    
                    $machine = rand(1,8);
                    
                    switch ($machine)
                    {
                        case 1:
                            $this->connector->req("INSERT INTO Evenement_conditionnement (Id_event_conditionnement,Date_event_conditionnement,Panne_machine_A_conditionnement,Panne_machine_B_conditionnement,Panne_machine_C_conditionnement,Maintenance_machine_A_conditionnement,Maintenance_machine_B_conditionnement,Maintenance_machine_C_conditionnement) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'1','0','0','0','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_conditionnement (Id_conditionement,Id_event_conditionnement) VALUES ('".$idCondi."','".$idEventvent."'");
                            
                            break;
                        case 2:
                            $this->connector->req("INSERT INTO Evenement_conditionnement (Id_event_conditionnement,Date_event_conditionnement,Panne_machine_A_conditionnement,Panne_machine_B_conditionnement,Panne_machine_C_conditionnement,Maintenance_machine_A_conditionnement,Maintenance_machine_B_conditionnement,Maintenance_machine_C_conditionnement) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','1','0','0','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_conditionnement (Id_conditionement,Id_event_conditionnement) VALUES ('".$idCondi."','".$idEventvent."'");
                            
                            break;
                        case 3:
                            $this->connector->req("INSERT INTO Evenement_conditionnement (Id_event_conditionnement,Date_event_conditionnement,Panne_machine_A_conditionnement,Panne_machine_B_conditionnement,Panne_machine_C_conditionnement,Maintenance_machine_A_conditionnement,Maintenance_machine_B_conditionnement,Maintenance_machine_C_conditionnement) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','0','1','0','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_conditionnement (Id_conditionement,Id_event_conditionnement) VALUES ('".$idCondi."','".$idEventvent."'");
                            
                            break;
                        case 4:
                            $this->connector->req("INSERT INTO Evenement_conditionnement (Id_event_conditionnement,Date_event_conditionnement,Panne_machine_A_conditionnement,Panne_machine_B_conditionnement,Panne_machine_C_conditionnement,Maintenance_machine_A_conditionnement,Maintenance_machine_B_conditionnement,Maintenance_machine_C_conditionnement) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','0','0','1','0','0')");
                            
                            $this->connector->req("INSERT INTO Event_conditionnement (Id_conditionement,Id_event_conditionnement) VALUES ('".$idCondi."','".$idEventvent."'");
                            
                            break;
                        case 5:
                            $this->connector->req("INSERT INTO Evenement_conditionnement (Id_event_conditionnement,Date_event_conditionnement,Panne_machine_A_conditionnement,Panne_machine_B_conditionnement,Panne_machine_C_conditionnement,Maintenance_machine_A_conditionnement,Maintenance_machine_B_conditionnement,Maintenance_machine_C_conditionnement) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'0','0','0','0','1','0')");
                            
                            $this->connector->req("INSERT INTO Event_conditionnement (Id_conditionement,Id_event_conditionnement) VALUES ('".$idCondi."','".$idEventvent."'");
                            
                            break;
                        case 6:
                            $this->connector->req("INSERT INTO Evenement_conditionnement (Id_event_conditionnement,Date_event_conditionnement,Panne_machine_A_conditionnement,Panne_machine_B_conditionnement,Panne_machine_C_conditionnement,Maintenance_machine_A_conditionnement,Maintenance_machine_B_conditionnement,Maintenance_machine_C_conditionnement) VALUES ('".$idEventvent."','".$date->format('Y-m-d H:i:s').",'1','0','0','0','0','1')");
                            
                            $this->connector->req("INSERT INTO Event_conditionnement (Id_conditionement,Id_event_conditionnement) VALUES ('".$idCondi."','".$idEventvent."'");
                            
                            break; 
                    }
                }
            }
            
            
        }
        
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
        
        $this->connector->req("INSERT INTO Pays (Nom_pays, Code_pays) VALUES ('France', 'FR')");
        $this->connector->req("INSERT INTO Pays (Nom_pays, Code_pays) VALUES ('Angleterre', 'EN')");
        $this->connector->req("INSERT INTO Pays (Nom_pays, Code_pays) VALUES ('Ukraine', 'UKR')");
        $this->connector->req("INSERT INTO Pays (Nom_pays, Code_pays) VALUES ('Canada', 'CA')");
        $this->connector->req("INSERT INTO Pays (Nom_pays, Code_pays) VALUES ('Espagne', 'ES')");
        $this->connector->req("INSERT INTO Pays (Nom_pays, Code_pays) VALUES ('Italie', 'IT')");
        $this->connector->req("INSERT INTO Pays (Nom_pays, Code_pays) VALUES ('Allemagne', 'GR')");
        
        
        $max = rand(150,200);
        for($e = 1 ; $e <= $max ; $e++)
        {
            $this->connector->req("INSERT INTO Client (Nom, Prenom, Entreprise,Age) VALUES ( 'Nom".$e."', 'Prenom".$e."', 'Entreprise".$e."','".rand(30,64)."')");
        }
        
        
        for ($i = 1 ; $i <= 1000 ; $i++)
        {
            $idCmd = $i;
            $numCmd = $i;
            
            
            
            
            if ($i <= 30) {
                $date = new DateTime();
                $inter = 30 - $i;
                $intervalle = new DateInterval('P'.$inter.'D');
                $date->sub($intervalle);
            }
            else
            {
                $date = new DateTime();
                $inter = round($i * 0.1,0);
                $intervalle = new DateInterval('P'.$inter.'D');
                $date->add($intervalle);
            }
            
            $datefinprevu = $date;
            $datefinprevu->add(new DateInterval('P'.rand(1,4).'D'));
            
            $datelivraison = $datefinprevu;
            $datelivraison->add(new DateInterval('P'.rand(1,2).'D'));
            
            $adresse = '20 Rue Dupont';
            
            
            if (rand(0,100) == 0)
            {
                $annulation = 1;
            }
            else
            {
                $annulation = 0;
            }
            
            // Selection du pays
            $tab = $this->connector->req("SELECT Id_pays FROM Pays");
            $Id_pays = $tab[rand(0,count($tab)-1)];
            
            
            
            
            $this->connector->req("INSERT INTO Commandes (Id_commande,Num_cmd,Date_passage_cmd,Date_fin_prevu,Date_livraison,Adresse,Annulation,Id_pays) VALUES ('".$idCmd."','".$numCmd."','".$date->format('Y-m-d H:i:s')."','".$datefinprevu->format('Y-m-d H:i:s')."','".$datelivraison->format('Y-m-d H:i:s')."','".$adresse."','".$annulation."','".$Id_pays[0]."')");
            
            // Satisfaction
            if ($i <= 30) {
                if (rand(1,3) == 2)
                {
                    $this->connector->req("UPDATE Commandes SET Reponse_sondage='".rand(0,1)."',Satisfait='Reponses ici',Commentaire='Commentaires ici' WHERE Id_commande='".$idCmd."'");
                }                
            }
            
            $tab = $this->connector->req("SELECT Id_client FROM Client");
            $idclient = $tab[rand(0,count($tab)-1)];
            
            $this->connector->req("INSERT INTO Possede (Id_commande,Id_client) VALUES ('".$idCmd."','".$idclient[0]."')");
            
            
            
            
            // Ajout des produits ou pièces
            if (rand(0,1) == 0)
            {
                $tab = $this->connector->req("SELECT * FROM Produit");
                
                $max = rand(2,3) + round($i * 0.01,0);
                $listeProduits = array();
                for ($e = 1 ; $e < $max ; $e++)
                {
                    array_push($listeProduits,$tab[rand(0,count($tab)-1)]);
                }
                
                $prixCmdTotal = 0;
                foreach($listeProduits as $ligne)
                {
                    //print_r($ligne);
                    //exit;
                    $prixCmdTotal = $prixCmdTotal + $ligne[3];
                    $str = "INSERT INTO Ligne (Prix_produit,Id_produit,Id_commande) VALUES ('".$ligne[3]."','".$ligne[0]."','".$numCmd."')"; 
                    
                    $this->connector->req($str);
                    //echo $str;
                }
            }
            else
            {
                $tab = $this->connector->req("SELECT * FROM Piece");
                
                $max = rand(15,17) + round($i * 0.05,0);
                $listePieces = array();
                for ($e = 1 ; $e < $max ; $e++)
                {
                    array_push($listePieces,$tab[rand(0,count($tab)-1)]);
                }
                $prixCmdTotal = 0;
                foreach($listePieces as $ligne) 
                {
                    
                    $prixCmdTotal = $prixCmdTotal + $ligne[3];
                    $str = "INSERT INTO Commander_piece (Prix_piece,Id_commande,Id_piece) VALUES ('".$ligne[3]."','".$numCmd."','".$ligne[0]."')";
                    $this->connector->req($str);
                    
                    //echo $str;
                }
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
