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

use BootHelp\ProgressBar;


class ProgressBarTest extends \PHPUnit_Framework_TestCase {
    public function testWithPercentageOption() {
        /**
         * It should generates:
         *
         * <div class="progress">
         *     <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar">
         *         <span class="sr-only">30%</span>
         *     </div>
         * </div>
         */
        $percentage = 30;
        $progress_bar = new ProgressBar(['percentage'=>$percentage]);
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress']));

        $bar = $html->get_child(0);
        $this->assertTrue($bar->is_a('div', ['style'=>"width: $percentage%", 'role'=>'progressbar', 'class'=>'progress-bar']));
        $this->assertTrue($bar->has_a_child_of_type('span', ['class'=>'sr-only']));
        $this->assertEquals($percentage . '%', $bar->get_child(0)->get_content());
    }

    public function testWithBarLabel() {
        /**
         * It should generates:
         *
         * <div class="progress">
         *     <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar">
         *         30%
         *     </div>
         * </div>
         */
        $percentage = 30;
        $progress_bar = new ProgressBar(['percentage'=>$percentage, 'label'=>true]);
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress']));

        $bar = $html->get_child(0);
        $this->assertTrue($bar->is_a('div', ['style'=>"width: $percentage%", 'role'=>'progressbar', 'class'=>'progress-bar']));
        $this->assertEquals($percentage . '%', $bar->get_content());
    }

    public function testWithCustomizedBarLabel() {
        /**
         * It should generates:
         *
         * <div class="progress">
         *     <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar">
         *         thirty percent
         *     </div>
         * </div>
         */
        $percentage = 30;
        $customized_label = 'thirty percent';
        $progress_bar = new ProgressBar(['percentage'=>$percentage, 'label'=>$customized_label]);
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress']));

        $bar = $html->get_child(0);
        $this->assertTrue($bar->is_a('div', ['style'=>"width: $percentage%", 'role'=>'progressbar', 'class'=>'progress-bar']));
        $this->assertEquals($customized_label, $bar->get_content());
    }

    /**
     * @dataProvider get_contexts
     */
    public function testSettingContextualOption($context) {
        /**
         * It should generates:
         *
         * <div class="progress">
         *     <div class="progress-bar progress-bar-{$context}" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar">
         *         <span class="sr-only">30%</span>
         *     </div>
         * </div>
         */
        $percentage = 30;
        $progress_bar = new ProgressBar(['percentage'=>$percentage, 'context'=>$context]);
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress']));

        $bar = $html->get_child(0);
        $this->assertTrue($bar->is_a('div', ['style'=>"width: $percentage%", 'role'=>'progressbar']));
        $this->assertTrue($bar->has_attribute('class',['progress-bar', 'progress-bar-' . $context]));
    }

    public function testSettingStripedOption() {
        /**
         * It should generates:
         *
         * <div class="progress">
         *     <div class="progress-bar progress-bar-striped" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar">
         *         <span class="sr-only">30%</span>
         *     </div>
         * </div>
         */
        $percentage = 30;
        $progress_bar = new ProgressBar(['percentage'=>$percentage, 'striped'=>true]);
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress']));

        $bar = $html->get_child(0);
        $this->assertTrue($bar->is_a('div', ['style'=>"width: $percentage%", 'role'=>'progressbar']));
        $this->assertTrue($bar->has_attribute('class',['progress-bar', 'progress-bar-striped' ]));
    }

    public function testSettingAnimatedOption() {
        /**
         * It should generates:
         *
         * <div class="progress">
         *     <div class="progress-bar progress-bar-striped active" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar">
         *         <span class="sr-only">30%</span>
         *     </div>
         * </div>
         */
        $percentage = 30;
        $progress_bar = new ProgressBar(['percentage'=>$percentage, 'animated'=>true]);
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress']));

        $bar = $html->get_child(0);
        $this->assertTrue($bar->is_a('div', ['style'=>"width: $percentage%", 'role'=>'progressbar']));
        $this->assertTrue($bar->has_attribute('class', 'active progress-bar progress-bar-striped'));
    }

    public function testStackedProgressBars() {
        /**
         * It should generates:
         *
         * <div class="progress">
         *     <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar" class="progress-bar progress-bar-success">
         *         Completed
         *     </div>
         *     <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" style="width: 40%" role="progressbar" class="progress-bar progress-bar-warning progress-bar-striped active">
         *         Pending
         *     </div>
         * </div>
         */
        $progress_bar = new ProgressBar([
            ['percentage'=>30, 'context'=>'success', 'label'=>'Completed'],
            ['percentage'=>40, 'context'=>'warning', 'animated'=>true, 'label'=>'Pending']
        ]);
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress']));
        $this->assertTrue(2 === $html->number_of_children());
        $bar_1 = $html->get_child(0);
        $bar_2 = $html->get_child(1);

        $this->assertTrue($bar_1->is_a('div', ['style'=>"width: 30%", 'role'=>'progressbar']));
        $this->assertTrue($bar_2->is_a('div', ['style'=>"width: 40%", 'role'=>'progressbar']));
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <div id="container" class="en progress">
         *     <div data-js="1" id="my-bar" class="progress-bar progress-bar-striped active" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" style="width: 30%" role="progressbar">
         *         <span class="sr-only">30%</span>
         *     </div>
         * </div>
         */
        $progress_bar = new ProgressBar(
                ['percentage'=>30, 'id'=>'my-bar', 'data-js'=>1],
                ['id'=>'container', 'class'=>'en']
        );
        $html = $progress_bar->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'progress en', 'id'=>'container']));

        $bar_container = $html->get_child(0);
        $this->assertTrue($bar_container->is_a('div', ['style'=>"width: 30%", 'role'=>'progressbar', 'class'=>'progress-bar']));
        $this->assertTrue($bar_container->has_attribute('data-js', 1) && $bar_container->has_attribute('id', 'my-bar'));
    }


    public function get_contexts() {
        return [ ['success'], ['info'], ['warning'], ['danger'] ];
    }
}
