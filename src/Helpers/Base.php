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


class Base
{
    public static function append_class(&$hash, $new_class, $attribute = 'class')
    {
        $existing_class = isset($hash[$attribute]) ? $hash[$attribute] : null;
        $hash[$attribute] = join( ' ', array_filter( [$existing_class, $new_class], 'strlen' ) );
    }

    public static function context_for($context, $options=[])
    {
        switch($context){
            case 'notice':
                $context = 'success';
                break;
            case 'alert':
                $context = 'danger';
                break;
        }

        if( isset($options['valid']) && in_array($context, $options['valid'] )){
            return $context;
        }

        elseif(isset($options['default'])){
            return $options['default'];
        }
        else{
            return 'default';
        }
    }

    public static function set_options($base_options, &$options)
    {
        foreach ($base_options as $key => $default)
        {
            !isset($options[$key]) && $options[$key] = $default;
        }
    }
}
