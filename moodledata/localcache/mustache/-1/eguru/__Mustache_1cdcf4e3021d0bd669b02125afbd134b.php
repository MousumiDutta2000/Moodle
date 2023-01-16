<?php

class __Mustache_1cdcf4e3021d0bd669b02125afbd134b extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="signupform">
';
        $buffer .= $indent . '    <h1 class="login-heading">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->sectionAd28b2234b4bb6059fc66eb1a7025b80($context, $indent, $value);
        $buffer .= '</h1>
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->find('formhtml'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function sectionAd28b2234b4bb6059fc66eb1a7025b80(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' newaccount ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' newaccount ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
