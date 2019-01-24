<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Play");

?>

    <!-- Canvas and Command line within it -->
    <div id="canvasCmdCont">
      <canvas id="mycanvas"></canvas>
      <div id="cmdCont">
        <input id="commandline" onfocus="this.value=''" autofocus></input>
        <button id="commandBtn" onclick="command()">Execute</button>
      </div>
    </div>

    <script src="javascript/game.js"></script>

    <section id="commandlist">
      <h2>Command List</h2>
      <ul>
        <li><a>Start/Restart the game: start</a></li>
        <hr>
        <li><a>Adjust angle: rotate value (example: rotate 45), (0 <= value <= 90)</a></li>
        <hr>
        <li><a>Shoot a projectile: fire force (example: fire 50), (30 <= force <= 100)</a></li>
      </ul>
    </section>


<?php

  //Footer function from functions.php file
  footer();

?>
