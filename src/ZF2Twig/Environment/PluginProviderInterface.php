<?php
namespace ZF2Twig\Environment;

interface PluginProviderInterface
{
    /**
     * Invoke helper plugin
     *
     * @param string $name
     * @param array $arguments
     */
    public function __call($name, array $arguments);
}
