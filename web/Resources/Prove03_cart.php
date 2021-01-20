<?php
   session_start();
   $MAXCOL = 3;
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset = "utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Sally's Terrible Store Cart </title>
      <script type="text/javascript">
         var DEBUG = true;
         window.onload = function() {
            if(DEBUG) {
               document.getElementById("DEBUG").style.display = "initial";
               AJAX('NAN');
            }
         };
         
         function AJAX(item, number) {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("DEBUG").innerHTML = this.responseText;
                  document.getElementById(item).innerHTML = number-1 + "... " + item +
                     "<br><button onclick=\'AJAX(" + item + "," + number + ")\'>Remove from Cart</button>";
               }
            };
            xhttp.open("POST", "Prove03_cartVar.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            if(item == 'NAN') xhttp.send();
            else xhttp.send("type=REMOVE&item="+item);
         }
         
         function callback(element){
            
         }
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
         <a href="../Prove03.php"> Products </a>
      </header>
      <hr/>
      <table id="cart">
         <th> Products in Cart</th>
         <?php
            $col = 0;
            $count = 0;
            foreach($_SESSION["cart"] as $item => $x) {
               if($x != 0) {
                  $count += 1;
                  if($col == 0) echo "<tr>";
                  echo "<td id='$item'>$x... $item<br><button onclick=\"AJAX('$item', '$x')\">Remove from Cart</button></td>";
                  $col += 1;
                  if($col == $MAXCOL) {
                     $col = 0;
                     echo "</tr>";
                  }
               }
            }
            if($col != 0) echo "</tr>";
            if($count == 0) echo "<tr><td> No items in Cart </td></tr>";
         ?>
      </table>
      <br>
      <form method="post">
         <input type="submit" id="clr" name="End_Session" value="Clear Cart">
      </form>
      <div id="info">
         <?php
            if(isset($_POST["End_Session"])) {
               if($_SESSION["DEBUG"]) {
                  $_SESSION['DBCOUNT'] += 1;
                  echo "ending session ",$_SESSION['DBCOUNT'],"<br>";
               }
               unset($_POST["End_Session"]);
               unset($_SESSION["cart"]);
                  if($_SESSION["DEBUG"]) print_r($_SESSION);
               header("Refresh:0");
               //session_unset(); session_destroy(); session_start();
            }
         ?>
      </div>
   </body>
</html>