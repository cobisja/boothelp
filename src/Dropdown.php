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

class Dropdown extends Base
{
    public function __construct($caption, $options = [], $block = null)
    {
        if (is_callable($options)) {
            $block = $options;
            $options = [];
        }

        $options['id'] = isset($options['id']) ? $options['id'] : 'label-dropdown-' . (string)( mt_rand(1, pow(10, 10)) );
        $options['caption'] = $caption;
        $options['div_class'] = $this->dropdown_div_class($options);
        $options['button_class'] = $this->dropdown_button_class($options);
        $options['list_class'] = $this->dropdown_list_class($options);

        $layout = isset($options['split']) && $options['split'] ? 'dropdown_split' : 'dropdown';

        Base::set_dropdown_link(true);

        $yield = is_callable($block) ? call_user_func($block) : null;
        $dropdown_template = $this->get_dropdown_template($layout);

        $dropdown_string = preg_replace(
            ["/%div_class%/", "/%button_class%/", "/%id%/", "/%caption%/", "/%list_class%/", "/%yield%/"],
            [
                $options['div_class'], $options['button_class'], $options['id'], $options['caption'], $options['list_class'], $yield
            ],
            $dropdown_template
        );

        Base::set_dropdown_link(false);

        $this->set_html($dropdown_string);
    }

    private function dropdown_div_class($options = [])
    {
        $group = (isset($options['groupable']) ? $options['groupable'] : true ) ? 'btn-group' : 'dropdown';
        $direction = isset($options['direction']) && $options['direction'] === 'up' ? 'dropup' : null;

        return  join( ' ', array_filter( [$group, $direction], 'strlen' ) );
    }

    private function dropdown_list_class($options = [])
    {
        $align = isset($options['align']) && $options['align'] === 'right' ? 'dropdown-menu-right' : null;
        return  join( ' ', array_filter( ['dropdown-menu', $align], 'strlen' ) );
    }

    private function dropdown_button_class($options = [])
    {
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

        return  join( ' ', array_filter( [$button_class, 'btn', "btn-$context", $size], 'strlen' ) );
    }

    private function get_dropdown_template($layout)
    {
        return file_get_contents(Base::TEMPLATES_PATH . $layout . '.template');
    }
}
