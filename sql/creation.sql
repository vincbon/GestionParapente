DROP SCHEMA IF EXISTS gsi CASCADE;

CREATE SCHEMA GSI;

-- Création des tables et vues

CREATE TABLE GSI.T_PARCOURS_PRC (
	PRC_ID			SERIAL NOT NULL,
	PRC_NOM			VARCHAR(32) NOT NULL,
	PRC_VILLE		VARCHAR(32) NOT NULL,
	PRC_SITE_DEC	VARCHAR(200) NOT NULL,
	PRC_SITE_ATT	VARCHAR(200) NOT NULL,
	PRC_COMMENTAIRE VARCHAR(200) NOT NULL DEFAULT 'aucun commentaire'::VARCHAR(200),
	CONSTRAINT C_PK_PRC PRIMARY KEY(PRC_ID)
);

CREATE OR REPLACE VIEW GSI.PARCOURS AS (
	SELECT PRC_ID AS ID, PRC_NOM AS NOM, PRC_VILLE AS VILLE, PRC_SITE_DEC AS SITE_DECOLLAGE,
		PRC_SITE_ATT AS SITE_ATTERRISSAGE, PRC_COMMENTAIRE AS COMMENTAIRE
	FROM GSI.T_PARCOURS_PRC
);


-- Table 'abstraite', pas de vue
CREATE TABLE GSI.T_PERSONNE_PER (
	PER_ID			SERIAL NOT NULL,
	PER_NOM			VARCHAR(36) NOT NULL,
	PER_PRENOM		VARCHAR(32) NOT NULL,
	PER_DDN			DATE NOT NULL,
	PER_TAILLE		INTEGER NOT NULL,
	PER_POIDS		INTEGER NOT NULL,
	PER_ADR			VARCHAR(128) NOT NULL,
	PER_VILLE		VARCHAR(32) NOT NULL,
	PER_CP			VARCHAR(5) NOT NULL,
	PER_TEL			VARCHAR(10) NOT NULL,
	CONSTRAINT C_PK_PER PRIMARY KEY(PER_ID),
	CONSTRAINT C_CHK_TAILLE_PER CHECK (PER_TAILLE >= 0),
	CONSTRAINT C_CHK_POIDS_PER CHECK (PER_POIDS >= 0)
);


CREATE TABLE GSI.T_PILOTE_PIL (
	PER_ID				INTEGER NOT NULL,
	PIL_NO_LICENCE		VARCHAR(20) NOT NULL,
	PIL_NIVEAU			VARCHAR(10) NOT NULL,
	PIL_QUAL_BIPLACE	BOOLEAN NOT NULL DEFAULT FALSE,
	CONSTRAINT C_PK_PIL PRIMARY KEY(PER_ID),
	CONSTRAINT C_UNI_NO_LICENCE_PIL UNIQUE(PIL_NO_LICENCE),
	CONSTRAINT C_FK_PER_PIL FOREIGN KEY(PER_ID) REFERENCES GSI.T_PERSONNE_PER
);

CREATE OR REPLACE VIEW GSI.PILOTE AS (
	SELECT PER_ID AS ID, PER_NOM AS NOM, PER_PRENOM AS PRENOM, PIL_NO_LICENCE AS NO_LICENCE,
		PIL_NIVEAU AS NIVEAU, PIL_QUAL_BIPLACE AS QUALIFICATION_BIPLACE, 
		PER_DDN AS DATE_DE_NAISSANCE, PER_TAILLE AS TAILLE, PER_POIDS AS POIDS, PER_ADR AS ADRESSE,
		PER_VILLE AS VILLE, PER_CP AS CODE_POSTAL, PER_TEL AS TELEPHONE
	FROM GSI.T_PILOTE_PIL NATURAL JOIN GSI.T_PERSONNE_PER
);


CREATE TABLE GSI.T_INVITE_INV (
	PER_ID	INTEGER NOT NULL,
	CONSTRAINT C_PK_INV PRIMARY KEY(PER_ID),
	CONSTRAINT C_FK_PER_INV FOREIGN KEY(PER_ID) REFERENCES GSI.T_PERSONNE_PER
);

