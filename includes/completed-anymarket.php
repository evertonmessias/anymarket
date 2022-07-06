<?php
if (isset($_GET['nid'])) {

    include 'Anymarket.php';
    
    $wcid = $_GET['nid'];

    sleep(5);

    $data = Anymarket::data();

    $order = wc_get_order($wcid);    

    try {
        $respostas = Anymarket::response();    
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $amid = "";
   
    foreach($respostas as $item){
        if($item->id_wc == $wcid){
            $amid = $item->id_am;
        }
    }    

    if ($order != null && $wcid != null && $amid != "") {
        
        try {
            $create_order = Anymarket::alter(["status" => "CONCLUDED", "tracking" => ["deliveredDate" => "$data"]],$amid);
            echo json_encode(Anymarket::registerdb($wcid,$amid,$create_order));                   
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}