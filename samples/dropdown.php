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

$dropdowns = [
    'title'=>'Dropdowns',
    'samples'=>[
        [
            'name'=> 'Basic dropdowns',
            'description'=>'Use <code>dropdown</code> without options to display a button with the given caption and the included links in a dropdown menu.',
            'php_code'=> "BHP::dropdown('Menu', function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users') .
        BHP::link_to('Profile');
});",
            'result'=> BHP::dropdown('Menu', function(){return BHP::link_to('Home') . BHP::link_to('Users') . BHP::link_to('Profile');}),
            'html_code'=>'<div class="btn-group">
  <button data-toggle="dropdown" id="label-dropdown-8291654764" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
    Menu
    <span class="caret"></span>
  </button>
  <ul aria-labelledby="label-dropdown-8291654764" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Users</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Profile</a></li>
  </ul>
</div>'
        ],
        [
            'name'=> 'Right-aligned dropdowns',
            'description'=>'Use <code>dropdown</code> with the <code>["align"=> "right"]</code> option to align the dropdown to the rightmost side of the button.',
            'php_code'=> "BHP::dropdown('Menu', ['align'=>'right'], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users') .
        BHP::link_to('Profile');
});",
            'result'=> BHP::dropdown('Menu', ['align'=>'right'], function(){return BHP::link_to('Home') . BHP::link_to('Users') . BHP::link_to('Profile');}),
            'html_code'=>'<div class="btn-group">
  <button data-toggle="dropdown" id="label-dropdown-894474825" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
    Menu
    <span class="caret"></span>
  </button>
  <ul aria-labelledby="label-dropdown-894474825" role="menu" class="dropdown-menu dropdown-menu-right">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Users</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Profile</a></li>
  </ul>
</div>'
        ],
        [
            'name'=> 'Grouped dropdowns',
            'description'=> 'Use <code>dropdown</code> with the <code>["groupable"=> "true"]</code> option to have multiple dropdowns grouped on the same line, rather than stacked.',
            'php_code'=> "echo BHP::dropdown('Menu', ['groupable'=>true], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users');
});
echo BHP::dropdown('Profile', ['groupable'=>true], function(){
    return
        BHP::link_to('Edit profile');
});",
            'result'=> BHP::dropdown('Menu', ['groupable'=>true], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users');
}) .
BHP::dropdown('Profile', ['groupable'=>true], function(){
    return
        BHP::link_to('Edit profile');
}),
            'html_code'=>'<div class="btn-group">
  <button data-toggle="dropdown" id="label-dropdown-4754820020" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
    Menu
    <span class="caret"></span>
  </button>
  <ul aria-labelledby="label-dropdown-4754820020" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Users</a></li>
  </ul>
</div>
<div class="btn-group">
  <button data-toggle="dropdown" id="label-dropdown-7794476771" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
    Profile
    <span class="caret"></span>
  </button>
  <ul aria-labelledby="label-dropdown-7794476771" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Edit profile</a></li>
  </ul>
</div>'
        ],
        [
            'name'=> 'Dropups',
            'description'=> 'Use <code>dropdown</code> with the <code>["direction"=> "up"]</code> option to show a dropup, that is, a menu that appears above the button.',
            'php_code'=> "echo BHP::dropdown('Menu', ['direction'=>'up'], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users') .
        BHP::link_to('Profile');
});",
            'result'=> BHP::dropdown('Menu', ['direction'=>'up'], function(){return BHP::link_to('Home') . BHP::link_to('Users') . BHP::link_to('Profile');}),
            'html_code'=>'<div class="btn-group dropup">
  <button data-toggle="dropdown" id="label-dropdown-8750917493" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
    Menu
    <span class="caret"></span>
  </button>
  <ul aria-labelledby="label-dropdown-8750917493" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Users</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Profile</a></li>
  </ul>
