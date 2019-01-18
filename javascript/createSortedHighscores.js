//takes users array as an argument and returns another array where all the user
//are sorted by their score
function sortUsers(users) {
  var usersSorted = users;
  for (var i = 0; i < usersSorted.length; i++) {
    for (var j = 0; j < (usersSorted.length - i - 1); j++) {
      if(usersSorted[j].score < usersSorted[j+1].score) {
          var tmp = usersSorted[j];
          usersSorted[j] = usersSorted[j+1];
          usersSorted[j+1] = tmp;
      }
    }
  }
  return usersSorted;
}

//checks if there is a logged in user within a sorted array
function returnActiveUser(sortedUsers) {
  var sortedLoggedIn = [false, null];
  for(var i = 0; i < users.length; i++) {
    if(sortUsers(users)[i].loggedIn == true) {
      sortedLoggedIn = [true, i];
    }
  }
  return sortedLoggedIn;
}

//takes sorted users array, creates html <li> tags and text tags within them
//to place users on the leaderboars according to their score
function createPosition(usersSorted) {
  if(usersSorted.length > 0) {
  for(let i = 0; i < usersSorted.length; i++) {
    //highlights a specific score and text value if a user is logged in
    if(returnActiveUser(usersSorted)[0] == true && returnActiveUser(usersSorted)[1] == i) {
      var nameHolder = document.createElement("a");
      var scoreHolder = document.createElement("a");
      var listItem = document.createElement("li");
      nameHolder.style.cssText = 'font-weight: bold; font-size: 20px; color: #ff7733;';
      scoreHolder.style.cssText = 'font-weight: bold; font-size: 20px; color: #ff7733;';
      listItem.style.cssText = 'font-weight: bold; font-size: 20px; color: #ff7733;';
    } else {
      var nameHolder = document.createElement("a");
      var scoreHolder = document.createElement("a");
      var listItem = document.createElement("li");
    }
    var list = document.getElementById("positions");
    var valueHolder = document.createElement("div");
    var scoreValue = document.createTextNode(usersSorted[i].score);
    var nameValue = document.createTextNode(usersSorted[i].name);
    var spacer = document.createElement("hr");
    nameHolder.appendChild(nameValue);
    scoreHolder.appendChild(scoreValue);
    valueHolder.appendChild(nameHolder);
    valueHolder.appendChild(scoreHolder);
    listItem.appendChild(valueHolder);
    list.appendChild(listItem);
    list.appendChild(spacer);
  }
  } else {
    // if no users have registered, text displaying that will be drawn
    var noUsersValue = document.createTextNode('No registered users yet');
    var noUsers = document.createElement("a");
    var container = document.getElementById("leaderboard");
    noUsers.appendChild(noUsersValue);
    container.appendChild(noUsers);
  }
}


createPosition(sortUsers(users));
