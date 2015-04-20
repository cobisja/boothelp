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

use cobisja\BootHelp\Icon;

class IconTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <span class="glyphicon glyphicon-user"></span>
         */
        $icon = new Icon('user');
        $html = $icon->get_html();

        $this->assertTrue($html->is_a('span', ['class'=>'glyphicon glyphicon-user']));
    }

    /**
     * @dataProvider get_libraries
     */
    public function testSetLibraryOption($library) {
        /**
         * It should generates:
         *
         * <span class="fa fa-user"></span>
         */
        $icon = new Icon('user', ['library'=>$library]);
        $html = $icon->get_html();

        $class = "$library $library-user";
        $this->assertTrue($html->is_a('span', ['class'=>$class]));
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <span data-value="1" id="icon" class="fa-2x fa fa-user"></span>
         */
        $icon = new Icon('user', ['id'=>'icon', 'class'=>'fa-2x', 'data-value'=>1, 'library'=>'font_awesome']);
        $html = $icon->get_html();

        $this->assertTrue($html->is_a('span', ['id'=>'icon', 'data-value'=>1, 'class'=>'fa fa-2x fa-user']));
    }


    public function get_libraries()
    {
        return [['fa'], ['foo']];
    }
}
