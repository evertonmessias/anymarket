<?php
if (isset($_GET['nid'])) {

    include 'Anymarket.php';
    
    $nid = $_GET['nid'];
    $order = wc_get_order($nid);

    if ($order != null && $nid != null) {

        $marketPlaceId = $order->get_id();
        $marketPlaceNumber = $order->get_id();
        $marketPlace = "ECOMMERCE";
        $createdAt = $order->get_date_created();
        $paymentDate = $order->get_date_paid();
        $transmissionStatus = "OK";
        $status = $order->get_status();
        $marketPlaceStatus = $order->get_status();
        $discount = $order->get_discount_total();
        $freight = 0;
        $interestValue = 0;
        $gross = $order->get_total();
        $total = $order->get_total();
        $shipping_city = $order->get_shipping_city();
        $shipping_state =  $order->get_shipping_state();
        $shipping_country =  $order->get_shipping_country();
        $shipping_address = $order->get_shipping_address_1();
        $shipping_number =  $order->get_shipping_address_1();
        $shipping_neighborhood = $order->get_shipping_address_2();
        $shipping_street = $order->get_shipping_address_2();
        $shipping_comment = $order->get_shipping_address_2();
        $shipping_zipCode =  $order->get_shipping_address_2();
        $billing_city = $order->get_billing_city();
        $billing_state =  $order->get_billing_state();
        $billing_country =  $order->get_billing_country();
        $billing_address = $order->get_billing_address_1();
        $billing_number =  $order->get_billing_address_1();
        $billing_neighborhood = $order->get_billing_address_2();
        $billing_street = $order->get_billing_address_2();
        $billing_comment = $order->get_billing_address_2();
        $billing_zipCode =  $order->get_billing_address_2();
        $buyer_name = $order->get_billing_first_name() . " " . $order->get_billing_last_name();
        $buyer_email = $order->get_billing_email();
        $array_buyer = array();
        foreach ($order->get_meta_data() as $buyer_data) {
            $array_buyer[] = $buyer_data->value;
        }
        $buyer_document = $array_buyer[1];
        $buyer_documentType = "CPF";
        $buyer_phone = $array_buyer[5];
        $buyer_documentNumberNormalized = $array_buyer[1];
        $payments_method = $order->get_payment_method_title();
        $payments_value = $order->get_total();
        $item_count = $order->get_item_count();
        $array_item = array();
        foreach ($order->get_items() as $item_data) {
            $array_item[] = $item_data;
        }
        $items_sku_title[] = array();
        $items_sku_partnerId[] = array();
        $items_amount[] = array();
        $items_unit[] = array();
        $items_gross[] = array();
        $items_total[] = array();
        $items_discount[] = array();
        for ($x = 0; $x < $item_count; $x++) {
            $items_sku_title[$x] = $array_item[$x]['name'];
            $items_sku_partnerId[$x] = wc_get_product($array_item[$x]['product_id'])->get_sku();
            $items_amount[$x] = $array_item[$x]['total'];
            $items_unit[$x] = $array_item[$x]['quantity'];
            $items_gross[$x] = $array_item[$x]['total'];
            $items_total[$x] = $array_item[$x]['total'];
            $items_discount[$x] = $array_item[$x]['total_tax'];
        }

        $arrayItens = array();
        for ($x = 0; $x < $item_count; $x++) {
            $arrayItens[$x] = [
                "sku" => [
                    "title" => "$items_sku_title[$x]",
                    "partnerId" => "$items_sku_partnerId[$x]"
                ],
                "amount" => $items_amount[$x],
                "unit" => $items_unit[$x],
                "gross" => $items_gross[$x],
                "total" => $items_total[$x],
                "discount" => $items_discount[$x]
            ];
        }

        try {
            $create_order = Anymarket::create(
                [
                    "marketPlaceId" => "1000$marketPlaceId",
                    "marketPlaceNumber" => "1000$marketPlaceId",
                    "marketPlace" => "$marketPlace",
                    "createdAt" =>  "$createdAt",
                    "paymentDate" => "$paymentDate",
                    "transmissionStatus" => "$transmissionStatus",
                    "status" => "PAID_WAITING_SHIP",
                    "marketPlaceStatus" => "$marketPlaceStatus",
                    "discount" => "$discount",
                    "freight" => "$freight",
                    "interestValue" => "$interestValue",
                    "gross" => "$gross",
                    "total" => "$item_count",
                    "shipping" => [
                        "city" => "$shipping_city",
                        "state" => "$shipping_state",
                        "country" => "$shipping_country",
                        "address" => "$shipping_address",
                        "number" => "$shipping_number",
                        "neighborhood" => "$shipping_neighborhood",
                        "street" => "$shipping_street",
                        "comment" => "$shipping_comment",
                        "zipCode" => "$shipping_zipCode"
                    ],
                    "billingAddress" => [
                        "city" => "$billing_city",
                        "state" => "$billing_state",
                        "country" => "$billing_country",
                        "number" => "$billing_number",
                        "neighborhood" => "$billing_neighborhood",
                        "street" => "$billing_street",
                        "comment" => "$billing_comment",
                        "zipCode" => "$billing_zipCode"
                    ],
                    "buyer" => [
                        "name" => "$buyer_name",
                        "email" => "$buyer_email",
                        "document" => "$buyer_document",
                        "documentType" => "$buyer_documentType",
                        "phone" => "$buyer_phone",
                        "documentNumberNormalized" => "$buyer_documentNumberNormalized"
                    ],
                    "payments" => [
                        [
                            "method" => "$payments_method",
                            "value" => "$payments_value"
                        ]
                    ],
                    "items" => $arrayItens
                ]
            );
            echo json_encode(Anymarket::registerdb($create_order));            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}