<?php

include_once("conn.php");
$method = $_SERVER["RESQUEST_METHOD"];

if($method === "GET") {
    $pedidosQuery = $conn->query("SELECT * FROM pedidos;");
    $pedidos = $pedidosQuery->fetchAll();

    $pizzas = [];

    foreach($pedidos as $pedido) {
        $pizzas = [];

        $pizza["id"] = $pedido["pizza_id"];
    }
} else if($method === "POST") {

}

?>