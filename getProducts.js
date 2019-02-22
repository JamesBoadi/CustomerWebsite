window.onload = displayProducts();


function clickSort(bool) {
  if (bool == true) {
    sortTable(getProducts());
  }
}

var products_;

function setProducts(product) {
  products_ = product;
}

function getProducts() {
  return products_;
}

function displayProducts() {
  var request = new XMLHttpRequest();
  request.onload = function () {
    if (request.status === 200) {
      //console.log(request.responseText);
      productInfo(request.responseText);
      setProducts(request.responseText);

    } else {
      console.log("Error communicating with server: " + request.status);
    }
  }
  request.open("GET", "display_products.php");
  request.send();
}

//<button onclick="addProduct('tank4')"><img class="itemL" src="images/20.gif"></button>
function productInfo(products) {
  var productList = JSON.parse(products);
  var holder = document.getElementById("itemHolder");
  for (var i = 0; i < productList.length; i++) {
    var valueHolder = document.createElement("div");
    valueHolder.setAttribute("class", "singleItem");
    valueHolder.setAttribute("id", productList[i].itemName);
    var button = document.createElement("button");
    button.setAttribute("onclick", "addProduct" + "(" + productList[i].itemName + ")");
    button.setAttribute("img", "images/20.gif");
    var picture = document.createElement("img");
    picture.setAttribute("class", "itemL");
    picture.setAttribute("src", "images/20.gif");
    var itmName = document.createElement("a");
    var itemPrice = document.createElement("a");
    var nameText = document.createTextNode(productList[i].itemName);
    var priceText = document.createTextNode(productList[i].price);
    itemPrice.appendChild(priceText);
    itmName.append(nameText);
    button.appendChild(picture);
    valueHolder.appendChild(button);
    valueHolder.appendChild(itmName);
    valueHolder.appendChild(itemPrice);
    holder.appendChild(valueHolder);
  }

  //sortTable();
}

function sortTable(products) {
  var i = 0;
  var a = 0;

  var productList = JSON.parse(products);

  while (a < productList.length - 1) { // Sort based on tagnames (swap image tags and a tags)s (extend) (bubble sort)
    while (i < productList.length - a - 1) {
      var t = i;
      var s = i + 1

      if (productList[i].price < productList[s].price) {
        var temp = productList[s].price;
        productList[i].price = productList[s].price;
        productList[s].price = temp;

        var temp2 = productList[s].itemName;
        productList[i].itemName = productList[i].itemName;
        productList[s].itemName = temp2;
      }
      i++;
    }
    a++;
  }

  var myNode = document.getElementById("itemHolder");
  while (myNode.firstChild) {
    myNode.removeChild(myNode.firstChild);
  }

  displaySortedList(productList);
}

function displaySortedList(productList) {
  var holder = document.getElementById("itemHolder");
  for (var i = 0; i < productList.length; i++) {
    var valueHolder = document.createElement("div");
    valueHolder.setAttribute("class", "singleItem");
    valueHolder.setAttribute("id", productList[i].itemName);
    var button = document.createElement("button");
    button.setAttribute("onclick", "addProduct" + "(" + productList[i].itemName + ")");
    button.setAttribute("img", "images/20.gif");
    var picture = document.createElement("img");
    picture.setAttribute("class", "itemL");
    picture.setAttribute("src", "images/20.gif");
    var itmName = document.createElement("a");
    var itemPrice = document.createElement("a");
    var nameText = document.createTextNode(productList[i].itemName);
    var priceText = document.createTextNode(productList[i].price);
    itemPrice.appendChild(priceText);
    itmName.append(nameText);
    button.appendChild(picture);
    valueHolder.appendChild(button);
    valueHolder.appendChild(itmName);
    valueHolder.appendChild(itemPrice);
    holder.appendChild(valueHolder);
  }
}

function searchIt() {

  var myNode = document.getElementById("itemHolder"); // first delete the current table
  while (myNode.firstChild) {
    myNode.removeChild(myNode.firstChild);
  }

  search(getProducts());

}


function search(products) { // Not fixed
  // Declare variables
  var holder = document.getElementById("itemHolder");
  var products = JSON.parse(products);
  input = document.getElementById('SearchBar'); // Get the value of input
  filter = input.value.toUpperCase(); // Filter

  for (i = 0; i < products.length; i++) {
    a = products[i].itemName; // get the item name and price
    b = products[i].price;
    txtValue = a;
    if (a.toUpperCase().indexOf(filter) > -1) { // Based on item name

      var valueHolder = document.createElement("div");
      valueHolder.setAttribute("class", "singleItem");
      valueHolder.setAttribute("id", a);
      var button = document.createElement("button");
      button.setAttribute("onclick", "addProduct" + "(" + a + ")");
      button.setAttribute("img", "images/20.gif");
      var picture = document.createElement("img");
      picture.setAttribute("class", "itemL");
      picture.setAttribute("src", "images/20.gif");
      var itmName = document.createElement("a");
      var itemPrice = document.createElement("a");
      var nameText = document.createTextNode(a);
      var priceText = document.createTextNode(b);
      itemPrice.appendChild(priceText);
      itmName.append(nameText);
      button.appendChild(picture);
      valueHolder.appendChild(button);
      valueHolder.appendChild(itmName);
      valueHolder.appendChild(itemPrice);
      holder.appendChild(valueHolder);

    } else {
      console.log("No match");
    }
  }
}