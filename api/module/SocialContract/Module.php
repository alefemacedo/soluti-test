<?php
namespace SocialContract;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Uri\UriFactory;

class Module implements ApigilityProviderInterface
{
    public function onBootstrap()
    {
        UriFactory::registerScheme('chrome-extension', 'Zend\Uri\Uri');
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}
