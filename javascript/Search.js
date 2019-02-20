

 var element = document.getElementById("tank1");
 var element2 = document.getElementById("tank2");
 var element3 = document.getElementById("tank3");
 var element4 = document.getElementById("tank4");

 var elementList = [element, element2, element3,
   element4];

counter = -1;

function search() {
  // Declare variables
  input = document.getElementById('SearchBar'); // Get the value of input
  filter = input.value.toUpperCase();
 
  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < elementList.length; i++) {
    a = elementList[i].getElementsByTagName("a")[0];
    b = elementList[i].getElementsByTagName("a")[1];
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

function sort(item, counter) { // Does not work, attempts to sort the elements after filtering it
  getName = item.getElementsByTagName("a")[0].innerHTML;
  getCost = item.getElementsByTagName("a")[1].innerHTML;

  elementList[counter].getElementsByTagName("a")[0].innerHTML = getName;
  elementList[counter].getElementsByTagName("a")[1].innerHTML = getCost;

}