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

class Modal extends Base
{
    const MODAL_TEMPLATE = 'modal.template';


    public function __construct($content_or_options_with_block = null, $options = null, $block = null)
    {
        $html = '';

        $num_args = $this->get_function_num_args(func_get_args());

        if (3 > $num_args && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);

            $html = $this->modal_string(null, is_null($content_or_options_with_block) ? [] : $content_or_options_with_block, $block);
        }
        elseif (is_array($content_or_options_with_block) && is_null($options)) {
            $html = $this->modal_string($content_or_options_with_block);
        }
        else {
            $html = $this->modal_string($content_or_options_with_block, is_null($options) ? [] : $options);
        }

        $this->set_html($html);
    }

    private function modal_string($body, $options = null, $block = null)
    {
        $base_options['id'] = 'modal-' . (string)( mt_rand(1, pow(10, 10)) );
        $base_options['title'] = 'Modal';
        $base_options['dialog_class'] = $this->dialog_class(isset($options['size']) ? $options['size'] : null);

        if (!is_null($body)) {
            $options['body'] = $body;
        }

        $options['body'] = $this->modal_body(isset($options['body']) ? $options['body'] : null);

        if (!isset($options['button']['caption'])) {
            $options['button']['caption'] = isset($options['title']) ? $options['title'] : $base_options['title'];
        }

        $options['button']['class'] = $this->button_class(isset($options['button']) ? $options['button'] : $base_options['button']);

        $this->set_options($base_options, $options);

        $yield = is_callable($block) ? call_user_func($block) : null;
        $modal_template = file_get_contents($this->get_templates_path() . self::MODAL_TEMPLATE);

        $modal_string = preg_replace(
          ["/%button_class%/", "/%id%/", "/%button_caption%/", "/%dialog_class%/", "/%title%/", "/%body%/", "/%yield%/"],
          [
              $options['button']['class'], $options['id'], $options['button']['caption'], $options['dialog_class'],
              $options['title'], $options['body'], $yield
          ],
          $modal_template
        );

        return $modal_string;
    }

    private function button_class($options = [])
    {
        $size = null;

        $valid_contexts = ['primary', 'success', 'info', 'warning', 'danger', 'link'];
        $context = $this->context_for(isset($options['context']) ? $options['context'] : null, ['valid' => $valid_contexts]);

        if (isset($options['size'])) {
            switch ($options['size']) {
                case 'lg': case 'large': $size = 'btn-lg'; break;
                case 'sm': case 'small': $size = 'btn-sm'; break;
                case 'xs': case 'extra_small': $size = 'btn-xs'; break;
            }
        }

        return  join( ' ', array_filter( ['btn', "btn-$context", $size], 'strlen' ) );
    }

    private function dialog_class($size = null)
    {
        $size_class = null;

        switch ($size) {
            case 'lg': case 'large': $size_class = 'modal-lg'; break;
            case 'sm': case 'small': $size_class = 'modal-sm'; break;
        }

        return join( ' ', array_filter( ['modal-dialog', $size_class], 'strlen' ) );
    }

    private function modal_body($body = null)
    {
        if (!is_null($body)) {
            return new ContentTag('div', $body, ['class' => 'modal-body']);
        }
    }
}
