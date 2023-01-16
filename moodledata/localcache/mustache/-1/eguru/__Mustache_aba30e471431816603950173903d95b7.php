<?php

class __Mustache_aba30e471431816603950173903d95b7 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'items' section
        $value = $context->find('items');
        $buffer .= $this->sectionF683876635d7151547efd27328d9dab6($context, $indent, $value);

        return $buffer;
    }

    private function section23af091fd3f4b163335e21746eca9cc0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{pixicon}}';
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
                
                $value = $this->resolveValue($context->find('pixicon'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD9625f345c43cbf47695087ebad2af59(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                {{#pix}}{{pixicon}}{{/pix}}
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
                
                $buffer .= $indent . '                ';
                // 'pix' section
                $value = $context->find('pix');
                $buffer .= $this->section23af091fd3f4b163335e21746eca9cc0($context, $indent, $value);
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3cf431fdbd0299f52bc9f89b1771f516(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '<img aria-hidden="true" src="{{imgsrc}}" alt="{{title}}"/>';
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
                
                $buffer .= '<img aria-hidden="true" src="';
                $value = $this->resolveValue($context->find('imgsrc'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" alt="';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"/>';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3a7cb825a8071dd6fd9878769bc75dc0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <a href="{{{url}}}" class="dropdown-item" role="menuitem" tabindex="-1">
            {{#pixicon}}
                {{#pix}}{{pixicon}}{{/pix}}
            {{/pixicon}}
            {{^pixicon}}
                {{#imgsrc}}<img aria-hidden="true" src="{{imgsrc}}" alt="{{title}}"/>{{/imgsrc}}
            {{/pixicon}}
            {{title}}
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
                
                $buffer .= $indent . '        <a href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= $value;
                $buffer .= '" class="dropdown-item" role="menuitem" tabindex="-1">
';
                // 'pixicon' section
                $value = $context->find('pixicon');
                $buffer .= $this->sectionD9625f345c43cbf47695087ebad2af59($context, $indent, $value);
                // 'pixicon' inverted section
                $value = $context->find('pixicon');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                ';
                    // 'imgsrc' section
                    $value = $context->find('imgsrc');
                    $buffer .= $this->section3cf431fdbd0299f52bc9f89b1771f516($context, $indent, $value);
                    $buffer .= '
';
                }
                $buffer .= $indent . '            ';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '
';
                $buffer .= $indent . '        </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6e25a04602ef637f801696638fac4ddf(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <a href="#" class="carousel-navigation-link dropdown-item" role="menuitem" tabindex="-1" data-carousel-target-id="carousel-item-{{submenuid}}">
            {{#pixicon}}
                {{#pix}}{{pixicon}}{{/pix}}
            {{/pixicon}}
            {{^pixicon}}
                {{#imgsrc}}<img aria-hidden="true" src="{{imgsrc}}" alt="{{title}}"/>{{/imgsrc}}
            {{/pixicon}}
            {{title}}
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
                
                $buffer .= $indent . '        <a href="#" class="carousel-navigation-link dropdown-item" role="menuitem" tabindex="-1" data-carousel-target-id="carousel-item-';
                $value = $this->resolveValue($context->find('submenuid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                // 'pixicon' section
                $value = $context->find('pixicon');
                $buffer .= $this->sectionD9625f345c43cbf47695087ebad2af59($context, $indent, $value);
                // 'pixicon' inverted section
                $value = $context->find('pixicon');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                ';
                    // 'imgsrc' section
                    $value = $context->find('imgsrc');
                    $buffer .= $this->section3cf431fdbd0299f52bc9f89b1771f516($context, $indent, $value);
                    $buffer .= '
';
                }
                $buffer .= $indent . '            ';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '
';
                $buffer .= $indent . '        </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5dcadd4c046d6ae7246de01cd0536384(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '<div class="dropdown-divider"></div>';
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
                
                $buffer .= '<div class="dropdown-divider"></div>';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF683876635d7151547efd27328d9dab6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    {{#link}}
        <a href="{{{url}}}" class="dropdown-item" role="menuitem" tabindex="-1">
            {{#pixicon}}
                {{#pix}}{{pixicon}}{{/pix}}
            {{/pixicon}}
            {{^pixicon}}
                {{#imgsrc}}<img aria-hidden="true" src="{{imgsrc}}" alt="{{title}}"/>{{/imgsrc}}
            {{/pixicon}}
            {{title}}
        </a>
    {{/link}}
    {{#submenulink}}
        <a href="#" class="carousel-navigation-link dropdown-item" role="menuitem" tabindex="-1" data-carousel-target-id="carousel-item-{{submenuid}}">
            {{#pixicon}}
                {{#pix}}{{pixicon}}{{/pix}}
            {{/pixicon}}
            {{^pixicon}}
                {{#imgsrc}}<img aria-hidden="true" src="{{imgsrc}}" alt="{{title}}"/>{{/imgsrc}}
            {{/pixicon}}
            {{title}}
        </a>
    {{/submenulink}}
    {{#divider}}<div class="dropdown-divider"></div>{{/divider}}
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
                
                // 'link' section
                $value = $context->find('link');
                $buffer .= $this->section3a7cb825a8071dd6fd9878769bc75dc0($context, $indent, $value);
                // 'submenulink' section
                $value = $context->find('submenulink');
                $buffer .= $this->section6e25a04602ef637f801696638fac4ddf($context, $indent, $value);
                $buffer .= $indent . '    ';
                // 'divider' section
                $value = $context->find('divider');
                $buffer .= $this->section5dcadd4c046d6ae7246de01cd0536384($context, $indent, $value);
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
