
//Sign up function
function signUp(users) {
  //Variables which comatin input values from Sign Up tab
  var usernameR = document.getElementById("usernameR").value;
  var passwordR = document.getElementById("passwordR").value;
  var passwordRR = document.getElementById("passwordRrepeated").value
  var exists = false;

  //checks if all fields have been filled and passwords matches
  if(usernameR != "" && passwordR != "" && passwordRR != "" && passwordR == passwordRR) {
    if(usernameR.length <= 25 && passwordR.length >= 8 && passwordR.length <= 25) {
      //loop checking if there is a user with the same name
      for(let i = 0; i < users.length; i++) {
        if(users[i].name == usernameR) {
          exists = true;
        }
      }

      //adds new user to the local Storage. If there is a user with the same name,
      //displays an alert
      if(exists) {
        alert("User with this name already exists, try a different one.");
      } else {
        //adds user object to the users array
        users.push({ name: usernameR, password: passwordR, score: 0, loggedIn: false });
        //saves the updated users array to local storage
        localStorage.setItem("users", JSON.stringify(users));
        alert("Successfully registered, you can now log in.");
        //clicks a login tab to make it active
        window.location.reload();
        //document.getElementById("Login").click();
        exists = false;
      }
    } else {
      alert("Username and password can not exceed 25 characters. Password must be at least 8 character long");
    }
  } else {
    alert("Please check your details. All fields are required to be filled.");
  }
}

//----------------------------------------------------------------------

//Sign up function
function logIn(users) {
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
}

//------------------------------------------------------------------------------

//log out function
function logOut(users) {
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
  } else {
    // adds class active to currently selected element
    document.getElementById("minNav").style.display = "inline-flex";
    evt.srcElement.className += " active";
  }

  document.getElementById(tabTitle).style.display = "grid";
}

// default content to display (Login)
document.getElementById("Login").click();
checkStatus();
