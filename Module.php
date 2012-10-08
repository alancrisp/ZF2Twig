<?php
namespace ZF2Twig;

use Zend\EventManager\Event,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\ModuleManager;

class Module implements AutoloaderProviderInterface
{
    public function onBootstrap(Event $event)
    {
        $application = $event->getApplication();
        $serviceManager = $application->getServiceManager();

        $view = $serviceManager->get('view');
        $twigStrategy = $serviceManager->get('ViewTwigStrategy');
        $view->getEventManager()->attach($twigStrategy, 100);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
