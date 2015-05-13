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

namespace cobisja\BootHelp;

use cobisja\BootHelp\Base;
use cobisja\BootHelp\Helpers\ContentTag;


/**
 * Generates an HTML block tag that follows the Bootstrap documentation
 * on how to display multiple column panels using <strong>Panel</strong> component.
 *
 * See {@link http://getbootstrap.com/css/#grid} for more information.
 */
class PanelRow extends Base {
    /**
     * Initializes the PanelRow instance.
     *
     * @param mixed $options [optional] the display options for the panel.
     * @param Callable $block [optional] Block to generate inside panel row content.
     */
    public function __construct($options, $block = null) {
        Base::set_panel_column_class(is_array($options) && isset($options['column_class']) ? $options['column_class'] : null);
        $panel_row = new ContentTag('div', call_user_func($block), $this->set_panel_row_options($options));

        $this->set_html_object($panel_row->get_html_object());
    }

    /**
     * Add the class 'row' to indicates that this object has to be built like a PanelRow.
     * 
     * @param array $options Panel information.
     * @return array options processed.
     */
    private function set_panel_row_options($options) {
        $this->append_class($options, 'row');

        if (isset($options['column_class'])) {
            unset($options['column_class']);
        }

        return $options;
    }
}
