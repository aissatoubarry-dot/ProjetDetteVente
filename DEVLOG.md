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