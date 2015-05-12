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
use cobisja\BootHelp\Helpers\Badge;

/**
 * ContentTag class: generates an specific HTML block tag surrounding an specific content.
 */
class ContentTag extends Base {
    /**
     * Initializes the object and returns an instance holding an HTML block tag
     * surrounding an specific content.
     *
     * @param string $name Block tag type.
     * @param mixed $content_or_options_with_block Options or closure.
     * @param mixed $options Options or closure.
     * @param callable $block closure that generates the content to be surrounding to.
     */
    public function __construct($name, $content_or_options_with_block = null, $options = null, callable $block = null) {
        $num_args = $this->get_function_num_args(func_get_args());

        if(4 > $num_args && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);

            if(is_array($content_or_options_with_block)){
                $options = $content_or_options_with_block;
            }

            $this->build_content_tag($name, call_user_func($block), $options);
        } else {
            $this->build_content_tag($name, $content_or_options_with_block, $options);
        }
    }

    /**
     * Builds the html object that represents ContentTag.
     *
     * @param string $name name of the tag that is going to be built.
     * @param mixed $content content.
     * @param mixed $options options to build the html object.
     */
    private function build_content_tag($name, $content, $options) {
//        ('a' === $name) && $this->get_alert_link() && $this->append_class($options, 'alert-link');
        $content = is_object($content) ? $content->get_html_object() : $content;        
        $badge = $this->check_for_badge($options);        
        $this->set_html_object($name, $options, is_null($badge) ? $content : [$content, Base::SPACE, $badge]);
    }
    
    /**
     * Tells if badge options has been detected to generate a Badge component.
     * 
     * @param mixed $options options.
     * @return Badge a instance of Badge component.
     */
    private function check_for_badge(&$options) {
        if (isset($options['badge'])) {
            $badge = new Badge($options['badge']);
            unset($options['badge']);
        } else {
            $badge = null;
        }
        
        return $badge;
    }    
}
