<h2>AMCALLBACK</h2>
<?php
$content = json_encode($_GET);
include 'Anymarket.php';
Anymarket::registerdb($content);