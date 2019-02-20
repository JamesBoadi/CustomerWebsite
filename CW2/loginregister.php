<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Login / Sign Up");

?>

    <!-- Login and Register container -->
    <div id="LogRegContainer">

      <!-- Mini navigation bar with login and register tabs -->
      <ul id="minNav" class="nav_LR">
        <li><a id="Login" class="tablinks" onclick="selectTab(event, 'log')" >Login  </a></li>
        <li><a id="Register" class="tablinks" onclick="selectTab(event, 'reg')" >Sign Up</a></li>
      </ul>

      <!-- Content and input fields of the Login tab -->
      <div id="log" class="inputfield">
        <a>Username</a>
        <input id="usernameL" type="text" name="user">
        <a>Password</a>
        <input id="passwordL" type="password">
        <button id="logBtn" type="button" onclick="logIn(users)">Login</button>
      </div>

      <!-- Content and input fields of the Register tab -->
      <div id="reg" class="inputfield">
        <a>Username</a>
        <input id="usernameR" type="text" name="user">
        <a>Password</a>
        <input id="passwordR" type="password">
        <a>Repeat Password</a>
        <input id="passwordRrepeated" type="password">
        <button id="regBtn" type="button" onclick="register()">Sign Up</button>
      </div>

      <div id="logedIn" class="inputfield">
        <a id="LoggedInAs"></a>
        <a id="playersHighscore"></a>
        <button type="button" onclick="logOut(users)">Log Out</button>
      </div>

      <!--Script for login and sign up functionality -->
      <script src="javascript/loginSignUp.js"></script>

    </div>




<?php

  //Footer function from functions.php file
  footer();

?>
