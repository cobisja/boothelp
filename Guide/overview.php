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

echo BootHelp::content_tag('header', ['id'=>'top', 'role'=>'banner'], function(){
    return
        BootHelp::navbar(['class'=>'navbar-brand', 'position'=>'top'], function(){
            return BootHelp::horizontal(function(){
                return BootHelp::link_to('BootHelp - PHP Helpers for Bootstrap', ['href'=>'#overview']);
            });
        });
});
echo BootHelp::content_tag('h1', 'Overview', ['id'=>'overview', 'class'=>'page-header']);
echo BootHelp::content_tag('p', function(){
    return
    "Nowadays Bootstrap is a great framework commonly used by a lot of web designers and web developers to "
    . " build web sites with a \"fresh looking\" using its HTML and CSS based design templates "
    . "for typography, forms, buttons, navigation, and other interface components, as well "
    . "JavaScript extensions.";
});
echo BootHelp::content_tag('p', function(){
    return
    'However, to get all of its powerful resources, usually you have to write a lot of HTML code, no matters if '
    . 'you want to use a simple component, like <a href="http://getbootstrap.com/components/#modal">Modal</a> for instance.';
});
echo BootHelp::content_tag('p', function(){
    return
    "<code>BootHelp</code> (<strong>Boot</strong>strap <strong>Help</strong>ers) is a set of "
    . "classes that allow you to get all the power of Bootstrap's components with no need "
    . "to write any HTML code (or at least a minimun amount of it).";
});
echo BootHelp::content_tag('p', function(){
    return
    "You have 2 ways to use BootHelp: Using <code>BootHelp</code> abstract class and then call any of its methods. "
    . "The other way is to get an instance of the component you want and then echo it.";
});
echo BootHelp::content_tag('h4', ['class'=>'subtitle'], function(){
    return
    "Method 1 - Using BootHelp abstract class:";
});
echo BootHelp::content_tag('div', ['class'=>'bs-example'], function(){
    return '<pre><code data-lang="php">' . htmlentities("<?php
use BootHelp;

// Let's create a Modal component.
echo BootHelp::modal('How easy is to use BootHelp!!!');

...
") . '</code></pre>';
});
echo BootHelp::content_tag('h4', ['class'=>'subtitle'], function(){
    return
    "Method 2 - Using directly the component class:";
});
echo BootHelp::content_tag('div', ['class'=>'bs-example'], function(){
    return '<pre><code data-lang="php">' . htmlentities("<?php
use BootHelp\Modal;

// Let's create a Modal component.
echo new Modal('How easy is to use BootHelp!!!');

...
") . '</code></pre>';
});
echo BootHelp::content_tag('p', function(){
    return
    "<code>BootHelp</code> creates all HTML code required!!!. :-D";
});
echo BootHelp::content_tag('p', function(){
    return
    "Now let's review some examples of using <code>BootHelp</code>. "
    . "(Actually this page has been built using <code>BootHelp</code> class :-P)";
});
