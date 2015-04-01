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

namespace BHP\Helpers;

use BHP\Base;
use BHP\Helpers\ContentTag;

class Vertical extends Base
{
    public function __construct($content_or_options_with_block = null, $options = null, callable $block = null)
    {
        $num_args = $this->get_function_num_args(func_get_args());
        $block = is_callable(func_get_arg($num_args-1)) ? func_get_arg($num_args-1) : null;

        switch ($num_args) {
            case '1':
                $content_or_options_with_block = null;
                $options = null;
                break;
            case '2':
                $options = null;
                break;
        }

        if ($block) {
            $html = $this->vertical_string($content_or_options_with_block ? $content_or_options_with_block : [], $block);
        } else {
            $html =  $this->vertical_string($options ? $options : [], $content_or_options_with_block);
        }

        $this->set_html_object($html);
    }

    private function vertical_string($options = [], $block = null)
    {
        Base::set_navbar_vertical(true);
        
        $this->append_class($options, 'navbar-header');
        $yield = is_callable($block) ? call_user_func($block) : $block;

        $vertical = new ContentTag('div', $options, function() use($yield){
                  return [$this->toggle_button(), $yield];
        });

        Base::set_navbar_vertical(false);

        return $vertical->get_html_object();
    }

    private function toggle_button($options = [])
    {
        $options['type'] = 'button';
        $options['class'] = 'navbar-toggle';
        $options['data-toggle'] = 'collapse';
        $options['data-target'] = '#' . Base::get_navbar_id();

        return (new ContentTag('button', $options, function(){
                    return [$this->toggle_text(), $this->toggle_bar(), $this->toggle_bar(), $this->toggle_bar()];
                })
        )->get_html_object();
    }

    private function toggle_text()
    {
        return (new ContentTag('span', 'Toggle navigation', ['class'=>'sr-only']))->get_html_object();
    }

    private function toggle_bar()
    {
        return (new ContentTag('span', null, ['class'=>'icon-bar']))->get_html_object();
    }
}
