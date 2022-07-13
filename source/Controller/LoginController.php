<?php

namespace Source\Controller;

use Source\Dao\UsuarioDao;
use Exception;

/**
 * Description of LoginController
 *
 * @author Reginaldo
 */
class LoginController extends Controller {

    public function __construct() {
        parent::__construct(__DIR__ . "/../../view");
        $this->usuarioDao = new UsuarioDao();
    }

    public function index(): void {
        echo $this->view->render("login", []);
    }

    public function logar(array $data): void {
        try {
            $usuarioDao = new UsuarioDao();
            $usuarioObj = $usuarioDao->select()
                    ->where("usuario", $data["login_usuario"])
                    ->and("senha", md5($data["login_senha"]))
                    ->fetch(true);
            if (!$usuarioObj) {
                $this->session->setMessageAlert("Usuário ou senha incorretos!", "alert-warning");
                redirect("/login");
            }
            $this->session->setMessageAlert("Bem vindo {$usuarioObj->nome_completo}, faça bom proveito do sistema!", "alert-info");
            redirect("/dashboard");
        } catch (Exception $e) {
            
        }
    }

}
