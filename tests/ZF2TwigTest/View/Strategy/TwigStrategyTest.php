<?php
namespace ZF2TwigTest\View\Strategy;

use Zend\View\Resolver\TemplatePathStack,
    Zend\View\ViewEvent;

use ZF2Twig\View\Renderer\TwigRenderer,
    ZF2Twig\View\Strategy\TwigStrategy;

class TwigStrategyTest extends \PHPUnit_Framework_TestCase
{
    protected $strategy;
    protected $viewEvent;

    public function setUp()
    {
        // Setup twig strategy
        $resolver = new TemplatePathStack();
        $twig = new \Twig_Environment(new \Twig_Loader_String());
        $renderer = new TwigRenderer($resolver, $twig);
        $this->strategy = new TwigStrategy($renderer);

        // Setup view event
        $this->viewEvent = new ViewEvent();
        $this->viewEvent->setRenderer($renderer);
    }

    public function testSelectRenderer()
    {
        $renderer = $this->strategy->selectRenderer($this->viewEvent);
        $this->assertTrue($renderer instanceof TwigRenderer);
    }
}
