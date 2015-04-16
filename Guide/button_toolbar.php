<?php

/*
 * BootHelp
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

$toolbars = [
    'title'=>'Button Toolbar',
    'samples'=>[
        [
            'name'=>'Standard Button toolbar',
            'description'=>'Use <code>button_group</code> without options to show a series of buttons together
        on a single line.',
            'php_code'=>"echo BootHelp::button_toolbar(function() {
    return [
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 1'),
                BootHelp::button('Button 2'),
                BootHelp::button('Button 3')
            ];
        }),
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 4'),
                BootHelp::button('Button 5')
            ];
        })
    ];
});",
            'result'=>BootHelp::button_toolbar(function() {
    return [
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 1'),
                BootHelp::button('Button 2'),
                BootHelp::button('Button 3')
            ];
        }),
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 4'),
                BootHelp::button('Button 5')
            ];
        })
    ];
}),
            'html_code'=>'<div role="toolbar" aria-label="toolbar" class="btn-toolbar">
    <div role="group" aria-label="button-group" class="btn-group">
        <button class="btn btn-default">Button 1</button>
        <button class="btn btn-default">Button 2</button>
        <button class="btn btn-default">Button 3</button>
    </div>
    <div role="group" aria-label="button-group" class="btn-group">
        <button class="btn btn-default">Button 4</button>
        <button class="btn btn-default">Button 5</button>
    </div>
</div>'
        ],
        [
            'name'=>'Complex Button Toolbar',
            'description'=>'You can specify additional options wich will be used for the button toolbar <code>div</code>.',
            'php_code'=>"echo BootHelp::button_toolbar(['id'=>'my-toolbar', 'class'=>'en'], function() {
    return [
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 1'),
                BootHelp::button('Button 2'),
                BootHelp::button('Button 3')
            ];
        }),
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 4'),
                BootHelp::button('Button 5')
            ];
        })
    ];
});",
            'result'=>BootHelp::button_toolbar(['id'=>'my-toolbar', 'class'=>'en'], function() {
    return [
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 1'),
                BootHelp::button('Button 2'),
                BootHelp::button('Button 3')
            ];
        }),
        BootHelp::button_group(function(){
            return [
                BootHelp::button('Button 4'),
                BootHelp::button('Button 5')
            ];
        })
    ];
}),
            'html_code'=>'<div id="my-toolbar" role="toolbar" aria-label="toolbar" class="en btn-toolbar">
    <div role="group" aria-label="button-group" class="btn-group">
        <button class="btn btn-default">Button 1</button>
        <button class="btn btn-default">Button 2</button>
        <button class="btn btn-default">Button 3</button>
    </div>
    <div role="group" aria-label="button-group" class="btn-group">
        <button class="btn btn-default">Button 4</button>
        <button class="btn btn-default">Button 5</button>
    </div>
</div>'
        ]
    ]
];

/**
 * Button Toolbar samples.
 */
echo new Sample($toolbars);


