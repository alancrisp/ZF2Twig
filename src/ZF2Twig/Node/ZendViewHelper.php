<?php
namespace ZF2Twig\Node;

class ZendViewHelper extends \Twig_Node
{
    /**
     * Compile Zend view helper method calls
     *
     * @see Twig_Node::compile()
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this)
                 ->write('$this->env->plugin()->' . $this->getAttribute('name') . '()');

        foreach ($this->getAttribute('methods') as $method) {
            $compiler->write('->' . $method['method'] . '(');

            if (null !== $method['arguments']) {
                $argCount = count($method['arguments']);
                $iteration = 0;

                foreach ($method['arguments'] as $argument) {
                    $compiler->subcompile($argument);

                    if ($argCount - 1 !== $iteration) {
                        $compiler->write(', ');
                    }

                    ++$iteration;
                }
            }

            $compiler->write(')');
        }

        $compiler->raw(";\n");
    }
}
