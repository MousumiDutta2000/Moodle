<?php

class __Mustache_9a654ebea4dc141cb2ae3799c4aaab3d extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'promatedcourse' section
        $value = $context->find('promatedcourse');
        $buffer .= $this->section46bcac7ad8d68a5df683e318481964e7($context, $indent, $value);

        return $buffer;
    }

    private function sectionA3fc7f5fa88d651e2d95e053aa42fc16(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="course-box">
                                <div class="thumb">
                                    <a href="{{courseurl}}"><img src="{{imgurl}}" width="135" height="135" alt=""></a>
                                </div>
                                <div class="info">
                                    <h5><a href="{{courseurl}}"> {{coursename}} </a></h5>
                                </div>
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
                
                $buffer .= $indent . '                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
';
                $buffer .= $indent . '                            <div class="course-box">
';
                $buffer .= $indent . '                                <div class="thumb">
';
                $buffer .= $indent . '                                    <a href="';
                $value = $this->resolveValue($context->find('courseurl'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"><img src="';
                $value = $this->resolveValue($context->find('imgurl'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" width="135" height="135" alt=""></a>
';
                $buffer .= $indent . '                                </div>
';
                $buffer .= $indent . '                                <div class="info">
';
                $buffer .= $indent . '                                    <h5><a href="';
                $value = $this->resolveValue($context->find('courseurl'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"> ';
                $value = $this->resolveValue($context->find('coursename'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' </a></h5>
';
                $buffer .= $indent . '                                </div>
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB31cfced026f12d1566b8007f7363c7b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <div class="carousel-item">
                        {{#.}}
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="course-box">
                                <div class="thumb">
                                    <a href="{{courseurl}}"><img src="{{imgurl}}" width="135" height="135" alt=""></a>
                                </div>
                                <div class="info">
                                    <h5><a href="{{courseurl}}"> {{coursename}} </a></h5>
                                </div>
                            </div>
                        </div>
                        {{/.}}
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
                
                $buffer .= $indent . '                    <div class="carousel-item">
';
                // '.' section
                $value = $context->last('.');
                $buffer .= $this->sectionA3fc7f5fa88d651e2d95e053aa42fc16($context, $indent, $value);
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section46bcac7ad8d68a5df683e318481964e7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
<div class="custom-courses-list" class="Promoted-Courses">
    <div class="container-fluid">
        <div class="titlebar with-felements">
            <h2> {{promotedtitle}} </h2>
            <div id="promatedcourse-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    {{#courses}}
                    <div class="carousel-item">
                        {{#.}}
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="course-box">
                                <div class="thumb">
                                    <a href="{{courseurl}}"><img src="{{imgurl}}" width="135" height="135" alt=""></a>
                                </div>
                                <div class="info">
                                    <h5><a href="{{courseurl}}"> {{coursename}} </a></h5>
                                </div>
                            </div>
                        </div>
                        {{/.}}
                    </div>
                    {{/courses}}
                </div>
                <a class="carousel-control carousel-control-prev" href="#promatedcourse-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control carousel-control-next" href="#promatedcourse-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
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
                
                $buffer .= $indent . '<div class="custom-courses-list" class="Promoted-Courses">
';
                $buffer .= $indent . '    <div class="container-fluid">
';
                $buffer .= $indent . '        <div class="titlebar with-felements">
';
                $buffer .= $indent . '            <h2> ';
                $value = $this->resolveValue($context->find('promotedtitle'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' </h2>
';
                $buffer .= $indent . '            <div id="promatedcourse-carousel" class="carousel slide" data-ride="carousel">
';
                $buffer .= $indent . '                <div class="carousel-inner">
';
                // 'courses' section
                $value = $context->find('courses');
                $buffer .= $this->sectionB31cfced026f12d1566b8007f7363c7b($context, $indent, $value);
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '                <a class="carousel-control carousel-control-prev" href="#promatedcourse-carousel" role="button" data-slide="prev">
';
                $buffer .= $indent . '                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
';
                $buffer .= $indent . '                    <span class="sr-only">Previous</span>
';
                $buffer .= $indent . '                </a>
';
                $buffer .= $indent . '                <a class="carousel-control carousel-control-next" href="#promatedcourse-carousel" role="button" data-slide="next">
';
                $buffer .= $indent . '                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
';
                $buffer .= $indent . '                    <span class="sr-only">Next</span>
';
                $buffer .= $indent . '                </a>
';
                $buffer .= $indent . '            </div>
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '</div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
