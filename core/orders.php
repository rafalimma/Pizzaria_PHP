<?php

include_once "conn.php";
$method = $_SERVER["REQUEST_METHOD"];

// se o metodo for GET:
if($method === "GET") {
    // resgata todos os pedidos com SELECT
    $pedidosQuery = $conn->query("SELECT * FROM pedidos;");
    $pedidos = $pedidosQuery->fetchAll();

    foreach($pedidos as $pedido) {
        $pizzas = [];
        // define um array para a pizza
        $pizza["id"] = $pedido["pizzas_id"];
        // resgatando a pizza
        $pizzaQuery = $conn->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");
        $pizzaQuery->bindParam(":pizza_id", $pizza["id"]);

        $pizzaQuery->execute();

        $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);
        // resgatando a borda
        $bordaQuery = $conn->prepare("SELECT * FROM bordas WHERE id = :borda_id");
        $bordaQuery->bindParam(":borda_id", $pizzaData["borda_id"]);

        $bordaQuery->execute();

        $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);
        $pizza["borda"] = $borda["tipo"];
        // tranzendo a massa
        $massaQuery = $conn->prepare("SELECT * FROM massas WHERE id = :massa_id");
        $massaQuery->bindParam(":massa_id", $pizzaData["massa_id"]);

        $massaQuery->execute();

        $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);
        $pizza["massa"] = $massa["tipo"];
        // trazendo sabores da pizza

        $saborQuery = $conn->prepare("SELECT * FROM pizza_sabor WHERE id = :pizza_id");
        $saborQuery->bindParam(":pizza_id", $pizza["id"]);

        $saborQuery->execute();

        $sabores = $saborQuery->fetchAll(PDO::FETCH_ASSOC);
        
        //nome dos sabores

        $saboresDaPizza = [];
        $saborIndivdQuery = $conn->prepare("SELECT * FROM sabores WHERE id = :sabor_id");

        foreach($sabores as $sabor) {
            $saborIndivdQuery->bindParam(":sabor_id", $sabor["sabores_id"]);

            $saborIndivdQuery->execute();

            $saborPizza = $saborIndivdQuery->fetch(PDO::FETCH_ASSOC);
            array_push($saboresDaPizza, $saborPizza["sabor"]);

        }

        $pizza["sabores"] = $saboresDaPizza;
        // adiciona status do pedido
        $pizza["status"] = $pedido["status_id"];

        // adicionar o array de pizza ao das pizzas
        array_push($pizzas, $pizza);
    }
    print_r($pizzas);
} else if($method === "POST") {

}

?>