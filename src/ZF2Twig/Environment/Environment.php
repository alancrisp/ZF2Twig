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
     * @param string $name
     * @param array|null $arguments
     * @return mixed
     */
    public function plugin($name = null, array $arguments = null)
    {
        if (null === $name) {
            return $this->pluginProvider;
        }

        return $this->pluginProvider->$name($arguments);
    }
}
