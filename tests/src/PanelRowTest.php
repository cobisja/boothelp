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

use BootHelp\PanelRow;
use BootHelp\Panel;
use BootHelp\Icon;


class PanelRowTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <div class="row">
         *     <div class="col-sm-4">
         *         <div class="panel panel-default">
         *             <div class="panel-body">Panel #1</div>
         *         </div>
         *     </div>
         *     <div class="col-sm-4">
         *         <div class="panel panel-default">
         *             <div class="panel-body">Panel #2</div>
         *         </div>
         *     </div>
         *     <div class="col-sm-4">
         *         <div class="panel panel-default">
         *             <div class="panel-body">Panel #3</div>
         *         </div>
         *     </div>
         * </div>
         */
        $column_class = 'col-sm-4';
        $panel_row = new PanelRow(['column_class' => $column_class], function(){
            return [ new Panel('Panel #1'), new Panel('Panel #2', ['context'=>'success']), new Panel('Panel #3') ];
        });
        $html = $panel_row->get_html();
        $this->assertTrue($html->is_a('div', ['class'=>'row']));
        $this->assertTrue(3 === $html->number_of_children());

        $this->assertTrue($html->get_child(0)->is_a('div', ['class'=>$column_class]));
        $this->assertTrue($html->get_child(1)->is_a('div', ['class'=>$column_class]));
        $this->assertTrue($html->get_child(2)->is_a('div', ['class'=>$column_class]));

        $panel_1 = $html->get_child(0)->get_child(0);
        $panel_2 = $html->get_child(1)->get_child(0);
        $panel_3 = $html->get_child(2)->get_child(0);

        $this->assertTrue($panel_1->is_a('div', ['class'=>'panel panel-default']));
        $this->assertTrue($panel_2->is_a('div', ['class'=>'panel panel-success']));
        $this->assertTrue($panel_3->is_a('div', ['class'=>'panel panel-default']));
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <div data-js="1" id="my-panel-row" class="en row">
         *     <div class="col-sm-6">
         *         <div class="panel panel-info">
         *             <div class="panel-heading">
         *                <h3 class="panel-title">User</h3>
         *             </div>
         *             <div class="panel-body">
         *                 John Smith
         *             </div>
         *         </div>
         *     </div>
         *     <div class="col-sm-6">
         *         <div class="panel panel-default">
         *             <div class="panel-heading">
         *                 <h3 class="panel-title">Phone</h3>
         *             </div>
         *             <div class="panel-body">
         *                 <span class="glyphicon glyphicon-earphone"></span>
         *                     323-555-5555
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $panel_row = new PanelRow(['column_class'=>'col-sm-6', 'id'=>'my-panel-row', 'class'=>'en', 'data-js'=>1], function(){
            return [
                new Panel('John Smith', ['title'=>'User', 'context'=>'info']),
                new Panel(['title'=>'Phone'], function(){ return new Icon('earphone') . ' 323-555-5555'; })
            ];
        });
        $html = $panel_row->get_html();
        $this->assertTrue($html->is_a('div', ['id'=>'my-panel-row', 'data-js'=>1, 'class'=>'row en']));
        $this->assertTrue(2 === $html->number_of_children());
    }
}
