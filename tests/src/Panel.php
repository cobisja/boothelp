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

use cobisja\BootHelp\Panel;


class PanelTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <div class="panel panel-default">
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         * </div>
         */
        $panel = new Panel('You accepted the Terms of service.');
        echo $panel;
        $html = $panel->get_html();
        $this->validate_panel($html);
    }

    public function testWithOptionsAndNoBodyContent() {
        /**
         * It should generates:
         *
         * <div id="my-panel" class="panel panel-default">
         *     <div class="panel-body"></div>
         * </div>
         */
        $panel = new Panel(['id'=>'my-panel']);
        $html = $panel->get_html();
        $this->validate_panel($html);
        $this->assertEquals('' , $html->get_child(0));
    }

    /**
     * @dataProvider get_heading_and_footer
     */
    public function testSetHeadingOrFooterOption($option) {
        /**
         * Setting heading option, it should generates:
         *
         * <div class="panel panel-default">
         *     <div class="panel-heading">
         *         Congratulations
         *     </div>
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         * </div>
         *
         * Setting footer option, it should generates:
         *
         * <div class="panel panel-default">
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         *     <div class="panel-footer">
         *         Pay attention to this!
         *     </div>
         * </div>

         */

        $panel = new Panel('You accepted the Terms of service.', $option);
        $html = $panel->get_html();
        $this->validate_panel($html);
        $this->assertTrue($html->has_a_child_of_type('div', ['class'=>'panel-heading']) ||
                $html->has_a_child_of_type('div', ['class'=>'panel-footer']));
    }

    public function testSetTitleOption() {
        /**
         * It should generates:
         *
         * <div class="panel panel-default">
         *     <div class="panel-heading">
         *         <h3 class="panel-title">Congratulations</h3>
         *     </div>
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         * </div>
         *
         * @return type
         */
        $panel = new Panel('You accepted the Terms of service.', ['title'=>'Congratulations']);
        $html = $panel->get_html();
        $this->validate_panel($html);
        $this->assertTrue($html->get_child(0)->get_child(0)->is_a('h3', ['class'=>'panel-title']));
    }

    /**
     * @dataProvider get_contexts
     */
    public function testSetContextOption($context)
    {
        /**
         * It should generates:
         *
         * <div class="panel panel-{$context}">
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         * </div>
         */
        $panel = new Panel('You accepted the Terms of service.', ['context'=>$context]);
        $html = $panel->get_html();
        $this->validate_panel($html);
        $this->assertTrue($html->has_attribute('class', 'panel-' . $context));
    }

    public function testWithCustomTag() {
        /**
         * It should generates:
         *
         * <aside class="panel panel-default">
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         * </aside>
         */
        $panel = new Panel('You accepted the Terms of service.', ['tag'=>'aside']);
        $html = $panel->get_html();
        $this->assertTrue($html->is_a('aside', ['class'=>'panel panel-default']));
    }

    public function testWithExtraOptions()
    {
        /**
         * It should generates:
         *
         * <div data-js="1" class="en panel panel-default" id="my-panel">
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         * </div>
         */
        $panel = new Panel('You accepted the Terms of service.', ['id'=>'my-panel', 'class'=>'en', 'data-js'=>1]);
        $html = $panel->get_html();
        $this->assertTrue($html->is_a('div', ['id'=>'my-panel', 'class'=>'panel en panel-default', 'data-js'=>1]));
    }

    public function testWithClosureContent() {
        /**
         * It should generates:
         *
         * <div class="panel panel-default">
         *     <div class="panel-body">
         *         You accepted the Terms of service.
         *     </div>
         * </div>
         */
        $panel = new Panel(function(){
            return 'You accepted the Terms of service';
        });
        $html = $panel->get_html();
        $this->validate_panel($html);
    }


    public function get_heading_and_footer()
    {
        return [[['heading' => 'Congratulations']], [['footer' => 'Pay attention to this!']]];
    }

    public function get_contexts() {
        return [ ['default'], ['primary'], ['success'], ['info'], ['warning'], ['danger'] ];
    }

    private function validate_panel($html) {
        $this->assertTrue($html->is_a('div'));
        $this->assertTrue($html->has_attribute('class', 'panel'));
        $this->assertTrue($html->has_a_child_of_type('div', ['class'=>'panel-body']));
    }
}
