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

namespace BHP\Helpers;

use BHP\Base;
use BHP\Helpers\ContentTag;

class Horizontal extends Base
{
    public function __construct($content_or_options_with_block = null, $options = null, callable $block = null)
    {
        $num_args = $this->get_function_num_args(func_get_args());
        $block = is_callable(func_get_arg($num_args-1)) ? func_get_arg($num_args-1) : null;

        switch ($num_args) {
            case '1':
                $content_or_options_with_block = null;
                $options = null;
                break;
            case '2':
                $options = null;
                break;
        }

        if ($block) {
            $html = $this->horizontal_string($content_or_options_with_block ? $content_or_options_with_block : [], $block);
        }
        else {
            $html = $this->horizontal_string($options ? $options : [], $content_or_options_with_block);
        }

        $this->set_html($html);
    }

    private function horizontal_string($options = [], $block = null)
    {
        $this->append_class($options, 'collapse navbar-collapse');
        $options['id'] = $this->navbar_id();

        return new ContentTag('div', $options, $block);
    }

    private function navbar_id()
    {
        return Base::get_navbar_id();
    }
}
