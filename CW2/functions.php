<?php

//HTML head and head elements

function outputHeader($title) {

  echo '<!DOCTYPE html>';
  echo  '<html lang="en">';
  echo    '<head>';
  echo      '<meta charset="UTF-8">';
  echo      '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
  echo      '<title>' . $title . '</title>';
  echo      '<link rel="stylesheet" type="text/css" href="css/styles.css">';
  echo    '</head>';
  echo    '<body>';
}

//Sets a body content container and generates main navigation bar

function navBar($pageName) {

  $linkNames = array("Login / Sign Up", "Highscores", "Market", "Play", "Home");
  $idNames = array("login_Area", "highscores_Area", "market_Area", "play_Area", "index_Area");
  $ids = array("user", "none", "none", "none", "none");

  //Assigns id names to specify css grid area of each page

  for($n = 0; $n < count($linkNames); $n++) {
    if($pageName == $linkNames[$n]) {
      echo '<div id="' . $idNames[$n] . '">';
    }
  }
  echo      '<nav class="navBar">';
  echo        '<a id="logoArea" href="index.php"><img href="index.php" id="logo" src="images/LogoText.png"></a>';
  echo        '<menu class="navLinks">';

  //Sets class="active" for selected page

  $linkAddresses = array("loginregister.php", "highscore.php",  "market.php", "play.php", "index.php");

  for($x = 0; $x < count($linkNames); $x++) {
    echo '<li><a id="'. $ids[$x] .'" ';
    if($linkNames[$x] == $pageName) {
      echo 'class="active"';
    }
    echo 'href="' . $linkAddresses[$x] . '">' . $linkNames[$x] . '</a></li>';
  }
  echo        '</menu>';
  echo      '</nav>';
  //checkLocalStorage script is being called on every page to check if there is
  //a local storage item "users" if not creates a new one.
  //checks if there is a user that is logged in
  echo      '<script src="javascript/checkLocalStorage.js"></script>';
}

//HTML and body closing tags and footer

function footer() {
  echo      '<footer class="footer">';
  echo        '<a href="https://www.mdx.ac.uk/" target="_blank">';
  echo          '<img src="images/mdxlogo.png">';
  echo          '<a href="https://www.mdx.ac.uk/" target="_blank">Middlesex<br>University<br>London</a>';
  echo        '</a>';
  echo      '</footer>';
  echo    '</div>';
  echo  '</body>';
  echo '</html>';
}
?>
