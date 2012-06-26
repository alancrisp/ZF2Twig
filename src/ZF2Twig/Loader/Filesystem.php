<?php
namespace ZF2Twig\Loader;

use Zend\View\Resolver\ResolverInterface;

class Filesystem implements \Twig_LoaderInterface
{
    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * Constructor
     *
     * @param ResolverInterface $resolver
     * @return void
     */
    public function __construct(ResolverInterface $resolver)
    {
        $this->setResolver($resolver);
    }

    /**
     * Set resolver
     *
     * @param ResolverInterface $resolver
     * @return Filesystem
     */
    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    /**
     * Find template file
     *
     * @see Twig_LoaderInterface::findTemplate()
     */
    public function findTemplate($name)
    {
        $template = $this->resolver->resolve($name);

        if (false === $template) {
            throw new \Twig_Error_Loader(sprintf('Unable to find template "%s".', $name));
        }

        return $template;
    }

    /**
     * Get template source
     *
     * @see Twig_LoaderInterface::getSource()
     */
    public function getSource($name)
    {
        return file_get_contents($this->findTemplate($name));
    }

    /**
     * Get template cache key
     *
     * @see Twig_LoaderInterface::getCacheKey()
     */
    public function getCacheKey($name)
    {
        return $this->findTemplate($name);
    }

    /**
     * Determine if template is still fresh
     *
     * @see Twig_LoaderInterface::isFresh()
     */
    public function isFresh($name, $time)
    {
        return filemtime($this->findTemplate($name)) <= $time;
    }
}
