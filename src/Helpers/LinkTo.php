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

use BHP\BHP;
use BHP\Helpers\Base;


class LinkTo
{
    private $html;


    public function __construct($name = null, $options = [], callable $block = null)
    {
      $num_args = count(array_filter(func_get_args(), function($item) { return !is_null($item); }));
      $block = is_callable(func_get_arg($num_args-1)) ? func_get_arg($num_args-1) : null;

      if(!is_array($options)){
          $options = [];
      }

      if(BHP::$dropdown_link) {
          $this->html = $this->content_tag(
                 'li',
                 ['role'=>'presentation'],
                 function() use ($num_args, $name, $options, $block) {
                      return $this->link_to_string($num_args, $name, $options, $block);
                  }
          );
      }
      else{
          $this->html = $this->link_to_string($num_args, $name, $options, $block);
      }
    }

    public function __toString()
    {
        return (string)$this->html;
    }

    private function link_to_string($num_args, $name, $options, $block)
    {
      $this->select_link_class($options);

      $options['href'] = $this->link_href($options);

      switch($num_args){
        case 1:
            return BHP::content_tag('a', $block ? $block : $name, $options);
        case 2:
            return BHP::content_tag('a', $name, $block ? $block : $options);
        default:
            return BHP::content_tag('a', $name, $options, $block);
      }
    }

    private function select_link_class(&$options = [])
    {
      if(BHP::$alert_link){
          Base::append_class($options, 'alert-link');
      }
      elseif(BHP::$navbar_vertical){
          Base::append_class($options, 'navbar-brand');
      }
      elseif(BHP::$dropdown_link){
          $options = array_merge($options, ['role'=>'menuitem', 'tabindex'=>'-1']);
      }

      BHP::$alert_link = false;
    }

    private function link_href($options = [])
    {
        return isset($options['href']) ? $options['href'] : '#';
    }
}
