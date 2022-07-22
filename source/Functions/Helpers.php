<?php

/**
 * ##################################
 * ## FUNCOES GLOBAIS PARA STRINGS ##
 * ##################################
 */

/**
 * @param string $string
 * @return string
 */
function str_slug(string $string): string {
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["-----", "----", "---", "--"], "-",
            str_replace(" ", "-",
                    trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
            )
    );
    return $slug;
}

/**
 * @param string $string
 * @return string
 */
function str_studly_case(string $string): string {
    $string = str_slug($string);
    $studlyCase = str_replace(" ", "",
            mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE)
    );

    return $studlyCase;
}

/**
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string {
    $camelCase = lcfirst(str_studly_case($string));

    return $camelCase;
}

/**
 * @param string $string
 * @return string
 */
function str_title(string $string): string {
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * @param string $text
 * @return string
 */
function str_textarea(string $text): string {
    $text = filter_var($text, FILTER_SANITIZE_STRIPPED);
    $arrayReplace = ["&#10;", "&#10;&#10;", "&#10;&#10;&#10;", "&#10;&#10;&#10;&#10;", "&#10;&#10;&#10;&#10;&#10;"];
    return "<p>" . str_replace($arrayReplace, "</p><p>", $text) . "</p>";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = "..."): string {
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWord = explode(" ", $string);
    $numWords = count($arrWord);

    if ($numWords < $limit) {
        return $string;
    }

    $words = implode(" ", array_slice($arrWord, 0, $limit));

    return "{$words}{$pointer}";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = "..."): string {
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));

    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
    return "{$chars}{$pointer}";
}

/**
 * ################
 * ## VALIDACOES ##
 * ################
 */

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $passwd
 * @return bool
 */
function is_passwd(string $passwd): bool {
    if (password_get_info($passwd)['algo'] || mb_strlen($passwd) >= CONF_PASSWD_MIN_LEN && mb_strlen($passwd) <= CONF_PASSWD_MAX_LEN) {
        return true;
    }

    return false;
}

/**
 * @param string $passwd
 * @return string
 */
