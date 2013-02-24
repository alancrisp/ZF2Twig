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
        $resolver = $serviceManager->get('ViewTwigResolver');

        return new Filesystem($resolver);
    }
}
