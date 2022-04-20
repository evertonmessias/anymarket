<h2>AMCALLBACK Register</h2>
<?php
if (!empty($_GET)) {
    include 'Anymarket.php';
    Anymarket::registerdb(json_encode($_GET));
}
if (!empty($_POST)) {
    include 'Anymarket.php';
    Anymarket::registerdb(json_encode($_POST));
}
