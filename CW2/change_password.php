<?php

    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->users;
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);

    $searchName = [
    "name" => $name,
    "password" => $password
    ];

    $cursor = $db->users->find($searchName);
    $resCount = $cursor->count();

    if($name != "" && $password != "" && $newPassword != "" && $resCount != 0) {//Check query parameters
        //STORE REGISTRATION DATA IN MONGODB

          $updateArray = [
            "password" => $newPassword
          ];

          //  $customerDataArray = json_decode($testCustomerData, true);
          //$collection->insert($dataArray);
          $returnVal = $collection->update($searchName, array('$set'=>$updateArray));

          if($returnVal['ok']==1){
            //Output message confirming registration
            echo 'ok';
          } else {
            echo 'Error';
          }

    }
    else{//A query string parameter cannot be found
        echo 'Registration data missing';
        //echo $newPassword;
    }

    $mongoClient->close();

?>
