<?php
if (!empty($_GET)) {
    include 'Anymarket.php';
    echo Anymarket::registerdb(json_encode($_GET));
}
if (!empty($_POST)) {
    include 'Anymarket.php';
    echo Anymarket::registerdb(json_encode($_POST));
}
