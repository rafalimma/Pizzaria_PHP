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

    // validação de valores maximos
    if (count($sabores) > 3) {
        $_SESSION["msg"] = "Selecione no máximo 3 sabores";
        $_SESSION["status"] = "warning";

    } else {
        $_SESSION["msg"] = "Pedido feito com Sucesso!";
        $_SESSION["status"] = "success";
    }
    header("Location: ..");
}
?>