<?php
   session_start();
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset = "utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Sally's Terrible Store Checkout </title>
      <script type="text/javascript">
         var DEBUG = true;
      </script>
   </head>
   <body>
      <div id="DEBUG" style="display:none">
      <?php
            if($_SESSION["DEBUG"] && !isset($_SESSION["DBCOUNT"])) {
               $_SESSION["DBCOUNT"] = 0;
               echo "DBcount reset to ",$_SESSION['DBCOUNT'],"<br>";
            }
            if($_SESSION["DEBUG"]) echo "DBcount = ", $_SESSION['DBCOUNT'],"<br>";
      ?>
      </div>
      <header style="text-align:center;">
         <h1>Sally's Terrible Store </h1>
         <a href="../Prove03.php"> Products </a> <a href="Prove03_cart.php"> Cart </a>
      </header>
      <hr/>
      
   </body>
</html>