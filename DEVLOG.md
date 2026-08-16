DEVLOG

Nom : Aïssatou BARRY
Projet : StoreManager Pro


Phase 1 : Conception UML

Heure : 19h00 - 20h30

Ce qui a été fait :
- Création du diagramme de cas d'utilisation.
- Création du diagramme de classes.
- Identification des acteurs et des principales classes.
- Enregistrement des diagrammes dans le dossier /docs.

Difficultés rencontrées :
- Comprendre les rôles des différents acteurs.
- Déterminer les relations entre les classes.


Phase 1 : Schéma BDD

Heure : 20h30 - 22h00

Ce qui a été fait :
- Transformation du diagramme de classes UML en schéma relationnel.
- Création du script schema.sql pour PostgreSQL.
- Création du script schema_sqlite.sql pour le fallback SQLite.
- Création des tables Produit, Client, Commande, LigneCommande, Dette, Paiement, Fournisseur, Approvisionnement et LigneApprovisionnement.
- Mise en place des clés primaires et des clés étrangères.
- Ajout des contraintes NOT NULL et CHECK pour garantir la cohérence des données.
- Mise en place de la relation entre une commande et une dette avec une dette facultative.
- Mise en place des relations entre les produits, les lignes de commande et les lignes d'approvisionnement.
- Ajout de la contrainte d'unicité sur le numéro de bon de livraison.

Difficultés / Obstacles :
- Traduction des multiplicités UML en contraintes SQL.
- Différence entre la syntaxe PostgreSQL (SERIAL) et SQLite (AUTOINCREMENT).
- Détermination des clés étrangères nécessaires pour représenter les associations entre les entités.
- Mise en place des contraintes CHECK pour empêcher les quantités et montants négatifs.


Phase 1 : Database Fallback

Heure : 22h00 - 23h00

Ce qui a été fait :
- Création de la classe Database dans src/Core/Database.php.
- Mise en place de la connexion à PostgreSQL avec PDO.
- Ajout d'un try/catch pour gérer les erreurs de connexion.
- Mise en place du fallback vers SQLite avec le fichier erp.db si PostgreSQL échoue.
- Mise en place du Singleton avec la méthode getInstance().
- Ajout de la méthode getConnexion() pour récupérer la connexion.

Choix effectués :
- Utilisation de PostgreSQL comme base principale.
- Utilisation de SQLite comme solution de secours.
- Utilisation du Singleton pour éviter de créer plusieurs instances de Database.

Difficultés / Obstacles :
- Comprendre le fonctionnement du Singleton.
- Comprendre pourquoi le constructeur de Database est privé.
- Comprendre le rôle de la méthode getInstance().
- Comprendre le fonctionnement du try/catch et du fallback vers SQLite.


Samedi - Phase 2

Step 2.1 — Entités POO

Heure de réalisation : 09h00 - 11h00

Ce qui a été fait :
- Création des différentes entités POO dans le dossier src/Model/Entity.
- Création des classes Produit, Client, Commande, LigneCommande, Dette, Paiement, Fournisseur, Approvisionnement et LigneApprovisionnement.
- Utilisation de propriétés privées afin de respecter le principe d'encapsulation.
- Ajout des constructeurs et des getters pour accéder aux informations des objets.
- Ajout de quelques méthodes métier comme augmenterStock(), diminuerStock(), calculerMontant() et enregistrerPaiement().

Choix effectués :
- Séparation des commandes et de leurs lignes.
- Séparation des approvisionnements et de leurs lignes.
- Les entités restent indépendantes de la base de données et ne contiennent pas de requêtes SQL.
- La gestion des clés étrangères et de la base de données sera réalisée avec les Repository.

Difficultés / Obstacles :
- Comprendre pourquoi les clés étrangères ne sont pas directement mises dans les constructeurs des entités.

Éléments importants à retenir :
- Cette étape m'a permis de mieux comprendre l'encapsulation et le rôle des entités en POO.
- J'ai compris qu'ici il ya autant d'entite que de tables dans la base de données.
- J'ai compris que les entités ne doivent pas gérer directement la base de données.
- La communication avec la base de données sera réalisée avec les Repository.




Phase 2 : Repositories

Heure : 11h00 - 13h00

Ce qui a été fait :
- Création de ProduitRepository, ClientRepository et FournisseurRepository.
- Mise en place de la connexion avec Database.
- Utilisation de PDO pour exécuter les requêtes.
- Utilisation des requêtes préparées avec prepare() et execute().
- Utilisation de FETCH_CLASS pour récupérer les résultats sous forme d'objets.
- Ajout des méthodes pour lister les éléments et rechercher un élément par son id.

Choix effectués :
- Utilisation de FETCH_CLASS pour travailler directement avec les entités POO.
- Utilisation des paramètres nommés comme :id pour sécuriser les requêtes.

Difficultés / Obstacles :
- Comprendre le rôle des Repository.
- Comprendre l'utilisation de FETCH_CLASS pour transformer les résultats SQL en objets.
- Comprendre le fonctionnement de prepare() et execute().



Phase 2 : VenteService

Heure de réalisation : 14h00 - 17h00

