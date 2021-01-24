<?php
   session_start(); 
   if(isset($_POST["Payment"]) {
      echo $_POST["street"] . " " . $_POST["apt"] . "</br>" . $_POST["city"] . ", " . $_POST["state"] . ", " . $_POST["zip"];
   }
   else {
      if($_SESSION["DEBUG"]) echo "REQUEST: ", print_r($_REQUEST, true),"<br>";
      $item = $_REQUEST["item"];
      if($_SESSION["DEBUG"]) echo "item = $item \n<br>";
      //if(!isset($_SESSION["cart"][$item])) $_SESSION["cart"][$item] = 0;
      if($_REQUEST["type"] == "ADD") $_SESSION["cart"][$item] += 1;
      if($_REQUEST["type"] == "REMOVE") $_SESSION["cart"][$item] -= 1;
      if($_SESSION["DEBUG"]) echo "<pre>SESSION ", print_r($_SESSION, true),"</pre>";
   }
?>

<?php/*
      if($_SESSION["DEBUG"]) echo "POST: ", print_r($_POST,true),"<br>";
   if(isset($_POST['item'])) {
      $item = $_POST["item"];
      unset($_REQUEST["item"]);
      $_SESSION["cart"][$item] += 1; (-= 1;)
         if($_SESSION["DEBUG"]) echo "item = $item \n<br>";
         if($_SESSION["DEBUG"]) echo "POST: ", print_r($_POST,true);
   }
      if($_SESSION["DEBUG"]) echo "<pre>SESSION ",print_r($_SESSION,true),"</pre>";
      
      
      
      "<td><form method='post'>
      <input type='text' name='item' value='$item' hidden>$x... $item <br>
      <input type='submit' value='Remove one from Cart'></form></td>";
*/?>