#Projet-BI
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/MadeInExiaCesi.jpg)

Projet CESI eXia Toulouse - A3 : [Adrien Meltzer](https://github.com/adrienelium), [Cyril Corbon](https://github.com/cyril-corbon), [Johan Dommergue](https://github.com/johanndom), [François Siegwald](https://github.com/Fitouf).

Ce projet consiste en l'étude d'une entreprise fictive : la société PlasticBoX, que l'on appelera par la suite PBX. L'entreprise existe depuis plus de 40 ans et est spécialisée dans la réalisation de boites en plastiques en tout genre. Elle souhaite par le biais d'une études BI (Business Intelligence) améliorer son système d'informations notamment sur la partie production, conditionnement et expédition.

##Diagramme de Gantt
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/gantt.JPG)

##Chronologie
Ce projet a été découpé en 5 parties la documentation qui sera réalisé en parallele de toutes les autres taches, l'infrastructure qui sera à installer et à simuler, la modélisation et le developpement des générateurs de données, l'installation et le paramettrage de l'infrastructure NoSQL et enfin la gestion des statistique et la création des tableaux de bord.  
Ce planning a été réalisé grâce a un planning poker 

 ![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/Chronologie.PNG)

## Mind Map
Une Mind map est un diagramme permettant de représenter et d'organiser des informations de façons visuelle. 
La Mind map ci-dessous représente l'ensemble du spectre de notre projet que cela soit les contraintes, les problématiques, les livrables ou les objectifs 

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

##Maquette Réseau:
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/Maquette Architecture.JPG)
Chaque bâtiments est sur un sous réseau différent. Un Vlan représente un sous réseau: en effet il y a :
Le vlan application : Il possède un serveur DNS, un serveur DHCP  un serveur stockant la base de donnée NoSQL et des postes utilisateurs. Il a pour adresse de réseau 192.168.3.0 et pour masque: 255.255.255.0.

Le vlan fabrication: Il possède un serveur hébergeant une base de données mysql et des postes utilisateurs. Il a pour adresse de réseau 192.168.0.0 et pour masque 255.255.255.0.

Le vlan préparation: Il possède un serveur hébergeant une base de données mysql et des postes utilisateurs. Il a pour adresse réseau: 192.168.1.0 et pour masque 255.255.255.0.

Pour finir, il y a le vlan expedition qui possède également une base de données mysql et des postes utilisateurs. Il a pour adresse réseau 192.168.2.0 et pour masque 255.255.255.0.