CREATE OR REPLACE VIEW GSI.INVITE AS (
	SELECT PER_ID AS ID, PER_NOM AS NOM, PER_PRENOM AS PRENOM, PER_DDN AS DATE_DE_NAISSANCE,
		PER_TAILLE AS TAILLE, PER_POIDS AS POIDS, PER_ADR AS ADRESSE,
		PER_VILLE AS VILLE, PER_CP AS CODE_POSTAL, PER_TEL AS TELEPHONE
	FROM GSI.T_INVITE_INV NATURAL JOIN GSI.T_PERSONNE_PER
);


CREATE TABLE GSI.T_PARAPENTE_PAR (
	PAR_IMMAT			VARCHAR(32) NOT NULL,
	PAR_OK				BOOLEAN NOT NULL DEFAULT TRUE,
	PAR_BIPLACE			BOOLEAN NOT NULL DEFAULT FALSE,
	PAR_MARQUE			VARCHAR(32) NOT NULL,
	PAR_MODELE			VARCHAR(32) NOT NULL,
	PAR_TAILLE		 	VARCHAR(10) NOT NULL,
	PAR_PTV				INT4RANGE NOT NULL,
	CONSTRAINT C_PK_PAR PRIMARY KEY(PAR_IMMAT)
);

CREATE OR REPLACE VIEW GSI.PARAPENTE AS (
	SELECT PAR_IMMAT AS IMMATRICULATION, PAR_MARQUE AS MARQUE,
		PAR_MODELE AS MODELE, PAR_TAILLE AS TAILLE, PAR_PTV AS PTV,
		PAR_BIPLACE AS BIPLACE, PAR_OK AS EN_ETAT_DE_VOLER
	FROM GSI.T_PARAPENTE_PAR
);


-- Table 'abstraite', pas de vue
CREATE TABLE GSI.T_CONTROLE_TECHNIQUE_CTE (
	CTE_ID					SERIAL NOT NULL,
	CTE_COMMENTAIRE 		VARCHAR(200) NOT NULL DEFAULT 'aucun commentaire',
	CTE_RES_VOILE			BOOLEAN NOT NULL,
	CTE_RES_SUSPENTES		BOOLEAN NOT NULL,
	CTE_RES_FREINS			BOOLEAN NOT NULL,
	CTE_RES_SELLETTE		BOOLEAN NOT NULL,
	CTE_RES_ACCELERATEUR	BOOLEAN NOT NULL,
	CTE_RES_TRIM		 	BOOLEAN NOT NULL,
	CTE_RES_CASQUE		 	BOOLEAN NOT NULL,
	CONSTRAINT C_PK_CTE PRIMARY KEY(CTE_ID)
);


CREATE TABLE GSI.T_CONTROLE_ANNUEL_CTA (
	CTE_ID		INTEGER NOT NULL,
	PAR_IMMAT	VARCHAR(32) NOT NULL,
	CTA_DATE	DATE NOT NULL,
	CONSTRAINT C_PK_CTA PRIMARY KEY(CTE_ID),
	CONSTRAINT C_FK_CTE_CTA FOREIGN KEY(CTE_ID) REFERENCES GSI.T_CONTROLE_TECHNIQUE_CTE,
	CONSTRAINT C_FK_PAR_CTA FOREIGN KEY(PAR_IMMAT) REFERENCES GSI.T_PARAPENTE_PAR
);

