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

$thumbnails = [
    'title'=>'Thumbnails',
    'samples'=>[
        [
            'name'=> 'Basic thumbnail',
            'description'=>'Use <code>thumbnail</code> without options to display thumbnails of images, videos, text and more.',
            'php_code'=> "echo BootHelp::thumbnail([
    'column_class'=>'col-xs-6 col-md-3',
    'src'=>'pic4.jpg'
]);",
            'result'=> BootHelp::content_tag('div', ['class'=>'row'], function(){
                return BootHelp::thumbnail([
                    'column_class'=>'col-xs-6 col-md-3',
                    'src'=>'Guide/img/pic4.jpg'
                ]);
            }),
            'html_code'=>'<div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
        <img alt="pic4" src="pic4.jpg">
    </a>
</div>'
        ],
        [
            'name'=> 'Passing attributes to the thumbnail image',
            'description'=>'To pass attributes to be applied to the thumbnail image us <code>["image"=>[image attributes]]</code>.',
            'php_code'=> "echo BootHelp::thumbnail([
    'column_class'=>'col-xs-6 col-md-3',
    'src'=>'pic2.jpg',
    'image'=>['id'=>'my-image', 'class'=>'en']
]);",
            'result'=> BootHelp::content_tag('div', ['class'=>'row'], function(){
            return BootHelp::thumbnail([
    'column_class'=>'col-xs-6 col-md-3',
    'src'=>'Guide/img/pic2.jpg',
    'image'=>['id'=>'my-image', 'class'=>'en']
]);
            }),
            'html_code'=>'<div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
        <img class="en" id="my-image" alt="pic2" src="pic2.jpg">
    </a>
</div>'
        ],
        [
            'name'=> 'Set of thumbnails',
            'description'=>'When you want to display several thumbnails, wrap them all into a <code>div</code> with
    <code>class="row"</code> to get them in the same row, acording bootstrap docs.',
            'php_code'=> "echo BootHelp::content_tag('div', ['class'=>'row'], function(){
    return [
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'pic1.jpg',
            'href'=>'http://pixabay.com/'
        ]),
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'pic2.jpg'
        ]),
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'pic3.jpg'
        ]),
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'pic4.jpg'
        ])        
    ];
});",
            'result'=> BootHelp::content_tag('div', ['class'=>'row'], function(){
    return [
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'Guide/img/pic1.jpg',
            'href'=>'http://pixabay.com/'
        ]),
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'Guide/img/pic2.jpg'
        ]),
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'Guide/img/pic3.jpg'
        ]),
        BootHelp::thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'Guide/img/pic4.jpg'
        ])        
    ];
}),
            'html_code'=>'<div class="row">
    <div class="col-xs-6 col-md-3">
        <a href="http://pixabay.com/" class="thumbnail">
            <img alt="pic1" src="pic1.jpg">
        </a>
    </div>
    <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail">
            <img alt="pic2" src="pic2.jpg">
        </a>
    </div>
    <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail">
            <img alt="pic3" src="pic3.jpg">
        </a>
    </div>
    <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail">
            <img alt="pic4" src="pic4.jpg">
        </a>
    </div>
