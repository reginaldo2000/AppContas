<?php

date_default_timezone_set("America/Sao_Paulo");
set_time_limit(120);

/**
 * PROJECT URLS
 */
define("CONF_URL_BASE", "http://localhost/AppContas");
define("CONF_URL_TEST", "http://localhost/AppContas");
define("CONF_URL_ADMIN", "/admin");
define("CONF_URL_ERROR", CONF_URL_BASE . "/404");

define("DB_HOST", "localhost");
define("DB_NAME", "sistema_contas");
define("DB_USER", "root");
define("DB_PASS", "");


/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");


/**
 *  VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../view");
define("CONF_VIEW_EXT", "php");
define("CONF_THEME_ADMINLTE", "adminlte");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * SITE
 */
define("CONF_SITE_NAME", "Admin Videos");
define("CONF_SITE_TITLE", "Admin Videos");
define("CONF_SITE_DESC", "Admin Videos");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "https://unicatolicaquixada.edu.br");
define("CONF_SITE_SESSION", "sistema_contas");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "@CTI");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@CTI");
define("CONF_SOCIAL_FACEBOOK_APP", "");
define("CONF_SOCIAL_FACEBOOK_PAGE", "CTI");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "CTI");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 32);
define("CONF_PASSWD_ALGO", PASSWORD_BCRYPT);
define("CONF_PASSWD_OPTIONS", ["cost" => 10]);

/**
 * EMAIL
 */
define("CONF_EMAIL_MAIL_SUPORT", "exemplo@gmail.com");
define("CONF_PASSWORD_MAIL_SUPORT", "");
define("CONF_SMTP_SECURE_MAIL_SUPORTE", "tls");
define("CONF_HOST_MAIL_SUPORTE", "smtp.gmail.com");
define("CONF_PORT_MAIL_SUPORTE", 587);
define("CONF_SMTP_AUTH_MAIL_SUPORTE", true);
define("CONF_FROM_EMAIL_MAIL_SUPORTE", "exemplo@gmail.com");
define("CONF_FROM_NAME_MAIL_SUPORTE", "Equipe de suporte");
