<?php
namespace ZF2Twig\Environment;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class EnvironmentFactory implements FactoryInterface
{
    /**
     * Create Twig environment
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return TwigRenderer
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $loader = $serviceManager->get('twigloaderfilesystem');
        $pluginProvider = $serviceManager->get('zftwigpluginprovider');

        $config = $serviceManager->get('config');
        $twigConfig = $config['zf2twig'];
        $options = $twigConfig['environment_options'];

        return new Environment($loader, $pluginProvider, $options);
    }
}
