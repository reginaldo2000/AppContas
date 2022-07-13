<?php

namespace Source\Controller;

use Exception;
use Source\Dao\CategoriaDao;
/**
 * Description of CategoriaController
 *
 * @author Reginaldo
 */
class CategoriaController extends Controller {

    public function __construct() {
        parent::__construct(__DIR__ . "/../../view");
    }

    public function index(): void {
        try {
            $nomeCategoria = filter_input(INPUT_GET, "nome_categoria", FILTER_SANITIZE_SPECIAL_CHARS);
            $categoriaDao = new CategoriaDao();
            
            $listaCategorias = $categoriaDao->select()->where("nome", "%{$nomeCategoria}%", "LIKE")->orderBy("nome")->fetch();
            echo $this->view->render("categoria", [
                "titulo" => "Categorias",
                "listaCategorias" => $listaCategorias,
                "nomeCategoria" => $nomeCategoria
            ]);
        } catch (Exception $e) {
            redirect("/ops/{$e->getCode()}");
        }
    }
    
    public function salvar(array $data): void {
        try {
            $categoriaDao = new CategoriaDao();
            $categoriaDao->addParam("id", $data["id"]);
            $categoriaDao->addParam("usuario_id", 1);
            $categoriaDao->addParam("nome", $data["nome"]);
            $categoriaDao->addParam("data_criacao", date("Y-m-d H:i:s"));
            $categoriaDao->addParam("data_modificacao", date("Y-m-d H:i:s"));
            $categoriaDao->save();
            echo $categoriaDao->lastInsertId();
        } catch (Exception $e) {
            redirect("/ops/{$e->getCode()}");
        }
    }

}
