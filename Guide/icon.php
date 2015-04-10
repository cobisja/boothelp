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

$icons = [
    'title'=>'Icons',
    'samples'=>[
        [
            'name'=> 'Basic example',
            'description'=>'Use <code>icon</code> without options to display any of the <a href="http://getbootstrap.com/components/#icons">200 glyphicons</a> available in Bootstrap.',
            'php_code'=> "BootHelp::icon('user');",
            'result'=> BootHelp::icon('user'),
            'html_code'=>'<span class="glyphicon glyphicon-user"></span>'
        ],
        [
            'name'=> 'Font awesome example',
            'description'=>'Use <code>icon</code> with the <code>["library"=> "font_awesome"]</code> option to display any of the <a href="http://fortawesome.github.io/Font-Awesome/icons">479 icons</a> available in Font Awesome.
You can also specify custom options which will be added to the alert’s <code>span</code> tag.',
            'php_code'=> "BootHelp::icon('user', ['library'=>'font_awesome', 'class'=>'fa-2x', 'id'=>'icon', 'data-value'=>1]);",
            'result'=> BootHelp::icon('user', ['library'=>'font_awesome', 'class'=>'fa-2x', 'id'=>'icon', 'data-value'=>1]),
            'html_code'=>'<span data-value="1" id="icon" class="fa-2x fa fa-user"></span>'
        ]
    ]
];

/**
 * Icon samples.
 */
echo new Sample($icons);
