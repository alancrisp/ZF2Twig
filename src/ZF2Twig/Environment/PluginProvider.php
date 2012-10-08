<?php
namespace ZF2Twig\Environment;

use Zend\View\HelperPluginManager;

class PluginProvider implements PluginProviderInterface
{
    /**
     * @var HelperPluginManager
     */
    protected $helperManager;

    /**
     * Constructor
     *
     * @param HelperPluginManager $helperManager
     * @return void
     */
    public function __construct(HelperPluginManager $helperManager)
    {
        $this->helperManager = $helperManager;
    }

    public function setRenderer($renderer)
    {
        $this->helperManager->setRenderer($renderer);
    }

    public function getRenderer()
    {
        return $this->helperManager->getRenderer();
    }

    /**
     * Invoke helper manager
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments = null)
    {
        if (null === $arguments) {
            return $this->helperManager->get($name);
        }

        return call_user_func_array(array($this->helperManager->get($name), '__invoke'), $arguments);
    }
}
