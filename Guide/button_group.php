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

use cobisja\BootHelp\BootHelp;
use cobisja\BootHelp\Guide\Sample;

$button_groups = [
    'title'=>'Button Group',
    'samples'=>[
        [
            'name'=>'Standard Button Group',
            'description'=>'Use <code>button_group</code> without options to show a series of buttons together
        on a single line.',
            'php_code'=>"echo BootHelp::button_group(function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
});",
            'result'=>BootHelp::button_group(function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
}),
            'html_code'=>'<div role="group" aria-label="button-group" class="btn-group">
    <button class="btn btn-default">Button 1</button>
    <button class="btn btn-default">Button 2</button>
    <button class="btn btn-default">Button 3</button>
</div>'
        ],
        [
            'name'=>'Custom-sized Button Group',
            'description'=>'Instead of applying button sizing classes to every button in a group, just use
    <code>"size"</code> option.',
            'php_code'=>"echo BootHelp::button_group(['size'=>'large'], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
});",
            'result'=>BootHelp::button_group(['size'=>'large'], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
}),
            'html_code'=>'<div role="group" aria-label="button-group" class="btn-group btn-group-lg">
    <button class="btn btn-default">Button 1</button>
    <button class="btn btn-default">Button 2</button>
    <button class="btn btn-default">Button 3</button>
</div>'
        ],
        [
            'name'=>'Vertical variation',
            'description'=>'Make a set of buttons appear vertically stacked rather than horizontally using
    <code>["vertical"=>true]</code> option.',
            'php_code'=>"echo BootHelp::button_group(['vertical'=>true], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
});",
            'result'=>BootHelp::button_group(['vertical'=>true], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
}),
            'html_code'=>'<div role="group" aria-label="button-group" class="btn-group-vertical">
    <button class="btn btn-default">Button 1</button>
    <button class="btn btn-default">Button 2</button>
    <button class="btn btn-default">Button 3</button>
</div>'
        ],
        [
            'name'=>'Justified Button Group',
            'description'=>'Make a group of buttons stretch at equal sizes to span the entire width of its parent
    using <code>["justified"=>true]</code> option.',
            'php_code'=>"echo BootHelp::button_group(['justified'=>true], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
});",
            'result'=>BootHelp::button_group(['justified'=>true], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
}),
            'html_code'=>'<div role="group" aria-label="button-group" class="btn-group btn-group-justified">
    <button class="btn btn-default">Button 1</button>
    <button class="btn btn-default">Button 2</button>
    <button class="btn btn-default">Button 3</button>
</div>'
        ],
        [
            'name'=>'Complex Button Group',
            'description'=>'You can specify additional options wich will be used for the button group <code>div</code>.',
            'php_code'=>"echo BootHelp::button_group(['id'=>'my-button-group', 'class'=>'en'], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
});",
            'result'=>BootHelp::button_group(['id'=>'my-button-group', 'class'=>'en'], function(){
    return [
        BootHelp::button('Button 1'),
        BootHelp::button('Button 2'),
        BootHelp::button('Button 3')
    ];
}),
            'html_code'=>'<div id="my-button-group" role="group" aria-label="button-group" class="en btn-group">
    <button class="btn btn-default">Button 1</button>
    <button class="btn btn-default">Button 2</button>
    <button class="btn btn-default">Button 3</button>
</div>'
        ]
    ]
];

/**
 * ButtonGroup samples.
 */
echo new Sample($button_groups);

