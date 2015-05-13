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
use cobisja\BootHelp\Image;
use cobisja\BootHelp\Helpers\ContentTag;
use cobisja\BootHelp\Helpers\LinkTo;

/**
 * Generates an HTML block tag that follows the Bootstrap documentation
 * on how to display <strong>Thumbnail</strong> component.
 *
 * See {@link http://getbootstrap.com/components/#thumbnails} for more information.
 */
class Thumbnail extends Base {
    /**
     * Initializes the Thumbnail instance.
     *
     * @param mixed $options [optional] the display options for the thumbnail.
     * @param Callable $block [optional] Block to generate customized thumbnail content.
     */
    public function __construct($options, $block=null) {
        $thumbnail = $this->build_thumbnail($options, $block);
        $this->set_html_object($thumbnail->get_html_object());
    }
    
    /**
     * Builds the Thumbnail component.
     * 
     * @param array $options Thumnail's options
     * @param closure $block Closure to generates complex Thumbnail's content.
     * @return ContentTag instance of ContentTag that represents the Thumbnail.
     */
    private function build_thumbnail(array $options, $block) {
        $image = new Image($this->get_image_options($options));        
        $klass = $this->get_column_class($options);
        
        if(is_null($block)) {
            $thumbnail = $this->build_standard_thumbnail($image, $options);
        } else {
            $thumbnail = $this->build_custom_thumbnail($image, $options, $block);
        }
        
        Base::append_class($options, $klass);
        
        return new ContentTag('div', $thumbnail, $options);
    }
    
    /**
     * Builds an standard thumbnail (single image with no content).
     * 
     * @param Image $image Image component.
     * @param array $options thumbnail's options.
     * @return LinkTo instance of LinkTo that represents an standard thumbnail.
     */
    private function build_standard_thumbnail($image, &$options) {
        $href = Base::get_and_unset('href', $options);
        $standard_thumbnail = new LinkTo(['class'=>'thumbnail', 'href'=>$href], function() use ($image) {
            return $image;
        });
        
        return $standard_thumbnail;
    }
    
    /**
     * Builds a customized thumbnail (image + mixed content)
     * 
     * @param Image $image Image component.
     * @param array $options thumbnail's options.
     * @param closure $block Closure that generates the mixed content.
     * @return ContentTag instance of ContenTag that represents the customized thumbnail.
     */
    private function build_custom_thumbnail($image, &$options, $block) {
        Base::get_and_unset('href', $options);
        Base::append_class($options, 'thumbnail');
        
        $custom_thumbnail = new ContentTag('div', $options, function() use ($image, $block){
            return [
                $image,
                call_user_func($block)
            ];
        });
        
        unset($options['class']);        
        return $custom_thumbnail;
    }
    
    /**
     * Look into options to get out those associated to the thumbnail's image.
     * 
     * @param array $options thumbnail's options.
     * @return array specific image's options.
     */
    private function get_image_options(&$options) {
        $src = Base::get_and_unset('src', $options);
        $alt = Base::get_and_unset('alt', $options);
        $image_options = Base::get_and_unset('image', $options);
        
        is_null($image_options) ? $image_options = [] : null;        
        $image_options = array_merge(['src'=>$src, 'alt'=>$alt], $image_options);
        
        return $image_options;
    }
    
    /**
     * Gets the column class associated to the thumbnail.
     * 
     * @param array $options thumbnail's options.
     * @return string thumbnail's column class.
     */
    private function get_column_class(&$options) {
        $column_class = Base::get_and_unset('column_class', $options);        
        return $column_class;
    }
}
