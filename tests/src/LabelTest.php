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

use cobisja\BootHelp\Label;
use cobisja\BootHelp\Icon;

class LabelTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <span class="label label-default">New</span>
         */
        $label = new Label('New');
        $html = $label->get_html();
        
        $this->validate_label($html);
    }    
    
    /**
     * @dataProvider get_contexts
     */
    public function testWithContextOption($context) {
        /**
         * It should generates:
         *
         * <span class="label label-{$context}">New</span>
         */
        $label = new Label('New', ['context'=>$context]);
        $html = $label->get_html();
        
        $this->validate_label($html);
    }
    
    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <span id="my-label" class="en label label-danger">New</span>
         */
        $label = new Label('New', ['id'=>'my-label', 'class'=>'en', 'context'=>'danger']);
        $html = $label->get_html();
        
        $this->validate_label($html);
        $this->assertTrue($html->has_attribute('id', 'my-label'));
        $this->assertTrue(3 === count($html->get_attribute('class', ['as'=>'array'])));
        $this->assertTrue($html->has_attribute('class', 'en label label-danger'));        
    }
    
    public function testWithClosure() {
        /**
         * It should generates:
         *
         * <span class="label label-default">New</span>
         */
        $label = new Label(function(){
            return 'New';
        });
        
        $html = $label->get_html();        
        $this->validate_label($html);
    }
    
    public function testWithClosureAndOptions() {
        /**
         * It should generates:
         * <span class="label label-primary">
         *     <span class="glyphicon glyphicon-headphones"></span>
         *     Enjoy the music
         * </span>
         */
        $label = new Label(['id'=>'my-label', 'context'=>'primary'], function(){
            return [
                new Icon('headphones'),
                'Enjoy the music'
            ];
        });
        
        $html = $label->get_html();        
        $this->validate_label($html);
        $this->assertTrue($html->has_attribute('class', 'label-primary'));
        $this->assertTrue($html->has_attribute('id', 'my-label'));
        $this->assertTrue(2 === $html->number_of_children());
    }
    

    private function validate_label($html) {
        $this->assertTrue($html->is_a('span'));
        $this->assertTrue($html->has_attribute('class', 'label'));        
    }
    
    public function get_contexts() {
        return [ ['default'], ['primary'], ['success'], ['info'], ['warning'], ['danger'] ];
    }    
}
