<div class="product-anymarket">
    <h2 class="title">Produtos na Anymarket</h2>
    <hr>
<?php

include 'Anymarket.php';

try {
    $products = Anymarket::products();    
} catch (Exception $e) {
    echo $e->getMessage();
}
$products = json_decode($products);
$produtos = array();
$produto = array();
foreach($products as $prod1){
    $produtos[] = $prod1;
}
foreach($produtos[1] as $prod2){
    $produto[] = $prod2;
}
echo "<table>";
echo "<tr><th>Produto</th><th>SKU</th></tr>";
foreach($produto as $item){
    echo "<tr><td>".$item->title."</td><td>".$item->skus[0]->title."</td></tr>";
}
echo "</table>";

?>    
</div>



