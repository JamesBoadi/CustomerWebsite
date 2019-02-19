<?php

//Reference to a functions.php file
include 'functions.php';


//Header and navigation bar functions from functions.php file
outputHeader("Tanks");
navBar("Login / Sign Up");
$manager = new MongoClient(); // Set up mongo db client

$db = $manager->selectDb("registration"); // select a database
$collection = $db->selectCollection("mycol"); // select a collection

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
if (!empty($_POST)) {

  if (isset($_POST["password"]) && isset($_POST["username"])) { 
    // Validation could be added here
    $registerArray = ["username" => $username, "password" => $password]; // Json format
    if(!empty($username) && !empty($password)) // Check if it is empty
    {
      $collection->insert($registerArray); // Insert
    }
    else
    {
      echo "<script>alert('All fields must be filled in');</script>";
    }
    
  } else {
    echo "<script>console.log('Both the username and password must be entered');</script>";
  }
  
  //Extract the data that was sent to the server
  if (isset($_POST["password_"]) ) {   // Get the data from log in
    $getUsername = filter_input(INPUT_GET, 'username_', FILTER_SANITIZE_STRING);
    $getPassword = filter_input(INPUT_GET, 'password_', FILTER_SANITIZE_STRING);
    
    //Create a PHP array with our search criteria
    $findCriteria = [
      $getUsername
    ];
  
    //Find all of the customers that match  this criteria
    $cursor = $db->selectCollection("mycol")->find($findCriteria);
  
      //Output the results
      foreach ($cursor as $cust) { // Check if password exists or not
          if($getPassword != $cust['password'] && empty($getPassword) )
          {
            echo "<script>alert('Password is incorrect');</script>";
          }
      }
    }
}

  



$manager->close();
// ----------------------------------------------------------------------https://stackoverflow.com/questions/24985684/mongodb-show-all-contents-from-all-collections

// Get data from database

?>
    <!-- Login and Register container -->
    <div id="LogRegContainer">

      <!-- Mini navigation bar with login and register tabs -->
      <ul id="minNav" class="nav_LR">
        <li><a id="Login" class="tablinks" onclick="selectTab(event, 'log')" >Login  </a></li>
        <li><a id="Register" class="tablinks" onclick="selectTab(event, 'reg')" >Sign Up</a></li>
      </ul>

      <!-- Content and input fields of the Login tab -->
      <form action="loginregister.php" method="POST"> <!-- Handle the LOGIN POST REQUEST HERE -->
      <div id="log" class="inputfield">
        <a>Username</a>
        <input id="usernameL" type="text" name="username_">
        <a>Password</a>
        <input id="passwordL" type="password" name="password_">
        <input id="logInButton" type="submit" onclick="logIn(users)" value="Log in"> <!-- Changes made to allow post request--> 
      </div>
      </form>

      <!-- Content and input fields of the Register tab -->
      <form action="loginregister.php" method="POST">
      <div id="reg" class="inputfield">
        <a>Username</a>
        <input id="usernameR" type="text" name="username">
        <a>Password</a>
        <input id="passwordR" type="password" name="password">
        <a>Repeat Password</a>
        <input id="passwordRrepeated" type="password" name="confirm-password">
        <input id="registerButton" type="submit" onclick="signUp(users)" value="Sign up">
      </div>
      </form>

      <div id="logedIn" class="inputfield">
        <a id="LoggedInAs"></a>
        <a id="playersHighscore"></a>
        <button type="button" onclick="logOut(users)">Log Out</button>
      </div>

      <!--Script for login and sign up functionality -->
      <script src="javascript/loginSignUp.js"></script>
    </div>


<?php

footer();

?>
