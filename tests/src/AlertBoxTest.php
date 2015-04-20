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

use cobisja\BootHelp\AlertBox;
use cobisja\BootHelp\Helpers\LinkTo;

class AlertBoxTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoAlertOptions() {
        /**
         * It should generates:
         *
         * <div class="alert alert-info" role="alert">
         *     Hello world
         * </div>
         */
        $alert_box = new AlertBox('Hello world');
        $html = $alert_box->get_html();

        $this->assertTrue($html->is_a('div', ['class'=>'alert alert-info', 'role'=>'alert']));
        $this->assertTrue(1 === $html->get_content()->length());
        $this->assertEquals('Hello world', $html->get_child(0));
    }

    public function testDisplayDismissButtonWhenSetToTrueDismissOption() {
        /**
         * It should generates:
         *
         * <div class="alert alert-info alert-dismissible" role="alert">
         *     <button aria-label="Close" data-dismiss="alert" class="close" type="button">
         *         <span aria-hidden="true">×</span>
         *     </button>
         *     You accepted the Terms of service.
         * </div>
         */
        $alert_box = new AlertBox('You accepted the Terms of service.', ['dismissible'=>true]);
        $html = $alert_box->get_html();
        $child_1 = $html->get_child(0);
        $child_2 = $html->get_child(1);
        $grand_child = $child_1->get_child(0);

        $this->assertTrue(2 === $html->number_of_children());
        $this->assertTrue($child_1->is_a('button', ['class'=>'close', 'data-dismiss'=>'alert']));
        $this->assertTrue($grand_child->is_a('span', ['aria-hidden'=>true]));
        $this->assertEquals("&times;", $grand_child->get_content());
        $this->assertEquals('You accepted the Terms of service.', $child_2);
    }

    public function testNotDisplayDismissButtonWhenSetToFalseDismissOption() {
        /**
         * It should generates:
         *
         * <div class="alert alert-info role="alert">
         *     You accepted the Terms of service.
         * </div>
         */
        $alert_box = new AlertBox('You accepted the Terms of service.', ['dismissible'=>false]);
        $html = $alert_box->get_html();
        $child = $html->get_child(0);

        $this->assertTrue($html->is_a('div', ['class'=>'alert alert-info', 'role'=>'alert']));
        $this->assertTrue(1 === $html->number_of_children());
        $this->assertEquals('You accepted the Terms of service.', $child);
    }

    /**
     * @dataProvider get_contexts
     */
    public function testSetContextClassWhenSetContextOption($context) {
        /**
         * For $context = ['success', 'info', 'warning', 'danger'], it should generates:
         *
         * <div class="alert alert-{$context}" role="alert">
         *     You accepted the Terms of service.
         * </div>
         */
        $alert_box = new AlertBox('Hello world', ['context'=>$context]);
        $html = $alert_box->get_html();

        $this->assertTrue($html->is_a('div', ['class'=>'alert alert-' . $context, 'role'=>'alert']));
    }

    public function testSetCorrectClassToLinksWithinAlerts() {
        /**
         * It should generates:
         *
         * <div class="alert alert-info" role="alert">
         *     <a href="#" class="alert-link">This a link!</a>
         * </div>
         *
         */
        $alert_box = new AlertBox(function(){ return new LinkTo('This is a link!');});
        $html = $alert_box->get_html();
        $child = $html->get_child(0);

        $this->assertTrue($html->is_a('div', ['class'=>'alert alert-info', 'role'=>'alert']));
        $this->assertTrue($child->is_a('a', ['class'=>'alert-link']));
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <div class="important alert alert-info" data-value="1" id="my-alert" role="alert">
         *     Hello world!
         * </div>
         */

        $alert_box = new AlertBox('Hello world', ['class'=>'important', 'id'=>'my-alert']);
        $html = $alert_box->get_html();

        $this->assertTrue($html->is_a('div', ['class'=>'important alert alert-info', 'id'=>'my-alert', 'role'=>'alert']));
    }

    public function testWithMultipleContent() {
        /**
         * It should generates:
         *
         * <div class="alert alert-warning alert-dismissible" role="alert">
         *     <button aria-label="Close" data-dismiss="alert" class="close" type="button">
         *         <span aria-hidden="true">×</span>
         *     </button>
         *     <strong>Well done!</strong> You successfully read
         *     <a href="#" class='alert-link'>this important alert message</a>
         * </div>
         */
        $alert_box = new AlertBox(['context'=>'warning', 'dismissible'=>true], function(){
            return [
                '<strong>Well done!</strong> You successfully read ',
                new LinkTo('this important alert message')
            ];
        });

        $html = $alert_box->get_html();
        $child_1 = $html->get_child(1);
        $child_2 = $html->get_child(2);

        $this->assertEquals('<strong>Well done!</strong> You successfully read ', $child_1);
        $this->assertTrue($child_2->is_a('a'));
    }


    public function get_contexts() {
        return [ ['success'], ['info'], ['warning'], ['danger'] ];
    }
}
