<?php

class __Mustache_b687f6003e659e53de4181b0c814a4ab extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'uservisible' section
        $value = $context->find('uservisible');
        $buffer .= $this->section15368da153d20ed024c7cf9c850ed332($context, $indent, $value);
        // 'uservisible' inverted section
        $value = $context->find('uservisible');
        if (empty($value)) {
            
            $buffer .= $indent . '    <span class="instancename">
';
            $buffer .= $indent . '        ';
            $value = $this->resolveValue($context->find('instancename'), $context);
            $buffer .= $value;
            $buffer .= ' ';
            $value = $this->resolveValue($context->find('altname'), $context);
            $buffer .= $value;
            $buffer .= '
';
            $buffer .= $indent . '    </span>
';
        }

        return $buffer;
    }

    private function section15368da153d20ed024c7cf9c850ed332(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <a href="{{url}}" class="{{linkclasses}} aalink stretched-link" onclick="{{{onclick}}}">
        <span class="instancename">{{{instancename}}} {{{altname}}}</span>
    </a>
';
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
                
                $buffer .= $indent . '    <a href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="';
                $value = $this->resolveValue($context->find('linkclasses'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' aalink stretched-link" onclick="';
                $value = $this->resolveValue($context->find('onclick'), $context);
                $buffer .= $value;
                $buffer .= '">
';
                $buffer .= $indent . '        <span class="instancename">';
                $value = $this->resolveValue($context->find('instancename'), $context);
                $buffer .= $value;
                $buffer .= ' ';
                $value = $this->resolveValue($context->find('altname'), $context);
                $buffer .= $value;
                $buffer .= '</span>
';
                $buffer .= $indent . '    </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
