<?php

    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->users;
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $searchName = [
    "name" => $name,
    "password" => $password
    ];

    $searchHistory = [
      "boughtBy" => $name
    ];

    $cursor = $db->users->find($searchName);
    $resCount = $cursor->count();

    if($name != "" && $password != ""  && $resCount != 0) {

          $returnVal = $collection->remove($searchName);
          $removeFromHistory = $db->history->remove($searchHistory);

          if($returnVal['ok']==1 && $removeFromHistory['ok']==1){
            //Output message confirming registration
            echo 'ok';
          } else {
            echo 'Error';
          }

    }
    else{//A query string parameter cannot be found
        echo 'Unsuccessful';
        //echo $newPassword;
    }

    $mongoClient->close();

?>
