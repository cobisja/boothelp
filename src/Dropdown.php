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
 * Class to generate a Dropdown object.
 */
class Dropdown extends Base {
    /**
     * Initializes the Dropdown instance.
     *
     * @param string $caption Dropdown caption.
     * @param array $options options to build the Dropdown.
     * @param closure $block closure to build the Dropdown content.
     */
    public function __construct($caption, $options = [], $block = null) {
        if (is_callable($options)) {
            $block = $options;
            $options = [];
        }

        $options['id'] = isset($options['id']) ? $options['id'] : 'label-dropdown-' . (string)( mt_rand(1, pow(10, 10)) );
        $options['caption'] = $caption . Base::SPACE;
        $options['div_class'] = $this->dropdown_div_class($options);
        $options['button_class'] = $this->dropdown_button_class($options);
        $options['list_class'] = $this->dropdown_list_class($options);

        Base::set_dropdown_link(true);

        $yield = is_callable($block) ? call_user_func($block) : null;
        $dropdown = isset($options['split']) && $options['split'] ? $this->build_split_dropdown($options, $yield) : $this->build_standard_dropdown($options, $yield);

        Base::set_dropdown_link(false);

        $this->set_html_object($dropdown->get_html_object());
    }

    /**
     * Builds a Standard Dropdown.
     *
     * @param array $options Dropdown's options.
     * @param mixed $yield Dropdown's content.
     * @return ContentTag a Contentag instance that represents a Dropdown, in this case a button that triggers an unordered html list.
     */
    private function build_standard_dropdown($options, $yield) {
        return
            new ContentTag('div', ['class'=>$options['div_class']], function() use ($options, $yield) {
                return [
                    new ContentTag(
                        'button',
                        ['class'=>'dropdown-toggle ' . $options['button_class'], 'type'=>'button', 'id'=>$options['id'], 'data-toggle'=>'dropdown'],
                        function() use ($options) {
                            return [$options['caption'] , new ContentTag('span', '', ['class'=>'caret'])];
                    }),
                    new ContentTag('ul', $yield, ['class'=>$options['list_class'], 'role'=>'menu', 'aria-labelledby'=>$options['id']])
                ];
            });
    }

    /**
     * Builds a Split Dropdown.
     *
     * @param array $options Dropdown's options.
     * @param mixed $yield Dropdown's content.
     * @return ContentTag a Contentag instance that represents a Split Dropdown, in this case 2 buttons, one of them triggers an unordered html list.
     */
    private function build_split_dropdown($options, $yield) {
        return
            new ContentTag('div', ['class'=>$options['div_class']], function() use ($options, $yield) {
                return [
                    new ContentTag('button', $options['caption'], ['type'=>'button', 'class'=>$options['button_class']]),
                    new ContentTag('button', ['class'=>'dropdown-toggle ' . $options['button_class'], 'type'=>'button', 'id'=>$options['id'], 'data-toggle'=>'dropdown'], function(){
                        return [
                            new ContentTag('span', '', ['class'=>'caret']),
                            new ContentTag('span', 'Toggle Dropdown', ['class'=>'sr-only'])
                        ];
                    }),
                    new ContentTag('ul', $yield, ['class'=>$options['list_class'], 'role'=>'menu', 'aria-labelledby'=>$options['id']])
                ];
            });
    }

    /**
     * Returns the class for the div that contains the Dropdown.
     *
     * @param array $options Div's class options.
     * @return string Div's class.
     */
    private function dropdown_div_class($options = []) {
        $group = (isset($options['groupable']) && $options['groupable']) ||
                 (isset($options['split']) && $options['split'] ) ||
                 (isset($options['align']) && 'right' === $options['align'] )? 'btn-group' : null;

        $direction = isset($options['direction']) && $options['direction'] === 'up' ? 'dropup' : 'dropdown';

        return  join(Base::SPACE, array_filter([$group, $direction], 'strlen' ));
    }

    /**
     * Returns the class related with alignment.
     *
     * @param array $options alignment options.
     * @return string alignment class.
     */
    private function dropdown_list_class($options = []) {
        $align = isset($options['align']) && $options['align'] === 'right' ? 'dropdown-menu-right' : null;
        return  join(Base::SPACE, array_filter(['dropdown-menu', $align], 'strlen' ));
    }

    /**
     * Returns the class information associated to the Button.
     *
     * @param array $options class options information.
     * @return string button's class.
     */
    private function dropdown_button_class($options = []) {
        $base_options = [
            'context' => null,
            'size' => '',
        ];

        $valid_contexts = [ 'primary', 'success', 'info', 'warning', 'danger', 'link' ];

        $this->set_options($base_options, $options);
        $context = $this->context_for( $options['context'], ['valid' => $valid_contexts]);
        $button_class = isset($options['button']['class']) ? $options['button']['class'] : null;

        switch ($options['size']) {
            case 'lg': case 'large': $size = 'btn-lg'; break;
            case 'sm': case 'small': $size = 'btn-sm'; break;
            case 'xs': case 'extra_small': $size = 'btn-xs'; break;
            default : $size = null;
        }

        unset($options['context']);
        unset($options['size']);

        return join(Base::SPACE, array_filter([$button_class, 'btn', "btn-$context", $size], 'strlen'));
    }
}
