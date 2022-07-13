<?php

namespace Source\Functions;

use ReflectionClass;

/**
 * Class Message
 * @author Yago Silva <yagosilvferreira@gmail.com>
 * @package Source\Functions
 */
class Message
{

    public const MS_ALERT_PRIMARY = "alert-primary";
    public const MS_ALERT_SECONDARY = "alert-secondary";
    public const MS_ALERT_SUCCESS = "alert-success";
    public const MS_ALERT_DANGER = "alert-danger";
    public const MS_ALERT_WARNING = "alert-warning";
    public const MS_ALERT_INFO = "alert-info";
    public const MS_ALERT_LIGHT = "alert-light";
    public const MS_ALERT_DARK = "alert-dark";

    /**
     *
     * @var string|null $message
     */
    private static ?string $message;

    /**
     *
     * @var string|null $errorType
     */
    private static ?string $messageType;

    /**
     * @param string $message
     * @param string $alertType
     * @param string $icon Examples: fa-ban, fa-check, fa-exclamation-triangle, fa-info
     * @param bool $dismissible
     * @return string
     */
    public static function messageAlert(
        string $message,
        string $alertType,
        string $icon = "",
        bool $dismissible = false
    ): string {
        $reflection = new ReflectionClass(__CLASS__);
        $alertTypes = $reflection->getConstants();
        $stringClassDismissible = ($dismissible) ? " alert-dismissible fade show" : "";
        $stringButtonDismissible = ($dismissible) ? "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>" : "";
        self::$message = self::filter($message);
        self::$messageType = (!empty($alertType) || in_array($alertType, $alertTypes) ? $alertType : "alert-light");
        self::$message = '<div class="alert ' . self::$messageType . $stringClassDismissible . '" role="alert">' . $stringButtonDismissible . (!empty($icon) ? "<i class='fas $icon'></i>&nbsp;&nbsp;" : "") . self::$message . '</div>';

        return self::$message;
    }

    public function messageJson(): string
    {
        return "";
    }

    /**
     * @param string $message
     * @return string
     */
    private static function filter(string $message): string
    {
        return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
