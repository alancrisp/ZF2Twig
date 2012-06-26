<?php
namespace ZF2Twig\Environment;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class PluginProviderFactory implements FactoryInterface
{
    /**
     * Create plugin proivder from helper broker
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return TwigRenderer
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $helperBroker = $serviceManager->get('viewhelperbroker');

        return new PluginProvider($helperBroker);
    }
}
