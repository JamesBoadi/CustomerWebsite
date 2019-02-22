<?php
    //Start session management
    $mongoClient = new MongoClient();

    $db = $mongoClient->ecommerce;

    $collection = $db->history;

    $userName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $bought = $_POST['basket'];

    $productArray = json_decode($bought, true);

    $total = 0;
    $balance = 0;
    for ($x = 0; $x < sizeof($productArray); $x++) {
        $total += $productArray[$x][0]['price'];
    }

    $searchName = [
      "name" => $userName
    ];

    $cursor = $db->users->find($searchName);

    foreach ($cursor as $item) {
      $balance = $item['points'];
    }


    if($total <= $balance) {

      $change = $balance - $total;

      $updateBalance = [
        "points" => $change
      ];

      for ($x = 0; $x < sizeof($productArray); $x++) {
        $submit = [
             "boughtBy" => $userName,
             "itemName" => $productArray[$x][0]['itemName'],
             "price" => $productArray[$x][0]['price']
          ];

        $cursor1 = $db->history->insert($submit);
      }

      $cursor2 = $db->users->update($searchName, array('$set'=>$updateBalance));

      echo 'ok';
      //$collection->update(array("title"=>"MongoDB"),
      //array('$set'=>array("title"=>"MongoDB Tutorial")));
    } else {
      echo 'Unsuccessful';
    }


    /*  $submit = [
          "boughtBy" => $userName,
          "itemName" => $productArray[$x][0]['itemName'],
          "price" => $productArray[$x][0]['price']
       ];

       //echo json_encode($submit);
      $cursor = $db->history->insert($submit);
    }*/
    //echo sizeof($productArray);
    //echo $val;


  //  $cursor = $db->products->find($findCriteria);
    //echo $username;
    //$findCriteria = [
    //    "itemName" => $itemName
    // ];

    //$cursor = $db->products->find($findCriteria);


    $mongoClient->close();
