<div class="product-anymarket">
    <h2 class="title">Respostas da Anymarket</h2>
    <hr>
<?php

include 'Anymarket.php';

try {
    $respostas = Anymarket::response();    
} catch (Exception $e) {
    echo $e->getMessage();
}
//echo json_encode($respostas);

echo "<table>";
echo "<tr><th>ID WC</th><th>ID AM</th><th>Respostas</th><th>Data</th></tr>";
foreach($respostas as $item){
    echo "<tr><td>".$item->id_wc."</td><td>".$item->id_am."</td><td>".$item->content."</td><td>".$item->time."</td></tr>";
}
echo "</table>";


?>    
</div>



