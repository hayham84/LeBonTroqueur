CREATE TABLE IF NOT EXISTS Role
(
    ID_Role  SERIAL PRIMARY KEY,
    nom_role VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS "user"
(
    ID_User SERIAL PRIMARY KEY,
    nom     VARCHAR(50)         NOT NULL,
    prenom  VARCHAR(50)         NOT NULL,
    tel     VARCHAR(20)         NOT NULL,
    mail    VARCHAR(100) UNIQUE NOT NULL,
    mdp     VARCHAR(255)        NOT NULL,
    ID_Role INT                 NOT NULL,
    FOREIGN KEY (ID_Role) REFERENCES Role (ID_Role) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Annonce
(
    ID_Annonce   SERIAL PRIMARY KEY,
    title        VARCHAR(255) NOT NULL,
    description  TEXT         NOT NULL,
    localisation VARCHAR(255) NOT NULL,
    price        int          NOT NULL,
    ID_User      INT          NOT NULL,
    FOREIGN KEY (ID_User) REFERENCES "user" (ID_User)
);

CREATE TABLE IF NOT EXISTS Annonce_Image
(
    ID_Image   SERIAL PRIMARY KEY,
    ID_Annonce INT   NOT NULL,
    image      VARCHAR(255) NOT NULL,
    FOREIGN KEY (ID_Annonce) REFERENCES Annonce (ID_Annonce)
);

INSERT INTO role (nom_role)
VALUES ('Admin');
INSERT INTO role (nom_role)
VALUES ('User');