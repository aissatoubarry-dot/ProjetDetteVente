 Journal de Développement (DEVLOG)

Nom & Prénom : Aïssatou Barry
Projet : StoreManager Pro (ERP PHP/POO)

 Suivi Chronologique des Phases
 [Vendredi - Phase 1] : Conception & BDD Fallback

Commit 1 — Conception UML

Heure de réalisation : 19h00 - 20h30

Ce qui a été fait :
J'ai commencé par analyser le fonctionnement général de l'application.
J'ai identifié les quatre profils qui vont utiliser le système : Admin, Chargé de Vente, Chargé de Stock et Inventaire.
J'ai ensuite identifié les principales fonctionnalités de chaque profil et réalisé les diagrammes de cas d'utilisation avec PlantUML.
J'ai également réalisé le diagramme de classes avec les principales classes : Produit, Client, Commande, LigneCommande, Dette, Paiement, Fournisseur, Approvisionnement et LigneApprovisionnement.
J'ai défini les associations et les multiplicités entre les différentes classes.

Choix effectués :
J'ai séparé les fonctionnalités selon les rôles afin que chaque utilisateur ait des responsabilités précises.
J'ai séparé Commande et LigneCommande car une commande peut contenir plusieurs produits.
J'ai aussi séparé Dette et Paiement car une dette peut être réglée en plusieurs fois.

Difficultés / Obstacles :
J'ai surtout eu des difficultés à différencier le rôle du Chargé de Stock et celui de l'Inventaire.


Éléments importants à retenir :
Cette étape m'a permis de mieux comprendre le fonctionnement global de l'application avant de commencer le développement.
J'ai compris que le diagramme de cas d'utilisation permet de définir qui fait quoi dans le système.
Le diagramme de classes permet de définir les principales données et leurs relations.






 [Vendredi - Phase 1] : Conception & BDD Fallback

Step 1.3 — Singleton Database & Fallback Automatique

Heure de réalisation : 22h00 - 23h00

Ce qui a été fait :
J'ai créé la classe Database dans src/Core/Database.php.
J'ai mis en place une connexion à PostgreSQL avec PDO.
J'ai ajouté un try/catch pour gérer les erreurs de connexion.
Si la connexion PostgreSQL échoue, l'application utilise automatiquement SQLite avec le fichier erp.db.
J'ai également utilisé le principe du Singleton afin de ne créer qu'une seule instance de la classe Database.
La méthode getInstance() permet de récupérer cette instance.

Choix effectués :
J'ai choisi PDO pour gérer la connexion aux bases de données.
J'ai choisi PostgreSQL comme base principale et SQLite comme solution de secours.
Le Singleton permet d'éviter de créer plusieurs connexions inutilement.

Difficultés / Obstacles :
J'ai eu quelques difficultés à comprendre le fonctionnement du Singleton, notamment pourquoi le constructeur doit être privé et pourquoi la méthode getInstance() est statique.
J'ai également dû comprendre le fonctionnement du try/catch pour pouvoir utiliser SQLite lorsque la connexion PostgreSQL échoue.

Éléments importants à retenir :
Cette étape m'a permis de comprendre comment centraliser la connexion à la base de données.
J'ai compris que le Singleton permet de conserver une seule instance de Database.
J'ai aussi compris le principe du fallback : si PostgreSQL ne fonctionne pas, SQLite prend automatiquement le relais.


