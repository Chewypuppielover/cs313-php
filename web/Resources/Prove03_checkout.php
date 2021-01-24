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
         var DEBUG = false;
         function AJAX() {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("main").innerHTML = this.responseText;
                  console.log(this.responseText);
               }
            };
            xhttp.open("POST", "/Resources/Prove03_checkout.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
         }
      </script>
      <style>
         .h3 {
            font-size: 1.17em;
            font-weight: bold;
         }
      </style>
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
      <div id=cart>
         <p class=h3>Products in Cart</p>
         <?php
            $count = 0;
            foreach($_SESSION["cart"] as $item => $x) {
               if ($x != 0) {
                  $count += 1;
                  echo "$item ..$x </br>";
               }
            }
            if($count == 0) echo "<h4>No items in Cart</h4>";
         ?>
         </br>
      </div>
      <div id="main">
         <?php
            if(isset($_POST["Payment"])) {
               echo $_POST["street"] . " " . $_POST["apt"] . "</br>" . $_POST["city"] . ", " . $_POST["state"] . ", " . $_POST["zip"];
               if($_SESSION["DEBUG"]) {
                  $_SESSION['DBCOUNT'] += 1;
                  echo "ending session " . $_SESSION['DBCOUNT'] . "<br>";
               }
               unset($_POST["End_Session"]);
               unset($_SESSION["cart"]);
                  if($_SESSION["DEBUG"]) print_r($_SESSION);
            }
            else {
               echo '<form method="post">';
               echo   '<label>Street: <input type="text" name="street"></label>';
               echo   '<label> Apt #: <input type="text" name="apt" size="2"></label> </br>';
               echo   '<label>City: <input type="text" name="city"></label>';
               echo   '<label> State: <input type="text" name="state"></label>';
               echo   '<label> Zip Code: <input type="text" name="zip" size="4"></label> </br>';
               echo   '<input type="submit" name="Payment" value="Finalize">';
               echo '</form>';
            }
         ?>
      </div>
   </body>
</html>