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
use BHP\Helpers\ContentTag;

/**
 * LinkTo: Generates a link tag.
 */
class LinkTo extends Base
{
    /**
     * Initializes the object and returns an instance holding the HTML code for
     * a link tag.
     *
     * @param mixed $name link target.
     * @param array $options link options.
     * @param callable $block closure that generates the content to be surrounding to.
     */
    public function __construct($name, $options = [], callable $block = null)
    {
        $html = '';

        $num_args = $this->get_function_num_args(func_get_args());
        $block = is_callable(func_get_arg($num_args-1)) ? func_get_arg($num_args-1) : null;

        if (!is_array($options)) {
            $options = [];
        }

        if (Base::get_dropdown_link()) {
            $html = $this->build_dropdown_link($num_args, $name, $options, $block);
        } elseif (Base::get_nav_link()) {
            $html = $this->build_nav_link($num_args, $name, $options, $block);
        } else {
            $html = $this->link_to_string($num_args, $name, $options, $block);
        }

        $this->set_html_object($html->get_html_object());
    }

    private function link_to_string($num_args, $name, $options, $block)
    {
      $this->select_link_class($options);
      $options['href'] = $this->link_href($options);

      switch($num_args){
        case 1:
            $link = new ContentTag('a', $block ? $block : $name, $options);
            break;
        case 2:
            $link = new ContentTag('a', $name, $block ? $block : $options);
            break;
        default:
            $link = new ContentTag('a', $name, $options, $block);
      }

      return $link;
    }

    private function select_link_class(&$options = [])
    {
      if($this->get_alert_link()){
          $this->append_class($options, 'alert-link');
      }
      elseif($this->get_navbar_vertical()){
          $this->append_class($options, 'navbar-brand');
      }
      elseif($this->get_dropdown_link()){
          $options = array_merge($options, ['role'=>'menuitem', 'tabindex'=>'-1']);
      }

      Base::set_alert_link(false);
    }

    private function build_dropdown_link($num_args, $name, $options, $block)
    {
        return new ContentTag(
                   'li',
                   ['role'=>'presentation'],
                   function() use ($num_args, $name, $options, $block) {
                        return $this->link_to_string($num_args, $name, $options, $block);
                    }
            );
    }

    private function build_nav_link($num_args, $name, $options, $block)
    {
        $options['href'] = $this->link_href($options);
        $nav_item_class = $this->current_page($options['href']) ? 'active' : null;

        if (isset($options['disabled']) && $options['disabled']) {
            $disabled = 'disabled';
            unset($options['disabled']);
        }
        else {
            $disabled = null;
        }

        return new ContentTag(
               'li',
               is_null($nav_item_class) && is_null($disabled) ? [] : ['class'=>trim($nav_item_class . ' ' . $disabled)],
               function() use ($num_args, $name, $options, $block) {
                    return $this->link_to_string($num_args, $name, $options, $block);
                }
        );
    }

    private function link_href($options = [])
    {
        return isset($options['href']) ? $options['href'] : '#';
    }

    private function current_page($href)
    {
        $href = str_replace('http://' . $_SERVER['HTTP_HOST'], '', $href);
        return $_SERVER['REQUEST_URI'] === $href;
    }
}
