<?php
   require('DBconnect.php');
   $db = get_db();
   
   try {
      echo $db -> query(SELECT sc.name AS school, so.name AS source, ct.name AS casting_time_type, d.name AS duration_type, s.name AS save_attack, spells.name, spells.casting_time, spells.duration, spells.lvl, spells.concentration, spells.ritual, spells.range, spells.range_type, spells.components, spells.component_desc, spells.consumed, spells.description, spells.higher_desc, spells.save_id
      FROM project1.spells AS spells, project1.schools AS sc, project1.sources AS so, project1.lengths AS ct, project1.lengths AS d, project1.saves_attacks AS s
      WHERE spells.school_id = sc.id
      AND spells.source_id = so.id
      AND spells.casting_time_id = ct.id
      AND spells.duration_id = d.id
      AND spells.save_id = s.id);
   } catch () {
      echo "Error connecting to DB. Details: $ex";
      die();
   }
?>

