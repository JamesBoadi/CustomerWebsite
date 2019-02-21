<?php
    //Start session management
    session_start();

    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $username= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    //Connect to MongoDB and select database
    $mongoClient = new MongoClient();
    $db = $mongoClient->ecommerce;

    //Create a PHP array with our search criteria
    $findCriteria = [
        "name" => $username,
     ];

    //Find all of the customers that match  this criteria
    $cursor = $db->users->find($findCriteria);

    //Check that there is exactly one customer
    if($cursor->count() == 0){
        echo 'Username not recognized.';
        return;
    }
    else if($cursor->count() > 1){
        echo 'Database error: Multiple customers have same Username.';
        return;
    }

    //Get customer
    $customer = $cursor->getNext();

    //Check password
    if($customer['password'] != $password){
        echo 'Password incorrect.';
        return;
    }

    //Start session for this user
    $_SESSION['loggedInUserName'] = $username;

    //Inform web page that login is successful
    echo 'ok';

    //Close the connection
    $mongoClient->close();
