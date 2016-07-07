#Projet-BI
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/MadeInExiaCesi.jpg)

Projet CESI eXia Toulouse - A3 : [Adrien Meltzer](https://github.com/adrienelium), [Cyril Corbon](https://github.com/cyril-corbon), [Johan Dommergue](https://github.com/johanndom), [François Siegwald](https://github.com/Fitouf).

Ce projet consiste en l'étude d'une entreprise fictive : la société PlasticBoX, que l'on appelera par la suite PBX. L'entreprise existe depuis plus de 40 ans et est spécialisée dans la réalisation de boites en plastiques en tout genre. Elle souhaite par le biais d'une études BI (Business Intelligence) améliorer son système d'informations notamment sur la partie production, conditionnement et expédition.

##Diagramme de Gantt
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/gantt.JPG)

Nous avons divisé le projet en cinq parties principales, à savoir:
les parties infrastructure, développement des simulateurs, création de la base de données NoSQL et la gestion des statistiques.

Infrastructure:
Divisée en quatre sous parties, la partie infrastructure comprend:
L'installation et le paramètrage des serveurs sur les VM, l'installation des bases de données sur ces serveurs, et le maquettage de l'architecture réseau à l'aide de packet tracer.

Développement des simulateurs:
La partie développement des simulateurs comprend:
La création d'un Github afin de regrouper les différentes parties du projet, la modélisation des tables merise et UML et la création des scripts de génération de données. 

Création de la base de données NoSQL:
La partie création de la base de données NoSQL comprend:
L'installation de la base et la création de l'ETL.

Gestion des statistiques:
Cette partie comprend: Le calcul des statistiques pour chaque zones de production, le choix et la mise en place des indicateurs et la création des différents dashboard.

Pour finir, une partie document comprend le Github qui présente l'ensemble du projet et le power point à présenter lors de la soutenance.

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


##Adressage IP:
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/Adressage.JPG)
L'entreprise se divise en quatre sous réseaux (un pour chaque Vlan). Chaque sous réseau peut avoir un total de 254 utilisateurs. 
##Maquette Réseau:
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/Maquette réseau.JPG)
Chaque bâtiments est sur un sous réseau différent. Un Vlan représente un sous réseau: en effet il y a :
Le vlan application : Il possède un serveur DNS, un serveur DHCP  un serveur stockant la base de donnée NoSQL et des postes utilisateurs. Il a pour adresse de réseau 192.168.3.0 et pour masque: 255.255.255.0.

Le vlan fabrication: Il possède un serveur hébergeant une base de données mysql et des postes utilisateurs. Il a pour adresse de réseau 192.168.0.0 et pour masque 255.255.255.0.

Le vlan préparation: Il possède un serveur hébergeant une base de données mysql et des postes utilisateurs. Il a pour adresse réseau: 192.168.1.0 et pour masque 255.255.255.0.

Pour finir, il y a le vlan expedition qui possède également une base de données mysql et des postes utilisateurs. Il a pour adresse réseau 192.168.2.0 et pour masque 255.255.255.0.

Mise en place du protocole VTP:
Le protocole VTP permet de configurer et administrer des VLAN. Il fonctionne sous trois modes: client, serveur transparent.
En mode serveur, il est possible de créer, modifier ou supprimer des vlans Et de les transmettre aux clients. Les vlan sont crées sur les coeurs de réseaux de l'entreprise, puis sont répartis sur les différents switchs. Les coeurs de réseau sont en mode server et les switchs sont en mode client.

Mise en place du protocole Spanning-tree :

L'objectif du protocole Spanning-tree est de vérifier qu'il n'y ai pas de boucle dans le réseau. Il est mis en place sur les switchs

Afin de gérer la redondance de la maquette, tous les switchs et routeurs ont été doublés. De plus, le protocole Spanning-tree a été utilisé afin d'avoir une redondance optimisée au maximum.



##Installation des VM et création des bases de données

Comme vu précédemment, l'entreprise est divisée en quatre bâtiments distincts comprenant chacun une base de données (le bâtiment administration est également composé de la base NoSQL). 

Les serveurs administration, fabrication, préparation, fabrication et préparation ont été crées sur quatre VM debian distinctes dotées d'un serveur web Apache. Les quatre bases de données ont été crées sur un serveur de bases de données Mysql. Ils ont pour adresse respective:
Serveur administration: 192.168.0.101
Serveur préparation: 192.168.0.102
Serveur fabrication: 192.168.0.103
Serveur expedition: 192.168.0.104

Le serveur NoSQL, quand à lui, a été" installé sur Windows 7 et utilise le SGBD CouchDB qui va permettre la répartition des données sur les différents serveurs. Les données renvoyées sont au format JSON.

##Définitions des indicateurs et des KPI
###Gestion des commandes

###Gestion de la satisfaction 

###Gestion de la fabrication 

###Gestion du conditionnement

###Gestion de l'expedition 

###Gestion du CA et de la marge 

##DashBoard
![alt tag](https://github.com/adrienelium/Projet-BI/blob/master/DashBoard_Commande.PNG)
