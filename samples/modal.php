<?php

/*
 * bhp
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

use BHP\BHP;
use BHP\Samples\Sample;

$modals = [
    'title'=>'Modals',
    'samples'=>[
        [
            'name'=> 'Basic modals',
            'description'=>'Use <code>modal</code> without options to display a button which toggles a modal with the given body when clicked.',
            'php_code'=> "echo BHP::modal('Do what you want!');",
            'result'=> BHP::modal('Do what you want!'),
            'html_code'=>'<button data-target="#modal-5289275540" data-toggle="modal" class="btn btn-default">
  Modal
</button>
<div aria-hidden="true" aria-labelledby="label-modal-5289275540" role="dialog" tabindex="-1" id="modal-5289275540" class="modal fade" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 id="label-modal-5289275540" class="modal-title">Modal</h4>
      </div>
      <div class="modal-body">Do what you want!</div>
    </div>
  </div>
</div>'
        ],
        [
            'name'=> 'Custom-sized modals',
            'description'=>'Use <code>modal</code> with the <code>size</code> option to display either a large or a small modal.',
            'php_code'=> "echo BHP::modal('Do what you want!', ['size'=>'small']);",
            'result'=> BHP::modal('Do what you want!', ['size'=>'small']),
            'html_code'=>'<button data-target="#modal-4425106897" data-toggle="modal" class="btn btn-default">
  Modal
</button>
<div aria-hidden="true" aria-labelledby="label-modal-4425106897" role="dialog" tabindex="-1" id="modal-4425106897" class="modal fade" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 id="label-modal-4425106897" class="modal-title">Modal</h4>
      </div>
      <div class="modal-body">Do what you want!</div>
    </div>
  </div>
</div>'
        ],
        [
            'name'=> 'Modals with custom title',
            'description'=>'Use <code>modal</code> with the <code>title</code> option to display a custom title at the top of the modal.',
            'php_code'=> "echo BHP::modal('Do what you want!', ['title'=>'Terms of service']);",
            'result'=> BHP::modal('Do what you want!', ['title'=>'Terms of service']),
            'html_code'=>'<button data-target="#modal-5575576164" data-toggle="modal" class="btn btn-default">
  Terms of service
</button>
<div aria-hidden="true" aria-labelledby="label-modal-5575576164" role="dialog" tabindex="-1" id="modal-5575576164" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 id="label-modal-5575576164" class="modal-title">Terms of service</h4>
      </div>
      <div class="modal-body">Do what you want!</div>
    </div>
  </div>
</div>'
        ],
        [
            'name'=> 'Modals with custom button caption',
            'description'=>'Use <code>modal</code> with the <code>["button"=> "caption"]</code> option to display a custom caption on the toggle button.',
            'php_code'=> "echo BHP::modal('Do what you want!', ['button'=>['caption'=>'Click me!']]);",
            'result'=> BHP::modal('Do what you want!', ['button'=>['caption'=>'Click me!']]),
            'html_code'=>'<button data-target="#modal-6889181934" data-toggle="modal" class="btn btn-default">
  Click me!
</button>
<div aria-hidden="true" aria-labelledby="label-modal-6889181934" role="dialog" tabindex="-1" id="modal-6889181934" class="modal fade" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 id="label-modal-6889181934" class="modal-title">Modal</h4>
      </div>
      <div class="modal-body">Do what you want!</div>
    </div>
  </div>
</div>'
        ],
        [
            'name'=> 'Modals with custom button context',
            'description'=>'Use <code>modal</code> with the <code>["button"=> "context"]</code> option to change the color (and semantic context) of the toggle button.
Available contexts are <code>"default"</code> (default), <code>"primary"</code>, <code>"success"</code>, <code>"info"</code>, <code>"warning"</code> and <code>"danger"</code>.',
            'php_code'=> "echo BHP::modal('Do what you want!', ['title'=>'Terms of service', 'button'=>['context'=>'info']]);",
            'result'=> BHP::modal('Do what you want!', ['title'=>'Terms of service', 'button'=>['context'=>'info']]),
            'html_code'=>'<button data-target="#modal-7981589619" data-toggle="modal" class="btn btn-info">
  Terms of service
</button>
<div aria-hidden="true" aria-labelledby="label-modal-7981589619" role="dialog" tabindex="-1" id="modal-7981589619" class="modal fade" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 id="label-modal-7981589619" class="modal-title">Terms of service</h4>
      </div>
      <div class="modal-body">Do what you want!</div>
    </div>
  </div>
</div>'
        ],
        [
            'name'=> 'Modals with custom button size',
            'description'=>'Use modal with the <code>["button"=> "size"]</code> option to change the size of the toggle button.',
            'php_code'=> "echo BHP::modal('Do what you want!', ['button'=>['size'=>'xs']]);",
            'result'=> BHP::modal('Do what you want!', ['button'=>['size'=>'xs']]),
            'html_code'=>'<button data-target="#modal-5690375441" data-toggle="modal" class="btn btn-default btn-xs">
  Modal
</button>
<div aria-hidden="true" aria-labelledby="label-modal-5690375441" role="dialog" tabindex="-1" id="modal-5690375441" class="modal fade" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 id="label-modal-5690375441" class="modal-title">Modal</h4>
      </div>
      <div class="modal-body">Do what you want!</div>
    </div>
  </div>
</div>'
        ],
        [
            'name'=> 'Complex modals',
            'description'=>'To include HTML tags or a long text in the modal, pass your content in a closure.
You can specify a custom <code>id</code> which will be added to the modal’s <code>div</code> tag.
You can also specify a custom <code>["button"=> "class"]</code> which will add a class to the toggle <code>button</code> tag.',
            'php_code'=> "echo BHP::modal(['title'=>'Terms of service', 'size'=>'large', 'id'=>'modal', 'button'=>['class'=>'en']], function(){
    return
        BHP::content_tag('div', 'Please accept the Terms of service.', ['class'=>'modal-body']) .
        BHP::content_tag('div', ['class'=>'modal-footer'], function(){
            return BHP::content_tag('button', 'Accept', ['type'=>'button', 'class'=>'btn btn-primary']);
        });
});",
            'result'=> BHP::modal(['title'=>'Terms of service', 'size'=>'large', 'id'=>'modal', 'button'=>['class'=>'en']], function(){
    return
        BHP::content_tag('div', "Please accept the Terms of service.", ['class'=>'modal-body']) .
        BHP::content_tag('div', ['class'=>'modal-footer'], function(){
            return BHP::content_tag('button', 'Accept', ['type'=>'button', 'class'=>'btn btn-primary']);
        });
}),
            'html_code'=>'<button data-target="#modal" data-toggle="modal" class="btn btn-default">
  Terms of service
</button>
<div aria-hidden="true" aria-labelledby="label-modal" role="dialog" tabindex="-1" id="modal" class="modal fade" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <h4 id="label-modal" class="modal-title">Terms of service</h4>
      </div>
      <div class="modal-body">Please accept the Terms of service.</div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button">Accept</button>
      </div>
    </div>
  </div>
</div>'
        ]
    ]
];

/**
 * Modal samples.
 */

echo new Sample($modals);
