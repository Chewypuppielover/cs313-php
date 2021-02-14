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
   duration_id INT NOT NULL REFERENCES project1.lengths(id),
   save_id INT REFERENCES project1.saves_attacks(id),
   casting_time INT NOT NULL,
   duration DECIMAL NOT NULL,
   lvl SMALLINT NOT NULL, -- only need numbers -1 thru 10
   concentration BOOLEAN NOT NULL,
   ritual BOOLEAN NOT NULL,
   range INT,
   range_type VARCHAR(30) NOT NULL, 
   area VARCHAR(100),
   components VARCHAR(7) NOT NULL, -- maybe three bools instead
   component_desc VARCHAR(100), -- needs to be way longer
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

INSERT INTO project1.schools (name) VALUES ('CONJURATION'), ('NECROMANCY'), ('EVOCATION'), ('ABJURATION'), ('TRANSMUTATION'), ('DIVINATION'), ('ENCHANTMENT'), ('ILLUSION');
INSERT INTO project1.sources (name) VALUES ('PLAYERS HANDBOOK'), ('ELEMENTAL EVIL PLAYERS COMPANION'), ('XANATHARS GUIDE TO EVERYTHING'), ('SWORD COAST ADVENTURERS GUIDE'), ('ACQUISITIONS INCORPORATED'), ('EXPLORERS GUIDE TO WILDEMOUNT'), ('GUILDMASTERS GUIDE TO RAVNICA'), ('LOST LABORATORY OF KWALISH'), ('UNEARTHED ARCANA'), ('CUSTOM');
INSERT INTO project1.classes (name) VALUES ('ARTIFICER'), ('BARBARIAN'), ('BARD'), ('CLERIC'), ('DRUID'), ('FIGHTER'), ('MONK'), ('PALADIN'), ('RANGER'), ('ROUGE'), ('SOURCERER'), ('WARLOCK'), ('WIZARD'), ('BLOOD HUNTER');
INSERT INTO project1.lengths (name) VALUES ('ACTION'), ('BONUS ACTION'), ('REACTION'), ('ROUNDS'), ('YEARS'), ('DAYS'), ('HOURS'), ('MINUTES'), ('SECONDS');
INSERT INTO project1.saves_attacks (name) VALUES ('DEX Save'), ('STR Save'), ('CON Save'), ('INT Save'), ('WIS Save'), ('CHAR Save'), ('MELEE'), ('RANGED');