Ce qui a été fait :
Création de la classe VenteService pour gérer la logique d'une vente.
Mise en place de la gestion des lignes de commande et de la vérification du stock avant la vente.
Calcul du montant total à partir des produits et des quantités.
Ajout du contrôle de la limite de crédit pour les ventes à crédit.
Utilisation d'une transaction PDO avec beginTransaction(), commit() et rollBack().
Enregistrement de la commande et de ses lignes, puis diminution du stock.
Création automatique d'une dette lorsqu'une vente est effectuée à crédit.
Utilisation des requêtes préparées avec prepare() et execute().
Utilisation de RETURNING id et fetchColumn() pour récupérer l'identifiant de la commande.

Choix effectués :
La logique de la vente est regroupée dans VenteService .
La transaction permet de valider toutes les opérations ensemble ou de les annuler en cas d'erreur.

Difficultés / Obstacles :
Compréhension du fonctionnement des transactions et du rollback.
Compréhension de fetchColumn() pour récupérer une valeur retournée par une requête.
Mise en place du contrôle de la limite de crédit avant la création d'une vente à crédit.


Éléments importants à retenir :
Le Service contient les principales règles métier de la vente.
La transaction permet d'éviter une vente enregistrée seulement en partie.
Le contrôle du stock et de la limite de crédit est effectué avant de valider la vente.





Phase 2 : Interface POS

Heure de réalisation : 17h00 - 20h00

Ce qui a été fait :
- Création du POSController pour gérer l'interface de caisse.
- Connexion de la vue POS au POSController.
- Récupération dynamique des clients et des produits depuis la base de données.
- Mise en place du formulaire de création d'une vente avec la méthode POST.
- Récupération du client sélectionné, des produits, des quantités et du mode de règlement.
- Connexion du POSController au VenteService pour enregistrer les ventes.
- Dynamisation de la liste des clients et des produits dans la vue.
- Mise en place de l'affichage dynamique du panier.

Choix effectués :
- Utilisation du POSController pour faire le lien entre la vue et le VenteService.
- Utilisation des données provenant directement de la base de données pour rendre la vue dynamique.
- Utilisation de la méthode POST pour transmettre les informations de la vente au contrôleur.
- Utilisation des identifiants des clients et des produits pour permettre au VenteService de retrouver les éléments concernés.

Difficultés / Obstacles :
- Comprendre le passage des données entre la vue, le contrôleur et le service.
- Comprendre pourquoi les données provenant de $_POST sont de type string.
- Gestion de la récupération des identifiants lors de la création des objets Client et Produit.
- Adaptation de la récupération des données après l'abandon de FETCH_CLASS.
- Comprendre le fonctionnement des données du panier envoyées avec product_ids[] et product_qtys[].

Éléments importants à retenir :
- Le Controller fait le lien entre la vue et le Service.
- La vue affiche les données récupérées par le Controller.
- Les données du formulaire sont transmises au Controller avec POST.
- Le Service reste responsable de la logique métier de la vente.
- Les Repository restent responsables de la récupération des données depuis la base de données.



Phase 3 : Gestion des Dettes & Remboursements

Heure : 09h00 - 11h30

Ce qui a été fait :
- Création de DetteRepository pour récupérer les dettes associées aux commandes et aux clients.
- Mise en place de la récupération des informations du client liées à chaque dette.
- Création de DebtService pour gérer la logique des remboursements.
- Mise en place du remboursement partiel d'une dette.
- Vérification que le montant du remboursement est supérieur à 0.
- Vérification que le montant du remboursement ne dépasse pas le montant restant.
- Enregistrement du remboursement dans la table paiement.
- Mise à jour du montant restant de la dette après chaque remboursement.
- Mise à jour automatique du statut de la dette.
- Passage du statut à SOLDEE lorsque le montant restant atteint 0.
- Conservation du statut EN_COURS lorsqu'il reste encore un montant à payer.
- Utilisation d'une transaction PDO avec beginTransaction(), commit() et rollBack().
- Création de DetteController pour gérer l'affichage des dettes et les remboursements.
- Mise en place de l'affichage dynamique des dettes dans l'interface.
- Ajout de l'affichage du montant initial, du montant payé, du reste dû et du statut.
- Ajout du formulaire permettant d'effectuer un remboursement depuis l'interface.
- Ajout d'un message de confirmation après un remboursement réussi.

Choix effectués :
- La logique du remboursement est placée dans DebtService.
- DetteRepository est utilisé pour récupérer les données des dettes.
- DetteController assure la communication entre la vue et le service.
- Les remboursements sont enregistrés dans la table paiement afin de conserver l'historique des paiements.
- Une transaction est utilisée afin d'assurer la cohérence entre l'enregistrement du paiement et la mise à jour de la dette.

Difficultés / Obstacles :
- Comprendre le lien entre une dette, une commande et un client.
- Faire communiquer correctement DetteController avec DebtService.
- Faire apparaître les dettes dans la vue principale qui contient plusieurs parties de l'application.
- Identifier les données disponibles dans le tableau retourné par le Repository.
- Corriger l'utilisation de la clé restedu qui ne correspondait pas au nom réel montant_restant.
- Mettre en place le routage permettant de distinguer une création de vente d'un remboursement.



Éléments importants à retenir :
- DebtService contient les principales règles métier liées au remboursement.
- Un remboursement partiel diminue le montant_restant de la dette.
- Une dette passe à SOLDEE uniquement lorsque son montant_restant atteint 0.
- La table paiement permet de conserver l'historique des remboursements.
- La transaction permet de garantir que l'enregistrement du paiement et la mise à jour de la dette sont réalisés ensemble.
- Le Repository récupère les données, le Service applique les règles métier et le Controller fait le lien avec la vue.