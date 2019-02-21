<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Market");

?>

<div id="searchField">
  <div id="barBtnHolder">
    <input id="searchBar"></input>
    <button id="searchBtn" onclick=""><img src="images/searchIcon.png"></button>
  </div>
  <a id="sortBtn">Sort↓</a>
</div>

<div id="itemHolder">
  <h1>Shop</h1>
  <!--<div class="singleItem">
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
  <div class="singleItem">
    <img class="itemL" src="images/20.gif">
    <a>Item name</a>
    <a>300</a>
  </div> -->
</div>

<h1 id="points">Points: 1000</h1>

<div id="basketContainer">
  <h1>Basket</h1>
  <div id="basket">
    <hr>
  <!--  <div class="singleItem">
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
    </div> -->
  </div>
  <hr>
  <h2>Total: 0</h2>
  <h2 id="clear"><a>Clear Basket</a></h2>
  <hr>
  <h2 id="checkoutBtn">Checkout</h2>
</div>

<script>

      window.onload = displayProducts();

      function displayProducts() {

          var request = new XMLHttpRequest();

          request.onload = function(){

            if(request.status === 200) {

              //console.log(request.responseText);

              productInfo(request.responseText);

            } else {

              console.log("Error communicating with server: " + request.status);
            }
          }

          request.open("GET", "display_products.php");
          request.send();
        }

        function productInfo(products) {

            var productList = JSON.parse(products);
            console.log(productList);
            console.log(productList[1].price);

            var holder = document.getElementById("itemHolder");

            for(var i = 0; i < productList.length; i++) {

                var valueHolder = document.createElement("div");
                valueHolder.setAttribute("class", "singleItem");
                var picture = document.createElement("img");
                picture.setAttribute("class", "itemL");
                picture.setAttribute("src", "images/20.gif");
                var itmName = document.createElement("a");
                var itemPrice = document.createElement("a");
                var nameText = document.createTextNode(productList[i].itemName);
                var priceText = document.createTextNode(productList[i].price);
                itemPrice.appendChild(priceText);
                itmName.append(nameText);
                valueHolder.appendChild(picture);
                valueHolder.appendChild(itmName);
                valueHolder.appendChild(itemPrice);
                holder.appendChild(valueHolder);

            }
        }



</script>


<?php

  //Footer function from functions.php file
  footer();

?>
