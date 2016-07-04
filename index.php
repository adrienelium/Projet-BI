<?php

require('Main.php');

// ****************************************************************************************//
// Seules les informations ci-dessous sont à retoucher lors de l'installation de la solution
// ****************************************************************************************//

var $host = 'localhost';
var $user = 'root';
var $pass = '';
var $port = 3306;
var $nomServer = 'xxx';

// ****************************************************************************************//
// Seules les informations ci-dessus sont à retoucher lors de l'installation de la solution
// ****************************************************************************************//

echo 'Initialisation de la génération pour : '.$nomServer.'<br>';
echo '-----------------------------------------------------<br>';
echo '-----------------------------------------------------<br>';

$Programme = new Main($host,$user,$pass,$port);

$Programme->Init($nomServer);
$Programme->Start();

echo '<br>Génération terminée pour le serveur : '.$nomServer;


