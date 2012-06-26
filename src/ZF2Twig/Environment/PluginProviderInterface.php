<?php
namespace ZF2Twig\Environment;

interface PluginProviderInterface
{
    /**
     * Invoke helper plugin
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments);
}
