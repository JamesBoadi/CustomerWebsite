<?php

  //Reference to a functions.php file
  include 'functions.php';

  //Header and navigation bar functions from functions.php file
  outputHeader("Tanks");
  navBar("Highscores");

?>

    <!-- Leaderboard content -->
    <div id="leaderboard">
      <h1>Leaderboard</h1>
        <ol id="positions">
        </ol>
    </div>

    <script src="javascript/createSortedHighscores.js"></script>

<?php

  //Footer function from functions.php file
  footer();

?>
