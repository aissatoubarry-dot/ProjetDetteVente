CREATE TABLE produit (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prix_achat NUMERIC(12,2) NOT NULL CHECK (prix_achat >= 0),
    prix_vente NUMERIC(12,2) NOT NULL CHECK (prix_vente >= 0),
    quantite_stock INTEGER NOT NULL DEFAULT 0 CHECK (quantite_stock >= 0)
);


CREATE TABLE client (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    limite_credit NUMERIC(12,2) NOT NULL DEFAULT 0 CHECK (limite_credit >= 0)
);


CREATE TABLE fournisseur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    adresse VARCHAR(255) NOT NULL
);


CREATE TABLE commande (
    id SERIAL PRIMARY KEY,
    client_id INTEGER NOT NULL,
    date_commande DATE NOT NULL DEFAULT CURRENT_DATE,
    montant_total NUMERIC(12,2) NOT NULL CHECK (montant_total >= 0),
    mode_reglement VARCHAR(50) NOT NULL,
    CONSTRAINT fk_commande_client FOREIGN KEY (client_id) REFERENCES client(id)
);


CREATE TABLE ligne_commande (
    id SERIAL PRIMARY KEY,
    commande_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,
    quantite INTEGER NOT NULL CHECK (quantite > 0),
    prix_unitaire NUMERIC(12,2) NOT NULL CHECK (prix_unitaire >= 0),
    CONSTRAINT fk_ligne_commande_commande FOREIGN KEY (commande_id) REFERENCES commande(id)ON DELETE CASCADE,
    CONSTRAINT fk_ligne_commande_produit FOREIGN KEY (produit_id) REFERENCES produit(id)
);


CREATE TABLE dette (
    id SERIAL PRIMARY KEY,
    commande_id INTEGER NOT NULL UNIQUE,
    montant_initial NUMERIC(12,2) NOT NULL CHECK (montant_initial > 0),
    montant_restant NUMERIC(12,2) NOT NULL CHECK (montant_restant >= 0),
    statut VARCHAR(30) NOT NULL CHECK (statut IN ('EN_COURS', 'SOLDEE')),
    CONSTRAINT fk_dette_commande FOREIGN KEY (commande_id) REFERENCES commande(id)
);


CREATE TABLE paiement (
    id SERIAL PRIMARY KEY,
    dette_id INTEGER NOT NULL,
    montant NUMERIC(12,2) NOT NULL CHECK (montant > 0),
    date_paiement DATE NOT NULL DEFAULT CURRENT_DATE,
    mode_paiement VARCHAR(50) NOT NULL,
    CONSTRAINT fk_paiement_dette FOREIGN KEY (dette_id) REFERENCES dette(id)
);


CREATE TABLE approvisionnement (
    id SERIAL PRIMARY KEY,
    fournisseur_id INTEGER NOT NULL,
    date_reception DATE NOT NULL DEFAULT CURRENT_DATE,
    numero_bl VARCHAR(100) NOT NULL UNIQUE,
    CONSTRAINT fk_approvisionnement_fournisseur FOREIGN KEY (fournisseur_id) REFERENCES fournisseur(id)
);


CREATE TABLE ligne_approvisionnement (
    id SERIAL PRIMARY KEY,
    approvisionnement_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,
    quantite_recue INTEGER NOT NULL CHECK (quantite_recue > 0),
    prix_achat_unitaire NUMERIC(12,2) NOT NULL CHECK (prix_achat_unitaire >= 0),
    CONSTRAINT fk_ligne_approvisionnement_approvisionnement FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement(id)ON DELETE CASCADE,
    CONSTRAINT fk_ligne_approvisionnement_produit FOREIGN KEY (produit_id) REFERENCES produit(id)
);