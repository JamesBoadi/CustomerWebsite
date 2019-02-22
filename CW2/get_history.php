<?php

    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->history;

    $username = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

    $findCriteria = [
        "boughtBy" => $username
     ];

    $cursor = $db->history->find($findCriteria);

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

?>