CREATE OR REPLACE VIEW GSI.CONTROLE_PONCTUEL AS (
	SELECT CTE_ID AS ID, PAR_IMMAT AS PARAPENTE, CTA_DATE AS DATE,
		(CTE_RES_VOILE AND CTE_RES_SUSPENTES AND CTE_RES_FREINS AND CTE_RES_SELLETTE
			AND CTE_RES_ACCELERATEUR AND CTE_RES_TRIM AND CTE_RES_CASQUE)
		AS RESULTAT, CTE_COMMENTAIRE AS COMMENTAIRE,
		CTE_RES_VOILE AS VOILE, CTE_RES_SUSPENTES AS SUSPENTES, CTE_RES_FREINS AS FREINS,
		CTE_RES_SELLETTE AS SELLETTE, CTE_RES_ACCELERATEUR AS ACCELERATEUR,
		CTE_RES_TRIM AS TRIM, CTE_RES_CASQUE AS CASQUE
	FROM GSI.T_CONTROLE_ANNUEL_CTA NATURAL JOIN GSI.T_CONTROLE_TECHNIQUE_CTE
);

CREATE TABLE GSI.T_CONTROLE_RECURRENT_CTR (
	CTE_ID	INTEGER NOT NULL,
	VOL_ID	INTEGER NOT NULL,
	CONSTRAINT C_PK_CTR PRIMARY KEY(CTE_ID),
	CONSTRAINT C_FK_CTE_CTR FOREIGN KEY(CTE_ID) REFERENCES GSI.T_CONTROLE_TECHNIQUE_CTE
);

CREATE TABLE GSI.T_VOL (
	VOL_ID			SERIAL NOT NULL,
	PRC_ID			INTEGER NOT NULL,
	PIL_ID			INTEGER NOT NULL,
	INV_ID			INTEGER,
	PAR_IMMAT		VARCHAR(32) NOT NULL,
	CTR_ID1			INTEGER,
	CTR_ID2			INTEGER,
	VOL_DATE		DATE NOT NULL,
	VOL_DUREE		INTEGER NOT NULL,
--	VOL_DISTANCE	INTEGER NOT NULL,
	VOL_PRIX		FLOAT NOT NULL,
	CONSTRAINT C_PK_VOL PRIMARY KEY(VOL_ID),
	CONSTRAINT C_FK_PRC_VOL FOREIGN KEY(PRC_ID) REFERENCES GSI.T_PARCOURS_PRC,
	CONSTRAINT C_FK_PIL_VOL FOREIGN KEY(PIL_ID) REFERENCES GSI.T_PILOTE_PIL,
	CONSTRAINT C_FK_INV_VOL FOREIGN KEY(INV_ID) REFERENCES GSI.T_INVITE_INV,
	CONSTRAINT C_FK_PAR_VOL FOREIGN KEY(PAR_IMMAT) REFERENCES GSI.T_PARAPENTE_PAR,
	CONSTRAINT C_FK_CTR_VOL_1 FOREIGN KEY(CTR_ID1) REFERENCES GSI.T_CONTROLE_RECURRENT_CTR,
	CONSTRAINT C_FK_CTR_VOL_2 FOREIGN KEY(CTR_ID2) REFERENCES GSI.T_CONTROLE_RECURRENT_CTR,
	CONSTRAINT C_CHK_DUREE_VOL CHECK(VOL_DUREE >= 0)
--	,CONSTRAINT C_CHK_DISTANCE_VOL CHECK(VOL_DISTANCE >= 0)
);

ALTER TABLE GSI.T_CONTROLE_RECURRENT_CTR
	ADD CONSTRAINT C_FK_VOL_CTR FOREIGN KEY(VOL_ID) REFERENCES GSI.T_VOL;
	
CREATE OR REPLACE VIEW GSI.CONTROLE_RECURRENT AS (
	SELECT CTE_ID AS ID, VOL_ID AS LOCATION, (CTE_RES_VOILE AND CTE_RES_SUSPENTES
		AND CTE_RES_FREINS AND CTE_RES_SELLETTE AND CTE_RES_ACCELERATEUR
		AND CTE_RES_TRIM AND CTE_RES_CASQUE) AS RESULTAT, CTE_COMMENTAIRE AS COMMENTAIRE,
		CTE_RES_VOILE AS VOILE, CTE_RES_SUSPENTES AS SUSPENTES, CTE_RES_FREINS AS FREINS,
		CTE_RES_SELLETTE AS SELLETTE, CTE_RES_ACCELERATEUR AS ACCELERATEUR,
		CTE_RES_TRIM AS TRIM, CTE_RES_CASQUE AS CASQUE
	FROM GSI.T_CONTROLE_RECURRENT_CTR NATURAL JOIN GSI.T_CONTROLE_TECHNIQUE_CTE
);

