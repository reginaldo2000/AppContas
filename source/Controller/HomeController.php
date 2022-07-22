<?php

namespace Source\Controller;

use DateTime;
use Source\Dao\ContaDao;

/**
 * Description of HomeController
 *
 * @author Reginaldo
 */
class HomeController extends Controller
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
        $dataConta = new \DateTime(date("Y-m-d"));
        $dataConta->setDate($dataConta->format("Y"), $dataConta->format("m") + 1, $dataConta->format("d"));
        $listaContas = $this->contaDao->select()->where("data_conta", $dataConta->format("Y-m-t"), "<=")
            ->orderBy("id", "DESC")->limit(0, 8)->fetch();

        echo $this->view->render("home", [
            "titulo" => "Dashboard",
            "listaContas" => $listaContas
        ]);
    }

    public function graficoGastoMes(): void
    {
        $response = [];
        for ($i = 5; $i >= 0; $i--) {
            $dataInicio = new DateTime(date("Y") . "-" . (date("m") + 1) . "-01");
            $dataInicio->setDate($dataInicio->format("Y"), $dataInicio->format("m") - $i, $dataInicio->format("d"));

            $dataFim = new DateTime($dataInicio->format("Y-m-t"));

            $contasMes = $this->contaDao->select(["SUM(valor) as valor_total"])
                ->between("data_conta", [$dataInicio->format("Y-m-d"), $dataFim->format("Y-m-d")], "AND")
                ->fetch(true);

            $dados = [
                "x" => mesTraduzido($dataInicio->format("M")),
                "y" => ($contasMes->valor_total != null ? $contasMes->valor_total : 0)
            ];
            array_push($response, $dados);
        }
        echo json_encode(["data" => $response], JSON_UNESCAPED_UNICODE);
    }

    public function graficoContasCategoria(): void
    {
        $dataInicio = new DateTime(date("Y") . "-" . (date("m") + 1) . "-01");
        $dataFim = new DateTime(date("Y") . "-" . (date("m") + 1) . "-" . date("t"));

        $totalContasCategorias = $this->contaDao->select(["categorias.nome", "SUM(valor) as valor"])
            ->joinTable("categorias", "contas", ["id", "categoria_id"])
            ->between("data_conta", [$dataInicio->format("Y-m-d"), $dataFim->format("Y-m-d")], "AND")
            ->groupBy(["nome"], "categorias")->fetch();

        $data = [];
        $labels = [];
        foreach ($totalContasCategorias as $conta) {
            array_push($data, (float) $conta->valor);
            array_push($labels, $conta->nome);
        }
        echo json_encode(["data" => $data, "labels" => $labels], JSON_UNESCAPED_UNICODE);
    }

    public function graficoGastoSaldo(): void
    {
        $gasto = [];
        $saldo = [];
        $meses = [];
        for ($i = 2; $i >= 0; $i--) {
            $dataInicio = new DateTime(date("Y") . "-" . (date("m") + 1) . "-01");
            $dataInicio->setDate($dataInicio->format("Y"), $dataInicio->format("m") - $i, $dataInicio->format("d"));

            $dataFim = new DateTime($dataInicio->format("Y-m-t"));

            $contasMes = $this->contaDao->select(["SUM(valor) as valor_total"])
                ->between("data_conta", [$dataInicio->format("Y-m-d"), $dataFim->format("Y-m-d")], "AND")
                ->fetch(true);

            array_push($gasto, (float) $contasMes->valor_total);
            array_push($saldo, (2850 - $contasMes->valor_total));
            array_push($meses, mesTraduzido($dataInicio->format("M")));
        }
        echo json_encode(["gasto" => $gasto, "saldo" => $saldo, "meses" => $meses], JSON_UNESCAPED_UNICODE);
    }
}
