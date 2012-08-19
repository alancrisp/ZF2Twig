<?php
namespace ZF2TwigTest\Environment;

use Zend\View\HelperPluginManager;

use ZF2Twig\Environment\Environment,
    ZF2Twig\Environment\PluginProvider;

class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    public function testTwigOptionsArePassedToParentEnvironment()
    {
        $loader = new \Twig_Loader_String();
        $pluginProvider = new PluginProvider(new HelperPluginManager());
        $options = array('debug' => true);
        $twig = new Environment($loader, $pluginProvider, $options);
        $this->assertTrue($twig->isDebug());
    }

    public function testPlugin()
    {
        $loader = new \Twig_Loader_String();
        $pluginProvider = new PluginProvider(new HelperPluginManager());
        $twig = new Environment($loader, $pluginProvider);
        $this->assertTrue($twig->plugin() instanceof PluginProvider);
    }
}