</div>'
        ],
        [
            'name'=> 'Complex thumbnails',
            'description'=>'Use closures to build complex <code>thumbnail</code> content.',
            'php_code'=> "echo BootHelp::content_tag('div', ['class'=>'row'], function(){
    return [
        BootHelp::thumbnail([
            'column_class'=>'col-sm-6 col-md-4',
            'src'=>'Guide/img/pic1.jpg',
            'href'=>'http://pixabay.com/'
        ], function(){
            return BootHelp::content_tag('div', ['class'=>'caption'], function(){
                return [
                    BootHelp::content_tag('h3', 'Thumbnail label'),
                    BootHelp::content_tag('p', 'Cras justo odio, dapibus ac facilisis in, egestas eget 
                        quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                        ultricies vehicula ut id elit.' ),
                    BootHelp::button('Button', ['context'=>'primary']),
                    BootHelp::button('Button')
                ];
            });
        }),
        BootHelp::thumbnail([
            'column_class'=>'col-sm-6 col-md-4',
            'src'=>'Guide/img/pic3.jpg',
            'href'=>'http://pixabay.com/'
        ], function(){
            return BootHelp::content_tag('div', ['class'=>'caption'], function(){
                return [
                    BootHelp::content_tag('h3', 'Thumbnail label'),
                    BootHelp::content_tag('p', 'Cras justo odio, dapibus ac facilisis in, egestas eget 
                        quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                        ultricies vehicula ut id elit.' ),
                    BootHelp::button('Button', ['context'=>'primary']),
                    BootHelp::button('Button')
                ];
            });
        }),
        BootHelp::thumbnail([
            'column_class'=>'col-sm-6 col-md-4',
            'src'=>'Guide/img/pic4.jpg',
            'href'=>'http://pixabay.com/'
        ], function(){
            return BootHelp::content_tag('div', ['class'=>'caption'], function(){
                return [
                    BootHelp::content_tag('h3', 'Thumbnail label'),
                    BootHelp::content_tag('p', 'Cras justo odio, dapibus ac facilisis in, egestas eget 
                        quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                        ultricies vehicula ut id elit.' ),
                    BootHelp::button('Button', ['context'=>'primary']),
                    BootHelp::button('Button')
                ];
            });
        })                
    ];
});",
            'result'=> BootHelp::content_tag('div', ['class'=>'row'], function(){
    return [
        BootHelp::thumbnail([
            'column_class'=>'col-sm-6 col-md-4',
            'src'=>'Guide/img/pic1.jpg',
            'href'=>'http://pixabay.com/'
        ], function(){
            return BootHelp::content_tag('div', ['class'=>'caption'], function(){
                return [
                    BootHelp::content_tag('h3', 'Thumbnail label'),
                    BootHelp::content_tag('p', 'Cras justo odio, dapibus ac facilisis in, egestas eget 
                        quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                        ultricies vehicula ut id elit.' ),
                    BootHelp::button('Button', ['context'=>'primary']),
                    BootHelp::button('Button')
                ];
            });
        }),
        BootHelp::thumbnail([
            'column_class'=>'col-sm-6 col-md-4',
            'src'=>'Guide/img/pic3.jpg',
            'href'=>'http://pixabay.com/'
        ], function(){
            return BootHelp::content_tag('div', ['class'=>'caption'], function(){
                return [
                    BootHelp::content_tag('h3', 'Thumbnail label'),
                    BootHelp::content_tag('p', 'Cras justo odio, dapibus ac facilisis in, egestas eget 
                        quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                        ultricies vehicula ut id elit.' ),
                    BootHelp::button('Button', ['context'=>'primary']),
                    BootHelp::button('Button')
                ];
            });
        }),
        BootHelp::thumbnail([
            'column_class'=>'col-sm-6 col-md-4',
            'src'=>'Guide/img/pic4.jpg',
            'href'=>'http://pixabay.com/'
        ], function(){
            return BootHelp::content_tag('div', ['class'=>'caption'], function(){
                return [
                    BootHelp::content_tag('h3', 'Thumbnail label'),
                    BootHelp::content_tag('p', 'Cras justo odio, dapibus ac facilisis in, egestas eget 
                        quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                        ultricies vehicula ut id elit.' ),
                    BootHelp::button('Button', ['context'=>'primary']),
                    BootHelp::button('Button')
                ];
            });
        })                
    ];
}),
            'html_code'=>'<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img alt="pic1" src="pic1.jpg">
            <div class="caption">
                <h3>Thumbnail label</h3>
                <p>
                    Cras justo odio, dapibus ac facilisis in, egestas eget 
                    quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                    ultricies vehicula ut id elit.
                </p>
                <button class="btn btn-primary">Button</button>
                <button class="btn btn-default">Button</button>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img alt="pic3" src="pic3.jpg">
            <div class="caption">
                <h3>Thumbnail label</h3>
                <p>
                    Cras justo odio, dapibus ac facilisis in, egestas eget 
                    quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                    ultricies vehicula ut id elit.
                </p>
                <button class="btn btn-primary">Button</button>
                <button class="btn btn-default">Button</button>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img alt="pic4" src="pic4.jpg">
            <div class="caption">
                <h3>Thumbnail label</h3>
                <p>
                    Cras justo odio, dapibus ac facilisis in, egestas eget 
                    quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                    ultricies vehicula ut id elit.
                </p>
                <button class="btn btn-primary">Button</button>
                <button class="btn btn-default">Button</button>
            </div>
        </div>
    </div>
</div>'
        ]        
    ]
];

/**
 * Thumbnail samples.
 */
echo new Sample($thumbnails);




