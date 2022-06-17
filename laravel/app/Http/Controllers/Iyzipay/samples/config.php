<?php

require_once(dirname(__DIR__).'/IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey('sandbox-V9iQ8Cca5kWaJl7gSOgBwEgD4v9P007U');
        $options->setSecretKey('sandbox-3MsFgN7ihKX0HlbEG3SsryJ8g4nfBdeD');
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');

        return $options;
    }
}