CREATE OR REPLACE VIEW GSI.VOL AS (
	SELECT VOL_ID AS ID, PIL_ID AS PILOTE, PAR_IMMAT AS PARAPENTE, INV_ID AS INVITE,
		PRC_ID AS PARCOURS, VOL_DATE AS DATE, VOL_DUREE AS DUREE, VOL_PRIX AS PRIX,
		CTR_ID1 AS CONTROLE_AVANT, CTR_ID2 AS CONTROLE_APRES-- VOL_DISTANCE AS DISTANCE	
	FROM GSI.T_VOL
);


-- Tables des tarifs
CREATE TABLE GSI.T_TARIF_TAR (
	TAR_ID		SERIAL NOT NULL,
	TAR_LIB		VARCHAR(10) NOT NULL,
	TAR_COEF	NUMERIC(4,2) NOT NULL,
	TAR_DEFAULT BOOLEAN NOT NULL DEFAULT FALSE,
	CONSTRAINT C_PK_TAR PRIMARY KEY(TAR_ID)
);

CREATE OR REPLACE VIEW GSI.TARIF AS (
	SELECT TAR_ID AS ID, TAR_LIB AS LIBELLE, TAR_COEF AS COEFFICIENT, TAR_DEFAULT AS DEFAUT
	FROM GSI.T_TARIF_TAR
);


-- Création des triggers et fonctions associées

-- Trigger insertion sur PILOTE
CREATE OR REPLACE FUNCTION GSI.F_INS_PILOTE() RETURNS TRIGGER AS $$
DECLARE
	ID INTEGER;
BEGIN
	INSERT INTO GSI.T_PERSONNE_PER(PER_ID, PER_NOM, PER_PRENOM, PER_DDN, PER_TAILLE, 
		PER_POIDS, PER_ADR, PER_VILLE, PER_CP, PER_TEL)
	VALUES (DEFAULT, NEW.NOM, NEW.PRENOM, NEW.DATE_DE_NAISSANCE, NEW.TAILLE, NEW.POIDS, NEW.ADRESSE,
		NEW.VILLE, NEW.CODE_POSTAL, NEW.TELEPHONE)
	RETURNING PER_ID INTO ID;
	INSERT INTO GSI.T_PILOTE_PIL(PER_ID, PIL_NO_LICENCE, PIL_NIVEAU, PIL_QUAL_BIPLACE)
	VALUES (ID, NEW.NO_LICENCE, NEW.NIVEAU, NEW.QUALIFICATION_BIPLACE);
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_I_INSERT INSTEAD OF INSERT ON GSI.PILOTE
FOR EACH ROW EXECUTE PROCEDURE GSI.F_INS_PILOTE();

-- Trigger update sur PILOTE
CREATE OR REPLACE FUNCTION GSI.F_UPD_PILOTE() RETURNS TRIGGER AS $$
BEGIN
	UPDATE GSI.T_PERSONNE_PER
	SET (PER_NOM, PER_PRENOM, PER_DDN, PER_TAILLE, PER_POIDS, PER_ADR, PER_VILLE, PER_CP, PER_TEL)
	= (NEW.NOM, NEW.PRENOM, NEW.DATE_DE_NAISSANCE, NEW.TAILLE, NEW.POIDS, NEW.ADRESSE,
		NEW.VILLE, NEW.CODE_POSTAL, NEW.TELEPHONE)
	WHERE PER_ID = NEW.ID;
	UPDATE GSI.T_PILOTE_PIL
	SET (PIL_NO_LICENCE, PIL_NIVEAU, PIL_QUAL_BIPLACE)
	= (NEW.NO_LICENCE, NEW.NIVEAU, NEW.QUALIFICATION_BIPLACE)
	WHERE PER_ID = NEW.ID;
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_I_UPDATE INSTEAD OF UPDATE ON GSI.PILOTE
FOR EACH ROW EXECUTE PROCEDURE GSI.F_UPD_PILOTE();


