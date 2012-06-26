<?php
namespace ZF2Twig;

use Zend\View\HelperBroker;

class PluginProvider
{
    /**
     * @var HelperBroker
     */
    protected $helperFunction;

    /**
     * Constructor
     *
     * @param HelperBroker $helperBroker
     * @return void
     */
    public function __construct(HelperBroker $helperBroker)
    {
        $this->helperBroker = $helperBroker;
    }

    /**
     * Invoke helper
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->helperBroker->load($name), '__invoke'), $arguments);
    }
}
