<?php

    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->products;

    $cursor = $db->products->find();

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
