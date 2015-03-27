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


class Icon extends Base
{
    public function __construct($name = null, $options = [])
    {
        !isset($options['library']) ? $options['library'] = 'glyphicons' : null;

        $prefix = $this->library_prefix_for($options['library']);
        unset($options['library']);

        $this->append_class($options, $prefix);

        if (!is_null($name)) {
            $name = str_replace('_', '-', $name);
            $this->append_class($options, "$prefix-$name");
        }

        $this->set_html(new ContentTag('span', '', $options));
    }

    private function library_prefix_for($name)
    {
        switch ($name){
            case 'font-awesome': case 'font_awesome':
                return 'fa';
            case '': case 'glyphicons':
                return 'glyphicon';
            default:
                return $name;
        }
    }
}