-- Trigger insertion sur INVITE
CREATE OR REPLACE FUNCTION GSI.F_INS_INVITE() RETURNS TRIGGER AS $$
DECLARE
	ID INTEGER;
BEGIN
	INSERT INTO GSI.T_PERSONNE_PER(PER_ID, PER_NOM, PER_PRENOM, PER_DDN, PER_TAILLE, 
		PER_POIDS, PER_ADR, PER_VILLE, PER_CP, PER_TEL)
	VALUES (DEFAULT, NEW.NOM, NEW.PRENOM, NEW.DATE_DE_NAISSANCE, NEW.TAILLE, NEW.POIDS, NEW.ADRESSE,
		NEW.VILLE, NEW.CODE_POSTAL, NEW.TELEPHONE)
	RETURNING PER_ID INTO ID;
	INSERT INTO GSI.T_INVITE_INV(PER_ID)
	VALUES (ID);
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_I_INSERT INSTEAD OF INSERT ON GSI.INVITE
FOR EACH ROW EXECUTE PROCEDURE GSI.F_INS_INVITE();


-- Trigger update sur INVITE
CREATE OR REPLACE FUNCTION GSI.F_UPD_INVITE() RETURNS TRIGGER AS $$
BEGIN
	UPDATE GSI.T_PERSONNE_PER
	SET (PER_NOM, PER_PRENOM, PER_DDN, PER_TAILLE, PER_POIDS, PER_ADR, PER_VILLE, PER_CP, PER_TEL)
	= (NEW.NOM, NEW.PRENOM, NEW.DATE_DE_NAISSANCE, NEW.TAILLE, NEW.POIDS, NEW.ADRESSE,
		NEW.VILLE, NEW.CODE_POSTAL, NEW.TELEPHONE)
	WHERE PER_ID = NEW.ID;
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_I_UPDATE INSTEAD OF UPDATE ON GSI.INVITE
FOR EACH ROW EXECUTE PROCEDURE GSI.F_UPD_INVITE();


-- Trigger insertion sur CONTROLE_PONCTUEL
CREATE OR REPLACE FUNCTION GSI.F_INS_CONTROLE_PONCTUEL() RETURNS TRIGGER AS $$
DECLARE
	ID INTEGER;
BEGIN
	IF (NEW.COMMENTAIRE) IS NULL THEN
		NEW.COMMENTAIRE = 'aucun commentaire';
	END IF;
	--
	INSERT INTO GSI.T_CONTROLE_TECHNIQUE_CTE(CTE_ID, CTE_COMMENTAIRE, CTE_RES_VOILE, CTE_RES_SUSPENTES,
		CTE_RES_FREINS, CTE_RES_SELLETTE, CTE_RES_ACCELERATEUR, CTE_RES_TRIM, CTE_RES_CASQUE)
	VALUES (DEFAULT, NEW.COMMENTAIRE, NEW.VOILE, NEW.SUSPENTES, NEW.FREINS, NEW.SELLETTE,
		NEW.ACCELERATEUR, NEW.TRIM, NEW.CASQUE)
	RETURNING CTE_ID INTO ID;
	INSERT INTO GSI.T_CONTROLE_ANNUEL_CTA(CTE_ID, PAR_IMMAT, CTA_DATE)
	VALUES (ID, NEW.PARAPENTE, NEW.DATE);
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_I_INSERT INSTEAD OF INSERT ON GSI.CONTROLE_PONCTUEL
FOR EACH ROW EXECUTE PROCEDURE GSI.F_INS_CONTROLE_PONCTUEL();


-- Trigger insertion sur CONTROLE_RECURRENT
CREATE OR REPLACE FUNCTION GSI.F_INS_CONTROLE_RECURRENT() RETURNS TRIGGER AS $$
DECLARE
	ID INTEGER;
