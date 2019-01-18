//--------------------------------------------
//Preparation for drawing on canvas and its size
var canvas = document.getElementById("mycanvas");
var ctx = canvas.getContext("2d");
var canHeight = ctx.canvas.height = 400;
var canWidth  = ctx.canvas.width  = 900;

//Command value list
var commandList = ["rotate", "fire", "start"];
//--------------------------------------------
//Object position variables
var currentTankY;
var currentTankX;
var currentProjectileX;
var currentProjectileY;
var currentTargetX;
var currentTargetY;
//---------------------------------------------
//Object sizes and physics variables
var targetRadius = 30;
var projectileRadius = 3;
var rotate = -25;
var speed = 0;
var fired = false;
var missed = false;
var gravity = 0.1;
//--------------------------------------------
//variable for projectile object
var p;
//---------------------------------------------
//start and gameOver variables and in-game performance variables
var gameStarted = false;
var gameOver    = false;
var score = 0;
var lives = 5;

//Geberates a random integer for X coordinate
function randomIntX() {
  return Math.floor(Math.random() * (canWidth - 250 - targetRadius + 1) + 250);
}

//Geberates a random integer for Y coordinate
function randomIntY() {
  return Math.floor(Math.random() * (250 - targetRadius + 1) + targetRadius);
}

//Draws a map
function map() {
  //canvas background
  ctx.fillStyle = "#202020";
  ctx.fillRect(0, 0, canWidth, canHeight);
  //ground background
  ctx.fillStyle = "#000000";
  ctx.fillRect(0, canHeight - 70, canWidth, canHeight);
  }

//Function for calculating distance between 2 objects
function distance(xP, yP, xTarg, yTarg) {
  var distanceX = xTarg - xP;
  var distanceY = yTarg - yP;
  return Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));
  }

//------------------------------------------------------------------------------
//Function that checks what command has been typed in and if it is correct
function command() {
  var command = document.getElementById("commandline").value;
  var param = "";
  var paramVal = "";

  if(command != "") {

    //scans a command that has been typed in
    for(let i = 0; i < command.length; i++) {
      if(command.charAt(i) === " ") {
        break;
      } else {
        param += command.charAt(i);
      }
    }

    //scans the value that has been typed in with the command
    for(let j = param.length + 1; j < command.length; j++) {
      paramVal += command.charAt(j);
    }

    //checks if command is correct
    if(param == commandList[0]) {
      //command for rotating a gun
      if(parseInt(paramVal) >= 0 && parseInt(paramVal) <= 90) {
        rotate = parseInt(-paramVal);
      } else {
        alert("Rotation value must be a number from 0 to 90.");
      }
      //command for firing the gun and spawning a projectile
    } else if(param == commandList[1]) {
      if(!fired) {
        if(parseFloat(paramVal) >= 30 && parseFloat(paramVal) <= 100) {
          if(!gameOver) {
            fired = true;
            speed = parseFloat(paramVal) / 5;
            p = new projectile(speed);
          }
        } else {
          alert("Force value must be a number from 30 to 100.");
        }
      }
      //command to start a game
    } else if(param == commandList[2]) {
      gameStarted = false;
      gameStarted = true;
      gameOver    = false;
      score = 0;
      livesLeft = new displayLives(lives);
      scoreText = new displayScore(score);
    } else {
      alert("Incorect command, check command list below.");
    }

  } else {
    alert("No command given, check command list below.");
  }
  }



//--------------------------------------------------------------------------------
//Tanks body size variables
var tankHeight = 12;
var tankWidth  = 40;
//Tanks gun size variables
var gunLength = 27;
var gunWidth  = 3;
//Tank turret size variables
var turretWidth  = 26;
var turretHeight = 10;

//Tank object
function tank(x, y, dy) {
  this.x = x;
  this.y = y;
  this.dy = dy;

  //updates position of a tank and redraws it
  this.update = function() {
    if (this.y < canHeight - 70 - tankHeight) {
      this.dy += gravity;
      this.y += this.dy;
    } else {
      this.y = canHeight - 70 - tankHeight;
    }
    this.draw();
    this.returnXY();
  }

  //return current tank position
  this.returnXY = function() {
    currentX = this.x;
    currentY = this.y;
  }

  //draw a tank on convas
  this.draw = function() {
    //draw tank body
    ctx.fillStyle = "#339933";
    ctx.fillRect(this.x, this.y, tankWidth, tankHeight);
    //draw gun
    ctx.save();
    ctx.translate(this.x + tankWidth / 2, this.y);
    ctx.rotate(rotate * Math.PI / 180);
    ctx.fillStyle = "#f441d9";
    ctx.fillRect(0, 0 - gunWidth, gunLength, gunWidth);
    ctx.restore();
    //draw turret
    ctx.fillStyle = "#006600";
    ctx.fillRect(this.x + tankWidth / 2 - (turretWidth / 2), this.y - turretHeight, turretWidth, turretHeight);
    }
  }

