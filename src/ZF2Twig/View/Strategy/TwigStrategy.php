<?php
namespace ZF2Twig\View\Strategy;

use Zend\EventManager\EventManagerInterface,
    Zend\EventManager\ListenerAggregateInterface,
    Zend\View\ViewEvent;

use ZF2Twig\View\Renderer\TwigRenderer;

class TwigStrategy implements ListenerAggregateInterface
{
    /**
     * @var TwigRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param TwigRenderer $renderer
     * @return void
     */
    public function __construct(TwigRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Attach listeners
     *
     * @param EventCollection $events
     * @param int $priority
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    /**
     * Detach previously attached listeners
     *
     * @param EventCollection $events
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Select the TwigRenderer
     *
     * @param ViewEvent $event
     * @return TwigRenderer
     */
    public function selectRenderer(ViewEvent $event)
    {
        return $this->renderer;
    }

    /**
     * Populate the response object from the view
     *
     * Populates the content of the response object from the view rendering
     * results.
     *
     * @param ViewEvent $event
     * @return void
     */
    public function injectResponse(ViewEvent $event)
    {
        if ($event->getRenderer() !== $this->renderer) {
            return;
        }

        $result = $event->getResult();
        $response = $event->getResponse();
        $response->setContent($result);
    }
}
