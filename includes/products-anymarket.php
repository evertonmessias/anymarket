<?php

include 'Anymarket.php';

try {
    $products = Anymarket::products();
    echo json_encode($products);
} catch (Exception $e) {
    echo $e->getMessage();
}