</div>'
        ],
        [
            'name'=> 'Dropdown with custom button context',
            'description'=>'Use <code>dropdown</code> with the <code>"context"</code> option to change the color (and semantic context) of the toggle button.
Available contexts are <code>"default"</code> (default), <code>"primary"</code>, <code>"success"</code>, <code>"info"</code>, <code>"warning"</code> and <code>"danger"</code>.',
            'php_code'=> "echo BHP::dropdown('Menu', ['context'=>'info'], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users');
});",
            'result'=> BHP::dropdown('Menu', ['context'=>'info'], function(){return BHP::link_to('Home') . BHP::link_to('Users');}),
            'html_code'=>'<div class="btn-group">
  <button data-toggle="dropdown" id="label-dropdown-6808993477" type="button" class="dropdown-toggle btn btn-info">
    Menu
    <span class="caret"></span>
  </button>
  <ul aria-labelledby="label-dropdown-6808993477" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Users</a></li>
  </ul>
</div>'
        ],
        [
            'name'=> 'Dropdown with custom button size',
            'description'=>'Use <code>dropdown</code> with the <code>"size"</code> option to change the size of the toggle button.',
            'php_code'=> "echo BHP::dropdown('Menu', ['size'=>'extra_small'], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users');
});",
            'result'=> BHP::dropdown('Menu', ['size'=>'extra_small'], function(){return BHP::link_to('Home') . BHP::link_to('Users');}),
            'html_code'=>'<div class="btn-group">
  <button data-toggle="dropdown" id="label-dropdown-2497444321" type="button" class="dropdown-toggle btn btn-default btn-xs">
    Menu
    <span class="caret"></span>
  </button>
  <ul aria-labelledby="label-dropdown-2497444321" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Users</a></li>
  </ul>
</div>'
        ],
        [
            'name'=> 'Dropdowns with split button',
            'description'=>'Use <code>dropdown</code> with the <code>["split"=> "true"]</code> option to show a split button that only toggles the dropdown when clicked on the right side.',
            'php_code'=> "echo BHP::dropdown('Menu', ['split'=>true], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to('Users') .
        BHP::link_to('Profile');
});",
            'result'=> BHP::dropdown('Menu', ['split'=>true], function(){return BHP::link_to('Home') . BHP::link_to('Users') . BHP::link_to('Profile');}),
            'html_code'=>'<div class="btn-group">
  <button class="btn btn-default" type="button">Menu</button>
  <button data-toggle="dropdown" id="label-dropdown-6883494473" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul aria-labelledby="label-dropdown-6883494473" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Users</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Profile</a></li>
  </ul>
</div>'
        ],
        [
            'name'=> 'Complex dropdowns',
            'description'=>'To include HTML tags or a long text in the dropdown, pass your content in a closure.
You can specify a custom <code>id</code> which will be added to the dropdown’s <code>ul</code> tag.
You can also specify a custom <code>["button"=> "class"]</code> which will be added to the toggle <code>button</code> tag.',
            'php_code'=> "echo BHP::dropdown('Menu', ['split'=>true, 'id'=>'dropdown', 'button'=>['class'=>'en']], function(){
    return
        BHP::link_to('Home') .
        BHP::link_to(BHP::content_tag('em', 'Profile'));
});",
            'result'=> BHP::dropdown('Menu', ['split'=>true, 'id'=>'dropdown', 'button'=>['class'=>'en']], function(){ return BHP::link_to('Home') .  BHP::link_to(BHP::content_tag('em', 'Profile'));}),
            'html_code'=>'<div class="btn-group">
  <button class="en btn btn-default" type="button">Menu</button>
  <button data-toggle="dropdown" id="dropdown" type="button" class="dropdown-toggle en btn btn-default">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul aria-labelledby="dropdown" role="menu" class="dropdown-menu">
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Home</a></li>
    <li role="presentation"><a href="#" tabindex="-1" role="menuitem"><em>Profile</em></a></li>
  </ul>
</div>'
        ]
    ]
];
/**
 * Dropdowns samples.
 */

echo new Sample($dropdowns);
