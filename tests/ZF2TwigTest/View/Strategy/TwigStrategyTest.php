<?php
namespace ZF2TwigTest\View\Strategy;

use Zend\EventManager\EventManager,
    Zend\Http\Response,
    Zend\View\Resolver\TemplatePathStack,
    Zend\View\ViewEvent;

use ZF2Twig\View\Renderer\TwigRenderer,
    ZF2Twig\View\Strategy\TwigStrategy;

class TwigStrategyTest extends \PHPUnit_Framework_TestCase
{
    protected $strategy;
    protected $viewEvent;
    protected $events;

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
        $this->viewEvent->setResponse(new Response());

        // Setup event manager
        $this->events = new EventManager();
    }

    public function testAttach()
    {
        $this->strategy->attach($this->events);
        $events = $this->events->getEvents();
        $this->assertTrue(in_array(ViewEvent::EVENT_RENDERER, $events), 'Renderer event not attached');
        $this->assertTrue(in_array(ViewEvent::EVENT_RESPONSE, $events), 'Response event not attached');
    }

    public function testDetach()
    {
        $this->strategy->attach($this->events);
        $this->strategy->detach($this->events);
        $events = $this->events->getEvents();
        $this->assertTrue(empty($events));
    }

    public function testSelectRenderer()
    {
        $renderer = $this->strategy->selectRenderer($this->viewEvent);
        $this->assertTrue($renderer instanceof TwigRenderer);
    }

    public function testInjectResponse()
    {
        $this->viewEvent->setResult('Hello world');
        $this->strategy->injectResponse($this->viewEvent);
        $content = $this->viewEvent->getResponse()->getContent();
        $this->assertEquals('Hello world', $content);
    }
}