BEGIN
	IF (NEW.COMMENTAIRE) IS NULL THEN
		NEW.COMMENTAIRE = 'aucun commentaire';
	END IF;
	--
	INSERT INTO GSI.T_CONTROLE_TECHNIQUE_CTE(CTE_ID, CTE_COMMENTAIRE, CTE_RES_VOILE, CTE_RES_SUSPENTES,
		CTE_RES_FREINS, CTE_RES_SELLETTE, CTE_RES_ACCELERATEUR, CTE_RES_TRIM, CTE_RES_CASQUE)
	VALUES (DEFAULT, NEW.COMMENTAIRE, NEW.VOILE, NEW.SUSPENTES, NEW.FREINS, NEW.SELLETTE,
		NEW.ACCELERATEUR, NEW.TRIM, NEW.CASQUE)
	RETURNING CTE_ID INTO ID;
	INSERT INTO GSI.T_CONTROLE_RECURRENT_CTR(CTE_ID, VOL_ID)
	VALUES (ID, NEW.LOCATION);
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_I_INSERT INSTEAD OF INSERT ON GSI.CONTROLE_RECURRENT
FOR EACH ROW EXECUTE PROCEDURE GSI.F_INS_CONTROLE_RECURRENT();


-- Trigger mise à jour de PARAPENTE après insertion sur CONTROLE ANNUEL
CREATE OR REPLACE FUNCTION GSI.F_CTA_UPD_PAR() RETURNS TRIGGER AS $$
DECLARE
	resultat boolean;
BEGIN
	SELECT CTE_RES_ACCELERATEUR 
			AND CTE_RES_CASQUE
			AND CTE_RES_FREINS
			AND CTE_RES_SELLETTE
			AND CTE_RES_SUSPENTES
			AND CTE_RES_TRIM
			AND CTE_RES_VOILE INTO resultat
	FROM GSI.T_CONTROLE_TECHNIQUE_CTE CTE NATURAL JOIN GSI.T_CONTROLE_ANNUEL_CTA CTA
	WHERE CTE_ID = NEW.CTE_ID AND PAR_IMMAT = NEW.PAR_IMMAT;
	IF (resultat) THEN
		UPDATE GSI.T_PARAPENTE_PAR SET PAR_OK = TRUE WHERE PAR_IMMAT = NEW.PAR_IMMAT;
	ELSE
		UPDATE GSI.T_PARAPENTE_PAR SET PAR_OK = FALSE WHERE PAR_IMMAT = NEW.PAR_IMMAT;
	END IF;
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_A_INSERT AFTER INSERT ON GSI.T_CONTROLE_ANNUEL_CTA
FOR EACH ROW EXECUTE PROCEDURE GSI.F_CTA_UPD_PAR();


-- Trigger mise à jour de PARAPENTE et VOL après insertion sur CONTROLE RECURRENT
CREATE OR REPLACE FUNCTION GSI.F_CTR_UPD() RETURNS TRIGGER AS $$
DECLARE
	IMMAT VARCHAR(32);
	CTR_AVANT INTEGER;
	CTR_APRES INTEGER;
	resultat BOOLEAN;
