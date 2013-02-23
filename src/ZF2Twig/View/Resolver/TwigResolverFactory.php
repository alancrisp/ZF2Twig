<?php
namespace ZF2Twig\View\Resolver;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class TwigResolverFactory implements FactoryInterface
{
    /**
     * Create Twig template resolver
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return ResolverInterface
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $config     = $serviceManager->get('config');
        $twigConfig = $config['zf2twig'];

        $twigResolver = clone $serviceManager->get('ViewTemplatePathStack');
        $twigResolver->setDefaultSuffix($twigConfig['default_suffix']);

        return $twigResolver;
    }
}
