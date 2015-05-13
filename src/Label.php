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

namespace cobisja\BootHelp;

use cobisja\BootHelp\Base;
use cobisja\BootHelp\Helpers\ContentTag;

/**
 * Generates an HTML block tag that follows the Bootstrap documentation
 * on how to display <strong>Label</strong> component.
 *
 * See {@link http://getbootstrap.com/components/#labels} for more information.
 */
class Label extends Base {
    /**
     * Initializes the Label component instance.
     *
     * @param mixed $content_or_options_with_block the content to display into the label.
     * @param mixed $options [optional] the display options for the label.
     */
    public function __construct($content_or_options_with_block = null, $options = null) {
        $num_args = $this->get_function_num_args(func_get_args());        
        $block = is_callable(func_get_arg($num_args-1)) ? func_get_arg($num_args-1) : null;
        $content = is_null($block) ? $content_or_options_with_block : call_user_func($block);        

        if (1 === $num_args) {
            $options = [];            
        } else {
            is_array($content_or_options_with_block) ? $options = $content_or_options_with_block : null;
        }

        $html = $this->build_label($content, $options);        
        $this->set_html_object($html->get_html_object());        
    }
    
    /**
     * Generates Label component HTML code.
     * 
     * @param string $content Panel's content.
     * @param array $options Panel's options.
     * @return ContentTag a ContentTag instance that represents a Label component object.
     */
    private function build_label($content, $options) {
        if (isset($options['context'])) {
            $context = $options['context'];
            unset($options['context']);
        } else {
            $context = null;
        }
        
        $this->append_class($options, $this->label_class($context));
        
        return new ContentTag('span', $content, $options);
    }
    
    /**
     * Return the context panel class.
     *
     * @param string $context context.
     * @return string context panel class.
     */
    private function label_class($context = null) {
        $valid_contexts = ['default', 'primary', 'success', 'info', 'warning', 'danger'];
        $context = $this->context_for($context, ['default'=>'default', 'valid' => $valid_contexts]);

        return "label label-$context";
    }
}
