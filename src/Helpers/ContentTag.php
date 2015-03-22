<?php

/*
 * pbh
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

class ContentTag extends Base
{
    static $BOOLEAN_ATTRIBUTES = [
        'disabled', 'readonly', 'multiple', 'checked', 'autobuffer',
        'autoplay', 'controls', 'loop', 'selected', 'hidden', 'scoped', 'async',
        'defer', 'reversed', 'ismap', 'seamless', 'muted', 'required',
        'autofocus', 'novalidate', 'formnovalidate', 'open', 'pubdate',
        'itemscope', 'allowfullscreen', 'default', 'inert', 'sortable',
        'truespeed', 'typemustmatch'
    ];


    public function __construct($name, $content_or_options_with_block = null, $options = null, callable $block = null)
    {
        $html = '';
        $num_args = $this->get_function_num_args(func_get_args());

        if(4 > $num_args && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);

            if(is_array($content_or_options_with_block)){
                $options = $content_or_options_with_block;
            }

            $html = $this->content_tag_string($name, call_user_func($block), $options);
        }
        else {
            $html = $this->content_tag_string($name, $content_or_options_with_block, $options);
        }

        $this->set_html($html);
    }

    private function content_tag_string($name, $content, $options)
    {
        $tag_options = $this->tag_options($options);

        return "<". rtrim($name . ' ' . $tag_options) . ">" . trim($content) . "</$name>";
    }

    private function tag_options($options)
    {
        $attrs = [];

        if(!is_null($options)){
          foreach($options as $key => $value){
            if(in_array($key, self::$BOOLEAN_ATTRIBUTES)){
              $attrs[] = $this->boolean_tag_option($key);
            }
            else{
              $value = $this->is_a_boolean_value($value);
              $attrs[] = "$key=\"$value\"";
            }
          }
        }

        return join(" ", $attrs);
    }

    private function boolean_tag_option($key)
    {
        return "$key=\"$key\"";
    }

    private function is_a_boolean_value($value)
    {
        $boolean_values = [0=>'false', 1=>'true'];

        return is_bool($value) ? $boolean_values[(int)$value] : $value;
    }
}
