<?php
if (!empty($_POST) || !empty($_GET)) {
    include 'Anymarket.php';
    header("Access-Control-Allow-Origin: *");
    header('Cache-Control: no-cache, must-revalidate');
    header("Content-Type: text/plain; charset=UTF-8");
    header("HTTP/1.1 200 OK");
    $dados = file_get_contents("php://input");
    $saida = array(
        "POST" => $_POST,
        "GET" => $_GET,
        "DADOS" => $dados
    );
    echo Anymarket::registerdb(json_encode($saida));
}
