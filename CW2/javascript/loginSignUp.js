
//var request = new XMLHttpRequest();
//Sign up function
function register(){
                //Create request object

                var request = new XMLHttpRequest();
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    //Check HTTP status code
                    if(request.status === 200){
                        //Get data from server
                        var responseData = request.responseText;

                        //Depending on response from the server alert will be shown and on successful registration user redirected to login
                        if(responseData === "Taken") {
                          alert("Username already taken");
                          selectTab(event, "reg");
                        } else if(responseData === "ok") {
                          alert("Successfuly registered");
                          document.getElementById("Login").click();
                        } else {
                          console.log(responseData);
                        }
                    }
                    else
                        console.log("Error communicating with server: " + request.status);
                };

                //Set up request with HTTP method and URL
                request.open("POST", "registration.php");
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                //Extract registration data
                var usernameR = document.getElementById("usernameR").value;
                var passwordR = document.getElementById("passwordR").value;
                var passwordRrepeated = document.getElementById("passwordR").value;

                //check if the information is correct
                if(usernameR != "" && passwordR != "" && passwordRrepeated != "" && passwordR == passwordRrepeated) {
                  if(usernameR.length <= 25 && passwordR.length >= 8 && passwordR.length <= 25) {
                      request.send("name=" + usernameR + "&password=" + passwordR);
                  }  else {
                     alert("Username and password can not exceed 25 characters. Password must be at least 8 character long");
                  }
                } else {
                  alert("Please check your details. All fields are required to be filled.");
                }
              }

//----------------------------------------------------------------------

 //var request = new XMLHttpRequest();

 function checkLogin() {

   var request = new XMLHttpRequest();
   request.onload = function() {
     console.log(request.responseText);
     if(request.responseText === "Not logged in.") {
       console.log(request.responseText);
       selectTab(event, 'log');
       document.getElementById("user").innerHTML = "Login / Sign Up";
     } else {
       var user = request.responseText;
       document.getElementById("user").innerHTML = user;
       selectTab(event, 'logedIn');
       document.getElementById("LoggedInAs").innerHTML = "Loged in as: " + user;
       displayProducts(user);
     }
   };

   request.open("GET", "check_login.php");
   request.send();
 }

 function login(){
                 //Create event handler that specifies what should happen when server responds
   var request = new XMLHttpRequest();
   request.onload = function(){
     //Check HTTP status code
     if(request.status === 200){
       //Get data from server
       var responseData = request.responseText;

       //Add data to page
       if(responseData === "ok"){
         selectTab(event, 'logedIn');
         document.getElementById("user").innerHTML = usernameL;
         checkLogin();

       } else {
         //document.getElementById("ErrorMessages").innerHTML = request.responseText;
         alert("Wrong username or password");
         console.log(responseData);
       }
     } else
         //document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
         alert("Error communicating with server");
     };

     //Extract login data
     var usernameL = document.getElementById("usernameL").value;
     var passwordL = document.getElementById("passwordL").value;

     //Set up and send request
     request.open("POST", "customer_login.php");
     request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     request.send("username=" + usernameL + "&password=" + passwordL);
    }


function logout(){
    //Create event handler that specifies what should happen when server responds
    var request = new XMLHttpRequest();
    request.onload = function(){
        checkLogin();
        window.location.reload();
    };
    //Set up and send request
    request.open("GET", "logout.php");
    request.send();
  }

