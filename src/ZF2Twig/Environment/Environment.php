<?php
namespace ZF2Twig\Environment;

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
