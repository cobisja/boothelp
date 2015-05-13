<?php

/*
 * The MIT License
 *
 * Copyright 2015 cobisja.
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
 * on how to display <strong>Images</strong> component.
 *
 * See {@link http://getbootstrap.com/css/#images} for more information.
 */
class Image extends Base {
    /**
     * Initializes Image component.
     * 
     * @param array $options image's options.
     * @param closure $block closure to build customized image content.
     */
    public function __construct($options, $block=null) {
        $image = $this->build_image($options, $block);
        $this->set_html_object($image->get_html_object());
    }
    
    /**
     * Build the Image component.
     * 
     * @param array $options image's options.
     * @param closure $block closure to build customized image content.
     * @return ContentTag a ContentTag instance that represents a Image component.
     */
    private function build_image($options, $block) {
        if(!isset($options['alt']) || is_null($options['alt'])) {
            $options['alt'] = $this->get_alternative_image_text($options['src']);
        }
        
        $shape_class = $this->get_image_shape_class($options);
        $responsive_class = $this->get_responsive_class($options);
        
        Base::append_class($options, $shape_class);
        Base::append_class($options, $responsive_class);
        
        return is_null($block) ? new ContentTag('img', '', $options) : new ContentTag('img', $options, $block);
    }
    
    /**
     * Returns an alternative image text using the image's filename for it.
     * 
     * @param string $image_src full image filename.
     * @return string alternative text.
     */
    private function get_alternative_image_text($image_src) {
        return pathinfo($image_src)['filename'];
    }
    
    /**
     * Returns the image shape class.
     * 
     * @param array $options image's options.
     * @return mixed shape class or null.
     */
    private function get_image_shape_class(&$options) {
        $shape = Base::get_and_unset('shape', $options);        
        return !is_null($shape) ? 'img-' . $shape : null;
    }
    
    /**
     * Returns the image responsive class.
     * 
     * @param array $options image's options.
     * @return mixed responsive class or null.
     */    
    private function get_responsive_class(&$options) {
        $responsive = Base::get_and_unset('responsive', $options);
        return $responsive ? 'img-responsive' : null;
    }
}
