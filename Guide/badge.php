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

$badges = [
    'title'=>'Badges',
    'samples'=>[
        [
            'name'=> 'Basic badge',
            'description'=>'Use <code>badge</code> without options to display a badge component useful to highlight new or unread items.',
            'php_code'=> "echo BootHelp::link_to(function(){
    return [
        'Inbox ',
        BootHelp::badge('42')
    ];
});",
            'result'=> BootHelp::link_to(function(){return ['Inbox ', BootHelp::badge('42')];}),
            'html_code'=>'<a href="#">Inbox <span class="badge">42</span></a>'
        ],
        [
            'name'=> 'Additional options to badges',
            'description'=>'You can pass an array with the attributes for the <code>span</code> tag that defines the
    <code>badge</code> component, achieving additional customization.',
            'php_code'=> "echo BootHelp::link_to(function(){
    return [
        'Inbox ',
        BootHelp::badge('42', ['id'=>'my-badge', 'class'=>'en'])
    ];
});",
            'result'=> BootHelp::link_to(function(){
                return ['Inbox ', BootHelp::badge('42', ['id'=>'my-badge', 'class'=>'en'])];
            }),
            'html_code'=>'<a href="#">Inbox <span id="my-badge" class="en badge">42</span></a>'
        ],
        [
            'name'=> 'Implicit support for badges',
            'description'=>'All <code>BootHelp</code> components have implicit support for <code>badges</code>, so you don\'t 
    have to build a Badge component by hand. To get <code>badge</code> support, just pass <code>["badge"=>value]</code> and
    BootHelp take care to create it!.',
            'php_code'=> "echo BootHelp::link_to('Inbox', ['badge'=>42]);",
            'result'=> BootHelp::link_to('Inbox', ['badge'=>42]),
            'html_code'=>'<a href="#">Inbox <span class="badge">42</span></a>'
        ]
    ]
];

/**
 * Badge samples.
 */
echo new Sample($badges);


