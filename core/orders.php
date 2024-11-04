<?php

include_once("conn.php");
$method = $_SERVER["RESQUEST_METHOD"];

if($method === "GET") {
    $pedidosQuery = $conn->query("SELECT * FROM pedidos;");
    $pedidos = $pedidosQuery->fetchAll();

    foreach($pedidos as $pedido) {
        $pizzas = [];

        $pizza["id"] = $pedido["pizza_id"];
        // resgatando a pizza
        $pizzaQuery = $conn->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");
        $pizzaQuery->bindParam(":pizza_id", $pizza["id"]);

        $pizzaQuery->execute();

        $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);
        // resgatando a borda
        $bordaQuery = $conn->prepare("SELECT * FROM bordas WHERE id = :borda_id");
        $bordaQuery->bindParam(":bordas_id", $pizzaData["bordas_id"]);

        $bordaQuery->execute();

        $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);
        $pizza["borda"] = $borda["tipo"];
        // tranzendo a massa
        $massaQuery = $conn->prepare("SELECT * FROM massas WHERE id = :massa_id");
        $massaQuery->bindParam(":massas_id", $pizzaData["massas_id"]);

        $massaQuery->execute();

        $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);
        $pizza["massa"] = $massa["tipo"];
        // trazendo sabores da pizza

        $saborQuery = $conn->prepare("SELECT * FROM pizza_sabor WHERE $pizza_id = :pizza_id");
        $saborQuery->bindParam(":pizza_id", $pizza["id"]);

        $saborQuery->execute();

        $sabor = $saborQuery->fetchAll(PDO::FETCH_ASSOC);
        
        //nome dos sabores

        $saboresDaPizza = [];
        $saborQuery = $conn->prepare("SELECT * FROM sabores WHERE id = :sabor_id");

        foreach($sabores as $sabor) {
            
        }
    }
} else if($method === "POST") {

}

?>