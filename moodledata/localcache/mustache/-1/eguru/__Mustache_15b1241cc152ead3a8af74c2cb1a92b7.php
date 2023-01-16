<?php

class __Mustache_15b1241cc152ead3a8af74c2cb1a92b7 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div data-region="event-list-container"
';
        $buffer .= $indent . '     data-days-offset="';
        $blockFunction = $context->findInBlock('daysoffset');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        } else {
            // 'hasdaysoffset' section
            $value = $context->find('hasdaysoffset');
            $buffer .= $this->sectionEb227d4e59821d552e785eff34c40bc7($context, $indent, $value);
            // 'hasdaysoffset' inverted section
            $value = $context->find('hasdaysoffset');
            if (empty($value)) {
                
                $buffer .= '0';
            }
        }
        $buffer .= '"
';
        $buffer .= $indent . '     ';
        // 'nodayslimit' inverted section
        $value = $context->find('nodayslimit');
        if (empty($value)) {
            
            $buffer .= 'data-days-limit="';
            $blockFunction = $context->findInBlock('dayslimit');
            if (is_callable($blockFunction)) {
                $buffer .= call_user_func($blockFunction, $context);
            } else {
                // 'hasdayslimit' section
                $value = $context->find('hasdayslimit');
                $buffer .= $this->sectionF18b214a66ab2a31f869650fafc48bbf($context, $indent, $value);
                // 'hasdayslimit' inverted section
                $value = $context->find('hasdayslimit');
                if (empty($value)) {
                    
                    $buffer .= '30';
                }
            }
            $buffer .= '"';
        }
        $buffer .= '
';
        $buffer .= $indent . '     data-course-id="';
        $blockFunction = $context->findInBlock('courseid');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '"
';
        $buffer .= $indent . '     data-midnight="';
        $value = $this->resolveValue($context->find('midnight'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '"
';
        $buffer .= $indent . '>
';
        // 'hascourses' section
        $value = $context->find('hascourses');
        $buffer .= $this->sectionBb4561eb1abe20335fbe2847f28bccea($context, $indent, $value);
        $buffer .= $indent . '    <div data-region="event-list-content"></div>
';
        if ($partial = $this->mustache->loadPartial('block_timeline/no-events')) {
            $buffer .= $partial->renderInternal($context, $indent . '    ');
        }
        if ($partial = $this->mustache->loadPartial('block_timeline/no-courses')) {
            $buffer .= $partial->renderInternal($context, $indent . '    ');
        }
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function sectionEb227d4e59821d552e785eff34c40bc7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{daysoffset}}';
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
                
                $value = $this->resolveValue($context->find('daysoffset'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF18b214a66ab2a31f869650fafc48bbf(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{dayslimit}}';
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
                
                $value = $this->resolveValue($context->find('dayslimit'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBb4561eb1abe20335fbe2847f28bccea(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <div data-region="event-list-loading-placeholder">
            <ul class="pl-0 list-group list-group-flush">
                {{> block_timeline/placeholder-event-list-item }}
                {{> block_timeline/placeholder-event-list-item }}
                {{> block_timeline/placeholder-event-list-item }}
                {{> block_timeline/placeholder-event-list-item }}
                {{> block_timeline/placeholder-event-list-item }}
            </ul>
            <div class="pt-3 pb-2 d-flex justify-content-between">
                <div class="w-25 bg-pulse-grey" style="height: 35px"></div>
            </div>
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
                
                $buffer .= $indent . '        <div data-region="event-list-loading-placeholder">
';
                $buffer .= $indent . '            <ul class="pl-0 list-group list-group-flush">
';
                if ($partial = $this->mustache->loadPartial('block_timeline/placeholder-event-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                ');
                }
                if ($partial = $this->mustache->loadPartial('block_timeline/placeholder-event-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                ');
                }
                if ($partial = $this->mustache->loadPartial('block_timeline/placeholder-event-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                ');
                }
                if ($partial = $this->mustache->loadPartial('block_timeline/placeholder-event-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                ');
                }
                if ($partial = $this->mustache->loadPartial('block_timeline/placeholder-event-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                ');
                }
                $buffer .= $indent . '            </ul>
';
                $buffer .= $indent . '            <div class="pt-3 pb-2 d-flex justify-content-between">
';
                $buffer .= $indent . '                <div class="w-25 bg-pulse-grey" style="height: 35px"></div>
';
                $buffer .= $indent . '            </div>
';
                $buffer .= $indent . '        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