//projectile object
function projectile(vel) {
  var x;
  var y;
  var dx = vel * Math.cos(-rotate * Math.PI / 180);
  var dy = vel * Math.sin(-rotate * Math.PI / 180);
  var t = 1;

  //returns current projectile position
  this.returnXY = function() {
    currentProjectileX = x;
    currentProjectileY = y;
  }

  //updates position of a projectile and redraws it
  this.update = function() {
    if(fired != false) {
      var calcDx = currentX + (tankWidth / 2) + dx * t;
      t += 0.5;
      x = calcDx;
      y = (canHeight - 70 - 10) - (dy * t - (gravity / 2) * t * t);
      this.draw();
      this.returnXY();
      if(x > canWidth || x < 0 || y > canHeight - 70) {
        fired = false;
        speed = 0;
        t = 1;
        missed = true;
      }
    }
  }

  //draws a projectile on convas
  this.draw = function() {
    ctx.beginPath();
    ctx.arc(x, y, projectileRadius, 0, Math.PI * 2, false);
    ctx.fillStyle = "white";
    ctx.fill();
    ctx.strokeStyle = "red";
    ctx.stroke();
    ctx.closePath();
  }
}

//target object
function target(radius) {
  var x = randomIntX();
  var y = randomIntY();

  //returns current position of a target
  this.returnXY = function() {
    currentTargetX = x;
    currentTargetY = y;
  }

  //redraws a target
  this.update = function() {
    this.draw();
    this.returnXY();
  }

  //draws a target on convas
  this.draw = function() {
    ctx.beginPath();
    ctx.arc(x, y, radius, 0, Math.PI * 2, false);
    ctx.fillStyle = "#ffffff";
    ctx.fill();
    ctx.strokeStyle = "red";
    ctx.stroke();
    ctx.closePath();
    ctx.beginPath();
    ctx.arc(x, y, radius - (radius * 30 / 100), 0, Math.PI * 2, false);
    ctx.fillStyle = "red";
    ctx.fill();
    ctx.closePath();
    ctx.beginPath();
    ctx.arc(x, y, radius - (radius * 60 / 100), 0, Math.PI * 2, false);
    ctx.fillStyle = "#ffffff";
    ctx.fill();
    ctx.closePath();
    ctx.beginPath();
    ctx.arc(x, y, radius - (radius * 90 / 100), 0, Math.PI * 2, false);
    ctx.fillStyle = "red";
    ctx.fill();
    ctx.closePath();
  }
}

//score container object
function displayScore(score) {
  this.score = score;

  //redraws a score
  this.update = function() {
    this.draw();
  }

  //draws a score on canvas
  this.draw = function() {
    ctx.fillStyle = "white";
    ctx.font = "bold 20px Arial";
    ctx.fillText(("Score: " + this.score), 15, 25);
  }
}

//lives container object
function displayLives(lives) {
  this.lives = lives;

  //redraws updates lives amount
  this.update = function() {
    this.draw();
  }

  //draws lives container
  this.draw = function() {
    ctx.fillStyle = "white";
    ctx.font = "bold 20px Arial";
    ctx.fillText(("Lives: " + this.lives), canWidth - (90 + (("" + lives).length * 10)), 25);
  }
}


//------------------------------------------------------------------------------
//saves users score to local storage
function saveUserScore() {
  if(loggedIn[0]) {
    if(users[loggedIn[1]].score < score) {
      users[loggedIn[1]].score = score;
      localStorage.setItem("users", JSON.stringify(users));
    }
  }
}

//calculates and updates lives and score, checks if objects have collided,
//updates position of objects on collision
function score_lives(cPX, cPY, cTX, cTY) {
  if(speed != 0 && fired) {
    p.update();
    if(distance(cPX, cPY, cTX, cTY) < projectileRadius + targetRadius) {
      speed = 0; fired = false;
      targ = new target(targetRadius);
      score += 1;
      scoreText = new displayScore(score);
      saveUserScore();
      if(score % 10 === 0) {
        lives += 1;
        livesLeft = new displayLives(lives);
      } else if(score % 5 === 0) {
        targetRadius *= 0.9;
        targ = new target(targetRadius);
      }
    } else if(missed == true) {
      lives -= 1;
      livesLeft = new displayLives(lives);
      missed = false;
      if(lives == 0) {
        gameOver = true;
        gameStarted = false;
      }
    }
  }
  }

//creates objects with initial values
var tank      = new tank(100, 100, 1);
var targ      = new target(targetRadius);
var scoreText = new displayScore(score);
var livesLeft = new displayLives(lives);

//recursive function which updates and redraws the canvas
loop = function() {
  map();
  //main game
  if(gameStarted) {
    tank.update();
    targ.update();
    scoreText.update();
    livesLeft.update();
    score_lives(currentProjectileX, currentProjectileY, currentTargetX, currentTargetY);
    //game over screen after life count reaches 0
  } else if(gameOver) {
       ctx.fillStyle = "white";
       ctx.font = "bold 20px Arial";
       ctx.fillText(("Game Over"), (canWidth / 2) - 60, 170);
       ctx.fillText(("Your score: " + score), (canWidth / 2) - (70 + (("" + score).length * 10) / 2), 195);
       lives = 5;
       rotate = -25;
       targ = new target(targetRadius);
    //start game screen
  } else {
      ctx.fillStyle = "white";
      ctx.font = "bold 20px Arial";
      ctx.fillText(("Type start to play"), (canWidth / 2) - (200 / 2), 190);
  }

  window.requestAnimationFrame(loop);
}

//listener for enter button click, on click executes a command in the commandline
commandline.addEventListener("keyup", function (event) {
  if(event.keyCode === 13) {
    document.getElementById("commandBtn").click();
    document.getElementById("commandline").value = "";
  }
});


window.requestAnimationFrame(loop);
