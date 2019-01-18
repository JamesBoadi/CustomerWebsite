<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Home");

?>

      <!-- Welcome page content -->
      <article id="infoField">

        <header>
          <h1>Welcome to Tanks</h1>
          <h2>How To Play</h2>
        </header>


        <ul>
          <li>Aim and shoot at the target using commands</li>
          <hr>
          <li>Destroy the target in order to earn points</li>
          <hr>
          <li>Target will decrease in size after every 5 successful hits</li>
          <hr>
          <li>Every 5th successful hit you will get 1 extra life point</li>
          <hr>
          <li>Dont forget to Sign Up to save your score</li>
          <hr>
          <li>Command list is provided at the bottom of the Play page</li>
        </ul>

        <h2>Have fun!</h2>

      </article>

<?php

  //Footer function from functions.php file
  footer();

?>
