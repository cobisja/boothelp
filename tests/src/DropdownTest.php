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

use BootHelp\Dropdown;
use BootHelp\Helpers\LinkTo;

class DropdownTest extends \PHPUnit_Framework_TestCase  {
    public function testWithNoDropdownOptions() {
        /**
         * It should generates:
         *
         * <div class="dropdown">
         *     <button data-toggle="dropdown" id="label-dropdown-{id}" type="button" class="dropdown-toggle btn btn-default">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{id}" role="menu" class="dropdown-menu">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *         <li><a href="#" role="menuitem">Profile</a></li>
         *     </ul>
         * </div>
         */
        $dropdown = new Dropdown('Menu', function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users'),
                new LinkTo('Profile')
            ];
        });
        $html=$dropdown->get_html();

        $this->assertTrue($html->is_a('div', ['class'=>'dropdown']));
        $this->assertTrue(2 === $html->number_of_children());

        $child_1 = $html->get_child(0);
        $child_2 = $html->get_child(1);

        $this->assertTrue($child_1->is_a('button', ['data-toggle'=>'dropdown', 'class'=>'dropdown-toggle btn btn-default']));
        $this->assertTrue($child_2->is_a('ul', ['class'=>'dropdown-menu']));
        $this->assertTrue($child_1->get_child(1)->is_a('span', ['class'=>'caret']));
        $this->assertTrue(3 === $child_2->number_of_children());

        foreach($child_2->get_children() as $child) {
            $this->assertTrue($child->is_a('li'));
            $this->assertTrue($child->get_child(0)->is_a('a', ['role'=>'menuitem']));
        }
    }

    public function testIdToConnectButtonAndUlAreTheSame() {
        /**
         * It should generates:
         *
         * <div class="dropdown">
         *     <button data-toggle="dropdown" id="my-id" type="button" class="dropdown-toggle btn btn-default">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="my-id" role="menu" class="dropdown-menu">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *         <li><a href="#" role="menuitem">Profile</a></li>
         *     </ul>
         * </div>
         */
        $dropdown = new Dropdown('Menu', ['id'=>'my-id'], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users'),
                new LinkTo('Profile')
            ];
        });
        $html = $dropdown->get_html();

        $button_id = $html->get_child(0)->get_attribute('id');
        $ul_id = $html->get_child(1)->get_attribute('aria-labelledby');

        $this->assertEquals($button_id, $ul_id);
    }

    /**
     * @dataProvider get_contexts
     */
    public function testSetButtonContextClassWhenSetContextOption($context) {
        /**
         * For $context = ['success', 'info', 'warning', 'danger'], it should generates:
         *
         * <div class="dropdown">
         *     <button data-toggle="dropdown" id="label-dropdown-{id}" type="button" class="dropdown-toggle btn btn-{$context}">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{id}" role="menu" class="dropdown-menu">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *     </ul>
         * </div>
         */
        $dropdown = new Dropdown('Menu', ['context'=>$context], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users')
            ];
        });
        $html = $dropdown->get_html();
        $button = $html->get_child(0);

        $this->assertTrue($button->has_attribute('class', 'btn-' . $context));
    }

    /**
     * @dataProvider get_sizes
     */
    public function testAddButtonSizeClassWhenSetSizeOption($size) {
        /**
         * For $size = ['xs', 'sm', 'lg'], it should generates:
         *
         * <div class="dropdown">
         *     <button data-toggle="dropdown" id="label-dropdown-{id}" type="button" class="dropdown-toggle btn btn-default btn-{size}">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{id}" role="menu" class="dropdown-menu">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *     </ul>
         * </div>
         */
        $dropdown = new Dropdown('Menu', ['size'=>$size], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users')
            ];
        });
        $html = $dropdown->get_html();
        $button = $html->get_child(0);

        $this->assertTrue($button->has_attribute('class', 'btn-' . $size));
    }

    public function testSetUlClassWhenSpecifyRightAlignement() {
        /**
         * It should generates:
         *
         * <div class="dropdown">
         *     <button data-toggle="dropdown" id="label-dropdown-894474825" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-894474825" role="menu" class="dropdown-menu dropdown-menu-right">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *     </ul>
         * </div>
         */
        $dropdown = new Dropdown('Menu', ['align'=>'right'], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users')
            ];
        });
        $html = $dropdown->get_html();
        $ul = $html->get_child(1);

        $this->assertTrue($ul->has_attribute('class', 'dropdown-menu-right'));
    }

    public function testSetDivClassWhenSpecifyGroupableOption() {
        /**
         * It should generates:
         *
         * <div class="btn-group">
         *     <button data-toggle="dropdown" id="label-dropdown-{$id1}" type="button" class="dropdown-toggle btn btn-default" aria-expanded="false">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{$id1}" role="menu" class="dropdown-menu dropdown-menu-right">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *     </ul>
         * </div>
         * <div class="btn-group">
         *     <button data-toggle="dropdown" id="label-dropdown-{$id2}" type="button" class="dropdown-toggle btn btn-default">
         *         Profile
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{$id2}" role="menu" class="dropdown-menu">
         *      <li><a href="#" role="menuitem">Edit profile</a></li>
         *     </ul>
         * </div>
         */
        $dropdown1 = new Dropdown('Menu', ['groupable'=>true], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users')
            ];
        });
        $dropdown2 = new Dropdown('Profile', ['groupable'=>true], function(){
            return new LinkTo('Edit profile');
        });

        $html1 = $dropdown1->get_html();
        $html2 = $dropdown2->get_html();

        $this->assertTrue($html1->is_a('div', ['class'=>'dropdown btn-group']) &&
            $html2->is_a('div', ['class'=> 'dropdown btn-group']));
    }

    public function testSetDivClassWhenSetDirectionToUp() {
        /**
         * It should be generates:
         *
         * <div class="dropup">
         *     <button data-toggle="dropdown" id="label-dropdown-{id}" type="button" class="dropdown-toggle btn btn-default">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{id}" role="menu" class="dropdown-menu">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *     </ul>
         * </div>
         */
        $dropdown = new Dropdown('Menu', ['direction'=>'up'], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users')
            ];
        });
        $html = $dropdown->get_html();

        $this->assertTrue($html->is_a('div', ['class'=>'dropup']));
    }

    public function testCanGenerateASplitButton() {
        /**
         * It should generates:
         *
         * <div class="btn-group dropdown">
         *     <button class="btn btn-default" type="button">
         *         Menu
         *     </button>
         *     <button data-toggle="dropdown" id="label-dropdown-{$id}" type="button" class="dropdown-toggle btn btn-default">
         *         <span class="caret"></span>
         *         <span class="sr-only">Toggle Dropdown</span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{$id}" role="menu" class="dropdown-menu">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *     </ul>
         *</div>
         */
        $dropdown = new Dropdown('Menu', ['split'=>true], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users')
            ];
        });
        $html = $dropdown->get_html();

        $this->assertTrue(3 === $html->number_of_children());
        $child_1 = $html->get_child(0);
        $child_2 = $html->get_child(1);

        $this->assertTrue($child_1->is_a('button') && $child_2->is_a('button'));
        $this->assertTrue(2 === $child_2->number_of_children());
        $this->assertTrue($child_2->get_child(0)->is_a('span', ['class'=>'caret']));
        $this->assertTrue($child_2->get_child(1)->is_a('span', ['class'=>'sr-only']));
    }

    public function testSetCustomClassToButtonDropdown() {
        /**
         * It should be generates:
         *
         * <div class="dropup">
         *     <button data-toggle="dropdown" id="label-dropdown-{id}" type="button" class="en dropdown-toggle btn btn-default">
         *         Menu
         *         <span class="caret"></span>
         *     </button>
         *     <ul aria-labelledby="label-dropdown-{id}" role="menu" class="dropdown-menu">
         *         <li><a href="#" role="menuitem">Home</a></li>
         *         <li><a href="#" role="menuitem">Users</a></li>
         *     </ul>
         * </div>
         */
        $dropdown = new Dropdown('Menu', ['button'=>['class'=>'en']], function(){
            return [
                new LinkTo('Home'),
                new LinkTo('Users')
            ];
        });
        $html = $dropdown->get_html();
        $button = $html->get_child(0);

        $this->assertTrue($button->has_attribute('class', 'en'));
    }


    public function get_contexts() {
        return [ ['success'], ['info'], ['warning'], ['danger'] ];
    }

    public function get_sizes() {
        return [ ['xs'], ['sm'], ['lg'] ];
    }
}
