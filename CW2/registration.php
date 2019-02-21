<?php

    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->users;
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $searchName = [
    "name" => $name,
    ];

    $cursor = $db->users->find($searchName);
    $exists = $cursor->count();

    if($name != "" && $password != "") {//Check query parameters
        //STORE REGISTRATION DATA IN MONGODB
        if($exists == 0) {
          $dataArray = [
            "name" => $name,
            "password" => $password,
            "points" => 1000
          ];

          //  $customerDataArray = json_decode($testCustomerData, true);
          //$collection->insert($dataArray);
          $returnVal = $collection->insert($dataArray);

          if($returnVal['ok']==1){
            //Output message confirming registration
            echo 'ok';
          } else {
            echo 'Error';
          }
      } else {
        echo 'Taken';
      }
    }
    else{//A query string parameter cannot be found
        echo 'Registration data missing';
    }

    $mongoClient->close();

?>
