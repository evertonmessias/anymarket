<?php
if (isset($_GET['nid'])) {

    include 'Anymarket.php';
    
    $nid = $_GET['nid'];
    $order = wc_get_order($nid);

    if ($order != null && $nid != null) {       
        
        try {
            $create_order = Anymarket::alter(["status" => "INVOICED"],$nid);
            echo json_encode(Anymarket::registerdb($create_order));            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}