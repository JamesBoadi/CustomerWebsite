<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Market");
  
  // connect to mongodb
  $m = new MongoDB\Driver\Manager();  //http://php.net/manual/en/class.mongodb-driver-manager.php
  
  echo "Connection to database successfully";
  // select a database
  // $db = $m->[DatabaseName]; etc...................
 

?>

<div id="searchField">
  <div id="barBtnHolder">
    <input id="searchBar"></input>
    <button id="searchBtn" onclick=""><img src="images/searchIcon.png"></button>
  </div>
  <a id="sortBtn">Sort↓</a>
</div>

<div id="itemHolder"> <!-- Maximum amount of items : 10 -->
  <h1>Shop</h1>
  <div class="singleItem" id="tank1">
    <img class="itemL" src="images/20.gif">
    <a>Tank1</a>
    <a>300</a>
    </div>

  <div class="singleItem" id="tank2">
    <img class="itemL" src="images/20.gif">
    <a>Tank2</a>
    <a>250</a>
  </div>

  <div class="singleItem" id="tank3">
    <img class="itemL" src="images/20.gif">
    <a>Tank3</a>
    <a>400</a>
  </div>

  <div class="singleItem" id="tank4">
    <img class="itemL" src="images/20.gif">
    <a>Tank4</a>
    <a>350</a>
  </div>


<!-- Small items -->

 <!-- Tag name = small 
    <div class="singleItem">
      <img class="itemL" src="images/20.gif">
      <a>Item name</a>
      <a>350</a>
    </div>

   
    <div class="singleItem">
      <img class="itemL" src="images/20.gif">
      <a>Item name</a>
      <a>390</a>
    </div>

  
  <div class="singleItem">
    <img class="itemL" src="images/20.gif">
    <a>Item name</a>
    <a>300</a>
  </div>-->

</div>

<h1 id="points">Points: 1000</h1>

<div id="basketContainer">
  <h1>Basket</h1>
  <div id="basket">
    <hr>
    <div class="singleItem">
      <img class="itemL" src="images/20.gif">
      <a>Item name</a>
      <a>300</a>
    </div>
    <div class="singleItem">
      <img class="itemL" src="images/20.gif">
      <a>Item name</a>
      <a>300</a>
    </div>
    <div class="singleItem">
      <img class="itemL" src="images/20.gif">
      <a>Item name</a>
      <a>300</a>
    </div>
  </div>
  <hr>
  <h2>Total: 0</h2>
  <h2 id="clear"><a>Clear Basket</a></h2>
  <hr>
  <h2 id="checkoutBtn">Checkout</h2>
</div>

<script>

</script>

<script src="market.js"></script>

<?php

  //Footer function from functions.php file
  footer();

?>
