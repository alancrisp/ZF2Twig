<?php
namespace ZF2Twig\View\Renderer;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class TwigRendererFactory implements FactoryInterface
{
    /**
     * Create Twig renderer
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return TwigRenderer
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $resolver = $serviceManager->get('viewresolver');
        $twig = $serviceManager->get('twigenvironment');

        $renderer = new TwigRenderer($resolver, $twig);
        $twig->plugin()->setRenderer($renderer);

        return $renderer;
    }
}
