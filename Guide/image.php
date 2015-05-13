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

$images = [
    'title'=>'Images',
    'samples'=>[
        [
            'name'=> 'Basic images',
            'description'=>'Use <code>image</code> without any extra options to display a simple image.',
            'php_code'=> "echo BootHelp::image(['src'=>'pic3.jpg']);",
            'result'=> BootHelp::image(['src'=>'Guide/img/pic3.jpg']),
            'html_code'=>'<img alt="pic3" src="pic3.jpg">'
        ],
        [
            'name'=> 'Responsive images',
            'description'=>'Image can be made responsive using <code>["responsive"=>true]</code> option.',
            'php_code'=> "echo BootHelp::image(['src'=>'pic3.jpg', 'responsive'=>true]);",
            'result'=> BootHelp::image(['src'=>'Guide/img/pic3.jpg', 'responsive'=>true]),
            'html_code'=>'<img class="img-responsive" alt="pic3" src="pic3.jpg">'
        ],
        [
            'name'=> 'Image shapes',
            'description'=>'Image can be easily styled using <code>shape</code> option. Available shapes values are
    <code>rounded</code>, <code>circle</code> and <code>thumbnail</code>.',
            'php_code'=> "echo BootHelp::image(['src'=>'pic3.jpg', 'shape'=>'circle']);",
            'result'=> BootHelp::image(['src'=>'Guide/img/pic3.jpg', 'shape'=>'circle']),
            'html_code'=>'<img class="img-circle" alt="pic3" src="pic3.jpg">'
        ],
        [
            'name'=> 'Additional attributes and complex content',
            'description'=>'You can pass additional attributes to the <code>img</code> tag using options array. 
    Also, if you need to build a complex image content, do it using a closure.',
            'php_code'=> "echo BootHelp::image(['src'=>'pic3.jpg', 'id'=>'my-image', 'class'=>'en', 'shape'=>'thumbnail']);",
            'result'=> BootHelp::image(['src'=>'Guide/img/pic3.jpg', 'id'=>'my-image', 'class'=>'en', 'shape'=>'thumbnail']),
            'html_code'=>'<img alt="pic3" class="en img-thumbnail" id="my-image" src="pic3.jpg">'
        ]
    ]
];

/**
 * Images samples.
 */

echo new Sample($images);
