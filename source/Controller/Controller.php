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

    /**
     * @param bool $error
     * @param int $code
     * @param string $message
     * @param string $content
     * @param bool $reset
     * @param string $element
     * @param array $fields
     */
    public function responseJson(bool $error, int $code, string $message, string $content = "", bool $reset = true, string $element = "content_response", ?array $fields = null): void {
        $response = [
            "error" => $error,
            "code" => $code,
            "message" => $message,
            "content" => $content,
            "reset" => $reset,
            "element" => $element,
            "fields" => $fields
        ];
        header("HTTP/1.0 {$code}");
        header("Content-Type: application/json");
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }

    public function head(string $title): string {
        return $this->seo->render($title, CONF_SITE_DESC, url(), "");
    }

}
