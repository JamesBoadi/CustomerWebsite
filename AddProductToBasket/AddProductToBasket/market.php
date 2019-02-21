<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Market");
  session_start();

  //Connect to MongoDB and select database
 /* $mongoClient = new MongoClient();
  $db = $mongoClient->ecommerce;
  
  //Create a basket document if we do not have one
  if( !array_key_exists("basket_id", $_SESSION) ){
      //Add an empty basket 
      $dataArray = ["products" => []];
      $returnVal = $db->baskets->insert($dataArray);
  
      //Check result 
      if($returnVal['ok'] != 1){
          throw new Exception("Error adding empty basket to MongoDB");
      }
  
      //Store basket ID in session key
      $_SESSION['basket_id'] = (string)$dataArray['_id'];
  }
  
  //Request for basket
  if ($_SERVER['REQUEST_METHOD'] === 'GET'){
      //Find basket with specified ID
      $findCriteria["_id"] = new MongoId($_SESSION['basket_id']);
      $basketCursor = $db->baskets->find($findCriteria);
  
      //Check that we have found exactly one basket
      $numResults = $basketCursor->count();//Number of products in database 
      if($numResults == 0){
          throw new Exception("Basket not found");
      }
  
      //Get basket from basket cursor
      $basket = $basketCursor->next();
  
      //Return product in JSON format
      echo json_encode($basket);//Convert PHP representation of product into JSON 
  }
  //Modified basket has been sent to server
  else if($_SERVER['REQUEST_METHOD'] === 'POST'){
      //Get JSON document containing basket from POST
      $basketJSON = $_POST['json'];
  
      //Convert JSON string to PHP  array. 'true' converts to array instead of PHP object.
      $basketPHPArray = json_decode($basketJSON, true);
  
      //Add ID field to basket array
      $basketPHPArray['_id'] = new MongoId($_SESSION['basket_id']);
  
      //#FIXME# CHECK THAT PRODUCTS ARE IN STOCK!
  
      //#FIXME# MERGE QUANTITIES OF PRODUCTS WITH THE SAME ID
  
      //#FIXME# MOVE REQUIRED NUMBER OF GOODS FROM PRODUCTS COLLECTION TO BASKET COLLECTION
  
      //Save the product in the database - it will overwrite the data for the basket with this ID
      $returnVal = $db->baskets->save($basketPHPArray);
      if($returnVal['ok'] != 1){
          throw new Exception("Error updating MongoDB basket.");
      }
  
      //Basket updated successfully
      echo 'ok';
  }
  else{
      throw new Exception("Request method not recognized.");
  }
  
  //Close connection to server
  $mongoClient->close();  */
  
  
?>

<div id="searchField">
    <div id="barBtnHolder">
        <input class="searchBar" id="SearchBar"></input>
        <button id="searchBtn" onclick="search()"><img src="images/searchIcon.png"></button>
    </div>
    <a id="sortBtn">Sort↓</a>
</div>

<div id="itemHolder">
    <!-- Maximum amount of items : 10 -->
    <h1>Shop</h1>
    <div class="singleItem" id="tank1">
        <button onclick="addProduct('tank1')"><img class="itemL" src="images/20.gif"></button>
        <a>RedTank</a>
        <a>300</a>
    </div>

    <div class="singleItem" id="tank2">
        <button onclick="addProduct('tank2')"><img class="itemL" src="images/20.gif"></button>
        <a>BlueTank</a>
        <a>250</a>
    </div>

    <div class="singleItem" id="tank3">
        <button onclick="addProduct('tank3')"><img class="itemL" src="images/20.gif"></button>
        <a>PurpleTank</a>
        <a>400</a>
    </div>

    <div class="singleItem" id="tank4">
        <button onclick="addProduct('tank4')"><img class="itemL" src="images/20.gif"></button>
        <a>YellowTank</a>
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

    </div>

    <hr>
    <h2>Total: 0</h2>
    <h2 id="clear"><a>Clear Basket</a></h2>
    <hr>
    <h2 id="checkoutBtn">Checkout</h2>
</div>



<script src="javascript/market.js"></script>
<script src="javascript/Search.js"></script>
<?php

  //Footer function from functions.php file
  footer();

?>