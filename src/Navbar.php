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

class Navbar extends Base
{
    public function __construct($options = [], callable $block = null)
    {
        if (is_callable($options)) {
            $block = $options;
            $options = [];
        }

        Base::set_navbar_id(!isset($options['id']) ? ('navbar-collapse-' . (string) (mt_rand(1, pow(10, 7)))) : $options['id']);
        $nav_tag = $this->navbar_string($options, $block);
        $html = join("\n", array_filter([$this->navbar_style_tag($options), $nav_tag], 'strlen'));

        $this->set_html($html);
    }

    private function navbar_string($options = [], $block = null)
    {
        if (is_callable($options)) {
            $block = $options;
            $options = [];
        }

        return new ContentTag(
            'nav',
            ['role'=>'navigation', 'class'=>$this->navbar_class($options)], function() use ($options, $block){
                return new ContentTag('div', ['class'=>$this->navbar_container_class($options)], $block);
            }
        );
    }

    private function navbar_style_tag($options = [])
    {
        $padding_value = isset($options['padding']) ? $options['padding'] : 70;

        if ($padding_value && $padding_type = $this->padding_type_for(isset($options['position']) ? $options['position'] : '')) {
            return new ContentTag('style', "body {padding-$padding_type: " . $padding_value . 'px}');
        }
    }

    private function padding_type_for($position)
    {
        $matches = [];
        preg_match('/fixed-(?<type>top|bottom)$/', $this->navbar_position_class_for($position), $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }

    private function navbar_class($options = [])
    {
        $style = isset($options['inverted']) && $options['inverted'] ? 'inverse' : 'default';
        $position = isset($options['position']) ? $this->navbar_position_class_for($options['position']) : null;

        $this->append_class($options, 'navbar');
        $this->append_class($options, "navbar-$style");

        if ($position) {
          $this->append_class($options, "navbar-$position");
        }

        return $options['class'];
    }

    private function navbar_position_class_for($position)
    {
        switch ($position) {
            case 'static': case 'static_top':
                $class = 'static-top';
                break;
            case 'top': case 'fixed_top':
                $class = 'fixed-top';
                break;
            case 'bottom': case 'fixed_bottom':
                $class = 'fixed-bottom';
                break;
            default:
                $class = '';
        }

        return $class;
    }

    private function navbar_container_class($options = [])
    {
        return isset($options['fluid']) && $options['fluid'] ?  'container-fluid' : 'container';
    }
}
