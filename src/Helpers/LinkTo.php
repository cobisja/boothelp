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


class LinkTo extends Base
{
    public function __construct($name = null, $options = [], callable $block = null)
    {
        $html = '';

        $num_args = count(array_filter(func_get_args(), function($item) { return !is_null($item); }));
        $block = is_callable(func_get_arg($num_args-1)) ? func_get_arg($num_args-1) : null;

        if(!is_array($options)){
            $options = [];
        }

        if($this->get_dropdown_link()) {
            $html = new ContentTag(
                   'li',
                   ['role'=>'presentation'],
                   function() use ($num_args, $name, $options, $block) {
                        return $this->link_to_string($num_args, $name, $options, $block);
                    }
            );
        }
        else{
            $html = $this->link_to_string($num_args, $name, $options, $block);
        }

        $this->set_html($html);
    }

    private function link_to_string($num_args, $name, $options, $block)
    {
      $this->select_link_class($options);

      $options['href'] = $this->link_href($options);

      switch($num_args){
        case 1:
            return new ContentTag('a', $block ? $block : $name, $options);
        case 2:
            return new ContentTag('a', $name, $block ? $block : $options);
        default:
            return new ContentTag('a', $name, $options, $block);
      }
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

    private function link_href($options = [])
    {
        return isset($options['href']) ? $options['href'] : '#';
    }
}
