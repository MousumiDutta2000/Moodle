<?php

class __Mustache_f0349e7eaff34e230bf14cfa68efa2c3 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $value = $this->resolveValue($context->findDot('output.doctype'), $context);
        $buffer .= $indent . $value;
        $buffer .= '
';
        $buffer .= $indent . '<html ';
        $value = $this->resolveValue($context->findDot('output.htmlattributes'), $context);
        $buffer .= $value;
        $buffer .= '>
';
        $buffer .= $indent . '<head>
';
        $buffer .= $indent . '    <title>';
        $value = $this->resolveValue($context->findDot('output.page_title'), $context);
        $buffer .= $value;
        $buffer .= '</title>
';
        $buffer .= $indent . '    <link rel="shortcut icon" href="';
        $value = $this->resolveValue($context->findDot('output.favicon'), $context);
        $buffer .= $value;
        $buffer .= '" />
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->findDot('output.standard_head_html'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '    <meta name="viewport" content="width=device-width, initial-scale=1.0">
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<body ';
        $value = $this->resolveValue($context->findDot('output.body_attributes'), $context);
        $buffer .= $value;
        $buffer .= '>
';
        if ($partial = $this->mustache->loadPartial('core/local/toast/wrapper')) {
            $buffer .= $partial->renderInternal($context, $indent . '    ');
        }
        $buffer .= $indent . '<div id="page-wrapper">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->findDot('output.standard_top_of_body_html'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '    <div class="header-main ">
';
        $buffer .= $indent . '        <div class="container">
';
        $buffer .= $indent . '            <nav class="navbar navbar-light bg-faded ">
';
        $buffer .= $indent . '                <a href="';
        $value = $this->resolveValue($context->findDot('config.wwwroot'), $context);
        $buffer .= $value;
        $buffer .= '/?redirect=0" class="navbar-brand ';
        // 'logourl' inverted section
        $value = $context->find('logourl');
        if (empty($value)) {
            
            $buffer .= '
';
            $buffer .= $indent . '                        hidden-sm-down
';
            $buffer .= $indent . '                    ';
        }
        $buffer .= '">
';
        $buffer .= $indent . '                    <span class="site-name hidden-sm-down">';
        $value = $this->resolveValue($context->find('sitename'), $context);
        $buffer .= $value;
        $buffer .= '</span>
';
        $buffer .= $indent . '                </a>
';
        $buffer .= $indent . '            </nav>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div id="page" class="container pb-3">
';
        $buffer .= $indent . '        <div class="row ">
';
        $buffer .= $indent . '            <div class="col-12 py-3">
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->findDot('output.page_heading'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        <div id="page-content" class="row">
';
        $buffer .= $indent . '            <section id="region-main" class="col-12" aria-label="';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section6b403a6a78537640b9e04a931aeb6463($context, $indent, $value);
        $buffer .= '">
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->findDot('output.main_content'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '            </section>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        if ($partial = $this->mustache->loadPartial('theme_eguru/footer')) {
            $buffer .= $partial->renderInternal($context, $indent . '    ');
        }
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>
';

        return $buffer;
    }

    private function section6b403a6a78537640b9e04a931aeb6463(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'content';
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
                
                $buffer .= 'content';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
