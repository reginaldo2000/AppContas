<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\Controller")->group(null);
$route->get("/login", "LoginController:index");
$route->post("/logar", "LoginController:logar");

$route->get("/dashboard", "HomeController:index");

$route->get("/categoria", "CategoriaController:index");
$route->post("/categoria/cadastrar", "CategoriaController:salvar");
$route->get("/categoria/buscar/{id}", "CategoriaController:buscar");
$route->delete("/categoria/excluir", "CategoriaController:excluir");

$route->get("/conta", "ContaController:index");

$route->post("/teste", "CategoriaController:salvar");

$route->namespace("Source\Controller")->group("/ops");
$route->get("/{code}", "ErroController:erro");

$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}