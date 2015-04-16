<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="Guide/css/bootstrap.min.css" rel="stylesheet">

        <!-- BootHelp -->
        <link href="Guide/css/boothelp.css" rel="stylesheet">

        <!-- Font awesome css -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />
    </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col-md-9" role="main">
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

/**
 * Guide to how to use BootHelp - PHP Helpers for Bootstrap
 *
 * To get running this web guide you have to download the followings pieces of software:
 *
 * - jQuery 1.9.x -> http://jquery.com
 * - Bootsrap 3.3.x -> http://getbootstrap.com
 *
 * Then copy the followings files into specified locations:
 *
 * bootstrap css: 'bootstrap.min.css -> 'Guide/css'.
 * bootstrap fonts: 'bootstrap/fonts/*' -> 'Guide/fonts'.
 * jquery and bootstrap js: 'bootstrap.min.js and jquery.min.js -> 'Guide/js'.
 *
 * Aditional css is required to use 'Font awesome'. You have to add a link to awesome.css:
 * <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />
 */
require 'vendor/autoload.php';

require('Guide/overview.php');
require('Guide/alert.php');
require('Guide/button.php');
require('Guide/button_group.php');
require('Guide/button_toolbar.php');
require('Guide/dropdown.php');
require('Guide/icon.php');
require('Guide/modal.php');
require('Guide/nav.php');
require('Guide/navbar.php');
require('Guide/panel.php');
require('Guide/panel_rows.php');
require('Guide/progress_bar.php');

use BootHelp\Nav;
use BootHelp\Helpers\LinkTo;
?>
                </div>
                <div class="col-md-3">
                   <div role="complementary" class="sidebar  affix">
                       <?php
                        echo new Nav(['as'=>'single', 'class'=>'bs-docs-sidenav'], function(){
                            return [
                                new LinkTo('Overview', ['href'=>'#overview']),
                                new LinkTo('Alerts', ['href'=>'#alerts']),
                                new LinkTo('Buttons', ['href'=>'#buttons']),
                                new LinkTo('Button Group', ['href'=>'#button-group']),
                                new LinkTo('Button Toolbar', ['href'=>'#button-toolbar']),
                                new LinkTo('Dropdowns', ['href'=>'#dropdowns']),
                                new LinkTo('Icons', ['href'=>'#icons']),
                                new LinkTo('Modals', ['href'=>'#modals']),
                                new LinkTo('Navs', ['href'=>'#navs']),
                                new LinkTo('Navbars', ['href'=>'#navbars']),
                                new LinkTo('Panels', ['href'=>'#panels']),
                                new LinkTo('Panel rows', ['href'=>'#panel-rows']),
                                new LinkTo('Progress bars', ['href'=>'#progress-bar'])
                            ];
                        });
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="Guide/js/jquery.min.js"></script>
        <script src="Guide/js/bootstrap.min.js"></script>
        <script src="Guide/js/boothelp.js"></script>
    </body>
</html>
