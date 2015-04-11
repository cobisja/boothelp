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

use BootHelp\BootHelp;
use BootHelp\Guide\Sample;

$buttons = [
    'title'=>'Buttons',
    'samples'=>[
        [
            'name'=> 'Basic buttons',
            'description'=>'Use <code>button</code> without options to display a button with the given caption.',
            'php_code'=> "echo BootHelp::button('Menu');",
            'result'=> BootHelp::button('Menu'),
            'html_code'=>'<button class="btn btn-default">
    Menu
</button>'
        ],
        [
            'name'=> 'Contextual buttons',
            'description'=>'Use button with the <code>"context"</code> option to change the color (and semantic context) of the toggle button.
Available contexts are <code>"default"</code> (default), <code>"primary"</code>, <code>"success"</code>, <code>"info"</code>, <code>"warning"</code> and <code>"danger"</code>.',
            'php_code'=> "echo BootHelp::button('Menu', ['context'=>'info']);",
            'result'=> BootHelp::button('Menu', ['context'=>'info']),
            'html_code'=>'<button class="btn btn-info">
    Menu
</button>'
        ],
[
            'name'=> 'Custom-sized buttons',
            'description'=>'Use button with the <code>"size"</code> option to change the size of the button.',
            'php_code'=> "echo BootHelp::button('Menu', ['size'=>'large']);",
            'result'=> BootHelp::button('Menu', ['size'=>'large']),
            'html_code'=>'<button class="btn btn-default btn-lg">
    Menu
</button>'
        ],
        [
            'name'=> 'Block-level buttons',
            'description'=>'Use button with the <code>["layout"=> "block"]</code> option to display a button that spans the full width of the parent.',
            'php_code'=> "echo BootHelp::button('Menu', ['layout'=>'block']);",
            'result'=> BootHelp::button('Menu', ['layout'=>'block']),
            'html_code'=>'<button class="btn btn-default btn-block">
    Menu
</button>'
        ],
        [
            'name'=> 'Complex buttons',
            'description'=>'To include HTML tags or a long text in the button, pass the caption as a closure.
You can also specify custom options which will be added to the <code>button</code> tag.',
            'php_code'=> "echo BootHelp::button(['context'=>'warning', 'id'=>'button', 'class'=>'en', 'data-js'=>1], function(){
    return 'Your <em>personal</em> menu';",
            'result'=> BootHelp::button(['context'=>'warning', 'id'=>'button', 'class'=>'en', 'data-js'=>1], function(){
            return 'Your <em>personal</em> menu';}),
            'html_code'=>'<button data-js="1" class="en btn btn-warning" id="button">
    Your <em>personal</em> menu
</button>'
        ]
    ]
];

/**
 * Button samples.
 */

echo new Sample($buttons);
