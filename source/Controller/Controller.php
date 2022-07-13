<?php

namespace Source\Controller;

use Source\Config\Session;
use Source\Functions\Seo;
use Source\Functions\View;

/**
 * Class Controller
 * @author Yago Silva <yagosilvferreira@gmail.com>
 * @package Source\Controller
 */
abstract class Controller {

    /**
     * @var View $view
     */
    protected $view;

    /**
     * @var Seo $seo
     */
    protected $seo;

    /**
     * @var Session $session
     */
    protected $session;

    /**
     * @param string|null $pathToView
     */
    public function __construct(string $pathToView = null) {
        $this->view = new View($pathToView);
        $this->seo = new Seo();
        $this->session = new Session();
    }

    public function head(string $title): string {
        return $this->seo->render($title, CONF_SITE_DESC, url(), "");
    }

}
