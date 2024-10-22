<?php

include_once("conn.php");

// ver qual metodo esta vindo da requisição
$method = $_SERVER["REQUEST_METHOD"];
// resgate dos dados, montagem do pedido
if ($method == "GET") {
    $bordasQuery = $conn->query("SELECT * FROM bordas;");
    $bordas = $bordasQuery->fetchAll();

    $massasQuery = $conn->query("SELECT * FROM massas;");
    $massas = $massasQuery->fetchAll();

    $saboresQuery = $conn->query("SELECT * FROM sabores;");
    $sabores = $saboresQuery->fetchAll();// aqui a query é transferida para um array
    // print_r($sabores); exit;
// criação do pedido
} else if ($method == "POST") {
    $data = $_POST;

    $borda = $data["borda"];
    $massa = $data["massa"];
    $sabores = $data["sabores"];
    $nome_cliente = $data["nome_cliente"];

    // validação de valores maximos
    if (count($sabores) > 3) {
        $_SESSION["msg"] = "Selecione no máximo 3 sabores";
        $_SESSION["status"] = "warning";

    } else {
        // salvando borda e massa da pizza:
        $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)
        ");
        // filtrando inputs

        $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
        $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);
        $stmt->execute();
        // resgatando o ultimo id e a ultima pizza
        $pizzaid = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO pizza_sabor (pizzas_id, sabores_id) VALUES
        (:pizza, :sabor)");

        // repetição ate salvar todos os sabores
        foreach($sabores as $sabor) {
            // filtra inputs
            $stmt->bindParam(":pizza", $pizzaid, PDO::PARAM_INT);
            $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);

            $stmt->execute();
        }
        // criando pedido

        $stmt = $conn->prepare("INSERT INTO pedidos (nome_cliente, pizzas_id, status_id) VALUES
        (:nome_cliente, :pizza, :status)");

        $statusId = 1;

        $stmt->bindParam(":pizza", $pizzaid);
        $stmt->bindParam(":status", $statusId);
        $stmt->bindParam(":nome_cliente", $nome_cliente);

        $stmt->execute();

        $_SESSION["msg"] = "Pedido feito com Sucesso!";
        $_SESSION["status"] = "success";
    }
    header("Location: ..");
}