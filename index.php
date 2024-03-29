<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\Controller")->group(null);
$route->get("/", function(){
    redirect("/login");
});
$route->get("/login", "LoginController:index");
$route->post("/logar", "LoginController:logar");

$route->get("/dashboard", "HomeController:index");
$route->get("/grafico/meses", "HomeController:graficoGastoMes");
$route->get("/grafico/categorias", "HomeController:graficoContasCategoria");
$route->get("/grafico/gasto-saldo", "HomeController:graficoGastoSaldo");

$route->get("/categoria", "CategoriaController:index");
$route->get("/categoria/{id}", "CategoriaController:getCategoria");
$route->post("/categoria/cadastrar", "CategoriaController:salvar");
$route->get("/categoria/buscar/{id}", "CategoriaController:buscar");
$route->delete("/categoria/excluir", "CategoriaController:excluir");

$route->get("/conta", "ContaController:index");
$route->get("/conta/formatar-valor/{valor}", "ContaController:formataValor");
$route->post("/conta/cadastrar", "ContaController:salvarConta");
$route->get("/conta/buscar/{id}", "ContaController:buscarConta");
//$route->

$route->get("/teste", "HomeController:graficoGastoSaldo");

$route->namespace("Source\Controller")->group("/ops");
$route->get("/{code}", "ErroController:erro");

$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}