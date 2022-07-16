<?php


namespace Source\Functions;

/**
 * Description of Response
 *
 * @author fcrs1808
 */
class JsonResponse {

    /**
     * @param int $erro
     * @param int $code
     * @param string $message
     * @param array $fields
     * @return void
     */
    public static function fields(bool $erro, int $code, string $message, array $fields): void {
        header("HTTP/1.0 {$code}");
        header("Content-Type: application/json");
        $array = [
            "erro" => $erro, 
            "code" => $code,
            "message" => $message,
            "data" => $fields
        ];
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * @param bool $erro
     * @param int $code
     * @param string $message
     * @param string $elemenId
     * @param string $content
     * @param bool $reset
     * @return void
     */
    public static function contentJson(bool $erro, int $code, string $message, string $elemenId = "", string $content = "", bool $reset = true): void {
        header("Content-Type: application/json");
        header("HTTP/1.0 {$code}");
        $array = [
            "erro" => $erro, 
            "code" => $code,
            "message" => $message,
            "data" => [
                "elementId" => $elemenId,
                "content" => $content,
                "reset" => $reset
            ]
        ];
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }

}
