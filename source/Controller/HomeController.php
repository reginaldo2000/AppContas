<?php

namespace Source\Controller;

/**
 * Description of HomeController
 *
 * @author Reginaldo
 */
class HomeController extends Controller {

    public function __construct() {
        parent::__construct(__DIR__ . "/../../view");
        if (!$this->session->has("usuarioLogado")) {
            redirect("/ops/401");
        }
    }

    public function index(): void {
        echo $this->view->render("home", [
            "titulo" => "Dashboard"
        ]);
    }

}
