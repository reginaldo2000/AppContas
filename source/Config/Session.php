<?php

namespace Source\Config;

/**
 * Class Session
 * @author Yago Silva <yagosilvferreira@gmail.com>
 * @package Source\Config
 */
class Session
{
    /**
     * Session contructor.
     */
    public function __construct()
    {
        if (!session_id()) {
            session_name(CONF_SITE_SESSION);
            session_start();
        }
        if(isset($_SESSION["time"])) {
            $dateNow = date("U");
            if(($dateNow - $_SESSION["time"]) > 1800) {
                session_destroy();
            }
        }
    }

    /**
     * @param mixed $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (!empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    /**
     * @param mixed $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return $this->has($name);
    }

    /**
     * @return object|null
     */
    public function all(): ?object
    {
        return (object)$_SESSION;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Session
     */
    public function set(string $key, $value): Session
    {
        $_SESSION[$key] = (is_array($value)) ? (object)$value : $value;
        return $this;
    }

    /**
     * @param string $key
     * @return Session
     */
    public function unset(string $key): Session
    {
        unset($_SESSION[$key]);
        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @return Session
     */
    public function regenerate(): Session
    {
        session_regenerate_id(true);
        return $this;
    }


    /**
     * @return Session
     */
    public function destroy(): Session
    {
        session_destroy();
        return $this;
    }

    /**
     * @param string $message
     * @param string $type
     * @param string $icon Examples: fa-ban, fa-check, fa-exclamation-triangle, fa-info
     * @return void
     */
    public function setMessageAlert(string $message, string $type, string $icon = ""): void
    {
        $this->set("message_alert", ["message" => $message, "type" => $type, "icon" => $icon]);
    }

    /**
     *
     * @return object|null
     */
    public function getMessageAlert(): ?object
    {
        if ($this->has("message_alert")) {
            $messageAlert = $this->message_alert;
            $this->unset("message_alert");
            return $messageAlert;
        }

        return null;
    }

    /**
     * @throws \Exception
     */
    public function csrf(): void
    {
        $_SESSION['csrf_token'] = base64_encode(random_bytes(20));
    }

}