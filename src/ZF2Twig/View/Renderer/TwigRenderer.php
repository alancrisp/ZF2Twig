<?php
namespace ZF2Twig\View\Renderer;

use Zend\View\Exception\DomainException,
    Zend\View\Model\ViewModel,
    Zend\View\Renderer\RendererInterface,
    Zend\View\Resolver\ResolverInterface;

class TwigRenderer implements RendererInterface
{
    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Constructor
     *
     * @param ResolverInterface $resolver
     * @param \Twig_Environment $twig
     * @return void
     */
    public function __construct(ResolverInterface $resolver, \Twig_Environment $twig)
    {
        $this->setResolver($resolver);
        $this->setEnvironment($twig);
    }

    /**
     * Set script resolver
     *
     * @param ResolverInterface $resolver
     * @return void
     */
    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Set Twig environment
     *
     * @param \Twig_Environment $twig
     * @return void
     */
    public function setEnvironment(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Return the template engine object, if any
     *
     * @see Zend\View.Renderer::getEngine()
     * @return \Twig_Environment
     */
    public function getEngine()
    {
        return $this->twig;
    }

    /**
     * Processes a view script and returns the output
     *
     * @see Zend\View.Renderer::render()
     */
    public function render($nameOrModel, $values = array())
    {
        if ($nameOrModel instanceof ViewModel) {
            $model = $nameOrModel;
            $template = $model->getTemplate();

            if (empty($nameOrModel)) {
                throw new DomainException(sprintf(
                    '%s: received View Model argument, but template is empty',
                    __METHOD__
                ));
            }

            $values = $model->getVariables();
        } else {
            $template = $nameOrModel;
        }

        if ($values instanceof \Traversable) {
            $values = (array) $values;
        }

        return $this->twig->render($template, $values);
    }

    public function plugin($name, array $arguments = null)
    {
        return $this->twig->plugin($name, $arguments);
    }

    public function setVars($variables)
    {
    }
}
