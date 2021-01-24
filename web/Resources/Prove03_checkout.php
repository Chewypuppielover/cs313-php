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
         function AJAX() {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("main").innerHTML = this.responseText;
               }
            };
            xhttp.open("POST", "/Resources/Prove03_checkout.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            if(item == 'NAN') xhttp.send();
            else xhttp.send("type=REMOVE&item="+item);
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
         <a href="/Prove03.php"> Products </a> </br> 
         <a href="/Resources/Prove03_cart.php"> Cart </a>
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
                  echo "<td id='$item'>$item ..$x</td>";
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
      <div id="main">
         <form method="post" onsubmit="AJAX();return true;">
            <label>Street: <input type="text" name="street"></label>
            <label> Apt #: <input type="text" name="apt"></label> </br>
            <label>City: <input type="text" name="city"></label>
            <label> State: <input type="text" name="state"></label>
            <label> Zip Code: <input type="text" name="zip"></label>
            <input type="submit" name="End_Session" value="Finalize">
         </form>
      </div>
      <?php
         if(isset($_POST["End_Session"])) {
            echo $_POST["street"] . " " . $_POST["apt"] . "</br>" . $_POST["city"] . ", " . $_POST["state"] . ", " . $_POST["zip"];
            if($_SESSION["DEBUG"]) {
               $_SESSION['DBCOUNT'] += 1;
               echo "ending session " . $_SESSION['DBCOUNT'] . "<br>";
            }
            unset($_POST["End_Session"]);
            unset($_SESSION["cart"]);
               if($_SESSION["DEBUG"]) print_r($_SESSION);
            header("Refresh:0");
            //session_unset(); session_destroy(); session_start();
         }
      ?>
   </body>
</html>