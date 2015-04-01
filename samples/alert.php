<?php

/*
 * bhp
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

use BHP\BHP;
use BHP\Samples\Sample;

$alerts = [
    'title'=>'Alerts',
    'samples'=>[
        [
            'name'=>'Standard alerts',
            'description'=>'Use <code>alert_box</code> without options to display a basic informational message.',
            'php_code'=>"echo BHP::alert_box('You successfully read this important alert message.');",
            'result'=>BHP::alert_box('You successfully read this important alert message.'),
            'html_code'=>'<div class="alert alert-info" role="alert">
    You successfully read this important alert message.
</div>'
        ],
        [
            'name'=>'Dismisible alerts',
            'description'=>'Add <code>["dismissible"=> true]</code> to add a close button to the alert box.',
            'php_code'=>"echo BHP::alert_box('You accepted the Terms of service.', ['dismissible'=>true]);",
            'result'=>BHP::alert_box('You accepted the Terms of service.', ['dismissible'=>true]),
            'html_code'=>'<div class="alert alert-info alert-dismissible" role="alert">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button">
        <span aria-hidden="true">×</span>
    </button>
    You accepted the Terms of service.
</div>'
        ],
        [
            'name'=>'Contextual alerts',
            'description'=>'Set the <code>context</code> option to change the color (and semantic context) of the alert message.
Available contexts are <code>"success"</code>, <code>"info"</code> (default), <code>"warning"</code> and <code>"danger"</code>.',
            'php_code'=>"echo BHP::alert_box('You accepted the Terms of service.', ['context'=>'success']);",
            'result'=>BHP::alert_box('You accepted the Terms of service.', ['context'=>'success']),
            'html_code'=>'<div class="alert alert-success" role="alert">
    You accepted the Terms of service.
</div>'
        ],
        [
            'name'=>'Links in alerts',
            'description'=>'When a link is within any alert box, class <code>.alert-link</code> is automatically added to quickly provide matching colored links.',
            'php_code'=>"echo BHP::alert_box(['context'=>'warning', 'dismissible'=>true, 'id'=>'my-alert', 'class'=>'en', 'data-js'=>1], function(){
        return [
            '<strong>Well done!</strong> You successfully read ',
            BHP::link_to('this important alert message', ['href'=> '#']),
            '.'
        ];
});",
            'result'=>BHP::alert_box(['context'=>'warning', 'dismissible'=>true, 'id'=>'my-alert', 'class'=>'en', 'data-js'=>1], function(){
        return ['<strong>Well done!</strong> You successfully read ', BHP::link_to('this important alert message', ['href'=> '#']), '.'];
    }),
            'html_code'=>'<div data-js="1" class="en alert alert-warning alert-dismissible" id="my-alert" role="alert">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Well done!</strong> You successfully read <a class="alert-link" href="#">this important alert message</a>.
</div>'
        ]
    ]
];


/**
 * AlertBox samples.
 */
echo new Sample($alerts);