BEGIN
	SELECT (CTE_RES_ACCELERATEUR 
			AND CTE_RES_CASQUE
			AND CTE_RES_FREINS
			AND CTE_RES_SELLETTE
			AND CTE_RES_SUSPENTES
			AND CTE_RES_TRIM
			AND CTE_RES_VOILE) INTO resultat
	FROM GSI.T_CONTROLE_TECHNIQUE_CTE
	WHERE CTE_ID = NEW.CTE_ID;
	-- Mise à jour de PARAPENTE
	SELECT VOL.PAR_IMMAT INTO IMMAT
	FROM GSI.T_VOL VOL
	WHERE VOL.VOL_ID = NEW.VOL_ID;
	IF (resultat) THEN
		UPDATE GSI.T_PARAPENTE_PAR SET PAR_OK = TRUE WHERE PAR_IMMAT = IMMAT;
	ELSE
		UPDATE GSI.T_PARAPENTE_PAR SET PAR_OK = FALSE WHERE PAR_IMMAT = IMMAT;
	END IF;
	-- Mise à jour de VOL
	SELECT VOL.CTR_ID1 INTO CTR_AVANT
	FROM GSI.T_VOL VOL
	WHERE VOL.VOL_ID = NEW.VOL_ID;
	SELECT VOL.CTR_ID2 INTO CTR_APRES
	FROM GSI.T_VOL VOL
	WHERE VOL.VOL_ID = NEW.VOL_ID;
	IF (CTR_AVANT IS NULL) THEN
		UPDATE GSI.T_VOL SET CTR_ID1 = NEW.CTE_ID WHERE VOL_ID = NEW.VOL_ID;
	ELSE IF (CTR_APRES IS NULL) THEN
		UPDATE GSI.T_VOL SET CTR_ID2 = NEW.CTE_ID WHERE VOL_ID = NEW.VOL_ID;
	ELSE
		RAISE EXCEPTION '2 contrôles sont déjà attribués à la location.';
	END IF;
	END IF;
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_A_INSERT AFTER INSERT ON GSI.T_CONTROLE_RECURRENT_CTR
FOR EACH ROW EXECUTE PROCEDURE GSI.F_CTR_UPD();

-- Trigger s'assurant qu'un vol en tandem requiert un parapente biplace
CREATE OR REPLACE FUNCTION GSI.F_CHK_VOL_TANDEM() RETURNS TRIGGER AS $$
DECLARE
	BIPLACE BOOLEAN;
BEGIN
	IF (NEW.INV_ID IS NOT NULL) THEN
		SELECT PAR_BIPLACE INTO BIPLACE
		FROM GSI.T_PARAPENTE_PAR
		WHERE PAR_IMMAT = NEW.PAR_IMMAT;
		IF NOT BIPLACE THEN
			RAISE EXCEPTION 'un vol en tandem requiert un parapente biplace';
		END IF;
	END IF;
	RETURN NEW;
END
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER TRG_B_INSERT_UPDATE BEFORE INSERT OR UPDATE ON GSI.T_VOL
FOR EACH ROW EXECUTE PROCEDURE GSI.F_CHK_VOL_TANDEM();


-- Fonctions annexes

-- Renvoie le nombre de mois depuis le premier vol du pilote d'id idPilote.
CREATE OR REPLACE FUNCTION GSI.F_PILOTE_GETMOIS(idPilote INTEGER) RETURNS INTEGER AS $$
DECLARE
	datePremierVol DATE;
	nb_mois INTEGER;
BEGIN
	SELECT MIN(date) INTO datePremierVol
	FROM gsi.vol
	WHERE pilote = idPilote;
	SELECT (date_part('year', age(datePremierVol))*12 + date_part('month', age(datePremierVol))) INTO nb_mois;
	RETURN nb_mois;
END
$$ LANGUAGE PLPGSQL;

-- Renvoie le nombre de mois depuis le premier vol de l'invite d'id idInvite.
CREATE OR REPLACE FUNCTION GSI.F_INVITE_GETMOIS(idInvite INTEGER) RETURNS INTEGER AS $$
DECLARE
	datePremierVol DATE;
	nb_mois INTEGER;
BEGIN
	SELECT MIN(date) INTO datePremierVol
	FROM gsi.vol
	WHERE invite = idInvite;
	SELECT (date_part('year', age(datePremierVol))*12 + date_part('month', age(datePremierVol))) INTO nb_mois;
	RETURN nb_mois;
END
$$ LANGUAGE PLPGSQL;

-- Renvoie le nombre de mois depuis la première location du club.
CREATE OR REPLACE FUNCTION GSI.F_VOL_GETMOIS() RETURNS INTEGER AS $$
DECLARE
	datePremierVol DATE;
	nb_mois INTEGER;
BEGIN
	SELECT MIN(date) INTO datePremierVol
	FROM gsi.vol;
	SELECT (date_part('year', age(datePremierVol))*12 + date_part('month', age(datePremierVol))) INTO nb_mois;
	RETURN nb_mois;
