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
use cobisja\BootHelp\Helpers\LinkTo;
use cobisja\BootHelp\Guide\Sample;

// Change $href to match your BootHelp app root path.
$href = 'http://localhost/local_php/BootHelp/index.php';

$navs = [
    'title'=>'Navs',
    'samples'=>[
        [
            'name'=> 'Basic navs',
            'description'=>'Use <code>nav</code> without options to display the included links as a row of tabs.
Note that links are automatically wrapped in <code>li</code> tags if you use the helper <code>link_to</code> or class <code>LinkTo</code>.
Additionally, if any link matches the current URL, its <code>li</code> tag automatically gets the <code>active</code> class.',
            'php_code'=> "echo BootHelp::nav(function(){
    return [
        new LinkTo('Home', ['href'=>'/']),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
});",
            'result'=> BootHelp::nav(function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        new LinkTo('Users', ['href'=>'/users']),
        new LinkTo('Profile', ['href'=>'/profile'])
    ];
}),
            'html_code'=>'<ul class="nav nav-tabs">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with disable links',
            'description'=>'Use the <code>["disabled"=> true]</code> option to make tab disabled.',
            'php_code'=> "echo BootHelp::nav(function(){
    return [
        new LinkTo('Home', ['href'=>'/']),
        new LinkTo('Users'),
        new LinkTo('Profile', ['disabled'=>true])
    ];
});",
            'result'=> BootHelp::nav(function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        new LinkTo('Users'),
        new LinkTo('Profile', ['disabled'=>true])
    ];
}),
            'html_code'=>'<ul class="nav nav-tabs">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li class="disabled"><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with justified tabs',
            'description'=>'Use the <code>["layout"=> "justified"]</code> option to make tabs occupy the entire width of their parent.',
            'php_code'=> "echo BootHelp::nav(['layout'=>'justified'], function(){
    return [
        new LinkTo('Home', ['href'=>'/']),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
});",
            'result'=> BootHelp::nav(['layout'=>'justified'], function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
}),
            'html_code'=>'<ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with pills',
            'description'=>'Use the <code>["as"=> "pills"]</code> option to make tabs look like pills.',
            'php_code'=> "echo BootHelp::nav(['as'=>'pills'], function(){
    return [
        new LinkTo('Home', ['href'=>'/']),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
});",
            'result'=> BootHelp::nav(['as'=>'pills'], function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
}),
            'html_code'=>'<ul class="nav nav-pills">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with stacked pills',
            'description'=>'Use the <code>["layout"=> "stacked"]</code> option to make pills vertically stacked.',
            'php_code'=> "echo BootHelp::nav(['as'=>'pills', 'layout'=>'stacked'], function(){
    return [
        new LinkTo('Home', ['href'=>'/']),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
});",
            'result'=> BootHelp::nav(['as'=>'pills', 'layout'=>'stacked'], function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
}),
            'html_code'=>'<ul class="nav nav-pills nav-stacked">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with badge support',
            'description'=>'Use <code>["badge"=>value]</code> with any of nav items option to display a badge.',
            'php_code'=> "echo BootHelp::nav(['as'=>'pills'], function(){
    return [
        BootHelp::link_to('Home', ['href'=>'/', 'badge'=>42]),
        BootHelp::link_to('Profile'),
        BootHelp::link_to('Messages', ['badge'=>3])
    ];
});",
            'result'=> BootHelp::nav(['as'=>'pills'], function() use ($href) {
    return [
        BootHelp::link_to('Home', ['href'=>$href, 'badge'=>42]),
        BootHelp::link_to('Profile'),
        BootHelp::link_to('Messages', ['badge'=>3])
    ];
}),
            'html_code'=>'<ul class="nav nav-pills nav-stacked">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="#">Users</a></li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],        
        [
            'name'=> 'Navs with Dropdowns - Option 1',
            'description'=>'Dropdowns into Navs has a different behaviour. Instead to build a Button to trigger the
    the dropdown menu, a Link (<code>"a" tag</code>) is generated. So, to get a Dropdown into a Nav just define the dropdown
    as any other Nav item.',
            'php_code'=> "echo BootHelp::nav(function(){
    return [
        new LinkTo('Home', ['href'=>'/']),
        Boothelp::dropdown('Social networks', function(){
            return [
                BootHelp::link_to('Twitter'),
                BootHelp::link_to('Facebook'),
                BootHelp::divider(),
                BootHelp::link_to('Other')
            ];
        }),
        new LinkTo('Profile')
    ];
});",
            'result'=> BootHelp::nav(function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        Boothelp::dropdown('Social networks', function(){
            return [
                BootHelp::link_to('Twitter'),
                BootHelp::link_to('Facebook'),
                BootHelp::divider(),
                BootHelp::link_to('Other')
            ];
        }),
        new LinkTo('Profile')
    ];
}),
            'html_code'=>'<ul class="nav nav-tabs">
    <li class="active"><a href="/">Home</a></li>
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            Social networks
            <span class="caret"></span>
        </a>
        <ul aria-labelledby="label-dropdown-705851964" role="menu" class="dropdown-menu">
            <li><a href="#" role="menuitem">Twitter</a></li>
            <li><a href="#" role="menuitem">Facebook</a></li>
            <li class="divider"></li><li><a href="#" role="menuitem">Other</a></li>
        </ul>
    </li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Navs with Dropdowns - Option 2',
            'description'=>'Maybe you want to build the <code>Dropdown</code> outside the <code>Nav</code> and then
    put it inside the Nav definition, to get the Nav code cleaner. In these cases, you have to use <code>["into_nav"=>true]</code>
    to indicates that the Dropdown is embedded the Nav.',
            'php_code'=> "\$sub_menu = Boothelp::dropdown('Social networks', ['into_nav'=>true], function(){
    return [
        BootHelp::link_to('Twitter'),
        BootHelp::link_to('Facebook'),
        BootHelp::divider(),
        BootHelp::link_to('Others')
    ];
});
echo BootHelp::nav(function() use (\$sub_menu) {
    return [
        new LinkTo('Home', ['href'=>'/']),
        \$sub_menu
        new LinkTo('Profile')
    ];
});",
            'result'=> BootHelp::nav(function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        Boothelp::dropdown('Social networks', function(){
            return [
                BootHelp::link_to('Twitter'),
                BootHelp::link_to('Facebook'),
                BootHelp::divider(),
                BootHelp::link_to('Other')
            ];
        }),
        new LinkTo('Profile')
    ];
}),
            'html_code'=>'<ul class="nav nav-tabs">
    <li class="active"><a href="/">Home</a></li>
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            Social networks
            <span class="caret"></span>
        </a>
        <ul aria-labelledby="label-dropdown-705851964" role="menu" class="dropdown-menu">
            <li><a href="#" role="menuitem">Twitter</a></li>
            <li><a href="#" role="menuitem">Facebook</a></li>
            <li class="divider"></li><li><a href="#" role="menuitem">Other</a></li>
        </ul>
    </li>
    <li><a href="#">Profile</a></li>
</ul>'
        ],
        [
            'name'=> 'Complex navs',
            'description'=>'To include HTML tags or a long text in the nav, pass your content in a block.
You can also specify custom options which will be added to the nav’s <code>ul</code> tag.',
            'php_code'=> "echo BootHelp::nav(['as'=>'pills', 'id'=>'nav', 'class'=>'en', 'data-js'=>1], function(){
    return [
        new LinkTo('Home', ['href'=>'/']),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
});",
            'result'=> BootHelp::nav(['as'=>'pills', 'id'=>'nav', 'class'=>'en', 'data-js'=>1], function() use ($href) {
    return [
        new LinkTo('Home', ['href'=>$href]),
        new LinkTo('Users'),
        new LinkTo('Profile')
    ];
}),
            'html_code'=>'<ul data-js="1" class="en nav nav-pills" id="nav">
    <li class="active"><a href="/">Home</a></li>
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
