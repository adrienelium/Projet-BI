 # Projet-BI

Projet CESI eXia Toulouse - A3 : [Adrien Meltzer](https://github.com/adrienelium), [Cyril Corbon](https://github.com/cyril-corbon), [Johan Dommergue](https://github.com/johanndom), [François Sigwald](https://github.com/Fitouf).

Ce projet consiste en l'étude d'une entreprise fictive : la société PlasticBoX, que l'on appelera par la suite PBX. L'entreprise existe depuis plus de 40 ans et est spécialisée dans la réalisation de boites en plastiques en tout genre. Elle souhaite par le biais d'une études BI (Business Intelligence) améliorer son système d'informations notamment sur la partie production, conditionnement et expédition.

## Mind Map

![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/Mindmap.PNG)

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

## Modélisation de la base de données (MERISE) : 

Le systeme d'information de PlasticBoX contient 4 base de données mysql

La premiere base de données est la base du **service administratif** elle permet de traiter l'ensemble des éléments correspondant à une commandes tels que : les pieces, les produit, les client, les pays ... 

![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/administration.jpg)

La deuxieme base de données gère le **service de production**, elle permet de gerer l'ensemble des informations relative a la chaine de production soit : l'ensembles des pieces qui doivent etre fabriqués, les différents états des différentes machines, les stocks dus aux commandes annulées ...

![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/fabrication.jpg)


La troisième base de données gère le **service de conditionnement**, elle permet d'avoir les informations sur la chaine de conditionnement soit : l'ensemble des produits qui doivent etre conditionnés, les différents état des machines et les différentes pannes (ou maintenances) effectués sur ces même machine.

![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/conditionnement.jpg)

Enfin la base de données du **service expedition** permet d'avoir les informations sur le type d'envoie du produit fini ainsi que d'autres informations tels que sa date d'expidition ou son type de pallete 

![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/expedition.jpg)

