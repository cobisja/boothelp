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

class Panel extends Base
{
    public function __construct($content_or_options_with_block = null, $options = null, $block = null)
    {
        $html = '';
        $num_args = $this->get_function_num_args(func_get_args());

        if ($num_args < 3 && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);
            $html = $this->panel_string(call_user_func($block), is_null($content_or_options_with_block) ? [] : $content_or_options_with_block);
        }
        elseif (is_array($content_or_options_with_block) && is_null($options)) {
            $html = $this->panel_string(null, $content_or_options_with_block);
        }
        else {
          $html = $this->panel_string($content_or_options_with_block, is_null($options) ? [] : $options);
        }

        $this->set_html($html);
    }

    private function panel_string($content = null, $options = [])
    {
        $content = $this->prepend_body_to($content);
        $content = $this->prepend_optional_heading_to($content, $options);
        $content = $this->optional_footer_to($content, $options);

        $tag = isset($options['tag']) ? $options['tag'] : 'div';

        if (isset($options['context'])) {
            $context = $options['context'];
            unset($options['context']);
        }
        else {
            $context = null;
        }

        $this->append_class($options, $this->panel_class($context));

        $panel_string = new ContentTag($tag, $content, $options);

        if (!is_null(Base::get_panel_column_class())) {
            $panel_string = new ContentTag('div', $panel_string, ['class'=>Base::get_panel_column_class()]);
        }

        return $panel_string;
    }

    private function panel_class($context = null)
    {
        $valid_contexts = ['primary', 'success', 'info', 'warning', 'danger'];
        $context = $this->context_for($context, ['valid' => $valid_contexts]);

        return "panel panel-$context";
    }

    private function prepend_body_to($content)
    {
        return new ContentTag('div', $content, ['class' => 'panel-body']);
    }

    private function prepend_optional_heading_to($content, &$options = [])
    {
        if ( isset($options['title']) ) {
            $title = new ContentTag('h3', $options['title'], ['class' => 'panel-title']);
            unset($options['title']);
        }
        elseif ( isset($options['heading'])) {
            $title = $options['heading'];
            unset($options['heading']);
        }
        else {
            $title = null;
        }

        $heading = !is_null(($title)) ? new ContentTag('div', $title, ['class' => 'panel-heading']) : null;

        return join( '', array_filter( [$heading, $content], 'strlen' ) );
    }

    private function optional_footer_to($content, &$options = [])
    {
        if (isset($options['footer'])) {
            $footer = $options['footer'];
            unset($options['footer']);
        }
        else {
            $footer = null;
        }

        if ($footer) {
            $footer = new ContentTag('div', $footer, ['class' => 'panel-footer']);
        }

        return join( '', array_filter( [$content, $footer], 'strlen' ) );
    }
}
