<?php

namespace Source\Functions;

use CoffeeCode\Optimizer\Optimizer;

/**
 * Class Seo
 * @author Yago Silva <yagosilvferreira@gmail.com>
 * @package Source\Functions
 */
class Seo
{
    /** @var Optimizer $optimizer */
    protected Optimizer $optimizer;

    /**
     * @param string $schema
     */
    public function __construct(string $schema = "article")
    {
        $this->optimizer = new Optimizer();
        $this->optimizer->openGraph(
            CONF_SITE_NAME,
            CONF_SITE_LANG,
            $schema
        )->twitterCard(
            CONF_SOCIAL_TWITTER_CREATOR,
            CONF_SOCIAL_TWITTER_PUBLISHER,
            CONF_SITE_DOMAIN
        )->publisher(
            CONF_SOCIAL_FACEBOOK_PAGE,
            CONF_SOCIAL_FACEBOOK_AUTHOR
        )->facebook(
            CONF_SOCIAL_FACEBOOK_APP
        );
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->optimizer->data()->$name;
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $image
     * @param bool $follow
     * @return string
     */
    public function render(string $title, string $description, string $url, string $image, bool $follow = true): string
    {
        return $this->optimizer->optimize($title, $description, $url, $image, $follow)->render();
    }

    /**
     * @param string|null $title
     * @param string|null $desc
     * @param string|null $url
     * @param string|null $image
     * @return object|null
     */
    public function data(string $title = null, string $desc = null, string $url = null, string $image = null): ?object
    {
        return $this->optimizer->data($title, $desc, $url, $image);
    }

    /**
     * @return Optimizer
     */
    public function getOptimizer(): Optimizer
    {
        return $this->optimizer;
    }
}