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


class Panel extends Base {
    public function __construct($content_or_options_with_block = null, $options = null, $block = null) {
        $html = '';
        $num_args = $this->get_function_num_args(func_get_args());

        if ($num_args < 3 && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);
            $html = $this->panel_string(call_user_func($block), is_null($content_or_options_with_block) ? [] : $content_or_options_with_block);
        } elseif (is_array($content_or_options_with_block) && is_null($options)) {
            $html = $this->panel_string(null, $content_or_options_with_block);
        } else {
          $html = $this->panel_string($content_or_options_with_block, is_null($options) ? [] : $options);
        }

        $this->set_html_object($html->get_html_object());
    }

    private function panel_string($content = null, $options = []) {
        !is_array($options) ? $options = [] : null;

        $body = $this->build_panel_body($content);
        $heading = $this->build_panel_heading($options);
        $footer = $this->build_panel_footer($options);

        if (isset($options['tag'])) {
            $tag = $options['tag'];
            unset($options['tag']);
        } else {
            $tag = 'div';
        }

        if (isset($options['context'])) {
            $context = $options['context'];
            unset($options['context']);
        } else {
            $context = null;
        }

        $this->append_class($options, $this->panel_class($context));

        $panel_string = new ContentTag($tag, $options, function() use ($heading, $body, $footer) {
            return [$heading, $body, $footer];
        });

        if (!is_null(Base::get_panel_column_class())) {
            $panel_string = new ContentTag('div', $panel_string, ['class'=>Base::get_panel_column_class()]);
        }

        return $panel_string;
    }

    private function panel_class($context = null) {
        $valid_contexts = ['primary', 'success', 'info', 'warning', 'danger'];
        $context = $this->context_for($context, ['valid' => $valid_contexts]);

        return "panel panel-$context";
    }

    private function build_panel_body($content) {
        return new ContentTag('div', $content, ['class' => 'panel-body']);
    }

    private function build_panel_heading(&$options = []) {
        if ( isset($options['title']) ) {
            $title = new ContentTag('h3', $options['title'], ['class' => 'panel-title']);
            unset($options['title']);
        } elseif ( isset($options['heading'])) {
            $title = $options['heading'];
            unset($options['heading']);
        } else {
            $title = null;
        }

        $heading = !is_null(($title)) ? new ContentTag('div', $title, ['class' => 'panel-heading']) : '';

        return $heading;
    }

    private function build_panel_footer(&$options = []) {
        if (isset($options['footer'])) {
            $footer = new ContentTag('div', $options['footer'], ['class' => 'panel-footer']);
            unset($options['footer']);
        } else {
            $footer = '';
        }

        return $footer;
    }
}
