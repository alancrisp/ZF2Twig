<?php
namespace ZF2TwigTest\View\Renderer;

use Zend\View\Model\ViewModel,
    Zend\View\Resolver\TemplatePathStack;

use ZF2Twig\View\Renderer\TwigRenderer;

class TwigRendererTest extends \PHPUnit_Framework_TestCase
{
    protected $renderer;

    public function setUp()
    {
        $resolver = new TemplatePathStack();
        $twig = new \Twig_Environment(new \Twig_Loader_String());
        $this->renderer = new TwigRenderer($resolver, $twig);
    }

    public function testGetEngine()
    {
        $engine = $this->renderer->getEngine();
        $this->assertTrue($engine instanceof \Twig_Environment);
    }

    public function testRenderWithViewModel()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('Hello {{ name }}');
        $viewModel->setVariable('name', 'world');
        $output = $this->renderer->render($viewModel);
        $this->assertEquals('Hello world', $output);
    }

    public function testRenderWithTemplate()
    {
        $template = 'Hello {{ name }}';
        $values = array('name' => 'world');
        $output = $this->renderer->render($template, $values);
        $this->assertEquals('Hello world', $output);
    }
}
