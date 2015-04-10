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


class Modal extends Base {
    public function __construct($content_or_options_with_block = null, $options = null, $block = null) {
        $html = '';

        $num_args = $this->get_function_num_args(func_get_args());

        if (3 > $num_args && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);
            if (is_string($content_or_options_with_block)) {
                $content = $content_or_options_with_block;
                $options = [];
            } elseif (is_array($content_or_options_with_block)) {
                $content = null;
                $options = $content_or_options_with_block;
            } elseif (is_callable($content_or_options_with_block)) {
                $content_or_options_with_block = null;
                $content = null;
                $options = [];
            }
            $html = $this->get_modal($content, $options, $block);
        } else {
            $html = $this->get_modal($content_or_options_with_block, is_null($options) ? [] : $options);
        }

        $this->set_html_object($html);
    }

    private function get_modal($body, $options = null, $block = null) {
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
        $yield = is_callable($block) ? call_user_func($block) : '';
        $modal = $this->build_modal($options, $yield);

        return $modal->get_html_object();
    }

    private function build_modal($options, $yield) {
        return new ContentTag('div', ['id'=>'modal-container-' . $options['id']], function() use ($options, $yield) {
            return [
                new ContentTag('button', $options['button']['caption'], ['class'=>$options['button']['class'], 'data-toggle'=>'modal', 'data-target'=>'#' . $options['id']]),
                new ContentTag('div', ['class'=>'modal fade', 'id'=>$options['id'], 'tabindex'=>-1, 'role'=>'dialog', 'arialabelledby'=>'label-' . $options['id'], 'aria-hidden'=>true], function() use ($options, $yield) {
                    return new ContentTag('div', ['class'=>$options['dialog_class']], function() use ($options, $yield) {
                        return new ContentTag('div', ['class'=>'modal-content'], function() use ($options, $yield) {
                            return [
                                new ContentTag('div', ['class'=>'modal-header'], function() use ($options, $yield) {
                                    return [
                                        new ContentTag('button', ['type'=>'button', 'class'=>'close', 'data-dismiss'=>'modal'], function(){
                                            return [
                                                new ContentTag('span', '&times', ['aria-hidden'=>true]),
                                                new ContentTag('span', 'Close', ['class'=>'sr-only'])
                                            ];
                                        }),
                                        new ContentTag('h4', $options['title'], ['class'=>'modal-title', 'id'=>'label-' . $options['id']])
                                    ];
                                }),
                                $options['body'],
                                $yield
                            ];
                        });
                    });
                })
            ];
        });
    }

    private function button_class($options = []) {
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

        return  join(Base::SPACE, array_filter(['btn', "btn-$context", $size], 'strlen'));
    }

    private function dialog_class($size = null) {
        $size_class = null;

        switch ($size) {
            case 'lg': case 'large': $size_class = 'modal-lg'; break;
            case 'sm': case 'small': $size_class = 'modal-sm'; break;
        }

        return join(Base::SPACE, array_filter(['modal-dialog', $size_class], 'strlen'));
    }

    private function modal_body($body = null) {
        return !is_null($body) ? (new ContentTag('div', $body, ['class' => 'modal-body']))->get_html_object() : '';
    }
}