function changePassword() {

    var request = new XMLHttpRequest();
    request.onload = function(){

      if(request.status === 200){

        //request.responseText;


        if(request.responseText === "ok"){
          alert("Password uccessfuly changed");

        } else {

          alert("Incorrect information");
          console.log(request.responseText);
        }
      } else

          alert("Error communicating with server");
        };

    //Extract login data
    var name = document.getElementById("user").innerHTML;
    console.log(name);
    var password = document.getElementById("currentPassword").value;
    var newPassword = document.getElementById("newPassword").value;

    //Set up and send request
    request.open("POST", "change_password.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("name=" + name + "&password=" + password + "&newPassword=" + newPassword);

}

function deleteAccount() {

    var request = new XMLHttpRequest();
    request.onload = function(){

      if(request.status === 200){

        //request.responseText;


        if(request.responseText === "ok"){
          logout();
          alert("Account successfuly deleted");

        } else {

          alert("Incorrect information");
          console.log(request.responseText);
        }
      } else

          alert("Error communicating with server");
        };

        //Extract login data
        var name = document.getElementById("user").innerHTML;
        console.log(name);
        var password = document.getElementById("passwordDelete").value;

        //Set up and send request
        request.open("POST", "delete_account.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("name=" + name + "&password=" + password);

}

function displayProducts(user) {

    var request = new XMLHttpRequest();
    request.onload = function(){

      if(request.status === 200) {

        //console.log(request.responseText);

        productInfo(request.responseText);
        //console.log(request.responseText);

      } else {

        console.log("Error communicating with server: " + request.status);
      }
    }

    request.open("POST", "get_history.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log("frm: " + user)
    request.send("name=" + user);
  }

  function productInfo(products) {

      var productList = JSON.parse(products);
      console.log(productList);
      //console.log(productList[0].price);

      var holder = document.getElementById("purchaseHistory");

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

//Sign up function
/*function logIn(users) {
  //Variables which comatin input values from Log In tab
  var usernameL = document.getElementById("usernameL").value;
  var passwordL = document.getElementById("passwordL").value;
  var existsWhere = [false, null];

  //checks if all fields have been filled
  if(usernameL != "" && passwordL != "") {
    //loop checking if there is a user for provided values
    for(let i = 0; i < users.length; i++) {
      if(usernameL == users[i].name && passwordL == users[i].password) {
        existsWhere = [true, i];
      }
    }

    //if user is found, changes users logged In status
    if(existsWhere[0]) {
      //sets users status to logged in and saves it to localStorage
      users[existsWhere[1]].loggedIn = true;
      localStorage.setItem("users", JSON.stringify(users));
      //displays user infirmation tab
      selectTab(event, "logedIn");
      document.getElementById("LoggedInAs").innerHTML = "Logged in as: " + users[existsWhere[1]].name;
      document.getElementById("playersHighscore").innerHTML = "Highest score: " + users[existsWhere[1]].score;
      existsWhere = [false, null];
      window.location.reload();
    } else {
      alert("Wrong information. Not registered? Sign Up!");
    }

  } else {
    alert("All fields are required to be filled.");
  }
}*/

//------------------------------------------------------------------------------

//log out function
/*function logOut(users) {
  //checks if user status is logged in
  if(loggedIn[0]) {
    //sets user status to not logged in and saves it to localStorage
    users[loggedIn[1]].loggedIn = false;
    localStorage.setItem("users", JSON.stringify(users));
    //displays log in page
    selectTab(event, 'log');
    loggedIn = [false, null];
    document.getElementById("Login").click();
    window.location.reload();

  } else {
    alert("Error");
  }
}
*/


//function selectTab for changing login, sign up and user information tabs
function selectTab(evt, tabTitle) {
  var inputfield, tablinks;
  evt = event || window.event;

  // Assingns variables to inputfield and tablink elements
  inputfield = document.getElementsByClassName("inputfield");
  tablinks = document.getElementsByClassName("tablinks");
  //navBar = document.getElementById("minNav");

  // Sets display property to none (invisible) of login and register content
  inputfield[0].style.display = "none";
  inputfield[1].style.display = "none";
  inputfield[2].style.display = "none";
  changeInfo.style.display = "none";
  purchaseHistory.style.display = "none";

  // removes class active from elements inside mini login signup navigation bar
  tablinks[0].className = tablinks[0].className.replace(" active", "");
  tablinks[1].className = tablinks[1].className.replace(" active", "");


  // Sets display property to grid in order to show content of selected tab
  if(tabTitle == "logedIn") {
    document.getElementById("minNav").style.display = "none";
    //Displays user information tab
    inputfield[0].style.display = "none";
    inputfield[1].style.display = "none";
    inputfield[2].style.display = "grid";
    changeInfo.style.display = "grid";
    purchaseHistory.style.display = "grid";
  } else {
    // adds class active to currently selected element
    document.getElementById("minNav").style.display = "inline-flex";
    evt.srcElement.className += " active";
  }

  document.getElementById(tabTitle).style.display = "grid";
}

// default content to display (Login)
document.getElementById("Login").click();
//checkStatus();

window.onload = checkLogin();
