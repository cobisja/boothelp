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

$labels = [
    'title'=>'Labels',
    'samples'=>[
        [
            'name'=> 'Basic labels',
            'description'=>'Use <code>label</code> without options to display a label with the given text content.',
            'php_code'=> "echo BootHelp::label('New');",
            'result'=> BootHelp::label('New'),
            'html_code'=>'<span class="label label-default">New</span>'
        ],
        [
            'name'=> 'Contextual labels',
            'description'=>'Use label with the <code>"context"</code> option to change the color (and semantic context) of the label.
Available contexts are <code>"default"</code> (default), <code>"primary"</code>, <code>"success"</code>, <code>"info"</code>, <code>"warning"</code> and <code>"danger"</code>.',
            'php_code'=> "echo BootHelp::label('New', ['context'=>'success']);",
            'result'=> BootHelp::label('News', ['context'=>'success']),
            'html_code'=>'<span class="label label-success">New</span>'
        ],
        [
            'name'=> 'Complex label\'s content',
            'description'=>'You are not limited to pass a string as Label\'s content. You can pass others components too.
    In fact, you can pass specific attributes for the <code>span</code> tag that contains the <code>label</code> definition. 
    To get that, pass the label\'s content as a closure.',
            'php_code'=> "echo BootHelp::label(['id'=>'my-label', 'context'=>'primary'], function(){
    return [
        BootHelp::icon('headphones'),
        'Enjoy the music'
    ];
});"
        ,
            'result'=> BootHelp::label(['id'=>'my-label', 'context'=>'primary'], function(){
    return [
        BootHelp::icon('headphones'),
        'Enjoy the music'
    ];
}),
        'html_code'=>'<span class="label label-primary" id="my-label">
    <span class="glyphicon glyphicon-headphones"></span>
    Enjoy the music
</span>'
],        
        [
            'name'=> 'Complex labels',
            'description'=>'To include HTML tags or a long text in the label, pass the label\'s content as a closure.
Actually, you can combine <code>label</code> with others components to get interesting results.',
            'php_code'=> "echo BootHelp::content_tag('h1', function(){
    return [
        'Example heading ',
        BootHelp::label(['id'=>'my-label', 'class'=>'en', 'context'=>'danger'], function(){
            return [
                BootHelp::icon('heart'),
                'My Love!'
            ];
        })
    ];
});",
            'result'=> BootHelp::content_tag('h1', function(){
    return [
        'Example heading ',
        BootHelp::label(['id'=>'my-label', 'class'=>'en', 'context'=>'danger'], function(){
            return [
                BootHelp::icon('heart'),
                'My Love!'
            ];
        })
    ];
}),
            'html_code'=>'<h1>
    Example heading 
    <span id="my-label" class="en label label-default">
        <span class="glyphicon glyphicon-heart"></span>My Love!
    </span>
</h1>'
        ]
    ]
];

/**
 * Label samples.
 */

echo new Sample($labels);
