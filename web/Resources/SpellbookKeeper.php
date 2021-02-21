<?php
   require('DBconnect.php');
   $db = get_db();
   
   $stm = "SELECT sc.name school, so.name source, ct.name casting_time_type, s.name save_attack, spells.name, spells.casting_time, spells.duration, spells.lvl, spells.concentration, spells.ritual, spells.range, spells.range_type, spells.area, spells.components, spells.component_desc, spells.consumed, spells.description, spells.higher_desc, spells.save_id " .
      "FROM project1.spells spells, project1.schools sc, project1.sources so, project1.lengths ct, project1.saves_attacks s " .
      "WHERE spells.school_id = sc.id " .
      "AND spells.source_id = so.id " .
      "AND spells.casting_time_id = ct.id " .
      "AND spells.save_id = s.id";
   
   try {
      $res = $db -> query($stm);
      $all = $res -> fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($all);
   } catch (PDOException $ex) {
      echo "Error connecting to DB. Details: $ex";
      die();
   }
?>

