//this script is used within function.php file as part of the
//navigation bar function (navBar()), in order to get called on every page

//function that checks if local storage item users exists, and creates a new one
//or updates the users array with the one item from local storage
function getUsers() {
  if(localStorage.getItem("users") == null) {
      users = [];
      return users;
    } else {
      users = JSON.parse(localStorage.getItem("users"));
      return users;
    }
  }

//Variable that conatins user logged in status
var loggedIn = [false, null];

//checks if any user is logged in
function checkStatus() {

    var users = getUsers();
    // variable count is used to monitor how many users are loged in, if more than
    // one then it sets the loged in status of all users to false
    var count = 0;

    for(var k = 0; k < users.length; k++) {
      if(users[k].loggedIn == true) {
        loggedIn = [true, k];
        count += 1;
      }
    }
    //if user is logged in changes the login tab to user information tab
    if(loggedIn[0] && count == 1) {
      if(document.getElementById("LoggedInAs") != null && document.getElementById("playersHighscore") != null) {
        document.getElementById("LoggedInAs").innerHTML = "Logged in as: " + users[loggedIn[1]].name;
        document.getElementById("playersHighscore").innerHTML = "Highest score: " + users[loggedIn[1]].score;
        selectTab(event, 'logedIn');
      } else {
        //sets the login / sign up value inside the navigation bar to a users username
        document.getElementById("user").innerHTML = users[loggedIn[1]].name;
      }
    } else {
      for(var l = 0; l < users.length; l++) {
        users[l].loggedIn = false;
      }
    }
  }

  checkStatus();
