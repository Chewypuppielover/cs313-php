CREATE SCHEMA project1;
CREATE TABLE project1.users
(
   id SERIAL NOT NULL UNIQUE PRIMARY KEY,
   username VARCHAR(100) NOT NULL UNIQUE,
   password VARCHAR(100) NOT NULL,
   name VARCHAR(100) NOT NULL
);
CREATE TABLE project1.sources
(
   id SERIAL NOT NULL PRIMARY KEY,
   name VARCHAR(100) NOT NULL UNIQUE
);
CREATE TABLE project1.schools
(
   id SERIAL NOT NULL UNIQUE PRIMARY KEY,
   name VARCHAR(100) NOT NULL UNIQUE
);
CREATE TABLE project1.classes
(
   id SERIAL NOT NULL UNIQUE PRIMARY KEY,
   name VARCHAR(100) NOT NULL UNIQUE
);
CREATE TABLE project1.lengths
(
   id SERIAL NOT NULL UNIQUE PRIMARY KEY,
   name VARCHAR(100) NOT NULL UNIQUE
);
CREATE TABLE project1.saves_attacks
(
   id SERIAL NOT NULL UNIQUE PRIMARY KEY,
   name VARCHAR(100) NOT NULL UNIQUE
);
CREATE TABLE project1.spells
(
   id SERIAL NOT NULL UNIQUE PRIMARY KEY,
   name VARCHAR(100) NOT NULL UNIQUE,
   school_id INT NOT NULL REFERENCES project1.schools(id),
   source_id INT NOT NULL REFERENCES project1.sources(id),
   casting_time_id INT NOT NULL REFERENCES project1.lengths(id),
   save_id INT REFERENCES project1.saves_attacks(id),
   casting_time INT NOT NULL,
   duration VARCHAR(100) NOT NULL,
   lvl SMALLINT NOT NULL, -- only need numbers 0 thru 10
   concentration BOOLEAN NOT NULL,
   ritual BOOLEAN NOT NULL,
   range INT,
   range_type VARCHAR(30) NOT NULL,
   area VARCHAR(100),
   components VARCHAR(7) NOT NULL, -- maybe three bools instead
   component_desc VARCHAR(100),
   consumed BOOLEAN NOT NULL,
   description TEXT NOT NULL,
   higher_desc TEXT
);
CREATE TABLE project1.spells_by_class
(
   id SERIAL NOT NULL UNIQUE PRIMARY KEY,
   class_id INT NOT NULL REFERENCES project1.classes(id),
   spell_id INT NOT NULL REFERENCES project1.spells(id)
);

INSERT INTO project1.schools (name) VALUES ('conjuration'), ('necromancy'), ('evocation'), ('abjuration'), ('transmutation'), ('divination'), ('enchantment'), ('illusion');
INSERT INTO project1.sources (name) VALUES ('player\'s handbook'), ('elemental evil player\'s companion'), ('xanathar\'s guide to everything'), ('sword coast adventurer\'s guide'), ('acquisitions incorporated'), ('explorer\'s guide to wildemount'), ('guildmaster\'s guide to ravnica'), ('lost laboratory of kwalish'), ('unearthed arcana'), ('custom');
INSERT INTO project1.classes (name) VALUES ('artificer'), ('barbarian'), ('bard'), ('cleric'), ('druid'), ('fighter'), ('monk'), ('paladin'), ('ranger'), ('rouge'), ('sourcerer'), ('warlock'), ('wizard'), ('blood hunter');
INSERT INTO project1.lengths (name) VALUES ('action'), ('bonus action'), ('reaction'), ('rounds'), ('years'), ('days'), ('hours'), ('minutes'), ('seconds'), ('instantaneous');
INSERT INTO project1.saves_attacks (name) VALUES ('dex save'), ('str save'), ('con save'), ('int save'), ('wis save'), ('char save'), ('melee'), ('ranged');