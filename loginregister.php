<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Login / Sign Up");



// ----------------------------------------------------------------------

// Get data from database



  // Call validation when user tries to log in
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
        <input id="usernameL" type="text" name="username">
        <a>Password</a>
        <input id="passwordL" type="password" name="password">
        <input id="logInButton" type="submit" onclick="logIn(users)" value="Log in"> <!-- Changes made to allow post request--> 
      </div>
      </form>

      <!-- Content and input fields of the Register tab -->
      <form action="register.php" method="POST">
      <div id="reg" class="inputfield">
        <a>Username</a>
        <input id="usernameR" type="text" name="username">
        <a>Password</a>
        <input id="passwordR" type="password" name="password">
        <a>Repeat Password</a>
        <input id="passwordRrepeated" type="confirm-password">
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
