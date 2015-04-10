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

use BootHelp\Modal;
use BootHelp\Helpers\ContentTag;

class ModalTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions()
    {
        /**
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">Modal</h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal = new Modal('Do what you want!');
        $html = $modal->get_html();
        $this->validate_modal($html);
    }

    public function testCustomIdCanConnectButtonAndModal() {
        /**
         * <div id="modal-container-my-modal">
         *     <button data-target="#my-modal" data-toggle="modal" class="btn btn-default">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-my-modal" role="dialog" tabindex="-1" id="my-modal" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-my-modal" class="modal-title">Modal</h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal_id = 'my-modal';
        $modal = new Modal('Do what you want!', ['id'=>$modal_id]);
        $html = $modal->get_html();
        $this->validate_modal($html);

        $this->assertTrue($html->is_a('div', ['id'=>'modal-container-' . $modal_id]));
        $this->assertTrue($html->get_child(0)->has_attribute('data-target', '#' . $modal_id));
    }

    /**
     * @dataProvider get_modal_sizes
     */
    public function testCustomModalSizeWhenSetSizeOption($size) {
        /**
         *  For $size = ['sm', 'lg'], it should generates:
         *
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog modal-{$size}">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">Modal</h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal = new Modal('Do what you want!', ['size'=>$size]);
        $html = $modal->get_html();
        $this->validate_modal($html);
        $this->assertTrue($html->get_child(1)->get_child(0)->has_attribute('class', 'modal-' . $size));
    }

    public function testCustomModalTitleWhenSetTitleOption() {
        /**
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">
         *                         {$custom_title}
         *                     </h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $title = 'Terms of service';
        $modal = new Modal('Do what you want!', ['title'=>$title]);
        $html = $modal->get_html();
        $this->validate_modal($html);

        $modal_header = $html->get_child(1)->get_child(0)->get_child(0)->get_child(0);
        $this->assertEquals($title, $modal_header->get_child(1)->get_content());
    }

    public function testCustomButtonCaptionWhenSetButtonCaptionOption() {
        /**
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default">
         *         {$custom_caption}
         *     </button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">
         *                         Modal
         *                     </h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $button_caption = 'Click me!';
        $modal = new Modal('Do what you want!', ['button'=>['caption'=>$button_caption]]);
        $html = $modal->get_html();
        $this->validate_modal($html);

        $button = $html->get_child(0);
        $this->assertEquals($button_caption, $button->get_content());
    }

    /**
     * @dataProvider get_contexts
     */
    public function testSetButtonContextWhenSetContextOption($context) {
        /**
         * For $context = ['success', 'info', 'warning', 'danger'], it should generates:
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-{$context}">
         *         Modal
         *     </button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">
         *                         Modal
         *                     </h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal = new Modal('Do what you want!', ['button'=>['context'=>$context]]);
        $html = $modal->get_html();
        $this->validate_modal($html);

        $button = $html->get_child(0);

        $this->assertTrue($button->has_attribute('class', 'btn-' . $context));
    }


    /**
     * @dataProvider get_button_sizes
     */
    public function testSetButtonSizeWhenSetButtonOption($size) {
        /**
         *  For $size = ['xs', 'sm', 'lg'], it should generates:
         *
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default btn-{$size}">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">Modal</h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal = new Modal('Do what you want!', ['button'=>['size'=>$size]]);
        $html = $modal->get_html();
        $this->validate_modal($html);
        $button = $html->get_child(0);

        $this->assertTrue($button->has_attribute('class', 'btn-' . $size));
    }

    public function testWithClosure() {
        /**
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">Modal</h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal = new Modal(function(){
            return new ContentTag('div', 'Footer', ['class'=>'modal-footer']);
        });
        $html = $modal->get_html();
        $this->validate_modal($html, false);
    }

    public function testWithBodyAndClosure() {
        /**
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">Modal</h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal = new Modal('Do what you want!', function(){
            return new ContentTag('div', 'Footer', ['class'=>'modal-footer']);
        });
        $html = $modal->get_html();
        $this->validate_modal($html);
    }

    public function testWithOptionsAndClosureButNoBody() {
        /**
         * <div id="modal-container-modal-{$id}">
         *     <button data-target="#modal-{$id}" data-toggle="modal" class="btn btn-default">Modal</button>
         *     <div aria-hidden="true" arialabelledby="label-modal-{$id}" role="dialog" tabindex="-1" id="modal-{$id}" class="modal fade">
         *         <div class="modal-dialog modal-lg">
         *             <div class="modal-content">
         *                 <div class="modal-header">
         *                     <button data-dismiss="modal" class="close" type="button">
         *                         <span aria-hidden="true">×</span>
         *                         <span class="sr-only">Close</span>
         *                     </button>
         *                     <h4 id="label-modal-{$id}" class="modal-title">Modal</h4>
         *                 </div>
         *                 <div class="modal-body">
         *                     Do what you want!
         *                 </div>
         *             </div>
         *         </div>
         *     </div>
         * </div>
         */
        $modal = new Modal(['size'=>'large'], function(){
            return new ContentTag('div', 'Footer', ['class'=>'modal-footer']);
        });
        $html = $modal->get_html();
        $this->validate_modal($html, false);
    }

    public function get_contexts() {
        return [ ['success'], ['info'], ['warning'], ['danger'] ];
    }

    public function get_modal_sizes() {
        return [ ['sm'], ['lg'] ];
    }

    public function get_button_sizes() {
        return [ ['xs'], ['sm'], ['lg'] ];
    }

    private function validate_modal($html, $validate_presence_of_modal_body=true) {
        $this->assertTrue($html->is_a('div') && 2 === $html->number_of_children());

        $child_1 = $html->get_child(0);
        $child_2 = $html->get_child(1);

        $this->assertTrue($child_1->is_a('button', ['data-toggle'=>'modal']) && $child_1->has_attribute('class','btn'));
        $this->assertTrue($child_2->is_a('div', ['role'=>'dialog']) && $child_2->has_attribute('class', 'modal'));
        $this->assertTrue(1 === $child_2->number_of_children());

        $grand_child = $child_2->get_child(0);

        $this->assertTrue(1 === $grand_child->number_of_children());
        $this->assertTrue($grand_child->is_a('div') && $grand_child->has_attribute('class','modal-dialog'));

        $grand_grand_child = $grand_child->get_child(0);
        $this->assertTrue($grand_grand_child->is_a('div', ['class'=>'modal-content']));
        $this->assertTrue(2 <= $grand_grand_child->number_of_children());

        $modal_header = $grand_grand_child->get_child(0);
        $modal_body = $grand_grand_child->get_child(1);

        $this->assertTrue($modal_header->is_a('div', ['class'=>'modal-header']));

        if ($validate_presence_of_modal_body) {
            $this->assertTrue($modal_body->is_a('div', ['class'=>'modal-body']));
            $this->assertTrue(1 === $modal_body->number_of_children());
        }

        $this->assertTrue(2 === $modal_header->number_of_children());
        $this->assertTrue($modal_header->get_child(0)->is_a('button', ['data-dismiss'=>'modal']));
        $this->assertTrue($modal_header->get_child(1)->is_a('h4', ['class'=>'modal-title']));
    }
}
