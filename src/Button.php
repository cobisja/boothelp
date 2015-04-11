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

namespace BootHelp;

use BootHelp\Base;
use BootHelp\Helpers\ContentTag;


/**
 * Class to generate a Button object.
 */
class Button extends Base {
    /**
     * Initializes the Button instance.
     *
     * @param mixed $content_or_options_with_block content of Button.
     * @param mixed $options options to build a Button.
     * @param closure $block closure to build the Button's content.
     */
    public function __construct($content_or_options_with_block = null, $options = null, $block = null) {
        $num_args = $this->get_function_num_args(func_get_args());

        if (3 > $num_args && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);
            $html = $this->build_button(call_user_func($block), is_null($content_or_options_with_block) ? [] : $content_or_options_with_block);
        } else {
            $html = $this->build_button($content_or_options_with_block, is_null($options) ? [] : $options);
        }

        $this->set_html_object($html->get_html_object());
    }

    /**
     * Builds the Button object.
     *
     * @param mixed $content Button's content.
     * @param mixed $options Button's options.
     * @return ContentTag instance of ContentTag object representing an Html Button.
     */
    private function build_button($content = null, $options = []) {
        $this->append_class($options, $this->btn_class($options));
        return new ContentTag('button', $content, $options);
    }

    /**
     * Sets the different Button classes.
     *
     * @param array $options Button's options.
     * @return string html class for the button.
     */
    private function btn_class(&$options = []) {
        $base_options = [
            'context' => null,
            'size' => '',
            'layout' => null
        ];

        $valid_contexts = [ 'primary', 'success', 'info', 'warning', 'danger', 'link' ];

        $this->set_options($base_options, $options);
        $context = $this->context_for($options['context'], ['valid' => $valid_contexts]);

        $size = null;
        switch ($options['size']) {
            case 'lg': case 'large': $size = 'btn-lg'; break;
            case 'sm': case 'small': $size = 'btn-sm'; break;
            case 'xs': case 'extra_small': $size = 'btn-xs'; break;
        }

        $layout = $options['layout'] === 'block' ? 'btn-block' : null;

        unset($options['context']);
        unset($options['size']);
        unset($options['layout']);

        return  join(Base::SPACE, array_filter(['btn', "btn-$context", $size, $layout], 'strlen'));
    }
}
