<?php
    //Start session management
    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->users;

    $username = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    //echo $username;
    $findCriteria = [
        "name" => $username
     ];

    $cursor = $db->users->find($findCriteria);


    $resCount = $cursor->count();
    $cntr = 0;

    echo '[';

    foreach ($cursor as $item) {
      echo json_encode($item);
      $cntr++;

      if($cntr != $resCount) {
        echo ',';
      }
    }

    echo ']';

    $mongoClient->close();