function passwd(string $passwd): string {
    if (!empty(password_get_info($passwd)['algo'])) {
        return $passwd;
    }

    return password_hash($passwd, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * @param string $passwd
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $passwd, string $hash): bool {
    return password_verify($passwd, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash): bool {
    return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * @param bool $dismissible
 */
function messageAlert(bool $dismissible = false): void {
    if ($msgTemp = session()->getMessageAlert()) {
        echo \Source\Functions\Message::messageAlert($msgTemp->message, $msgTemp->type, $msgTemp->icon, $dismissible);
    }
}

function messageAlertJson(): void {
    //echo \Source\Functions\Message::messageAlert($msgTemp->message, $msgTemp->type, $msgTemp->icon, $dismissible);
}

/**
 * @return string
 * @throws Exception
 */
function csrf_input(): string {
    $session = new \Source\Config\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'>";
}

/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool {
    $session = new \Source\Config\Session();
    if (empty($session->csrf_token) || empty($request['csrf']) || $request['csrf'] != $session->csrf_token) {
        return false;
    }

    return true;
}

/**
 * ##########
 * ## FORMATACOES ##
 * ##########
 */

/**
 * @param null|string $date
 * @param string $format
 * @return string
 * @throws Exception
 */
function date_fmt(?string $date = "now", string $format = "d/m/Y H\hi"): string {
    return (new DateTime($date))->format($format);
}

/**
 * @param null|string $date
 * @return string
 * @throws Exception
 */
function date_fmt_br(?string $date = "now"): string {
    return (new DateTime($date))->format(CONF_DATE_BR);
}

/**
 * @param null|string $date
 * @return string
 * @throws Exception
 */
function date_fmt_app(?string $date = "now"): string {
    return (new DateTime($date))->format(CONF_DATE_APP);
}

/**
 * @param float $value
 * @return string
 */
function format_price_brl(float $value): string {
    return number_format($value, 2, ',', '.');
}

/**
 * ##########
 * ## URLS ##
 * ##########
 */

/**
 * @param null|string $path
 * @return string
 */
function url(string $path = null): string {
    if (strpos($_SERVER['HTTP_HOST'], "172.16.1.105")) {
        if ($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return CONF_URL_TEST;
    }

    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE;
}

/**
 * @param string|null $path
 * @param string $theme
 * @return string
 */
function theme(string $path = null, string $theme = CONF_THEME_ADMINLTE): string {
    if (strpos($_SERVER['HTTP_HOST'], "localhost")) {
        if ($path) {
            return CONF_URL_TEST . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return CONF_URL_TEST . "/themes/{$theme}";
    }

    if ($path) {
        return CONF_URL_BASE . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE . "/themes/{$theme}";
}

/**
 * @return string
 */
function url_back(): string {
    return ($_SERVER["HTTP_REFERER"] ?? '');
}

/**
 * @param string $url
 */
function redirect(string $url): void {
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

/**
 * ################
 * ## INSTANCIAS ##
 * ################
 */

/**
 * @return \Source\Config\Session
 */
function session(): \Source\Config\Session {
    return new \Source\Config\Session();
}

/**
 * @return \source\Model\User|null
 */
function userLogado(): ?\source\Model\User {
    if (!session()->has("authUser")) {
        return null;
    }

    return \Source\DAO\UserDAO::getInstance()->findById(session()->authUser)->fetchObject(\source\Model\User::class);
}

/**
 * ##########
 * ## IMAGE ##
 * ##########
 */

/**
 * @param string $image
 * @param int $width
 * @param int|null $height
 * @return string
 */
function image(string $image, int $width, ?int $height = null): string {
    return url() . "/" . (new \Source\Functions\Thumb(CONF_IMAGE_CACHE, false))->make($image, $width, $height);
}

/**
 * ###############################
 * ## RESQUEST LIMIT AND REPEAT ##
 * ###############################
 */

/**
 * @param string $key
 * @param int $limit
 * @param int $seconds
 * @return bool
 */
function request_limit(string $key, int $limit = 5, int $seconds = 60): bool {
    $session = new \Source\Config\Session();
    if ($session->has($key) && $session->$key->time >= time() && $session->$key->requests < $limit) {
        $session->set($key, [
            "time" => time() + $seconds,
            "requests" => $session->$key->requests + 1
        ]);
        return false;
    }

    if ($session->has($key) && $session->$key->time >= time() && $session->$key->requests >= $limit) {
        return true;
    }

    $session->set($key, [
        "time" => time() + $seconds,
        "requests" => 1
    ]);

    return false;
}

/**
 * @param string $field
 * @param string $value
 * @return bool
 */
function request_repeat(string $field, string $value): bool {
    $session = new \Source\Core\Session();
    if ($session->has($field) && $session->$field == $value) {
        return true;
    }

    $session->set($field, $value);
    return false;
}

/**
 * @param string $nameBase
 * @return string
 */
function get_color_name(string $nameBase): string {
    $caractere = mb_strtolower(mb_substr($nameBase, 0, 1));
    switch ($caractere) {
        case "a": return "#363636";
        case "b": return "#4F4F4F";
        case "c": return "#6A5ACD";
        case "d": return "#836FFF";
        case "e": return "#6959CD";
        case "f": return "#483D8B";
        case "g": return "#191970";
        case "h": return "#000080";
        case "i": return "#0000CD";
        case "j": return "#0000FF";
        case "k": return "#6495ED";
        case "l": return "#4169E1";
        case "m": return "#4682B4";
        case "n": return "#708090";
        case "o": return "#008B8B";
        case "p": return "#008080";
        case "q": return "#5F9EA0";
        case "r": return "#3CB371";
        case "s": return "#006400";
        case "t": return "#808000";
        case "u": return "#8B4513";
        case "v": return "#7B68EE";
        case "w": return "#4B0082";
        case "x": return "#8B008B";
        case "y": return "#C71585";
        case "z": return "#DC143C";
        default : return "#000";
    }
}

function openAlertMessage(): void {
    if (session()->has("message_alert")) {
        $message = session()->message_alert;
        $icon = "";
        switch ($message->type) {
            case \Source\Functions\Message::MS_ALERT_SUCCESS : $icon = "<i class='fa fa-check-circle' aria-hidden='true'></i>";
                break;
            case \Source\Functions\Message::MS_ALERT_WARNING : $icon = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>";
                break;
            case \Source\Functions\Message::MS_ALERT_DANGER : $icon = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>";
                break;
            default : $icon = "<i class='fa fa-info-circle' aria-hidden='true'></i>";
        }
        echo "<div class='alert {$message->type} alert-dismissible fade show' role='alert'>"
        . "{$icon} {$message->message}"
        . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>"
        . "</div>";
        session()->unset("message_alert");
    }
}

function mesTraduzido(string $mes): string {
    switch($mes) {
        case "Jan": return "Janeiro";
        case "Feb": return "Fevereiro";
        case "Mar": return "Março";
        case "Apr": return "Abril";
        case "May": return "Maio";
        case "Jun": return "Junho";
        case "Jul": return "Julho";
        case "Aug": return "Agosto";
        case "Sep": return "Setembro";
        case "Oct": return "Outubro";
        case "Nov": return "Novembro";
        case "Dec": return "Dezembro";
        default: return "";
    }
}