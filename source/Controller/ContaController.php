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
class ContaController extends Controller
{

    private ContaDao $contaDao;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../view");
        if (!$this->session->has("usuarioLogado")) {
            redirect("/ops/401");
        }

        $this->contaDao = new ContaDao();
    }

    public function index(): void
    {
        try {
            $dados = filter_input_array(INPUT_GET);
            $listaContas = $this->listacontas($dados);

            $categoriaDao = new CategoriaDao();
            $listaCategorias = $categoriaDao->select()
                ->where("usuario_id", $this->session->usuarioLogado->id)
                ->orderBy("nome")->fetch();

            $valorTotal = $this->calcularValorTotal($listaContas);

            echo $this->view->render("conta", [
                "titulo" => "Contas",
                "listaCategorias" => $listaCategorias,
                "listaContas" => $listaContas,
                "valorTotal" => $valorTotal,
                "categoria" => $dados["categoria"] ?? "",
                "dataInicial" => $dados["data_inicial"] ?? "",
                "dataFinal" => $dados["data_final"] ?? ""
            ]);
        } catch (Exception $e) {
            redirect("/ops/{$e->getCode()}");
        }
    }

    public function formataValor(array $data): void
    {
        $valorDigitado = str_replace(",", "", str_replace(".", "", $data["valor"]));
        echo json_encode(["valorFormatado" => number_format($valorDigitado / 100, 2, ",", ".")]);
    }

    public function salvarConta(array $data): void
    {
        try {
            $parcelas = $data["parcelas"] != "" ? $data["parcelas"] : 1;
            $valorConta = ((str_replace(",", "", str_replace(".", "", $data["valor"])) / 100) / $parcelas);

            for ($i = 1; $i <= $parcelas; $i++) {
                $dataConta = new \DateTime($data["data_conta"]);
                $dataConta->setDate($dataConta->format("Y"), $dataConta->format("m") + $i, $dataConta->format("d"));

                $this->contaDao->addParam("id", $data["id"]);
                $this->contaDao->addParam("usuario_id", $this->session->usuarioLogado->id);
                $this->contaDao->addParam("categoria_id", $data["categoria"]);
                $this->contaDao->addParam("descricao", $data["descricao"]);
                $this->contaDao->addParam("valor", $valorConta);
                $this->contaDao->addParam("data_criacao", date("Y-m-d H:i:s"));
                $this->contaDao->addParam("data_modificacao", date("Y-m-d H:i:s"));
                $this->contaDao->addParam("data_conta", $dataConta->format("Y-m-d"));
                $this->contaDao->save();
            }

            $listaContas = $this->listacontas([]);
            $valorTotal = $this->calcularValorTotal();

            $renderTable = $this->view->render("_includes/table-contas", [
                "listaContas" => $listaContas,
                "valorTotal" => $valorTotal
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

    private function listacontas(array $data): array
    {
        $categoria = $data["categoria"] ?? "";
        $dataInicial = $data["data_inicial"] ?? "";
        $dataFinal = $data["data_final"] ?? "";

        $this->contaDao->select(["contas.*", "categorias.nome"])->joinTable("categorias", "contas", ["id", "categoria_id"]);
        if($categoria != "") {
            $this->contaDao->where("categoria_id", $categoria);
        }
        if ($dataInicial != "" && $dataFinal != "") {
            $this->contaDao->between("data_conta", [$dataInicial, $dataFinal], "AND");
        }
        return $this->contaDao
            ->orderBy("categoria_id")
            ->orderBy("data_conta")
            ->fetch();
    }

    public function buscarConta(array $data): void
    {
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

    private function calcularValorTotal(): float
    {
        $mesAtual = intval(date("m"));
        $anoAtual = intval(date("Y"));
        $proximoMes = ($mesAtual < 12) ? $mesAtual + 1 : 1;
        $proximoAno = ($mesAtual < 12) ? $anoAtual : $anoAtual + 1;
        $dataInicial = "{$proximoAno}-{$proximoMes}-01";
        $dataFinal = "{$proximoAno}-{$proximoMes}-" . date("t");
        $lista = $this->contaDao->select()->between("data_conta", [$dataInicial, $dataFinal], "AND")->fetch();
        $valorTotal = 0.0;
        foreach ($lista as $obj) {
            $valorTotal = $valorTotal + $obj->valor;
        }
        return $valorTotal;
    }
}
