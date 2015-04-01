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


class PanelRow extends Base
{
    public function __construct($options, $block = null) {
        Base::set_panel_column_class(is_array($options) && isset($options['column_class']) ? $options['column_class'] : null);
        $panel_row = new ContentTag('div', call_user_func($block), $this->set_panel_row_options($options));

        $this->set_html_object($panel_row->get_html_object());
    }

    private function set_panel_row_options($options) {
        if (isset($options['class'])) {
            $this->append_class($options, $options['class']);
        }

        $this->append_class($options, 'row');

        if (isset($options['column_class'])) {
            unset($options['column_class']);
        }

        return $options;
    }
}
