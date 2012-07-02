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

    /**
     * Invoke helper manager
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->helperManager->get($name), '__invoke'), $arguments);
    }
}
