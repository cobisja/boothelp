<?php

/*
 * BootHelp - PHP Helpers for Bootstrap
 *
 * (The MIT License)
 *
 * Copyright (c) 2015 Jorge Cobis <jcobis@gmail.com / http://twitter.com/cobisja>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

use cobisja\BootHelp\BootHelp;
use cobisja\BootHelp\Guide\Sample;

$panels = [
    'title'=>'Panels',
    'samples'=>[
        [
            'name'=> 'Basic panels',
            'description'=>'Use <code>panel</code> without options to display a basic panel.',
            'php_code'=> "echo BootHelp::panel('You accepted the Terms of service.');",
            'result'=> BootHelp::panel('You accepted the Terms of service.'),
            'html_code'=>'<div class="panel panel-default">
    <div class="panel-body">You accepted the Terms of service.</div>
</div>'
        ],
        [
            'name'=> 'Panel with headings',
            'description'=>'Use the <code>heading</code> options to display a heading above the panel.',
            'php_code'=> "echo BootHelp::panel('You accepted the Terms of service.', ['heading'=>'Congratulations']);",
            'result'=> BootHelp::panel('You accepted the Terms of service.', ['heading'=>'Congratulations']),
            'html_code'=>'<div class="panel panel-default">
    <div class="panel-heading">Congratulations</div>
    <div class="panel-body">You accepted the Terms of service.</div>
</div>'
        ],
        [
            'name'=> 'Panel with footer',
            'description'=>'Use the <code>footer</code> options to display a footer below the panel.',
            'php_code'=> "echo BootHelp::panel('You accepted the Terms of service.', ['footer'=>'Pay attention to this!']);",
            'result'=> BootHelp::panel('You accepted the Terms of service.', ['footer'=>'Pay attention to this!']),
            'html_code'=>'<div class="panel panel-default">
    <div class="panel-body">You accepted the Terms of service.</div>
    <div class="panel-footer">Pay attention to this!</div>
</div>'
        ],
        [
            'name'=> 'Panel with title',
            'description'=>'Use the <code>title</code> options to display a title above the panel.',
            'php_code'=> "echo BootHelp::panel('You accepted the Terms of service.', ['title'=>'Congratulations']);",
            'result'=> BootHelp::panel('You accepted the Terms of service.', ['title'=>'Congratulations']),
            'html_code'=>'<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Congratulations</h3>
    </div>
    <div class="panel-body">
        You accepted the Terms of service.
    </div>
</div>'
        ],
        [
            'name'=> 'Contextual panels',
            'description'=>'Set the <code>"context"</code> option to change the color (and semantic context) of the panel.
Available contexts are <code>"default"</code> (default), <code>"primary"</code>, <code>"success"</code>, <code>"info"</code>, <code>"warning"</code> and <code>"danger"</code>.',
            'php_code'=> "echo BootHelp::panel('You accepted the Terms of service.', ['title'=>'Thanks', 'context'=>'success']);",
            'result'=> BootHelp::panel('You accepted the Terms of service.', ['title'=>'Thanks', 'context'=>'success']),
            'html_code'=>'<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Thanks</h3>
    </div>
    <div class="panel-body">You accepted the Terms of service.</div>
</div>'
        ],
        [
            'name'=> 'Panels with custom tag',
            'description'=> 'Set the <code>tag</code> option to use a different HTML tag to wrap the panel.',
            'php_code'=> "echo BootHelp::panel('You accepted the Terms of service.', ['tag'=>'aside']);",
            'result'=> BootHelp::panel('You accepted the Terms of service.', ['tag'=>'aside']),
            'html_code'=>'<aside class="panel panel-default">
    <div class="panel-body">You accepted the Terms of service.</div>
</aside>'
        ],
        [
            'name'=> 'Complex panels',
            'description'=>'To include HTML tags or a long text in the panel, pass your content in a block.
You can also specify custom options which will be added to the alert’s <code>div</code> tag.',
            'php_code'=> "echo BootHelp::panel(['heading'=>'Thanks', 'context'=>'info', 'id'=>'panel', 'class'=>'en', 'data-js'=>1], function(){
    return 'You accepted the Terms of service. ' . BootHelp::icon('ok');
});",
            'result'=> BootHelp::panel(['heading'=>'Thanks', 'context'=>'info', 'id'=>'panel', 'class'=>'en', 'data-js'=>1], function(){
    return 'You accepted the Terms of service. ' . BootHelp::icon('ok');
}),
            'html_code'=>'<div data-js="1" class="en panel panel-info" id="panel">
    <div class="panel-heading">Thanks</div>
    <div class="panel-body">
        You accepted the Terms of service.
        <span class="glyphicon glyphicon-ok"></span>
    </div>
</div>'
        ]
    ]
];

/**
 * Panel samples.
 */
echo new Sample($panels);
