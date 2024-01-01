CREATE DATABASE emensawerbeseite
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE emensawerbeseite;

CREATE TABLE gericht(
    id INT8 PRIMARY KEY,
    name VARCHAR(80) NOT NULL UNIQUE,
    beschreibung VARCHAR(800) NOT NULL,
    erfasst_am DATE NOT NULL,
    vegetarisch BOOL NOT NULL,
    vegan BOOL NOT NULL,
    preis_intern DOUBLE NOT NULL,
    preis_extern DOUBLE NOT NULL CHECK(preis_intern <= preis_extern),
    bildname VARCHAR(200) DEFAULT '00_image_missing.jpg'
);

CREATE TABLE allergen(
    code CHAR(4) PRIMARY KEY NOT NULL,
    name VARCHAR(300) NOT NULL,
    typ VARCHAR(20) NOT NULL
);

CREATE TABLE kategorie(
    id INT8 PRIMARY KEY,
    name VARCHAR(80) NOT NULL,
    eltern_id INT8 REFERENCES kategorie(id),
    bildname VARCHAR(200)
);

CREATE TABLE gericht_hat_allergen(
    code CHAR(4) REFERENCES allergen(code) ON UPDATE CASCADE ,
    gericht_id INT8 NOT NULL REFERENCES gericht(id) ON DELETE CASCADE
);

CREATE TABLE gericht_hat_kategorie(
    gericht_id INT8 NOT NULL REFERENCES gericht(id) ON DELETE CASCADE,
    kategorie_id INT8 NOT NULL REFERENCES kategorie(id),
    PRIMARY KEY(gericht_id, kategorie_id)

);

CREATE TABLE wunschgericht(
    wunsch_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80),
    beschreibung VARCHAR(800),
    erstellungsdatum DATE,
    erstellt_von_userid BIGINT UNSIGNED REFERENCES users(id)
);


CREATE TABLE statistiken(
    anzahl_besuche BIGINT NOT NULL
);

ALTER TABLE users
    ADD COLUMN admin BOOL NOT NULL DEFAULT FALSE,
    ADD COLUMN anzahl_fehler INT NOT NULL DEFAULT 0,
    ADD COLUMN anzahl_anmeldungen INT NOT NULL DEFAULT 0,
    ADD COLUMN letzte_anmeldung DATETIME,
    ADD COLUMN letzter_fehler DATETIME;

CREATE INDEX name_index ON users(name);

CREATE TABLE bewertung(
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    bemerkung VARCHAR(800) CHECK(LENGTH(bemerkung) > 5) ,
    sterne TINYINT CHECK(sterne < 5 and sterne > 0),
    bewertungszeitpunkt DATETIME,
    erstellt_von_user_id BIGINT UNSIGNED REFERENCES users(id),
    gericht_id BIGINT REFERENCES gericht(id),
    hervorgehoben BOOLEAN DEFAULT FALSE
);

CREATE PROCEDURE updateUserStatistics(IN username VARCHAR(200), IN date DATETIME)
BEGIN
    DECLARE counter INT DEFAULT 0;
    SELECT anzahl_anmeldungen INTO counter FROM benutzer WHERE name = username;
    SET counter = counter + 1;
    UPDATE benutzer SET anzahl_anmeldungen = counter, letzte_anmeldung = date WHERE name = username;
END;

