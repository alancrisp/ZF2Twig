<?php
namespace ZF2Twig\Environment;

use ZF2Twig\TokenParser\ZendViewHelper;

class Environment extends \Twig_Environment
{
    /**
     * @var PluginProviderInterface
     */
    protected $pluginProvider;

    /**
     * Constructor
     *
     * @param \Twig_LoaderInterface $loader
     * @param PluginProviderInterface $pluginProvider
     * @param array $options
     * @return void
     */
    public function __construct(\Twig_LoaderInterface $loader = null, PluginProviderInterface $pluginProvider = null, array $options = array())
    {
        parent::__construct($loader, $options);

        $this->pluginProvider = $pluginProvider;

        $this->addGlobal('plugin', $this->plugin());
        $this->addTokenParser(new ZendViewHelper());
    }

    /**
     * Get plugin provider
     *
     * @return PluginProviderInterface
     */
    public function plugin()
    {
        return $this->pluginProvider;
    }
}
