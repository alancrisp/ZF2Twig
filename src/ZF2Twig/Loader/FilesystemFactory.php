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
        $config     = $serviceManager->get('config');
        $twigConfig = $config['zf2twig'];

        $twigTemplateResolver = clone $serviceManager->get('viewtemplatepathstack');
        $twigTemplateResolver->setDefaultSuffix($twigConfig['default_suffix']);

        $resolver = $serviceManager->get('ViewResolver');
        $resolver->attach($resolver, 1);

        return new Filesystem($twigTemplateResolver);
    }
}

