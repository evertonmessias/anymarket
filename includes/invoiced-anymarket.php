<?php
if (isset($_GET['nid'])) {

    include 'Anymarket.php';
    
    $wcid = $_GET['nid'];
    $order = wc_get_order($wcid);

    $data = gmdate("Y\-m\-d\TH:i:s");
    

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
            $create_order = Anymarket::alter(["status" => "INVOICED", "invoice" => ["date" => "$data"]],$amid);
            echo json_encode(Anymarket::registerdb($wcid,$amid,$create_order));                   
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}