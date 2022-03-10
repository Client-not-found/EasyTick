-- Ticketsystem Database

use nicolas_db1;

-- Tabelle für Gruppen
CREATE TABLE tGroup (
groKey INT NOT NULL auto_increment,
groName VARCHAR(255),
PRIMARY KEY(groKey)
);

-- Mehrsprachigkeit Haupttabelle
CREATE TABLE tLanguage (
lanKey INT NOT NULL auto_increment,
lanLanguage VARCHAR(50),
PRIMARY kEY(lanKey)
);

-- Tabelle für User
CREATE TABLE tUser (
useKey INT NOT NULL auto_increment,
useLanId INT NOT NULL,
useGroId INT NOT NULL,
useUsername VARCHAR(50),
useFirstname VARCHAR(100),
useLastname VARCHAR(100),
usePassword VARCHAR(100),
useStreet VARCHAR(200),
useZIP VARCHAR(10),
useCity VARCHAR(200),
useState VARCHAR(200),
useMail VARCHAR(200),
useTel VARCHAR(200),
FOREIGN KEY (useLanId) REFERENCES tLanguage(LanKey) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (useGroId) REFERENCES tGroup(groKey) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY(useKey)
);

-- Tabelle für Tickets
CREATE TABLE tTicket (
ticKey INT NOT NULL auto_increment,
ticUseId INT NOT NULL,
ticTopic VARCHAR(50),
ticDate DATETIME,
FOREIGN KEY (ticUseId) REFERENCES tUser(useKey) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY(ticKey)

);

-- Tabelle für Message
CREATE TABLE tMessage (
mesKey INT NOT NULL auto_increment,
mesTicId INT NOT NULL,
mesUseId INT NOT NULL,
mesMessage MEDIUMTEXT,
FOREIGN KEY (mesUseId) REFERENCES tUser(useKey) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (mesTicId) REFERENCES tTicket(ticKey) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY(mesKey)
);

-- Tabelle Kategorien für die Wissendatenbank
CREATE TABLE tCategory (
catKey INT NOT NULL auto_increment,
catActive boolean,
PRIMARY KEY (catKey)
);

-- Tabelle für Wissendatenbank
CREATE TABLE tArticel (
artKey INT NOT NULL auto_increment,
artUseId INT NOT NULL,
artCatId INT NOT NULL,
artTopic VARCHAR(50),
artMessage MEDIUMTEXT,
FOREIGN KEY (artUseId) REFERENCES tUser(useKey) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (artCatId) REFERENCES tCategory(catKey) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY (artKey)
);

-- Mehrsprachigkeit Zwischentabelle
CREATE TABLE tLanguageToTicket (
lttKey INT NOT NULL auto_increment,
lttLanId INT,
lttTicId INT,
lttDEStatus VARCHAR(255),
lttDEPriority VARCHAR(255),
lttDEDepartement VARCHAR(255),
lttENStatus VARCHAR(255),
lttENPriority VARCHAR(255),
lttENDepartement VARCHAR(255),
FOREIGN KEY (lttLanId) REFERENCES tLanguage(LanKey) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (lttTicId) REFERENCES tTicket(ticKey) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY(lttKey)
);

CREATE TABLE tLanguageToCategory (
ltcKey INT NOT NULL auto_increment,
ltcLanId INT,
ltcCatId INT,
ltcName VARCHAR(255),
FOREIGN KEY (ltcLanId) REFERENCES tLanguage(LanKey) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (ltcCatId) REFERENCES tCategory(catKey) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY(ltcKey)
);

-- Default group inserts
INSERT INTO tGroup(groName) VALUES ('Administrator');
INSERT INTO tGroup(groName) VALUES ('Supporter');
INSERT INTO tGroup(groName) VALUES ('Customer');

-- Default language inserts
INSERT INTO tLanguage(lanLanguage) VALUES ('de');
INSERT INTO tLanguage(lanLanguage) VALUES ('en');

-- Default user inserts
INSERT INTO tUser(useLanId, useGroId, useUsername, useFirstname, useLastname, usePassword, useStreet, useZIP, useCity, useState, useMail) VALUES (2, 1, 'admin', 'EasyTick', 'Admin', 'admin', 'Musterstrasse 1', 44056, 'Basel', 'Switzerland', 'admin@admin.ch');
INSERT INTO tUser(useLanId, useGroId, useUsername, useFirstname, useLastname, usePassword, useStreet, useZIP, useCity, useState, useMail) VALUES (1, 2, 'supporter', 'EasyTick', 'Supporter', 'supporter', 'Musterstrasse 1', 44056, 'Basel', 'Switzerland', 'supporter@supporter.ch');
INSERT INTO tUser(useLanId, useGroId, useUsername, useFirstname, useLastname, usePassword, useStreet, useZIP, useCity, useState, useMail) VALUES (1, 3, 'customer', 'EasyTick', 'Customer', 'customer', 'Musterstrasse 2', 44055, 'Basel', 'Switzerland', 'customer@customer.ch');

-- Default ticket inserts
INSERT INTO tTicket(ticUseId, ticTopic, ticDate) VALUES (1, 'Willkommen bei EasyTick', now());
INSERT INTO tTicket(ticUseId, ticTopic, ticDate) VALUES (2, 'Mein erstes Problem', now());

-- Default Language to Ticket inserts
INSERT INTO tLanguageToTicket(lttLanId, lttTicId, lttENStatus, lttENPriority, lttENDepartement) VALUES(1, 1, 'closed', 'Important', 'General Support');
INSERT INTO tLanguageToTicket(lttLanId, lttTicId, lttENStatus, lttENPriority, lttENDepartement) VALUES(1, 2, 'closed', 'Important', 'Technical Support');

-- INSERT INTO tLanguageToTicket(lttLanId, lttTicId, lttENStatus, lttENPriority, lttENDepartement) VALUES(2, 1, 'open', 'Important', 'General Support');
-- INSERT INTO tLanguageToTicket(lttLanId, lttTicId, lttENStatus, lttENPriority, lttENDepartement) VALUES(2, 2, 'open', 'Important', 'Technical Support');

-- Default message inserts
INSERT INTO tMessage(mesTicId, mesUseId, mesMessage) VALUES (1, 1, 'Willkommen bei EasyTick');
INSERT INTO tMessage(mesTicId, mesUseId, mesMessage) VALUES (2, 3, 'Ich habe mein erstes Problem');

-- Default category inserts
INSERT INTO tCategory(catActive) VALUES (true);
INSERT INTO tCategory(catActive) VALUES (false);

-- Default Language to category inserts
INSERT INTO tLanguageToCategory(ltcLanId, ltcCatId, ltcName) VALUES (1, 1, 'Technical Support');
INSERT INTO tLanguageToCategory(ltcLanId, ltcCatId, ltcName) VALUES (2, 2, 'Allgemeiner Support');

-- Default knowledge base article
INSERT INTO tArticel(artUseId, artCatId, artTopic, artMessage) VALUES (1, 1, 'Telefon-Support', 'Wenn Sie unsere Nummer nicht kennen rufen Sie uns bitte an.');
INSERT INTO tArticel(artUseId, artCatId, artTopic, artMessage) VALUES (2, 2, 'Fuss steckt in Mikrowelle fest, was tun?', 'Nehmen Sie den Fuss aus der Mikrowelle.');