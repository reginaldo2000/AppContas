<?php

namespace Source\Controller;

use Exception;
use Source\Dao\ContaDao;
use Source\Dao\CategoriaDao;

/**
 * Description of ContaController
 *
 * @author Reginaldo
 */
class ContaController extends Controller {

    public function __construct() {
        parent::__construct(__DIR__ . "/../../view");
    }

    public function index(array $data): void {
        try {
            $descricao = filter_input(INPUT_GET, "descricao") ?? "";
            $dataInicial = filter_input(INPUT_GET, "data_inicial") ?? "";
            $dataFinal = filter_input(INPUT_GET, "data_final") ?? "";
            
            $contaDao = new ContaDao();
            $contaDao->select()->joinTable("categorias", "contas", ["id", "categoria_id"])
                    ->where("descricao", "%{$descricao}%", "LIKE");
            if ($dataInicial != "" && $dataFinal != "") {
                $contaDao->between("data_conta", [$dataInicial, $dataFinal], "AND");
            }
            $listaContas = $contaDao->orderBy("data_conta", "DESC")->fetch();
            
            $categoriaDao = new CategoriaDao();
            $listaCategorias = $categoriaDao->select()
                    ->where("usuario_id", $this->session->usuarioLogado->id)
                    ->orderBy("nome")->fetch();
            echo $this->view->render("conta", [
                "titulo" => "Contas",
                "listaCategorias" => $listaCategorias,
                "listaContas" => $listaContas,
                "descricao" => $descricao,
                "dataInicial" => $dataInicial,
                "dataFinal" => $dataFinal
            ]);
        } catch (Exception $e) {
            redirect("/ops/{$e->getCode()}");
        }
    }

}
