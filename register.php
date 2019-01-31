<?php

// Add customer details to database
$manager = new MongoDB\Driver\Manager(); // Set up mongo db client

//$username = $_POST['username']; // validate and add to database

//$password = $_POST['password'];

// Check if the passwords match before registering
if($_POST['password'] != $_POST['confirm-password']){  // Can be extended
    $error_message = 'Passwords should be same<br>'; 
    echo 'console.log(passwords do not match)';
}
else
{
    echo 'console.log(success)';
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    var_dump($username);
    
    $registerArray = ["username" => $username, "password" => $password];

    $db = $manager->ecommerce;
 
    //Select a collection 
    $collection = $db->customers;

//Add the new product to the database
$returnVal = $collection->insert($registerArray);
    
//Echo result back to user
if($returnVal['ok']==1){
    echo 'ok' ;
}
else {
    echo 'Error adding customer';
}

//Close the connection
$mongoClient->close();



}
?>