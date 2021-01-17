<html>
   <head>
      <meta charset = "utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Character</title>
      <link rel="stylesheet" href="resources/Prove02.css">
   </head>
   
   <body>
      <header>
         <?php print $_GET['CharacterName']; ?>
      </header>
      <div class="flex">
         <img src="https://cdnb.artstation.com/p/assets/images/images/006/017/293/large/kevin-furr-halfelfranger.jpg?1495455953" 
             alt="Dungeons and Dragons Character" width="160" height="300">
         <div class="col1">
            <?php print $_GET['gender']; ?>
         </div>
         <div class="col2">
            <?php print $_GET['align'];
                  print $_GET['align1']; ?>
         </div>
         <div class="col3">
            <?php print $_GET['Class']; ?>
         </div>
         <div class="col4">
            <?php print $_GET['Race']; ?>
         </div>
      </div>
      <div>
         <?php print $_GET['Ideal']; ?>
         <?php print $_GET['Bond']; ?>
         <?php print $_GET['Flaw']; ?>
      </div>
   </body>
</html>