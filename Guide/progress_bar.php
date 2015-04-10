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

$progress_bar = [
    'title'=>'Progress bar',
    'samples'=>[
        [
            'name'=> 'Basic progress bar',
            'description'=>'Use <code>progress_bar</code> with the <code>percentage</code> option to show a progress bar.',
            'php_code'=> "echo BootHelp::progress_bar(['percentage'=>30]);",
            'result'=> BootHelp::progress_bar(['percentage'=>30]),
            'html_code'=>'<div class="progress">
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar">
        <span class="sr-only">30%</span>
    </div>
</div>'
        ],
        [
            'name'=> 'Progress bar with label',
            'description'=>'Use <code>progress_bar</code> with the <code>label</code> option to show a label on the progress bar.
Set <code>label</code> to a string to use a custom label, or to <code>true</code> to use its value as the label.',
            'php_code'=> "echo BootHelp::progress_bar(['percentage'=>30, 'label'=>true]);
echo BootHelp::progress_bar(['percentage'=>30, 'label'=>'thirty percent']);",
            'result'=> BootHelp::progress_bar(['percentage'=>30, 'label'=>true]) . BootHelp::progress_bar(['percentage'=>30, 'label'=>'thirty percent']),
            'html_code'=>'<div class="progress">
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar">
        30%
    </div>
</div>
<div class="progress">
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar">
        thirty percent
    </div>
</div>'
        ],
        [
            'name'=> 'Contextual progress bar',
            'description'=>'Use <code>progress_bar</code> with the <code>context</code> option to change the color (and semantic context) of the progress bar.
Available contexts are <code>success</code>, <code>info</code>, <code>warning</code> and <code>danger</code>.',
            'php_code'=> "echo BootHelp::progress_bar(['percentage'=>30, 'context'=>'warning']);",
            'result'=> BootHelp::progress_bar(['percentage'=>30, 'context'=>'warning']),
            'html_code'=>'<div class="progress">
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar progress-bar-warning">
        <span class="sr-only">30% (warning)</span>
    </div>
</div>'
        ],
        [
            'name'=> 'Striped progress bar',
            'description'=>'Use <code>progress_bar</code> with the <code>["striped"=> true]"</code> option to display a striped progress bar.',
            'php_code'=> "echo BootHelp::progress_bar(['percentage'=>30, 'striped'=>true]);",
            'result'=> BootHelp::progress_bar(['percentage'=>30, 'striped'=>true]),
            'html_code'=>'<div class="progress">
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar progress-bar-striped">
        <span class="sr-only">30%</span>
    </div>
</div>'
        ],
        [
            'name'=> 'Animated progress bar',
            'description'=>'Use progress_bar with the <code>["animated"=> true]</code> option to display a striped animated progress bar.',
            'php_code'=> "echo BootHelp::progress_bar(['percentage'=>30, 'animated'=>true]);",
            'result'=> BootHelp::progress_bar(['percentage'=>30, 'animated'=>true]),
            'html_code'=>'<div class="progress">
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar progress-bar-striped active">
        <span class="sr-only">30%</span>
    </div>
</div>'
        ],
        [
            'name'=> 'Stacked progress bar',
            'description'=>'Use <code>progress_bar</code> with an array of options to display a set of stacked progress bars.',
            'php_code'=> "echo BootHelp::progress_bar([
    ['percentage'=>30, 'context'=>'success', 'label'=>'Completed'],
    ['percentage'=>40, 'context'=>'warning', 'animated'=>true, 'label'=>'Pending']
]);",
            'result'=> BootHelp::progress_bar([
    ['percentage'=>30, 'context'=>'success', 'label'=>'Completed'],
    ['percentage'=>40, 'context'=>'warning', 'animated'=>true, 'label'=>'Pending']
]),
            'html_code'=>'<div class="progress">
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar progress-bar-success">
        Completed
    </div>
    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" style="width: 40%" role="progressbar" class="progress-bar progress-bar-warning progress-bar-striped active">
        Pending
    </div>
</div>'
        ],
        [
            'name'=> 'Complex progress bar',
            'description'=>'You can specify custom options for each progress bar which will be added to the progress bar’s <code>div</code> tag.
You can also specify custom options for the wrapping <code>div</code> container by passing them as the last argument.',
            'php_code'=> "echo BootHelp::progress_bar(['percentage'=>30, 'id'=>'bar', 'data-js'=>1], ['id'=>'container', 'class'=>'en']);",
            'result'=> BootHelp::progress_bar(['percentage'=>30, 'id'=>'bar', 'data-js'=>1], ['id'=>'container', 'class'=>'en']),
            'html_code'=>'<div class="en progress" id="container">
    <div data-js="1" id="bar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar">
        <span class="sr-only">
            30%
        </span>
    </div>
</div>'
        ]
    ]
];

/**
 * Progress bar samples.
 */
echo new Sample($progress_bar);
