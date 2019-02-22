<?php
    //Start session management
    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->products;

    $itemName = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    //echo $username;
    $findCriteria = [
        "itemName" => $itemName
     ];

    $cursor = $db->products->find($findCriteria);


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
