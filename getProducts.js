window.onload = displayProducts();


function clickSort(bool) {
  if(bool == true)
  {
    sortTable(getProducts());
  }
}

var products_;

function setProducts(product)
{
products_ = product;
}

function getProducts()
{

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




function search() { // Not fixed
  // Declare variables
  input = document.getElementById('SearchBar'); // Get the value of input
  filter = input.value.toUpperCase();
  var holder = document.getElementById("itemHolder");
 
  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < getProducts().length; i++) {
    a = holder[i].getElementsByTagName("a")[0];
    b = holder[i].getElementsByTagName("a")[1];
    txtValue = a.innerHTML;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a.style.display = ''; // Remove (Hide the elements)
      b.style.display = '';
    } else {
      
      a.style.display = 'none'; // Remove (Hide the elements)
      b.style.display = 'none';
    }
  }
}