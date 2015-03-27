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

include('samples/html/start_page.html');
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
include('samples/html/end_page.html');
