<?php
namespace ZF2TwigTest\Environment;

use Zend\View\HelperPluginManager;

use ZF2Twig\Environment\PluginProvider;

class PluginProviderTest extends \PHPUnit_Framework_TestCase
{
    protected $pluginProvider;

    public function setUp()
    {
        $this->pluginProvider = new PluginProvider(new HelperPluginManager());
    }

    public function testCall()
    {
        $doctypeHelper = $this->pluginProvider->doctype();
        $this->assertTrue($doctypeHelper instanceof \Zend\View\Helper\Doctype);
    }

    public function testCallWithArguments()
    {
        $doctypeHelper = $this->pluginProvider->doctype('HTML5');
        $this->assertEquals('HTML5', $doctypeHelper->getDoctype());
    }
}
