<?php
    //Start session management
    session_start();

    if( array_key_exists("loggedInUserName", $_SESSION) ){
        echo $_SESSION;
    }
    else{
        echo 'Not logged in.';
    }
