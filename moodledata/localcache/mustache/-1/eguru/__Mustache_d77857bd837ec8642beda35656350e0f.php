<?php

class __Mustache_d77857bd837ec8642beda35656350e0f extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div id="';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '-course-format">
';
        $buffer .= $indent . '    <h2 class="accesshide">';
        $value = $this->resolveValue($context->find('title'), $context);
        $buffer .= $value;
        $buffer .= '</h2>
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->find('completionhelp'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '    <ul class="';
        $value = $this->resolveValue($context->find('format'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-for="course_sectionlist">
';
        // 'initialsection' section
        $value = $context->find('initialsection');
        $buffer .= $this->section8827b1a17576f48cfc178a23d2836e73($context, $indent, $value);
        // 'sections' section
        $value = $context->find('sections');
        $buffer .= $this->section8827b1a17576f48cfc178a23d2836e73($context, $indent, $value);
        $buffer .= $indent . '    </ul>
';
        // 'hasnavigation' section
        $value = $context->find('hasnavigation');
        $buffer .= $this->section8897cbcfe3ad4384c35345767ed9cdd0($context, $indent, $value);
        // 'numsections' section
        $value = $context->find('numsections');
        $buffer .= $this->section3e01fd0618fb9e53b875dff48db1ff75($context, $indent, $value);
        $buffer .= $indent . '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->section658d9a99a3fddbc6159734309bfdedf6($context, $indent, $value);

        return $buffer;
    }

    private function section8827b1a17576f48cfc178a23d2836e73(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{$ core_courseformat/local/content/section }}
                {{> core_courseformat/local/content/section }}
            {{/ core_courseformat/local/content/section }}
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
                
                $blockFunction = $context->findInBlock('core_courseformat/local/content/section');
                if (is_callable($blockFunction)) {
                    $buffer .= call_user_func($blockFunction, $context);
                } else {
                    if ($partial = $this->mustache->loadPartial('core_courseformat/local/content/section')) {
                        $buffer .= $partial->renderInternal($context, $indent . '                ');
                    }
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionFacbfac0606048ebfae74ceeb14690de(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{$ core_courseformat/local/content/sectionnavigation }}
                {{> core_courseformat/local/content/sectionnavigation }}
            {{/ core_courseformat/local/content/sectionnavigation }}
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
                
                $blockFunction = $context->findInBlock('core_courseformat/local/content/sectionnavigation');
                if (is_callable($blockFunction)) {
                    $buffer .= call_user_func($blockFunction, $context);
                } else {
                    if ($partial = $this->mustache->loadPartial('core_courseformat/local/content/sectionnavigation')) {
                        $buffer .= $partial->renderInternal($context, $indent . '                ');
                    }
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section986e0d757a08f2dc36e0f3ce06fcab6e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{$ core_courseformat/local/content/sectionselector }}
                {{> core_courseformat/local/content/sectionselector }}
            {{/ core_courseformat/local/content/sectionselector }}
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
                
                $blockFunction = $context->findInBlock('core_courseformat/local/content/sectionselector');
                if (is_callable($blockFunction)) {
                    $buffer .= call_user_func($blockFunction, $context);
                } else {
                    if ($partial = $this->mustache->loadPartial('core_courseformat/local/content/sectionselector')) {
                        $buffer .= $partial->renderInternal($context, $indent . '                ');
                    }
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8897cbcfe3ad4384c35345767ed9cdd0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="single-section">
        {{#sectionnavigation}}
            {{$ core_courseformat/local/content/sectionnavigation }}
                {{> core_courseformat/local/content/sectionnavigation }}
            {{/ core_courseformat/local/content/sectionnavigation }}
        {{/sectionnavigation}}
        <ul class="{{format}}">
        {{#singlesection}}
            {{$ core_courseformat/local/content/section }}
                {{> core_courseformat/local/content/section }}
            {{/ core_courseformat/local/content/section }}
        {{/singlesection}}
        </ul>
        {{#sectionselector}}
            {{$ core_courseformat/local/content/sectionselector }}
                {{> core_courseformat/local/content/sectionselector }}
            {{/ core_courseformat/local/content/sectionselector }}
        {{/sectionselector}}
    </div>
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
                
                $buffer .= $indent . '    <div class="single-section">
';
                // 'sectionnavigation' section
                $value = $context->find('sectionnavigation');
                $buffer .= $this->sectionFacbfac0606048ebfae74ceeb14690de($context, $indent, $value);
                $buffer .= $indent . '        <ul class="';
                $value = $this->resolveValue($context->find('format'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                // 'singlesection' section
                $value = $context->find('singlesection');
                $buffer .= $this->section8827b1a17576f48cfc178a23d2836e73($context, $indent, $value);
                $buffer .= $indent . '        </ul>
';
                // 'sectionselector' section
                $value = $context->find('sectionselector');
                $buffer .= $this->section986e0d757a08f2dc36e0f3ce06fcab6e($context, $indent, $value);
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3e01fd0618fb9e53b875dff48db1ff75(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        {{$ core_courseformat/local/content/addsection}}
            {{> core_courseformat/local/content/addsection}}
        {{/ core_courseformat/local/content/addsection}}
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
                
                $blockFunction = $context->findInBlock('core_courseformat/local/content/addsection');
                if (is_callable($blockFunction)) {
                    $buffer .= call_user_func($blockFunction, $context);
                } else {
                    if ($partial = $this->mustache->loadPartial('core_courseformat/local/content/addsection')) {
                        $buffer .= $partial->renderInternal($context, $indent . '            ');
                    }
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section658d9a99a3fddbc6159734309bfdedf6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'core_courseformat/local/content\'], function(component) {
    component.init(\'{{uniqid}}-course-format\', {}, {{sectionreturn}});
});
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
                
                $buffer .= $indent . 'require([\'core_courseformat/local/content\'], function(component) {
';
                $buffer .= $indent . '    component.init(\'';
                $value = $this->resolveValue($context->find('uniqid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '-course-format\', {}, ';
                $value = $this->resolveValue($context->find('sectionreturn'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ');
';
                $buffer .= $indent . '});
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
