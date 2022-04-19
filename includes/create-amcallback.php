<h2>AMCALLBACK</h2>
<?php
if(!empty($_GET)){
include 'Anymarket.php';
Anymarket::registerdb(json_encode($_GET));
}