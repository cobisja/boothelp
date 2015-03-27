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
use BHP\Helpers\LinkTo;
use BHP\Samples\Sample;

$navs = [
    'title'=>'Navs',
    'samples'=>[
        [
            'name'=> 'Basic navs',
            'description'=>'Use <code>nav</code> without options to display the included links as a row of tabs.
Note that links are automatically wrapped in <code>li</code> tags if you use the helper <code>link_to</code> or class <code>LinkTo</code>.
Additionally, if any link matches the current URL, its <code>li</code> tag automatically gets the <code>active</code> class.',
            'php_code'=> "echo BHP::nav(function(){
    return
        new LinkTo('Home', ['href'=>'/']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
});",
            'result'=> BHP::nav(function(){
    return
        new LinkTo('Home', ['href'=>'http://localhost/local_php/bhp/index.php']) .
        new LinkTo('Users', ['href'=>'/users']) .
        new LinkTo('Profile', ['href'=>'/profile']);
}),
            'html_code'=>'<ul role="tablist" class="nav nav-tabs">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with disable links',
            'description'=>'Use the <code>["disabled"=> true]</code> option to make tab disabled.',
            'php_code'=> "echo BHP::nav(function(){
    return
        new LinkTo('Home', ['href'=>'/']) .
        new LinkTo('Users') .
        new LinkTo('Profile', ['disabled'=>true]);
});",
            'result'=> BHP::nav(function(){
    return
        new LinkTo('Home', ['href'=>'http://localhost/local_php/bhp/index.php']) .
        new LinkTo('Users') .
        new LinkTo('Profile', ['disabled'=>true]);
}),
            'html_code'=>'<ul role="tablist" class="nav nav-tabs">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li class="disabled"><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with justified tabs',
            'description'=>'Use the <code>["layout"=> "justified"]</code> option to make tabs occupy the entire width of their parent.',
            'php_code'=> "echo BHP::nav(['layout'=>'justified'], function(){
    return
        new LinkTo('Home', ['href'=>'/']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
});",
            'result'=> BHP::nav(['layout'=>'justified'], function(){
    return
        new LinkTo('Home', ['href'=>'/local_php/bhp/index.php']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
}),
            'html_code'=>'<ul role="tablist" class="nav nav-tabs nav-justified" layout="justified">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with pills',
            'description'=>'Use the <code>["as"=> "pills"]</code> option to make tabs look like pills.',
            'php_code'=> "echo BHP::nav(['as'=>'pills'], function(){
    return
        new LinkTo('Home', ['href'=>'/']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
});",
            'result'=> BHP::nav(['as'=>'pills'], function(){
    return
        new LinkTo('Home', ['href'=>'/local_php/bhp/index.php']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
}),
            'html_code'=>'<ul role="tablist" class="nav nav-pills">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with stacked pills',
            'description'=>'Use the <code>["layout"=> "stacked"]</code> option to make pills vertically stacked.',
            'php_code'=> "echo BHP::nav(['as'=>'pills', 'layout'=>'stacked'], function(){
    return
        new LinkTo('Home', ['href'=>'/']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
});",
            'result'=> BHP::nav(['as'=>'pills', 'layout'=>'stacked'], function(){
    return
        new LinkTo('Home', ['href'=>'/local_php/bhp/index.php']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
}),
            'html_code'=>'<ul role="tablist" class="nav nav-pills nav-stacked" layout="stacked">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Complex navs',
            'description'=>'To include HTML tags or a long text in the nav, pass your content in a block.
You can also specify custom options which will be added to the nav’s <code>ul</code> tag.',
            'php_code'=> "echo BHP::nav(['as'=>'pills', 'id'=>'nav', 'class'=>'en', 'data-js'=>1], function(){
    return
        new LinkTo('Home', ['href'=>'/']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
});",
            'result'=> BHP::nav(['as'=>'pills', 'id'=>'nav', 'class'=>'en', 'data-js'=>1], function(){
    return
        new LinkTo('Home', ['href'=>'/local_php/bhp/index.php']) .
        new LinkTo('Users') .
        new LinkTo('Profile');
}),
            'html_code'=>'<ul role="tablist" data-js="1" class="en nav nav-pills" id="nav">
    <li class="active"><a href="/local_php/bhp/index.php">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ]
    ]
];

/**
 * Nav samples.
 */
echo new Sample($navs);
