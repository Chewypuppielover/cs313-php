<?php 
   require('DBconnect.php');
   $db = get_db();
   $insert = 'INSERT INTO project1.spells (name, school_id, source_id, casting_time_id, duration_id, casting_time, duration, lvl, concentration, ritual, range, range_type, components, component_desc, consumed, description, higher_desc, save_id, area) 
   VALUES (:name, :school_id, :source_id, :casting_id, :duration_id, :casting_time, :duration, :lvl, :con, :ritual, :range, :range_type, :components, :component_desc, :consumed, :description, :higher_desc, :save_id, :area)';
   try {
      $stm = $db->query('SELECT id, name FROM project1.schools');
      $schools = $stm -> fetchAll(PDO::FETCH_ASSOC);
      print_r($schools);
      $stm = $db->query('SELECT id, name FROM project1.sources');
      $sources = $stm -> fetchAll(PDO::FETCH_ASSOC);
      print_r($sources);
      $stm = $db->query('SELECT id, name FROM project1.classes');
      $classes = $stm -> fetchAll(PDO::FETCH_ASSOC);
      print_r($classes);
      $stm = $db->query('SELECT id, name FROM project1.lengths');
      $lengths = $stm -> fetchAll(PDO::FETCH_ASSOC);
      print_r($lengths);
      $stm = $db->query('SELECT id, name FROM project1.saves_attacks');
      $saves = $stm -> fetchAll(PDO::FETCH_ASSOC);
      print_r($saves);
      
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
         echo "POST caught";
         print_r($_POST);
         $com = implode(", ", $_POST['components']);
         $query = $db -> prepare($insert);
         $query -> execute(['name' => $_POST['name'], 'school_id' => $_POST['school'],
            'source_id' => $_POST['source'], 'casting_id' => $_POST['cast_id'], 'duration_id' => $_POST['time_id'],
            'casting_time' => $_POST['casting_time'], 'duration' => $_POST['duration'],
            'lvl' => $_POST['level'], 'con' => $_POST['con'], 'ritual' => $_POST['ritual'],
            'range' => $_POST['range'], 'range_type' => $_POST['range_type'], 'components' => $com,
            'component_desc' => $_POST['com_desc'], 'consumed' => $_POST['consumed'], 
            'description' => $_POST['description'], 'higher_desc' => $_POST['higher_desc'],
            'save_id' => $_POST['save'], 'area' => $_POST['area']]);
         print_r($query -> feth());
         unset($_POST);
      }
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
<form method='POST'>
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
      <label>Save or Attack: <select name='save'>
         <?php foreach($saves as $row) {
            echo "<option value='" .$row['id']. "'>" . ucwords(strtolower($row['name'])) . "</option>";
         } ?>
      </select></label>
   </fieldset>
   <fieldset> 
      <label>Casting Time: <input type='number' name='casting_time'></input></label>
      <label>Action: <select name='cast_id'>
         <?php foreach($lengths as $row) {
            echo "<option value='" .$row['id']. "'>" . ucwords(strtolower($row['name'])) . "</option>";
         } ?>
      </select></label></br>
      
      <label>Range: <input type='number' name='range'></input></label>
      <label><input type='text' name='range_type'></input></label></br>
      
      <label>Duration: <input type='number' name='duration'></input></label>
      <label><select name='time_id'>
         <?php foreach($lengths as $row) {
            echo "<option value='" .$row['id']. "'>" . ucwords(strtolower($row['name'])) . "</option>";
         } ?>
      </select></label></br>
      
      <label>Area: <input type='text' name='area'></input></label></br>
   </fieldset>
   <fieldset> 
      Components: 
      <label><input type='checkbox' name='components[]' value='V'/>Verbal</label>
      <label><input type='checkbox' name='components[]' value='S'/>Semantic</label>
      <label><input type='checkbox' name='components[]' value='M'/>Material</label></br>
      <label><input type='checkbox' name='consumed'/>Materials Consumed?</label>
      <label>Components Description: <input type='text' name='com_desc'/></label></br>
      <label><input type='checkbox' name='con'/>Concentration</label>
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