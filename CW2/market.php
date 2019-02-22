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
</div>

<h1 id="points">Log In to use market</h1>

<div id="basketContainer">
  <h1>Basket</h1>
  <div id="basket">
    <hr>
  </div>

  <hr>
  <h2 id="totalP">Total: 0</h2>
  <h2 id="clear" onclick="emptyBasket()"><a>Clear Basket</a></h2>
  <hr>
  <h2 id="checkoutBtn" onclick="checkOut()">Checkout</h2>
</div>

<script>

window.onload = displayProducts();
window.onload = loadBasket();
checkLogin();

function checkLogin() {
  var request = new XMLHttpRequest();

  request.onload = function() {

    if(request.responseText === "Not logged in.") {

      displayPoints(request.responseText);

    } else {

      displayPoints(request.responseText);
      console.log(request.responseText + "bbb");
      document.getElementById("user").innerHTML = request.responseText;
    }
  };
  request.open("GET", "return_user.php");
  request.send();
}


function displayPoints(us) {
    var request = new XMLHttpRequest();

    request.onload = function(){

        if(request.status === 200){

            if(request.responseText === "[]") {

              document.getElementById("points").innerHTML = "Log In to use market";

            } else {

              var pointString = "Points: " + JSON.parse(request.responseText)[0].points;// + JSON.parse(request.responseText)[0].points;
              document.getElementById("points").innerHTML = pointString;
              console.log(JSON.parse(request.responseText)[0].points);
            }
        }
        else
            console.log("Error communicating with server: " + request.status);
    };

    request.open("POST", "get_points.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("name=" + us);
}


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
            //console.log(productList[0]._id.$id);

            var holder = document.getElementById("itemHolder");

            for(var i = 0; i < productList.length; i++) {

                var valueHolder = document.createElement("div");
                valueHolder.setAttribute("class", "singleItem");
                valueHolder.setAttribute("id", productList[i].itemName);
                valueHolder.setAttribute("onclick", "getId(this.id)");
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

        function getId(id) {
          //console.log(id);
          var request = new XMLHttpRequest();
          request.onload = function(){
              //Check HTTP status code
              if(request.status === 200){

                  console.log(JSON.parse(request.responseText));
                  addToBasket(JSON.parse(request.responseText));
              }
              else
                  console.log("Error communicating with server: " + request.status);
          };

          //Set up request with HTTP method and URL
          request.open("POST", "check_product.php");
          request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          //console.log(user);
          request.send("id=" + id);
      }



      function loadBasket(){
    //Get basket from local storage or create one if it does not exist
    var basketArray;
    if(sessionStorage.basket === undefined || sessionStorage.basket === ""){
        basketArray = [];
    }
    else {
        basketArray = JSON.parse(sessionStorage.basket);
    }

    var basketCont = document.getElementById("basket");
    basketCont.innerHTML = "";
    var total = 0;
    for(var i = 0; i < basketArray.length; ++i){
      total += basketArray[i][0].price;
      var valueHolder = document.createElement("div");
      valueHolder.setAttribute("class", "singleItem");
      var picture = document.createElement("img");
      picture.setAttribute("class", "itemL");
      picture.setAttribute("src", "images/20.gif");
      var itmName = document.createElement("a");
      var itemPrice = document.createElement("a");
      var nameText = document.createTextNode(basketArray[i][0].itemName);
      var priceText = document.createTextNode(basketArray[i][0].price);
      itemPrice.appendChild(priceText);
      itmName.append(nameText);
      valueHolder.appendChild(picture);
      valueHolder.appendChild(itmName);
      valueHolder.appendChild(itemPrice);
      basketCont.appendChild(valueHolder);
    }
    document.getElementById("totalP").innerHTML = "Total: " + total;
}

//Adds an item to the basket
function addToBasket(prodName){
    //Get basket from local storage or create one if it does not exist
    var basketArray;
    if(sessionStorage.basket === undefined || sessionStorage.basket === ""){
        basketArray = [];
    }
    else {
        basketArray = JSON.parse(sessionStorage.basket);
    }

    //Add product to basket
    basketArray.push(prodName);
    console.log(basketArray);

    //Store in local storage
    sessionStorage.basket = JSON.stringify(basketArray);

    //Display basket in page.
    loadBasket();
}

//Deletes all products from basket
function emptyBasket(){
    sessionStorage.clear();
    loadBasket();
}

function checkOut() {
  var request = new XMLHttpRequest();
 // var request = new XMLHttpRequest();
  request.onload = function() {

    if(request.responseText === "Not logged in.") {
      //displayPoints(request.responseText);


    } else {
      sumbitToDatabase(request.responseText);
      //displayPoints(request.responseText);
      //console.log(request.responseText + "bbb");
    //  selectTab(event, 'log');

      document.getElementById("user").innerHTML = request.responseText;
    }
  };
  //console.log(user);
  request.open("GET", "return_user.php");
  request.send();
}



function sumbitToDatabase(us) {
  var request = new XMLHttpRequest();

  request.onload = function(){

    if(request.status === 200) {

      if(request.responseText === 'ok') {
        emptyBasket();
        displayPoints(us);
        alert("Thank you for your purchase");
      } else {
        alert("Insufficient balance");
      }

      //productInfo(request.responseText);

    } else {

      console.log("Error communicating with server: " + request.status);
    }
  };

  request.open("POST", "submit_purchase.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("name=" + us + "&basket=" + sessionStorage.basket);
}





</script>


<?php

  //Footer function from functions.php file
  footer();

?>