END
$$ LANGUAGE PLPGSQL;







-- INSERTION






-- Insertion des parcours
INSERT INTO gsi.parcours (nom, ville, site_decollage, site_atterrissage) VALUES
	('Le Bus', 'SAINT-MICHEL en GREVES', 'En longeant la plage, prendre la route étroite juste avant la route de Tréducer/Chateau de Rosambo', 'Au sommet (difficile), sur la plage (facile)')
;
INSERT INTO gsi.parcours (nom, ville, site_decollage, site_atterrissage, commentaire) VALUES
	('Beg Leguer', 'Lannion', 'Chemin de Goas-lagorn', 'Attero possible au deco ou sur la plage de Beg-Leguer', 'Vachage possible dans les nombreux pâturages à condition de ne pas effrayer les animaux. Le vent peut etre turbulent avec une tendance sud')
;

-- Insertion des pilotes
INSERT INTO gsi.pilote (nom, prenom, no_licence, niveau, qualification_biplace, date_de_naissance, taille, poids, adresse, ville, code_postal, telephone) VALUES
	('bonhomme', 'vincent', 'lic#314', 'vert', false, '21/07/1994', 175, 55, '2 rue de la petite haie', 'dinan', '22100', '0618421192'),
	('bonhomme', 'allan', 'lic#117', 'vert', false, '1994/07/21', 174, 55, '2 rue de la petite haie', 'dinan', '22100', '0605348777'),
	('insalien', 'pierre', 'lic#888', 'bleu', true, '1990/12/17', 180, 70, '8 dans une rue de rennes', 'rennes', '35000', '0612345678'),
	('legros', 'jean', 'lic#456', 'marron', false, '1979/02/27', 190, 90, '1 rue de paris', 'paris', '75000', '0698765432')
;

-- Insertion des invités
INSERT INTO gsi.invite (nom, prenom, date_de_naissance, taille, poids, adresse, ville, code_postal, telephone) VALUES
	('martin', 'pierre', '1999/12/25', 175, 79, '1 place de la rue ville', 'toulouse', '12345', '0615611256'),
	('michel', 'jean', '1985/03/05', 184, 91, '1 rue edouard branly', 'lannion', '22300', '0284235400')
;

-- Insertion des parapentes
INSERT INTO gsi.parapente (immatriculation, marque, modele, taille, ptv, biplace) VALUES
	('4502FE8', 'Skywalk', 'mescal4', 'M', '[85,110]', false),
	('AZ84211', 'Ozone', 'magnum2', 'L', '[150,190]', true),
	('4D021MP', 'Advance', 'sigma7', 'XS', '[84,108]', false)
;
	
-- Insertion des contrôles ponctuels
INSERT INTO gsi.controle_ponctuel (parapente, date, commentaire, voile, suspentes, freins, sellette, accelerateur, trim, casque) VALUES
	('AZ84211', '12/10/2015', default, true, true, true, true, true, true, true),
	('4502FE8', '05/11/2015', 'Suspentes trop usées, accélérateur défaillant', true, false, true, true, false, true, true)
;

-- Insertion des locations
INSERT INTO gsi.vol (pilote, parapente, invite, parcours, date, duree, prix) VALUES 
	(1, '4502FE8', null, 1, '31/10/2015', 150, 30),
	(3, 'AZ84211', 5, 2, '15/09/2015', 100, 35),
	(3, '4502FE8', null, 1, '22/08/2015', 60, 30)
;

-- Insertion des contrôles récurrents
INSERT INTO gsi.controle_recurrent (location, commentaire, voile, suspentes, freins, sellette, accelerateur, trim, casque)VALUES
	(1, default, true, true, true, true, true, true, true),
	(1, 'Voile déchirée', false, true, true, true, true, true, true),
	(2, 'RAS', true, true, true, true, true, true, true)
;

-- Inserion des tarifs
INSERT INTO GSI.TARIF(libelle, coefficient, defaut) VALUES
   ('normal', 0.35, true),
   ('pro', 0.50, false),
   ('réduit', 0.20, false)
;