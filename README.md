# Projet-BI
Projet CESI eXia Toulouse - A3 : [Adrien Meltzer](https://github.com/adrienelium), [Cyril Corbon](https://github.com/cyril-corbon), [Johan Dommergue](https://github.com/johanndom), François Sigwald.

Ce projet consiste en l'étude d'une entreprise fictive : la société PlasticBoX, que l'on appelera par la suite PBX. L'entreprise existe depuis plus de 40 ans et est spécialisée dans la réalisation de boites en plastiques en tout genre. Elle souhaite par le biais d'une études BI (Business Intelligence) améliorer son système d'informations notamment sur la partie production, conditionnement et expédition.

## Générateur de données 
Le générateur de données permet de généré une suite de données pour l'un des serveurs du réseaux, 4 algorithmes de génération sont enregistrés :
  - Algo fabrication
  - Algo preparation
  - Algo adminsitratif
  - Algo expedition
  
Lors de l'installation du système de génération, il convient de modifier le fichier [index.php](https://github.com/adrienelium/Projet-BI/blob/master/index.php), et de renseigner les paramètres de connexion à la base de données, ainsi que le nom du serveur / nom de l'algo à utiliser.
**Le nom de la base est identique à l'identifiant de connexion à la base**

UML du générateur :

![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/uml-1.png?raw=true)
