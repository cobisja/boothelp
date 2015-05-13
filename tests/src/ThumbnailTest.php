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

namespace BootHelp\Tests;

use cobisja\BootHelp\Thumbnail;
use cobisja\BootHelp\Button;
use cobisja\BootHelp\Helpers\ContentTag;


class ThumbnailTest extends \PHPUnit_Framework_TestCase {
    public function testWithBasicOptions() {
        /**
         * It should generates:
         * 
         * <div class="col-xs-6 col-md-3">
         *     <a href="#" class="thumbnail">
         *         <img alt="pic4" src="pic4.jpg">
         *     </a>
         * </div>
         */
        $column_class = 'col-xs-6 col-md-3';
        
        $thumbnail = $thumb = new Thumbnail([
            'column_class'=>$column_class,
            'src'=>'pic4.jpg'
        ]);
        $html = $thumbnail->get_html();
        
        $this->validate_thumbnail($html, $column_class);

    }
    
    public function testWithThumbnailTargetViaHref() {
        /**
         * It should generates:
         * 
         * <div class="col-xs-6 col-md-3">
         *     <a href="http://pixabay.com" class="thumbnail">
         *         <img alt="pic4" src="pic4.jpg">
         *     </a>
         * </div>
         */
        $href = 'http://pixabay.com';
        $column_class = 'col-xs-6 col-md-3';
        
        $thumbnail = $thumb = new Thumbnail([
            'column_class'=>$column_class,
            'src'=>'pic4.jpg',
            'href'=>$href
        ]);
        $html = $thumbnail->get_html();
        
        $this->validate_thumbnail($html, $column_class);        
        $this->assertTrue($html->get_child(0)->has_attribute('href', $href));
    }
    
    public function testWithSpecificImageAttributesViaImageOption() {
        /**
         * It should generates:
         * 
         * <div class="col-xs-6 col-md-3">
         *     <a href="#" class="thumbnail">
         *         <img class="en" id="my-image" alt="pic4" src="pic2.jpg">
         *     </a>
         * </div>
         */
        $column_class = 'col-xs-6 col-md-3';
        
        $thumbnail = new Thumbnail([
            'column_class'=>'col-xs-6 col-md-3',
            'src'=>'pic4.jpg',
            'image'=>['id'=>'my-image', 'class'=>'en']
        ]);
        $html = $thumbnail->get_html();
        $img = $html->get_child(0)->get_child(0);
        
        $this->validate_thumbnail($html, $column_class);
        $this->assertTrue($img->has_attribute('id', 'my-image'));
        $this->assertTrue($img->has_attribute('class', 'en'));        
    }
    
    public function testBuildCustomThumbnail() {
        /**
         * It should generates:
         * 
         * <div class="col-sm-6 col-md-4">
         *     <div class="thumbnail">
         *         <img alt="pic1" src="pic1.jpg">
         *         <div class="caption">
         *             <h3>Thumbnail label</h3>
         *             <p>
         *                 Cras justo odio, dapibus ac facilisis in, egestas eget 
         *                 quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
         *                 ultricies vehicula ut id elit.
         *             </p>
         *             <button class="btn btn-primary">Button</button>
         *             <button class="btn btn-default">Button</button>
         *         </div>
         *     </div>
         * </div>
         */
        $column_class = 'col-sm-6 col-md-4';
        
        $thumbnail = new Thumbnail([
                'column_class'=>$column_class,
                'src'=>'Guide/img/pic1.jpg',
                'href'=>'http://pixabay.com/'
            ],
            function(){
                return new ContentTag('div', ['class'=>'caption'], function(){
                    return [
                        new ContentTag('h3', 'Thumbnail label'),
                        new ContentTag('p', 'Cras justo odio, dapibus ac facilisis in, egestas eget 
                            quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                            ultricies vehicula ut id elit.' ),
                        new Button('Button', ['context'=>'primary']),
                        new Button('Button')
                    ];
            });
        });
        
        $html = $thumbnail->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>$column_class]));
        $this->assertTrue(1 === $html->number_of_children());
        $this->assertTrue($html->get_child(0)->is_a('div', ['class'=>'thumbnail']));
        $this->assertTrue($html->get_child(0)->get_child(0)->is_a('img'));
        
        $custom_content = $html->get_child(0)->get_child(1);
        
        $this->assertTrue(4 === $custom_content->number_of_children());
    }
    
    private function validate_thumbnail($html, $column_class) {
        $child = $html->get_child(0);
        $this->assertTrue($html->is_a('div', ['class'=>$column_class]));
        $this->assertTrue($child->is_a('a', ['class'=>'thumbnail']));
        $this->assertTrue($child->has_a_child_of_type('img'));
    }
}
