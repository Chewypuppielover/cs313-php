<html>
  <head>
    <title>PHP Test</title>
  </head>
  <body>
    <form action="Resources/Team03.php" method="POST">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name"> </br>
        <label for="Email">Email: </label>
        <input type="text" id="Email" name="Email"> </br>
        
        Major: </br>
        <?php
            $majors  = [
                'Computer Science',
                'Web Design and Development',
                'Computer Information Technology',
                'Computer Engineering'
            ];
            foreach ($majors as $key => $value)
            {
                echo "<label><input type='radio' name='major' value='$key'>$value</label></br>";
            }
        ?>

        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" rows="3"></textarea></br>

        Continents you have visited: </br>
        <label><input type="checkbox" name="Continents[]" value="na">North America</label></br>
        <label><input type="checkbox" name="Continents[]" value="sa">South America</label></br>
        <label><input type="checkbox" name="Continents[]" value="eu">Europe</label></br>
        <label><input type="checkbox" name="Continents[]" value="as">Asia</label></br>
        <label><input type="checkbox" name="Continents[]" value="aus">Australia</label></br>
        <label><input type="checkbox" name="Continents[]" value="af">Africa</label></br>
        <label><input type="checkbox" name="Continents[]" value="an">Antarctica</label></br>

        <input type="submit" value="Submit">
    </form>
  </body>
</html>