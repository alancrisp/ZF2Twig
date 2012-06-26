<?php
namespace ZF2Twig\Extension;

/**
 * Adds filters used in the skeleton ZF2 skeleton application
 */
class ZFHelper extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ZFHelper';
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            'get_class' => new \Twig_Filter_Function('get_class'),
        );
    }
}
