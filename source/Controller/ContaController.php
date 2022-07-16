<?php

namespace Source\Controller;

use Exception;
use Source\Dao\ContaDao;
use Source\Dao\CategoriaDao;
use Source\Functions\JsonResponse;

/**
 * Description of ContaController
 *
 * @author Reginaldo
 */
class ContaController extends Controller {

    private ContaDao $contaDao;

    public function __construct() {
        parent::__construct(__DIR__ . "/../../view");
        $this->contaDao = new ContaDao();
    }

    public function index(): void {
        try {
            $dados = filter_input_array(INPUT_GET);
            $listaContas = $this->listacontas($dados);
            $categoriaDao = new CategoriaDao();
            $listaCategorias = $categoriaDao->select()
                            ->where("usuario_id", $this->session->usuarioLogado->id)
                            ->orderBy("nome")->fetch();
            echo $this->view->render("conta", [
                "titulo" => "Contas",
                "listaCategorias" => $listaCategorias,
                "listaContas" => $listaContas,
                "descricao" => $dados["descricao"] ?? "",
                "dataInicial" => $dados["data_inicial"] ?? "",
                "dataFinal" => $dados["data_final"] ?? ""
            ]);
        } catch (Exception $e) {
            redirect("/ops/{$e->getCode()}");
        }
    }

    public function formataValor(array $data): void {
        $valorDigitado = str_replace(",", "", str_replace(".", "", $data["valor"]));
        echo json_encode(["valorFormatado" => number_format($valorDigitado / 100, 2, ",", ".")]);
    }

    public function salvarConta(array $data): void {
        try {
            $parcelas = $data["parcelas"] != "" ?? 1;
            for ($i = 1; $i <= $parcelas; $i++) {
                $dataConta = new \DateTime($data["data_conta"]);
                $dataConta->setDate($dataConta->format("Y"), $dataConta->format("m") + $i, $dataConta->format("d"));

                $this->contaDao->addParam("id", $data["id"]);
                $this->contaDao->addParam("usuario_id", $this->session->usuarioLogado->id);
                $this->contaDao->addParam("categoria_id", $data["categoria"]);
                $this->contaDao->addParam("descricao", $data["descricao"]);
                $this->contaDao->addParam("valor", (str_replace(",", "", str_replace(".", "", $data["valor"])) / 100));
                $this->contaDao->addParam("data_criacao", date("Y-m-d H:i:s"));
                $this->contaDao->addParam("data_modificacao", date("Y-m-d H:i:s"));
                $this->contaDao->addParam("data_conta", $dataConta->format("Y-m-d"));
                $this->contaDao->save();
            }

            $renderTable = $this->view->render("_includes/table-contas", [
                "listaContas" => $this->listacontas([])
            ]);

            if ($data["id"] == "") {
                JsonResponse::contentJson(false, 200, "Conta cadastrada com sucesso!", "tableContas", $renderTable);
            } else {
                JsonResponse::contentJson(false, 200, "Conta atualizada com sucesso!", "tableContas", $renderTable);
            }
        } catch (Exception $e) {
            JsonResponse::contentJson(true, $e->getCode(), $e->getMessage());
        }
    }

    private function listacontas(array $data): array {
        $descricao = $data["descricao"] ?? "";
        $dataInicial = $data["data_inicial"] ?? "";
        $dataFinal = $data["data_final"] ?? "";

        $this->contaDao->select(["contas.*", "categorias.nome"])->joinTable("categorias", "contas", ["id", "categoria_id"])
                ->where("descricao", "%{$descricao}%", "LIKE");
        if ($dataInicial != "" && $dataFinal != "") {
            $this->contaDao->between("data_conta", [$dataInicial, $dataFinal], "AND");
        }
        return $this->contaDao->orderBy("categoria_id", "ASC")->fetch();
    }

    public function buscarConta(array $data): void {
        try {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            if (!$id) {
                throw new Exception("Formato do Id é inválido!", 400);
            }
            $contaObj = $this->contaDao->select()->where("id", $id)->fetch(true);
            if (!$contaObj) {
                throw new Exception("Nenhuma conta encontrada com o id correspondente!", 400);
            }
            JsonResponse::fields(false, 200, "", [
                "contaId" => $contaObj->id,
                "contaDescricao" => $contaObj->descricao,
                "contaCategoria" => $contaObj->categoria_id,
                "contaValor" => number_format($contaObj->valor, 2, ",", "."),
                "contaDataConta" => date("Y-m-d", strtotime($contaObj->data_conta))
            ]);
        } catch (Exception $e) {
            JsonResponse::fields(true, $e->getCode(), $e->getMessage(), []);
        }
    }

}
