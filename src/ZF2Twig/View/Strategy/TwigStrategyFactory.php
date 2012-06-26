<?php
namespace ZF2Twig\View\Strategy;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class TwigStrategyFactory implements FactoryInterface
{
    /**
     * Create Twig rendering strategy
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return TwigStrategy
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $renderer = $serviceManager->get('ViewTwigRenderer');

        return new TwigStrategy($renderer);
    }
}
