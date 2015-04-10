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

namespace Tests;

use BootHelp\Button;


class ButtonTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoButtonOptions() {
        /**
         * It should generates:
         *
         * <button class="btn btn-default">
         *     Menu
         * </button>
         */
        $button = new Button('Menu');
        $html = $button->get_html();

        $this->assertTrue($html->is_a('button', ['class'=>'btn btn-default']));
    }

    /**
     * @dataProvider get_contexts
     */
    public function testSetContextClassWhenSetContextOption($context) {
        /**
         * For $context = ['success', 'info', 'warning', 'danger'], it should generates:
         *
         * <button class="btn btn-{$context}">
         *     Menu
         * </button>
         */
        $button = new Button('Menu', ['context'=>$context]);
        $html = $button->get_html();

        $this->assertTrue($html->is_a('button', ['class'=>'btn btn-' . $context]));
    }

    /**
     * @dataProvider get_sizes
     */
    public function testAddSizeClassWhenSetSizeOption($size) {
        /**
         * For $size = ['xs', 'small', 'lg'], it should generates:
         *
         * <button class="btn btn-default btn-{$size}">
         *     Menu
         * </button>
         */
        $button = new Button('Menu', ['size'=>$size]);
        $html = $button->get_html();

        $this->assertTrue($html->is_a('button', ['class'=>'btn btn-default btn-' . $size]));
    }

    public function testWithExtraOptions() {
        /**
         * <button data-js="1" class="en btn btn-warning" id="button">
         *     Your <em>personal</em> menu
         * </button>
         */
        $button = new Button(['context'=>'warning', 'id'=>'button', 'class'=>'en', 'data-js'=>1], function(){
            return 'Your <em>personal</em> menu';
        });
        $html = $button->get_html();

        $this->assertTrue($html->is_a('button', ['class'=>'btn en btn-warning', 'data-js'=>1, 'id'=>'button']));
        $this->assertEquals('Your <em>personal</em> menu', $html->get_child(0));
    }


    public function get_contexts() {
        return [ ['success'], ['info'], ['warning'], ['danger'] ];
    }

    public function get_sizes() {
        return [ ['xs'], ['sm'], ['lg'] ];
    }
}
