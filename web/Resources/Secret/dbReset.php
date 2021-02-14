<?php
   if($_SERVER['REQUEST_METHOD'] == 'POST') {
      try {
         require('../DBconnect.php');
         $db = get_db();
         
         if($_POST['submit'] == 'delete') {
            $db->query("DROP TABLE IF EXISTS project1.spells_by_class, project1.spells, project1.saves_attacks, project1.lengths, project1.classes, project1.schools, project1.sources, project1.users");
         }
         if($_POST['submit'] == 'create') {
            $db->query("CREATE TABLE project1.users (
                  id SERIAL NOT NULL UNIQUE PRIMARY KEY,
                  username VARCHAR(100) NOT NULL UNIQUE,
                  password VARCHAR(100) NOT NULL,
                  name VARCHAR(100) NOT NULL)");
            $db->query("CREATE TABLE project1.sources (
                  id SERIAL NOT NULL PRIMARY KEY,
                  name VARCHAR(100) NOT NULL UNIQUE)");
            $db->query("CREATE TABLE project1.schools (
                  id SERIAL NOT NULL UNIQUE PRIMARY KEY,
                  name VARCHAR(100) NOT NULL UNIQUE)");
            $db->query("CREATE TABLE project1.classes (
                  id SERIAL NOT NULL UNIQUE PRIMARY KEY,
                  name VARCHAR(100) NOT NULL UNIQUE)");
            $db->query("CREATE TABLE project1.lengths (
                  id SERIAL NOT NULL UNIQUE PRIMARY KEY,
                  name VARCHAR(100) NOT NULL UNIQUE)");
            $db->query("CREATE TABLE project1.saves_attacks (
                  id SERIAL NOT NULL UNIQUE PRIMARY KEY,
                  name VARCHAR(100) NOT NULL UNIQUE)");
            $db->query("CREATE TABLE project1.spells (
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
                  range_type VARCHAR(30),
                  area VARCHAR(100),
                  components VARCHAR(7) NOT NULL,
                  component_desc VARCHAR(100),
                  consumed BOOLEAN NOT NULL,
                  description TEXT NOT NULL,
                  higher_desc TEXT)");
            $db->query("CREATE TABLE project1.spells_by_class (
                  id SERIAL NOT NULL UNIQUE PRIMARY KEY,
                  class_id INT NOT NULL REFERENCES project1.classes(id),
                  spell_id INT NOT NULL REFERENCES project1.spells(id))");
         }
         if($_POST['submit'] == 'insert') {
            $schools = $db->query("INSERT INTO project1.schools (name) VALUES ('conjuration'), ('necromancy'), ('evocation'), ('abjuration'), ('transmutation'), ('divination'), ('enchantment'), ('illusion')");
            
            $books = $db->prepare("INSERT INTO project1.sources (name) VALUES (?), (?), (?), (?), ('acquisitions incorporated'), (?), (?), ('lost laboratory of kwalish'), ('unearthed arcana'), ('custom')");
            $books->execute(["player's handbook", "elemental evil player's companion", "xanathar's guide to everything", "sword coast adventurer's guide", "explorer's guide to wildemount", "guildmaster's guide to ravnica"]);
            
            $classes = $db->query("INSERT INTO project1.classes (name) VALUES ('artificer'), ('barbarian'), ('bard'), ('cleric'), ('druid'), ('fighter'), ('monk'), ('paladin'), ('ranger'), ('rouge'), ('sourcerer'), ('warlock'), ('wizard'), ('blood hunter')");
            $lengths = $db->query("INSERT INTO project1.lengths (name) VALUES ('action'), ('bonus action'), ('reaction'), ('rounds'), ('years'), ('days'), ('hours'), ('minutes'), ('seconds')");
            $saves = $db->query("INSERT INTO project1.saves_attacks (name) VALUES ('dex save'), ('str save'), ('con save'), ('int save'), ('wis save'), ('char save'), ('melee'), ('ranged')");
         }
      } catch (PDOException $ex) {
         echo "Error connecting to DB. Details: $ex";
      }
      unset($_POST);
      unset($_SERVER['REQUEST_METHOD']);
   }
?>
<form method='POST'>
   <input type='submit' name='submit' value='delete'>
   <input type='submit' name='submit' value='create'>
   <input type='submit' name='submit' value='insert'>
</form>