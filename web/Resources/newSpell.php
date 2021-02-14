<?php 
   require('DBconnect.php');
   $db = get_db();
   try {
      $schools = $db->query('SELECT id, name FROM project1.schools');
      $schools -> fetch(PDO::FETCH_ASSOC);
      //print_r($schools);
      $sources = $db->query('SELECT id, name FROM project1.sources');
      $sources -> fetch(PDO::FETCH_ASSOC);
      //print_r($sources);
      $classes = $db->query('SELECT id, name FROM project1.classes');
      $classes -> fetch(PDO::FETCH_ASSOC);
      //print_r($classes);
      $lengths = $db->query('SELECT id, name FROM project1.lengths');
      $lengths -> fetch(PDO::FETCH_ASSOC);
      //print_r($lengths);
   }
   catch (PDOException $ex) {
      echo "Error connecting to DB. Details: $ex";
      die();
   }
?>
<head>
   <link rel="stylesheet" href="Prove06.css">
   <script src="Prove06.js"> </script>
</head>
<form method='POST' >
   <fieldset>
      <h2>Create New Spell</h2>
      <label>Spell Name: <input type='text' name='name'></input></label></br>
      
      <label>Level: <select name='level'>
         <option value='-1'>Cantrip</option>
         <?php for($x = 0; $x < 10; $x++) {
            echo "<option value='$x'>Level $x</option>";
         } ?>
      </select></label>
      <label>School: <select name='school'>
         <?php foreach($schools as $row) {
            echo "<option value='" .$row['id']. "'>" . ucwords(strtolower($row['name'])) . "</option>";
         } ?>
      </select></label></br>
   </fieldset>
   <fieldset> 
      <lable>Casting Time: <input type='number' name='casting_time'></input></label>
      <lable>Action: <input type='text' name='casting_type'></input></label></br>
      
      <lable>Range: <input type='number' name='range'></input></label>
      <lable><input type='text' name='range_type'></input></label></br>
      
      <lable>Duration: <input type='number' name='duration'></input></label>
      <lable><input type='text' name='duration_type'></input></label></br>
      
      <label>Area: <input type='text' name='area'></input></label></br>
   </fieldset>
   <fieldset> 
      Components: 
      <label><input type='checkbox' name='components[]' value='V'/>Verbal</label>
      <label><input type='checkbox' name='components[]' value='S'/>Semantic</label>
      <label><input type='checkbox' name='components[]' value='M'/>Material</label></br>
      <label><input type='checkbox' name='consumed'/>Materials Consumed?</label>
      <label>Components Description: <input type='text' name='name'/></label></br>
      <label><input type='checkbox' name='concentration'/>Concentration</label>
      <label><input type='checkbox' name='ritual'/>Ritual</label></br>
   </fieldset>
   <fieldset> 
      <label>Spell Description: </br>
      <textarea name='description'></textarea></label></br>
      <label>Spell Description at Higher Levels: </br>
      <textarea name='higher_desc'></textarea></label></br>
   </fieldset>
   <fieldset> 
      <label>Book: <select name='source'>
         <?php foreach($sources as $row) {
            echo "<option value='" .$row['id']. "'>" . ucwords(strtolower($row['name'])) . "</option>";
         } ?>
      </select></label></br>
      
      Classes: </br>
      <?php foreach($classes as $row) {
         echo "<label><input type='checkbox' name='classes[]' value='" .$row['id']. "'/>" . ucwords(strtolower($row['name'])) . "</label></br>";
      } ?>
   </fieldset>
      <input type='submit' value='Create Spell'/>
</form>