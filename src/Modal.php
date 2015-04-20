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
 * on how to display <strong>Modal</strong> component.
 *
 * See {@link http://getbootstrap.com/javascript/#modals} for more information.
 */
class Modal extends Base {
    /**
     * Initializes the Modal instance.
     *
     * @param mixed $content_or_options_with_block the content to display in the Modal.
     * @param mixed $options [optional] the display options for the Modal.
     * @param mixed $block [optional] Block to generate a customized inside Modal content.
     */
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
            $html = $this->set_modal_params($content, $options, $block);
        } else {
            $html = $this->set_modal_params($content_or_options_with_block, is_null($options) ? [] : $options);
        }

        $this->set_html_object($html);
    }

    /**
     * Set all the Modal's parameters prior to build it.
     *
     * @param mixed $body Modal's body.
     * @param array $options Modal's options.
     * @param closure $block Closure to generates complex Modal's body.
     * @return Html a Html instance that holds the html representation of a Modal object.
     */
    private function set_modal_params($body, $options = null, $block = null) {
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

        if (!isset($options['button']['style'])) {
            $options['button']['style'] = null;
        }

        $options['button']['class'] = $this->button_class(isset($options['button']) ? $options['button'] : $base_options['button']);
        $this->set_options($base_options, $options);
        $yield = is_callable($block) ? call_user_func($block) : '';
        $modal = $this->build_modal($options, $yield);

        return $modal->get_html_object();
    }

    /**
     * Builds the Modal.
     *
     * @param array $options Modal's options.
     * @param mixed $yield Complementary content.
     * @return ContentTag a ContentTag instance that represents a Modal.
     */
    private function build_modal($options, $yield) {
        return new ContentTag('div', ['id'=>'modal-container-' . $options['id']], function() use ($options, $yield) {
            return [
                new ContentTag('button', $options['button']['caption'], array_merge($options['button'], ['data-toggle'=>'modal', 'data-target'=>'#' . $options['id']])),
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

    /**
     * Returns the Modal's button class.
     *
     * @param array $options options information to generate the button's class.
     * @return string button's class.
     */
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

        $this->append_class($options, 'btn');
        $this->append_class($options, 'btn-' . $context);
        $this->append_class($options, $size);

        return  $options['class'];
    }

    /**
     * Returns the class associated to Modal's dialog.
     *
     * @param array $size options information to generate the Modal's dialog class.
     * @return string dialog's class.
     */
    private function dialog_class($size = null) {
        $size_class = null;

        switch ($size) {
            case 'lg': case 'large': $size_class = 'modal-lg'; break;
            case 'sm': case 'small': $size_class = 'modal-sm'; break;
        }

        return join(Base::SPACE, array_filter(['modal-dialog', $size_class], 'strlen'));
    }

    /**
     * Returns the Modal's body
     *
     * @param array $body options for Modal's body.
     * @return mixed Modal's body.
     */
    private function modal_body($body = null) {
        return !is_null($body) ? (new ContentTag('div', $body, ['class' => 'modal-body']))->get_html_object() : '';
    }
}
