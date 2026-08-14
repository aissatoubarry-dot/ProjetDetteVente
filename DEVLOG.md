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



- Heure de réalisation** : 20h30 - 22h00

- Ce qui a été fait** :
  - Transformation du diagramme de classes UML en schéma relationnel.
  - Création du script `schema.sql` pour PostgreSQL.
  - Création du script `schema_sqlite.sql` pour le fallback SQLite.
  - Création des tables Produit, Client, Commande, LigneCommande, Dette, Paiement, Fournisseur, Approvisionnement et LigneApprovisionnement.
  - Mise en place des clés primaires et des clés étrangères.
  - Ajout des contraintes `NOT NULL` et `CHECK` pour garantir la cohérence des données.
  - Mise en place de la relation entre une commande et une dette avec une dette facultative.
  - Mise en place des relations entre les produits, les lignes de commande et les lignes d'approvisionnement.
  - Ajout de la contrainte d'unicité sur le numéro de bon de livraison.

- Difficultés / Obstacles :
  - Traduction des multiplicités UML en contraintes SQL.
  - Différence entre la syntaxe PostgreSQL (`SERIAL`) et SQLite (`AUTOINCREMENT`).
  - Détermination des clés étrangères nécessaires pour représenter les associations entre les entités.
  - Mise en place des contraintes `CHECK` pour empêcher les quantités et montants négatifs.