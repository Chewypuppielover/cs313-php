<html>
    <body>
        <pre>
            <?php var_dump($_POST); ?>
        </pre>
        <?php
            echo $_POST["name"] . "</br>";
            echo "<a href='mailto:{$_POST['Email']}'>Send email</a></br>";

            $majors  = [
                'Computer Science',
                'Web Design and Development',
                'Computer Information Technology',
                'Computer Engineering'
            ];
            echo $majors[$_POST["major"]] . "</br>";
            echo $_POST["comments"] . "</br>";

            $continents  = [
            'na' => 'North America',
            'sa' => 'South America',
            'eu' => 'Europe',
            'as' => 'Asia',
            'aus' => 'Australia',
            'af' => 'Africa',
            'an' => 'Antarctica'
            ];

            foreach ($_POST["Continents"] as $key) 
            {echo "$continents[$key]</br>";}
        ?>
    </body>
</html>