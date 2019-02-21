var element = document.getElementById("tank1");
var element2 = document.getElementById("tank2");
var element3 = document.getElementById("tank3");
var element4 = document.getElementById("tank4");
/*  var element5 = document.getElementById("tank5");
 var element6 = document.getElementById("tank6");
 var element7 = document.getElementById("tank7");
 var element8 = document.getElementById("tank8");*/

var elementList = [element, element2, element3,
  element4];//, element5, element6, element7, element8];

function sortTable() {

  var i = 0;
  var a = 0;
  var counter = 0;

  while (a < elementList.length - 1) { // Sort based on tagnames (swap image tags and a tags)s (extend) (bubble sort)
    while (i < elementList.length - a - 1) {
      var t = i;
      var s = i + 1
      var switch_ = false;

      var valOne = parseInt(elementList[t].getElementsByTagName("a")[1].innerText);
      var valTwo = parseInt(elementList[s].getElementsByTagName("a")[1].innerText); // Get the integer of the string of the innertext of tag a

      if (valOne > valTwo) {
        var temp = valTwo;
        elementList[t].getElementsByTagName("a")[1].innerHTML = temp;
        elementList[s].getElementsByTagName("a")[1].innerHTML = valOne;

        var temp2 = elementList[i + 1].getElementsByTagName("a")[0].innerHTML;
        elementList[i + 1].getElementsByTagName("a")[0].innerHTML = elementList[i].getElementsByTagName("a")[0].innerHTML;
        elementList[i].getElementsByTagName("a")[0].innerHTML = temp2;
      }
      i++;
    }
    a++;
  }
}

bool = true;
arr = [''];

function addProduct(id) {
  for (i = 0; i <= arr.length - 1; i++) {
    if (arr[i] != id) {
      this.bool = true;
    }
    else { this.bool = false; }
  }

  if (this.bool == true) {
    var product = document.getElementById(id);
    itemName = product.getElementsByTagName("a")[0].innerText;
    itemCost = product.getElementsByTagName("a")[1].innerText;

    var div = document.createElement('div');
    div.innerHTML = '<div class="singleItem">' + '<img class="itemL" src="images/20.gif">'
      + '<a>' + itemName + '</a>' + '<a>' + itemCost + '</a> </div>';
    document.getElementById("basket").appendChild(div);
    arr.push(id);
  }
  else
  {
    alert('You already selected this product');
  }
}

sortTable(); // only call upon clicking sort