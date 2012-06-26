<?php
namespace ZF2Twig\TokenParser;

use ZF2Twig\Node\ZendViewHelper as ZendViewHelperNode;

/**
 * Adds 'plugin' tag to Twig for calling view helper methods which do not output HTML
 *
 * Examples:
 *     Doctype:
 *         Zend:
 *             $this->doctype('HTML5')
 *         Twig:
 *             {% plugin doctype('HTML5') %}
 *     HeadScript:
 *         Zend:
 *             $this->headScript->appendFile('script.js')
 *         Twig:
 *             {% plugin headScript.appendFile('script.js') %}
 */
class ZendViewHelper extends \Twig_TokenParser
{
    /**
     * @var array View helper method calls
     */
    protected $methods = array();

    /**
     * Parse token
     * @see Twig_TokenParserInterface::parse()
     */
    public function parse(\Twig_Token $token)
    {
        $this->methods = array();

        $name = $this->parser->getStream()->expect(\Twig_Token::NAME_TYPE)->getValue();

        if ($this->parser->getStream()->test(\Twig_Token::PUNCTUATION_TYPE, '(')) {
            $this->addMethod('__invoke', $this->getArguments());
        }

        $this->getMethods();

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new ZendViewHelperNode(array(), array('name' => $name, 'methods' => $this->methods), $token->getLine(), $this->getTag());
    }

    /**
     * Get chained method calls
     * @return void
     */
    protected function getMethods()
    {
        if ($this->parser->getStream()->test(\Twig_Token::PUNCTUATION_TYPE, '.')) {
            $this->parser->getStream()->next();
            $method = $this->parser->getStream()->expect(\Twig_Token::NAME_TYPE)->getValue();
            $this->addMethod($method, $this->getArguments());
            $this->getMethods();
        }
    }

    /**
     * Add view helper method call
     *
     * @param string $method
     * @param array|null $arguments
     * @return void
     */
    protected function addMethod($method, $arguments = null)
    {
        $this->methods[] = array(
            'method'    => $method,
            'arguments' => $arguments
        );
    }

    /**
     * Get arguments to method call
     *
     * @return array|null
     */
    protected function getArguments()
    {
        if ($this->parser->getStream()->test(\Twig_Token::PUNCTUATION_TYPE)) {
            return $this->parser->getExpressionParser()->parseArguments();
        }

        return null;
    }

    /**
     * Get tag
     *
     * @see Twig_TokenParserInterface::getTag()
     */
    public function getTag()
    {
        return 'plugin';
    }
}
