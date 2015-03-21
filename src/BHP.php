<?php
/*
 * pbh
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

namespace BHP;

use BHP\Helpers\ContentTag;
use BHP\Helpers\LinkTo;
use BHP\AlertBox;

/**
 * PHP Bootstrap Helper: Less code more beauty of Bootstrap's design.
 */
abstract class BHP
{
    static public $dropdown_link = false;
    static public $alert_link = false;
    static public $navbar_vertical = false;


    public static function content_tag($name, $content_or_options_with_block = null, $options = null, callable $block = null)
    {
        return new ContentTag(
            $name,
            $content_or_options_with_block,
            $options,
            $block
        );
    }

    public static function link_to($name = null, $options = [], callable $block = null)
    {
        return new LinkTo($name, $options, $block);
    }

    public static function alert_box($message_or_options_with_block = null, $options = null, $block=null)
    {
        return new AlertBox($message_or_options_with_block, $options, $block);
    }
}
