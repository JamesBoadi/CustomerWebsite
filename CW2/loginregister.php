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
        <button id="logBtn" type="button" onclick="login()">Login</button>
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

      <div id="logedIn"  class="inputfield" >
          <div id=logoutField>
            <a id="LoggedInAs"></a>
            <button type="button" onclick="logout()">Log Out</button>
          </div>
      </div>
    </div>

    <div id="changeInfo" class="changeInfoStl">
      <h2>Change password</h2>
      <a>Current password</a>
      <input id="currentPassword" type="password">
      <a>New password</a>
      <input id="newPassword" type="password">
      <button id="changePassword" type="button" onclick="changePassword()">Confirm</button>
      <hr>
      <h2>Delete account (type in current password)</h2>
      <input id="passwordDelete" type="password">
      <button id="deleteAcc" type="button" onclick="deleteAccount()">Confirm</button>
    </div>

    <div id="purchaseHistory" class="purchaseHistoryStl">
      <h1>Purchase history</h1>
      <hr>
    </div>
      <!--Script for login and sign up functionality -->
    <script src="javascript/loginSignUp.js"></script>






<?php

  //Footer function from functions.php file
  footer();

?>
