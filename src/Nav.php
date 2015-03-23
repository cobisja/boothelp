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

namespace BHP;

use BHP\Base;
use BHP\Helpers\ContentTag;

class Nav extends Base
{
    public function __construct($options = [], $block = null)
    {
        $num_args = $this->get_function_num_args(func_get_args());

        if (2 > $num_args && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);
            $options = [];
        }

        Base::set_nav_link(true);
        $html = new ContentTag('ul', $this->nav_options($options), $block);
        Base::set_nav_link(false);

        $this->set_html($html);
    }

    private function nav_options($options = [])
    {
        $this->append_class($options, 'nav');

        if (Base::get_navbar_id()) {
            $this->append_class($options, 'navbar-nav');
        }
        else {
            $options['role'] = 'tablist';

            if (isset($options['as'])) {
                $as = $options['as'];
                unset($options['as']);
            }
            else {
                $as = 'tabs';
            }

            $this->append_class($options, "nav-$as");

            if (isset($options['layout'])) {
                $this->append_class($options, "nav-{$options['layout']}");
            }
      }

      return $options;
//      return isset($options['role']) ? [ 'role'=>$options['role'], 'class'=>$options['class'] ] : [ 'class'=>$options['class'] ];
    }
}
