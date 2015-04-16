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

use BootHelp\Nav;
use BootHelp\Dropdown;
use BootHelp\Helpers\LinkTo;
use BootHelp\Helpers\Divider;

class NavTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <ul role="tablist" class="nav nav-tabs">
         *     <li class="active"><a href="/">Home</a></li>
         *     <li><a href="#">Users</a></li>
         *     <li><a href="#">Profile</a></li>
         *</ul>
         */
        $nav = new Nav(function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users'),
                new LinkTo('Profile')
            ];
        });
        $this->validate_nav($nav->get_html());
    }

    public function testMakeTabDisabled() {
        /**
         * It should generates:
         *
         * <ul role="tablist" class="nav nav-tabs">
         *     <li class="active"><a href="/">Home</a></li>
         *     <li><a href="#">Users</a></li>
         *     <li class="disabled"><a href="#">Profile</a></li>
         * </ul>
         */
        $nav = new Nav(function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users'),
                new LinkTo('Profile', ['disabled'=>true])
            ];
        });
        $html = $nav->get_html();
        $this->validate_nav($html);
        $this->assertTrue($html->get_child(2)->is_a('li', ['class'=>'disabled']));
    }

    public function testSetLayoutOption() {
        /**
         * It should generates:
         *
         * <ul role="tablist" class="nav nav-tabs nav-justified">
         *     <li class="active"><a href="/">Home</a></li>
         *     <li><a href="#">Users</a></li>
         *     <li><a href="#">Profile</a></li>
         * </ul>
         */
        $nav = new Nav(['layout'=>'justified'], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users'),
                new LinkTo('Profile')
            ];
        });
        $html = $nav->get_html();
        $this->validate_nav($html);
        $this->assertTrue($html->has_attribute('class', 'nav-justified'));
    }

    public function testSetAsPillsOption() {
        /**
         * It should generates:
         *
         * <ul role="tablist" class="nav nav-pills">
         *     <li class="active"><a href="/">Home</a></li>
         *     <li><a href="#">Users</a></li>
         *     <li><a href="#">Profile</a></li>
         * </ul>
         */
        $nav = new Nav(['as'=>'pills'], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users'),
                new LinkTo('Profile')
            ];
        });
        $html = $nav->get_html();
        $this->validate_nav($html);
        $this->assertTrue($html->has_attribute('class', 'nav-pills'));
    }

    public function testSetAsPillsAndStackedLayoutOptions() {
        /**
         * It should generates:
         *
         * <ul role="tablist" class="nav nav-pills nav-stacked">
         *     <li class="active"><a href="/">Home</a></li>
         *     <li><a href="#">Users</a></li>
         *     <li><a href="#">Profile</a></li>
         * </ul>
         */
        $nav = new Nav(['as'=>'pills', 'layout'=>'stacked'], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users'),
                new LinkTo('Profile')
            ];
        });
        $html = $nav->get_html();
        $this->validate_nav($html);
        $this->assertTrue($html->has_attribute('class', 'nav-pills'));
        $this->assertTrue($html->has_attribute('class', 'nav-stacked'));
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <ul role="tablist" data-js="1" class="en nav nav-tabs" id="my-nav">
         *     <li class="active"><a href="/">Home</a></li>
         *     <li><a href="#">Users</a></li>
         *     <li><a href="#">Profile</a></li>
         * </ul>
         */
        $nav = new Nav(['id'=>'my-nav', 'class'=>'en', 'data-js'=>1], function(){
            return [
                new LinkTo('Home', ['href'=>'/']),
                new LinkTo('Users'),
                new LinkTo('Profile')
            ];
        });
        $html = $nav->get_html();
        $this->assertTrue($html->is_a('ul', ['id'=>'my-nav', 'data-js'=>1, 'class'=>'en nav nav-tabs']));
    }

    public function testDropdownIntoNav() {
        /**
         * It should generates:
         *
         * <ul class="nav nav-tabs">
         *     <li><a href="/">Home</a></li>
         *     <li class="dropdown">
         *         <a data-toggle="dropdown" class="dropdown-toggle" href="#">
         *             Social networks
         *             <span class="caret"></span>
         *         </a>
         *         <ul aria-labelledby="label-dropdown-7152901241" role="menu" class="dropdown-menu">
         *             <li><a href="#" role="menuitem">Twitter</a></li>
         *             <li><a href="#" role="menuitem">Facebook</a></li>
         *             <li class="divider"></li>
         *             <li><a href="#" role="menuitem">Other</a></li>
         *         </ul>
         *     </li>
         *     <li><a href="#">Profile</a></li>
         * </ul>
         */
        $nav = new Nav(function(){
            return [
                new LinkTo('Home', ['href'=>'/']),
                new Dropdown('Social networks', function(){
                    return [
                        new LinkTo('Twitter'),
                        new LinkTo('Facebook'),
                        new Divider(),
                        new LinkTo('Other')
                    ];
                }),
                new LinkTo('Profile')
            ];
        });
        $html = $nav->get_html();
        $this->validate_nav($html);

        $dropdown = $html->get_child(1);
        $this->assertTrue($dropdown->is_a('li', ['class'=>'dropdown']));
        $this->assertTrue(2 === $dropdown->number_of_children());
        $this->assertTrue($dropdown->get_child(0)->is_a('a', ['class'=>'dropdown-toggle']));
        $this->assertTrue($dropdown->get_child(1)->is_a('ul', ['class'=>'dropdown-menu']));
    }


    private function validate_nav($html) {
        $this->assertTrue($html->is_a('ul'));
        $this->assertTrue($html->has_attribute('class', 'nav'));
    }
}
