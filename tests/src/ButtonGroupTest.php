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

use cobisja\BootHelp\ButtonGroup;
use cobisja\BootHelp\Button;

class ButtonGroupTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <div role="group" aria-label="button-group" class="btn-group">
         *     <button class="btn btn-default">Button 1</button>
         *     <button class="btn btn-default">Button 2</button>
         *     <button class="btn btn-default">Button 3</button>
         * </div>
         */
        $button_group = new ButtonGroup(function(){
            return [
                new Button('Button 1'),
                new Button('Button 2'),
                new Button('Button 3')
            ];
        });
        $html = $button_group->get_html();
        $this->validate_button_group($html);
    }

    /**
     * @dataProvider get_sizes
     */
    public function testWithSizeOption($size) {
        /**
         * It should generates:
         *
         * <div role="group" aria-label="button-group" class="btn-group btn-group-{$size}">
         *     <button class="btn btn-default">Button 1</button>
         *     <button class="btn btn-default">Button 2</button>
         *     <button class="btn btn-default">Button 3</button>
         * </div>
         */
        $button_group = new ButtonGroup(['size'=>$size], function(){
            return [
                new Button('Button 1'),
                new Button('Button 2'),
                new Button('Button 3')
            ];
        });
        $html = $button_group->get_html();
        $this->validate_button_group($html);
        $this->assertTrue($html->has_attribute('class', 'btn-group-' . $size));
    }

    public function testWithVerticalOption() {
        /**
         * It should generates:
         *
         * <div role="group" aria-label="button-group" class="btn-group-vertical">
         *     <button class="btn btn-default">Button 1</button>
         *     <button class="btn btn-default">Button 2</button>
         *     <button class="btn btn-default">Button 3</button>
         * </div>
         */
        $button_group = new ButtonGroup(['vertical'=>true], function(){
            return [
                new Button('Button 1'),
                new Button('Button 2'),
                new Button('Button 3')
            ];
        });
        $html = $button_group->get_html();
        $this->validate_button_group($html, true);
    }

    public function testWithJustifiedOption() {
        /**
         * It should generates:
         *
         * <div role="group" aria-label="button-group" class="btn-group btn-group-justified">
         *     <div role="group" class="btn-group">
         *         <button class="btn btn-default">Button 1</button>
         *     </div>
         *     <div role="group" class="btn-group">
         *         <button class="btn btn-default">Button 2</button>
         *     </div>
         *     <div role="group" class="btn-group">
         *         <button class="btn btn-default">Button 3</button>
         *     </div>
         * </div>
         */
        $button_group = new ButtonGroup(['justified'=>true], function(){
            return [
                new Button('Button 1'),
                new Button('Button 2'),
                new Button('Button 3')
            ];
        });
        $html = $button_group->get_html();
        $this->validate_button_group($html);
        $this->assertTrue($html->has_attribute('class', 'btn-group-justified'));
        $child_1 = $html->get_child(0);
        $child_2 = $html->get_child(1);
        $child_3 = $html->get_child(2);

        $this->assertTrue(
            $child_1->is_a('div', ['class'=>'btn-group']) &&
            $child_2->is_a('div', ['class'=>'btn-group']) &&
            $child_3->is_a('div', ['class'=>'btn-group'])
        );
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <div id="my-button-group" role="group" aria-label="button-group" class="en btn-group">
         *     <button class="btn btn-default">Button 4</button>
         *     <button class="btn btn-default">Button 5</button>
         * </div>
         */
        $button_group = new ButtonGroup(['class'=>'en', 'id'=>'my-button-group'], function(){
            return [
                new Button('Button 4'),
                new Button('Button 5')
            ];
        });
        $html = $button_group->get_html();
        $this->validate_button_group($html);
        $this->assertTrue($html->has_attribute('id', 'my-button-group'));
        $this->assertTrue($html->has_attribute('class', 'en'));
    }

    public function get_sizes() {
        return [ ['xs'], ['sm'], ['lg'] ];
    }

    private function validate_button_group($html, $vertical=false) {
        $this->assertTrue($html->is_a('div', ['role'=>'group']));

        if (!$vertical) {
            $this->assertTrue($html->has_attribute('class', 'btn-group'));
        } else {
            $this->assertTrue($html->has_attribute('class', 'btn-group-vertical'));
        }
    }
}
