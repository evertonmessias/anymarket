<?php
if (!empty($_POST) || !empty($_GET)) {
    include 'Anymarket.php';
    header("Access-Control-Allow-Origin: *");
    header('Cache-Control: no-cache, must-revalidate');
    header("Content-Type: text/plain; charset=UTF-8");
    header("HTTP/1.1 200 OK");
    $dados = json_decode(file_get_contents("php://input"));

    if ($dados->type == "ORDER") {

        $order_id = $dados->content->id;

        $saida = json_decode(Anymarket::orders($order_id));

        $id = substr($saida->marketPlaceNumber, 4);

        $status = $saida->status;

        $tab_status = array(
            'PAID_WAITING_SHIP' => 'pending',
            'CANCELED' => 'cancelled'
        );

        $order = wc_get_order($id);

        $result = $order->update_status($tab_status[$status]);

        if ($result == 1) {
            echo Anymarket::registerdb("Update Anymarket; id: " . $id . " , " . $status);
        }
    }
}
