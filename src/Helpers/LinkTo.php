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

namespace cobisja\BootHelp\Helpers;

use cobisja\BootHelp\Base;
use cobisja\BootHelp\Helpers\ContentTag;

/**
 * LinkTo: Generates a link tag.
 */
class LinkTo extends Base {
    /**
     * Initializes the object and returns an instance holding the HTML code for
     * a link tag.
     *
     * @param mixed $name link target.
     * @param array $options link options.
     * @param callable $block closure that generates the content to be surrounding to.
     */
    public function __construct($name, $options = [], callable $block = null) {
        $html = '';

        $num_args = $this->get_function_num_args(func_get_args());
        $block = is_callable(func_get_arg($num_args-1)) ? func_get_arg($num_args-1) : null;

        if (Base::get_dropdown_link()) {
            $html = $this->build_dropdown_link($num_args, $name, $options, $block);
        } elseif (Base::get_nav_link()) {
            $html = $this->build_nav_link($num_args, $name, $options, $block);
        } else {
            $html = $this->build_standard_link($num_args, $name, $options, $block);
        }

        $this->set_html_object($html->get_html_object());
    }

    /**
     * Build an standard link.
     *
     * @param int $num_args number of arguments passed when the class was instantiated.
     * @param mixed $name link's content.
     * @param mixed $options link's options.
     * @param closure $block closure to build link's content.
     * @return ContentTag instance of ContentTag that represents the link.
     */
    private function build_standard_link($num_args, $name, $options, $block) {
        $options = is_array($name) ? $name : $options;
        $this->select_link_class($options);
        $options['href'] = $this->link_href($options);

        switch($num_args){
            case 1:
                if (!is_null($block)) {
                    $link = new ContentTag('a', $options, $block);
                } else {
                    $link = new ContentTag('a', is_array($name) ? '' : $name, $options);
                }
                break;
            case 2:
                if (is_string($name) && is_array($options)) {
                    $link = new ContentTag('a', $name, $options);
                } else {
                    $link = new ContentTag('a', $options, $block);
                }
                break;
        }

      return $link;
    }

    /**
     * Determines the correct class associated with the link.
     *
     * @param array $options options associated with the link.
     */
    private function select_link_class(&$options = []) {
        if($this->get_alert_link()){
            $this->append_class($options, 'alert-link');
        } elseif($this->get_navbar_vertical()){
            $this->append_class($options, 'navbar-brand');
        } elseif($this->get_dropdown_link()){
            $options = array_merge($options, ['role'=>'menuitem']);
        }

        Base::set_alert_link(false);
    }

    /**
     * Build a link surrounded with a 'li' tag. This is used with dropdowns.
     *
     * @param int $num_args number of arguments passed when the class was instantiated.
     * @param mixed $name link's content.
     * @param mixed $options link's options.
     * @param closure $block closure to build link's content.
     * @return ContentTag instance of ContentTag that represents the link.
     */
    private function build_dropdown_link($num_args, $name, $options, $block) {
        return new ContentTag(
            'li',
            function() use ($num_args, $name, $options, $block) {
                 return $this->build_standard_link($num_args, $name, $options, $block);
             }
        );
    }

    /**
     * Build a link surrounded with a 'li' tag. This is used with nav and navbars.
     *
     * @param int $num_args number of arguments passed when the class was instantiated.
     * @param mixed $name link's content.
     * @param mixed $options link's options.
     * @param closure $block closure to build link's content.
     * @return ContentTag instance of ContentTag that represents the link.
     */
    private function build_nav_link($num_args, $name, $options, $block) {
        $options['href'] = $this->link_href($options);
        $nav_item_class = $this->current_page($options['href']) ? 'active' : null;

        if (isset($options['disabled']) && $options['disabled']) {
            $disabled = 'disabled';
            unset($options['disabled']);
        } else {
            $disabled = null;
        }

        return new ContentTag(
            'li',
             is_null($nav_item_class) && is_null($disabled) ? [] : ['class'=>trim($nav_item_class . ' ' . $disabled)],
             function() use ($num_args, $name, $options, $block) {
                 return $this->build_standard_link($num_args, $name, $options, $block);
             }
        );
    }

    /**
     * Sets the link's href attribute.
     *
     * @param array $options link's options.
     * @return string href value.
     */
    private function link_href($options = []) {
        return isset($options['href']) ? $options['href'] : '#';
    }

    /**
     * Tells if current page (requested page) match with the link's href attribute.
     *
     * @param string $href href value.
     * @return boolean true on success, false otherwise.
     */
    private function current_page($href) {
        if (isset($_SERVER['HTTP_HOST'])) {
            $href = str_replace('http://' . $_SERVER['HTTP_HOST'], '', $href);
            return $_SERVER['REQUEST_URI'] === $href;
        } else {
            return false;
        }
    }
}
