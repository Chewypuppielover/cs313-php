<?php
   session_start();
   if(!isset($_SESSION["cart"])) $_SESSION["cart"] = array(
         "Broken TV" => 0, "JarJar" => 0, "Pirate Magnet" => 0,
         "Cleric" => 0, "Sorcerer" => 0, "Ranger" => 0,
         "Druid" => 0, "Necromancer" => 0, "Holly" => 0);
   if(!isset($_SESSION["DEBUG"])) $_SESSION["DEBUG"] = true;
   $MAXCOL = 3;
   $cartPHP = "Resources/Prove03_cart.php";
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset = "utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Sally's Terrible Store Products</title>
      <script type="text/javascript">
         var DEBUG = true;
         window.onload = function() {
            if(DEBUG) {
               //alert("JS is Working, page loaded");
               document.getElementById("DEBUG").style.display = "initial";
               AJAX('NAN');
            }
         };
         
         function AJAX(value) {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("DEBUG").innerHTML = this.responseText;
               }
            };
            xhttp.open("POST", <?php echo "'$cartPHP'" ?>, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            if(value == 'NAN') xhttp.send();
            else xhttp.send("type=ADD&item="+value);
         }
      </script>
      <style>
         #products { margin-left: 20%; }
         td { padding: 10px; }
      </style>
   </head>
   <body>
      <div id="DEBUG" style="display:none">
      </div>
      <header style="text-align:center;">
         <h1>Sally's Terrible Store </h1>
         <h3><a href="Resources/Prove03_cart.php"> Cart </a></h3>
      </header>
      <hr/>
      <div id="products">
         <table>
            <th> Products </th>
            <?php
               $col = 0;
               foreach($_SESSION["cart"] as $item => $x) {
                  if($col == 0) echo "<tr>";
                  echo "<td>$item<br><button onclick=\"AJAX('$item')\">Add To Cart</button></td>";
                  $col += 1;
                  if($col == $MAXCOL) {
                     $col = 0;
                     echo "</tr>";
                  }
               }
               if($col != 0) echo "</tr>";
            ?>
         </table>
      </div>
   </body>
</html>