<?php

/*
 * cobisja\BootHelp
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
 * on how to display <strong>Button Toolbar</strong>.
 *
 * See {@link http://getbootstrap.com/components/#btn-groups-toolbar} for more information.
 */
class ButtonToolbar extends Base {
    /**
     * Initializes the ButtonToolbar instance.
     *
     * @param mixed $options the display options for the ButtonToolbar.
     * @param Callable $block Block to generate inside ButtonToolbar content.
     */
    public function __construct($options, $block = null) {
        if (is_callable($options)) {
            $block = $options;
            $options = [];
        }

        $button_toolbar = $this->build_button_toolbar($options, $block);
        $this->set_html_object($button_toolbar->get_html_object());
    }

    /**
     * Generates de ButtonToolbar object.
     *
     * @param array $options
     * @param type $block
     * @return ContentTag
     */
    private function build_button_toolbar(Array $options, $block) {
        $this->append_class($options, 'btn-toolbar');

        return new ContentTag('div', array_merge($options, ['aria-label'=>'toolbar', 'role'=>'toolbar']), function() use ($block) {
            return call_user_func($block);
        });
    }
}
