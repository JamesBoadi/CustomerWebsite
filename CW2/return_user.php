<?php
    //Start session management
    session_start();

    if( array_key_exists("loggedInUserName", $_SESSION) ){

        echo $_SESSION['loggedInUserName'];
    }
    else{
        echo 'Not logged in.';
    }
