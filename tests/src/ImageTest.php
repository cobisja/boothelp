<?php

/*
 * BootHelp - Bootstrap Helpers written in PHP
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

namespace BootHelp\Tests;

use cobisja\BootHelp\Image;


class ImageTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoExtraOptions() {
        /**
         * It should generates:
         * 
         * <img alt="pic1" src="pic1.jpg">
         */
        $img = new Image(['src'=>'pic1.jpg']);
        $html = $img->get_html();
        
        $this->assertTrue($html->is_a('img', ['src'=>'pic1.jpg', 'alt'=>'pic1']));
    }
    
    public function testWithAltOption() {
        /**
         * It should generates:
         * 
         * <img alt="Profile picture" src="pic1.jpg">
         */
        $img = new Image(['src'=>'pic1.jpg', 'alt'=>'Profile picture']);
        $html = $img->get_html();
        
        $this->assertTrue($html->is_a('img', ['src'=>'pic1.jpg', 'alt'=>'Profile picture']));
    }
    
    public function testWithResponsiveOption() {
        /**
         * It should generates:
         * 
         * <img alt="pic1" src="pic1.jpg" class="img-responsive">
         */
        $img = new Image(['src'=>'pic1.jpg', 'responsive'=>true]);
        $html = $img->get_html();
        
        $this->assertTrue($html->is_a('img', ['class'=>'img-responsive']));
    }
    
    /**
     * @dataProvider get_shapes
     */
    public function testWithShapeOption($shape) {
        /**
         * It should generates:
         * 
         * <img alt="pic1" src="pic1.jpg" class="img-{$shape}">
         */
        $img = new Image(['src'=>'pic1.jpg', 'shape'=>$shape]);
        $html = $img->get_html();
        
        $this->assertTrue($html->is_a('img', ['class'=>'img-' . $shape]));
    }
    
    
    public function testWithExtraOptions() {
        /**
         * It should generates:
         * 
         * <img alt="pic1" src="pic1.jpg" class="en img-thumbnail" id="my-image">
         */
        $img = new Image(['src'=>'pic1.jpg', 'shape'=>'thumbnail', 'id'=>'my-image', 'class'=>'en']);
        $html = $img->get_html();
        
        $this->assertTrue($html->is_a('img', ['id'=>'my-image']));
        $this->assertTrue($html->has_attribute('class', 'en'));
    }
    
    public function testWithClosure() {
        /**
         * It should generates:
         * 
         * <img alt="pic1" src="pic1.jpg">This is a picture</img>
         */
        $content = 'This is a picture';
        $img = new Image(['src'=>'pic1.jpg'], function() use ($content) {return $content;});
        $html = $img->get_html();
        
        $this->assertTrue($html->is_a('img'));
        $this->assertTrue(1 === $html->number_of_children());
        $this->assertEquals($content, $html->get_child(0));
    }
    
    public function get_shapes() {
        return [ ['rounded'], ['circle'], ['thumbnail'] ];
    }    
}
