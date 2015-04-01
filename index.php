<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="samples/css/bootstrap.min.css" rel="stylesheet">

        <!-- BHP -->
        <link href="samples/css/bhp_samples.css" rel="stylesheet">

        <!-- Font awesome css -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />
    </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col-md-9" role="main">
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

/**
 * Sample file to show you how to use BHP - Bootstrap Helpers using PHP
 *
 * To get running this demo you have to download the followings pieces of software:
 *
 * - jQuery 1.9.x -> http://jquery.com
 * - Bootsrap 3.3.x -> http://getbootstrap.com
 *
 * Then copy the followings files into specified locations:
 *
 * bootstrap css: 'bootstrap.min -> 'samples/css'.
 * bootstrap fonts: 'bootstrap/fonts/*' -> 'samples/fonts'.
 * jquery and bootstrap js: 'bootstrap.min.js and jquery.min.js -> 'samples/js'.
 *
 * Aditional css is required to use 'Font awesome'. You have to add a link to awesome.css:
 * <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />
 */
require 'vendor/autoload.php';

use BHP\Helpers\ContentTag;
use BHP\Helpers\LinkTo;
use BHP\AlertBox;
use BHP\Button;
use BHP\Dropdown;
use BHP\Icon;
use BHP\Modal;
use BHP\Nav;
use BHP\Navbar;
use BHP\Helpers\Horizontal;
use BHP\Helpers\Vertical;
use BHP\Panel;
use BHP\PanelRow;
use BHP\ProgressBar;

//$dd = new Dropdown('Menu', function(){
//    return [new LinkTo('Home'), new LinkTo('Users') , new LinkTo('Profile')];
//});
//echo $dd;

//include('samples/html/start_page.html');

//$bt = new Button(['context'=>'warning', 'id'=>'button', 'class'=>'en', 'data-js'=>1], function(){
//    return ['Your ', new ContentTag('em', 'personal'), 'menu'];
//});
//echo $bt;

//
//$ct = new ContentTag('p', 'Hello world');
//$ct = new ContentTag('div', ['id'=>'sample'], function(){
//    return [
//        new ContentTag('button', ['type'=>'button', 'class'=>'close'], function(){
//            return new ContentTag('span', '&times;', ['aria-hidden'=>true]);
//        }),
//        '<strong>Warning!</strong> Better check yourself.'
//    ];
//});
//echo $ct;
//$ct = new ContentTag('p', ['class'=> 'demo main-demo en', 'id'=>'ct2'], function(){
//    return new ContentTag('strong','Hello world',  ['disabled'=>true]);
//});
//echo $ct;
//
//$link = new LinkTo(['class'=>'new en2', 'id'=>'lnk'], function(){
//    return 'Add new ' . new ContentTag('strong', 'User');
//});
//echo $link;

//$ab = new AlertBox (['context'=>'warning', 'dismissible'=>true, 'id'=>'my-alert', 'class'=>'en', 'data-js'=>1], function(){
//        return [
//            '<strong>Well done!</strong> You successfully read ',
//            new LinkTo('this important alert message', ['href'=> '#']),
//            '.'
//        ];
//    });
//echo $ab;

//$i = new Icon('user');
//echo $i;
//$m = new Modal('Do what you want!', ['button'=>['caption'=>'Click me']]);
//echo $m;

//$n = new Nav(function(){
//    return [
//        new LinkTo('Home', ['href'=>'http://localhost/local_php/bhp/index.php']),
//        new LinkTo('Users'),
//        new LinkTo('Profile')
//    ];
//});
//echo $n;

//$nb = new Navbar(['position'=>'top'], function(){
//    return [
//        new Vertical(function(){
//            return new LinkTo('Home');
//        }),
//        new Horizontal(function(){
//            return new Nav(['class'=>'navbar-right'], function(){
//                return [
//                    new LinkTo('Profile'),
//                    new LinkTo('Settings')
//                ];
//            });
//        })
//    ];
//});

//echo $nb;

//$p = new Panel('You accepted the Terms of service.', ['footer'=>'Congratulations']);
//echo $p;

//$pr = new PanelRow(['column_class'=>'col-sm-4'], function (){
//    return [
//        new Panel('Panel #1'),
//        new Panel('Panel #2'),
//        new Panel('Panel #3')
//    ];
//});
//echo $pr;

//$pb = new ProgressBar(['percentage'=>30, 'id'=>'bar', 'data-js'=>1], ['id'=>'container', 'class'=>'en']);
//echo $pb;

require('samples/overview.php');
require('samples/alert.php');
require('samples/button.php');
require('samples/dropdown.php');
require('samples/icon.php');
require('samples/modal.php');
require('samples/nav.php');
require('samples/navbar.php');
require('samples/panel.php');
require('samples/panel_rows.php');
require('samples/progress_bar.php');
//include('samples/html/end_page.html');

?>
                </div>
                <div class="col-md-3">
                   <div role="complementary" class="sidebar  affix">
                        <ul class="nav bs-docs-sidenav">
                          <li><a href="#overview">Overview</a></li>
                          <li><a href="#alerts">Alerts</a></li>
                          <li><a href="#buttons">Buttons</a></li>
                          <li><a href="#dropdowns">Dropdowns</a></li>
                          <li><a href="#icons">Icons</a></li>
                          <li><a href="#modals">Modals</a></li>
                          <li><a href="#navs">Navs</a></li>
                          <li><a href="#navbars">Navbars</a></li>
                          <li><a href="#panels">Panels</a></li>
                          <li><a href="#panel-rows">Panel rows</a></li>
                          <li><a href="#progress-bar">Progress bars</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="samples/js/jquery.min.js"></script>
        <script src="samples/js/bootstrap.min.js"></script>
        <script src="samples/js/bhp_samples.js"></script>
    </body>
</html>
