<?php
   if($_SERVER['REQUEST_METHOD'] == 'GET') {
      try {
         require('../DBconnect.php');
         $db = get_db();
         
         if($_GET['submit'] == 'delete') {
            $db->query("DROP TABLE IF EXISTS project1.spells_by_class, project1.spells, project1.saves_attacks, project1.lengths, project1.classes, project1.schools, project1.sources, project1.users");
         }
         if($_GET['submit'] == 'create') {
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
                  lvl SMALLINT NOT NULL,
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
         if($_GET['submit'] == 'insert') {
            $schools = $db->query("INSERT INTO project1.schools (name) VALUES ('conjuration'), ('necromancy'), ('evocation'), ('abjuration'), ('transmutation'), ('divination'), ('enchantment'), ('illusion')");
            
            $books = $db->prepare("INSERT INTO project1.sources (name) VALUES (?), (?), (?), (?), ('acquisitions incorporated'), (?), (?), ('lost laboratory of kwalish'), ('unearthed arcana'), ('custom')");
            $books->execute(["player's handbook", "elemental evil player's companion", "xanathar's guide to everything", "sword coast adventurer's guide", "explorer's guide to wildemount", "guildmaster's guide to ravnica"]);
            
            $classes = $db->query("INSERT INTO project1.classes (name) VALUES ('artificer'), ('barbarian'), ('bard'), ('cleric'), ('druid'), ('fighter'), ('monk'), ('paladin'), ('ranger'), ('rouge'), ('sourcerer'), ('warlock'), ('wizard'), ('blood hunter')");
            $lengths = $db->query("INSERT INTO project1.lengths (name) VALUES ('action'), ('bonus action'), ('reaction'), ('rounds'), ('years'), ('days'), ('hours'), ('minutes'), ('seconds'), ('instantaneous')");
            $saves = $db->query("INSERT INTO project1.saves_attacks (name) VALUES ('dex save'), ('str save'), ('con save'), ('int save'), ('wis save'), ('char save'), ('melee'), ('ranged')");
         }
         if($_GET['submit'] == 'json') {
            $json = file_get_contents('./spellData.json');
            //print_r($json);
            $spells = json_decode($json, true);
            //echo "</br>Spells: ";
            //print_r($spells);
            $casting_id = join(' ', array_slice(split(' ', strtolower($spells['casting_time'])), 1));
            $duration_id = split(' ', strtolower($spells['duration']))[-1];
            $lvl = (ctype_digit($spells['level'][0]))? $spells['level'][0]:0;
            $consumed = str_contains($spells['material'], 'gp');
            $rn = split(' ', $spells['range'])[0];
            $range_num = (ctype_digit($rn) ? $rn : 0);
            
            $insert = $db->prepare('INSERT INTO project1.spells (name, school_id, source_id, casting_time_id, duration_id, casting_time, duration, lvl, concentration, ritual, range, range_type, components, component_desc, consumed, description, higher_desc, area) 
            VALUES (:name, (SELECT id FROM project1.schools WHERE name=:school_id),
            (SELECT id FROM project1.sources WHERE name=:source_id),
            (SELECT id FROM project1.lengths WHERE name=:casting_id),
            (SELECT id FROM project1.lengths WHERE name=:duration_id),
            :casting_time, :duration, :lvl, :con, :ritual, :range, :range_type, :components, :component_desc, :consumed, :description, :higher_desc)');
            $query -> bindValue(':name', $spells['name'], PDO::PARAM_STR);
            $query -> bindValue(':school_id', strtolower($spells['school']), PDO::PARAM_STR);
            $query -> bindValue(':source_id', strtolower($spells['source']), PDO::PARAM_STR);
            $query -> bindValue(':casting_id', $casting_id, PDO::PARAM_STR);
            $query -> bindValue(':duration_id', $duration, PDO::PARAM_STR);
            $query -> bindValue(':casting_time', split(' ', $spells['casting_time'])[0], PDO::PARAM_INT);
            $query -> bindValue(':duration', $split(' ', $spells['duration'])[0], PDO::PARAM_STR);
            $query -> bindValue(':lvl', $lvl, PDO::PARAM_INT);
            $query -> bindValue(':components', $spells['components'], PDO::PARAM_STR);
            $query -> bindValue(':con', ($spells['concentration'] == 'yes' ? true : false), PDO::PARAM_BOOL);
            $query -> bindValue(':ritual', ($spells['ritual'] == 'yes' ? true : false), PDO::PARAM_BOOL);
            $query -> bindValue(':consumed', $consumed, PDO::PARAM_BOOL);
            $query -> bindValue(':range', $range_num, PDO::PARAM_INT);
            $query -> bindValue(':range_type', split(' ', $spells['range'])[-1], PDO::PARAM_STR);
            $query -> bindValue(':component_desc', $spells['material'], PDO::PARAM_STR);
            $query -> bindValue(':description', $spells['desc'], PDO::PARAM_STR);
            $query -> bindValue(':higher_desc', $spells['higher_level'], PDO::PARAM_STR);
            $query->execute();
         }
      } catch (PDOException $ex) {
         echo "Error connecting to DB. Details: $ex";
      }
      unset($_GET);
      unset($_SERVER['REQUEST_METHOD']);
   }
   
   
   
   
?>
<form method='GET'>
   <input type='submit' name='submit' value='delete'>
   <input type='submit' name='submit' value='create'>
   <input type='submit' name='submit' value='insert'>
   <input type='submit' name='submit' value='json'>
</form>