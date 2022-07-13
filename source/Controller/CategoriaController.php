<?php

namespace Source\Controller;

use Exception;
use Source\Dao\CategoriaDao;
use Source\Functions\JsonResponse;

/**
 * Description of CategoriaController
 *
 * @author Reginaldo
 */
class CategoriaController extends Controller {

    public function __construct() {
        parent::__construct(__DIR__ . "/../../view");
        if (!$this->session->has("usuarioLogado")) {
            redirect("/ops/401");
        }
    }

    public function index(): void {
        try {
            $nomeCategoria = filter_input(INPUT_GET, "nome_categoria", FILTER_SANITIZE_SPECIAL_CHARS);
            $categoriaDao = new CategoriaDao();

            $listaCategorias = $categoriaDao->select()
                    ->where("nome", "%{$nomeCategoria}%", "LIKE")
                    ->and("usuario_id", $this->session->usuarioLogado->id)
                    ->orderBy("nome")
                    ->fetch();
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
            if (isset($data["id"])) {
                $categoriaDao->addParam("id", $data["id"]);
            }
            $categoriaDao->addParam("usuario_id", $this->session->usuarioLogado->id);
            $categoriaDao->addParam("nome", $data["nome"]);
            $categoriaDao->addParam("data_criacao", date("Y-m-d H:i:s"));
            $categoriaDao->addParam("data_modificacao", date("Y-m-d H:i:s"));
            $categoriaDao->save();

            $listaCategorias = $categoriaDao->select()->orderBy("nome")->fetch();
            $render = $this->view->render("_includes/table-categorias", [
                "listaCategorias" => $listaCategorias
            ]);

            if ($data["id"] != "") {
                JsonResponse::contentJson(false, 200, "Categoria atualizada com sucesso!", "tableCategorias", $render);
            } else {
                JsonResponse::contentJson(false, 200, "Categoria cadastrada com sucesso!", "tableCategorias", $render);
            }
        } catch (Exception $e) {
            JsonResponse::contentJson(true, $e->getCode(), $e->getMessage());
        }
    }

    public function buscar(array $data): void {
        try {
            $id = $data["id"];
            $categoriaDao = new CategoriaDao();

            $categoriaObj = $categoriaDao->select()->where("id", $id)->fetch(true);
            $dados = [
                "categoriaId" => $categoriaObj->id,
                "categoriaNome" => $categoriaObj->nome
            ];
            JsonResponse::fields(false, 200, "", $dados);
        } catch (Exception $e) {
            JsonResponse::contentJson(true, $e->getCode(), $e->getMessage());
        }
    }

    public function excluir(array $data): void {
        try {
            $id = $data["id"];
            $categoriaDao = new CategoriaDao();
            $categoriaDao->addParam("id", $id);
            $categoriaDao->delete();

            $listaCategorias = $categoriaDao->select()->orderBy("nome")->fetch();
            $render = $this->view->render("_includes/table-categorias", [
                "listaCategorias" => $listaCategorias
            ]);

            JsonResponse::contentJson(false, 200, "Categoria excluída com sucesso!", "tableCategorias", $render);
        } catch (Exception $e) {
            JsonResponse::contentJson(true, $e->getCode(), $e->getMessage());
        }
    }

}
