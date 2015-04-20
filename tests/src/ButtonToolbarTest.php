<?php

/*
 * BootHelp
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

use cobisja\BootHelp\ButtonToolbar;
use cobisja\BootHelp\ButtonGroup;
use cobisja\BootHelp\Button;

class ButtonToolbarTest extends \PHPUnit_Framework_TestCase  {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <div role="toolbar" aria-label="toolbar" class="btn-toolbar">
         *     <div role="group" aria-label="button-group" class="btn-group">
         *         <button class="btn btn-default">Button 1</button>
         *         <button class="btn btn-default">Button 2</button>
         *         <button class="btn btn-default">Button 3</button>
         *     </div>
         *     <div role="group" aria-label="button-group" class="btn-group">
         *         <button class="btn btn-default">Button 4</button>
         *         <button class="btn btn-default">Button 5</button>
         *     </div>
         * </div>
         */

        $toolbar = new ButtonToolbar(function() {
            return [
                new ButtonGroup(function(){
                    return [
                        new Button('Button 1'),
                        new Button('Button 2'),
                        new Button('Button 3')
                    ];
                }),
                new ButtonGroup(function(){
                    return [
                        new Button('Button 4'),
                        new Button('Button 5')
                    ];
                })
            ];
        });
        $html = $toolbar->get_html();
        $this->validate_button_toolbar($html);
        $this->assertTrue(2 === $html->number_of_children());
        $this->assertTrue(
            $html->get_child(0)->is_a('div', ['role'=>'group', 'class'=>'btn-group']) &&
            $html->get_child(1)->is_a('div', ['role'=>'group', 'class'=>'btn-group'])
        );
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <div id="my-toolbar" role="toolbar" aria-label="toolbar" class="en btn-toolbar">
         *     <div role="group" aria-label="button-group" class="btn-group">
         *         <button class="btn btn-default">Button 1</button>
         *         <button class="btn btn-default">Button 2</button>
         *         <button class="btn btn-default">Button 3</button>
         *     </div>
         *     <div role="group" aria-label="button-group" class="btn-group">
         *         <button class="btn btn-default">Button 4</button>
         *         <button class="btn btn-default">Button 5</button>
         *     </div>
         * </div>
         */

        $toolbar = new ButtonToolbar(['id'=>'my-toolbar', 'class'=>'en'], function() {
            return [
                new ButtonGroup(function(){
                    return [
                        new Button('Button 1'),
                        new Button('Button 2'),
                        new Button('Button 3')
                    ];
                }),
                new ButtonGroup(function(){
                    return [
                        new Button('Button 4'),
                        new Button('Button 5')
                    ];
                })
            ];
        });
        $html = $toolbar->get_html();
        $this->validate_button_toolbar($html);
        $this->assertTrue($html->has_attribute('id', 'my-toolbar'));
        $this->assertTrue($html->has_attribute('class', 'en'));
    }


    private function validate_button_toolbar($html) {
        $this->assertTrue($html->is_a('div', ['role'=>'toolbar']));
        $this->assertTrue($html->has_attribute('class', 'btn-toolbar'));
        $this->assertTrue(2 === $html->number_of_children());
        $this->assertTrue(
            $html->get_child(0)->is_a('div', ['role'=>'group', 'class'=>'btn-group']) &&
            $html->get_child(1)->is_a('div', ['role'=>'group', 'class'=>'btn-group'])
        );
    }
}
