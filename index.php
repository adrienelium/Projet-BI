

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Installation</title>
</head>
<body>
<h1>Process de génération de données</h1>

<?php

    require('Main.php');

    // ****************************************************************************************
    // Seules les informations ci-dessous sont à retoucher lors de l'installation de la solution
    // ****************************************************************************************

    $host = 'localhost';
    $user = 'root';
    $pass = 'exia2016';
    $port = 3306;
    $nomServer = 'expedition';

    // ****************************************************************************************
    // Seules les informations ci-dessus sont à retoucher lors de l'installation de la solution
    // ****************************************************************************************

?>

<p><strong>Server :</strong> <u><?php echo $nomServer; ?></u></p>
<a href="/?action=0" style="color: green;"><strong>Générer les données (<?php echo $nomServer; ?>)</strong></a><br><br>
<a href="/?reset=0" style="color: red;">Reinitialiser la base (<?php echo $nomServer; ?>)</a><br><br>



<?php
    
if (isset($_GET['action']))
{
    echo 'Initialisation de la génération pour : '.$nomServer.'<br>';
    echo '-----------------------------------------------------<br>';
    echo '-----------------------------------------------------<br><br>';

    $Programme = new Main($host,$user,$pass,$port);

    $Programme->Init($nomServer);
    $Programme->Start();

    echo '<br><br>Génération terminée pour le serveur : '.$nomServer;
    echo '<br><a href="/">Retour</a>';
}

if (isset($_GET['reset']))
{
    echo 'Réinstallation de la base pour : '.$nomServer.'<br>';
    echo '-----------------------------------------------------<br>';
    echo '-----------------------------------------------------<br><br>';
    
    $Programme = new Main($host,$user,$pass,$port);
    $Programme->InstallDatabase();
    
    echo '<br><br>Réinstallation terminée pour le serveur : '.$nomServer;
    echo '<br><a href="/">Retour</a>';
}

?>
</body>
</html>

