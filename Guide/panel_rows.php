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

$panel_rows = [
    'title'=>'Panel rows',
    'samples'=>[
        [
            'name'=> 'Basic row of panel',
            'description'=>'Use <code>panel_row</code> with the <code>column_class</code> option to wrap panels of the same size in a row.',
            'php_code'=> "echo BootHelp::panel_row(['column_class' => 'col-sm-4'], function(){
    return [
        BootHelp::panel('Panel #1'),
        BootHelp::panel('Panel #2'),
        BootHelp::panel('Panel #3')
    ];
});",
            'result'=> BootHelp::panel_row(['column_class' => 'col-sm-4'], function(){return [BootHelp::panel('Panel #1'), BootHelp::panel('Panel #2'), BootHelp::panel('Panel #3')];}),
            'html_code'=>'<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">Panel #1</div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">Panel #2</div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">Panel #3</div>
        </div>
    </div>
</div>'
        ],
        [
            'name'=> 'Complex row of panels',
            'description'=>'You can specify custom options which will be added to the panel row’s <code>div</code> tag.',
            'php_code'=> "echo BootHelp::panel_row(['column_class'=>'col-sm-6', 'id'=>'panel_row', 'class'=>'en', 'data-js'=>1], function(){
    return [
        BootHelp::panel('John Smith', ['title'=>'User', 'context'=>'info']),
        BootHelp::panel(['title'=>'Phone'], function(){
            return BootHelp::icon('earphone') . ' 323-555-5555';
        })
    ];
});",
            'result'=> BootHelp::panel_row(['column_class'=>'col-sm-6', 'id'=>'panel_row', 'class'=>'en', 'data-js'=>1], function(){
    return [
        BootHelp::panel('John Smith', ['title'=>'User', 'context'=>'info']),
        BootHelp::panel(['title'=>'Phone'], function(){
            return BootHelp::icon('earphone') . ' 323-555-5555';
        })
    ];
}),
            'html_code'=>'<div data-js="1" class="en row" id="panel_row">
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">User</h3>
            </div>
            <div class="panel-body">
                John Smith
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Phone</h3>
            </div>
            <div class="panel-body">
                <span class="glyphicon glyphicon-earphone"></span>
                323-555-5555
            </div>
        </div>
    </div>
</div>'
        ]
    ]
];

/**
 * Panel rows samples.
 */
echo new Sample($panel_rows);
