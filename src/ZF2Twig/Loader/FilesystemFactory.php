<?php
namespace ZF2Twig\Loader;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class FilesystemFactory implements FactoryInterface
{
    /**
     * Create Twig filesystem loader
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return TwigRenderer
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $config = $serviceManager->get('config');
        $twigConfig = $config['zf2twig'];

        $resolver = $serviceManager->get('viewtemplatepathstack');
        $resolver->setDefaultSuffix($twigConfig['default_suffix']);

        return new Filesystem($resolver);
    }
}
