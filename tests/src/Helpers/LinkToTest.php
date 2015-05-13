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

namespace Tests\BootHelpHelpers;

use cobisja\BootHelp\Helpers\LinkTo;
use cobisja\BootHelp\Helpers\ContentTag;


class LinkToTest extends \PHPUnit_Framework_TestCase {
    public function testLinkWithJustTarget() {
        /**
         * It should generates:
         *
         * <a href="#">Home</a>
         */
        $html = '<a href="#">Home</a>';
        $link = new LinkTo('Home');

        $this->assertEquals($html, $link->to_string());
    }

    public function testLinkWithOnlyOptions() {
        /**
         * It should generates:
         *
         * <a class="#" href="#"></a>
         */
        $options = ['class'=>'en', 'id'=>'my-link'];
        $link = new LinkTo($options);
        $html = $link->get_html();

        $this->assertTrue($html->is_a('a', $options));
    }

    public function testLinkWithClosure() {
        /**
         * It should generates:
         *
         * <a href="#"><strong>Home</strong></a>
         */
        $link = new LinkTo(function(){
            return new ContentTag('strong', 'Home');
        });
        $html = $link->get_html();

        $this->assertTrue($html->is_a('a', ['href'=>'#']));
    }

    public function testLinkWithHref() {
        /**
         * It should generates:
         *
         * <a href="/home">Home</a>
         */
        $html = '<a href="/home">Home</a>';
        $link = new LinkTo('Home', ['href'=>'/home']);

        $this->assertEquals($html, $link->to_string());
    }
    
    public function testLinkWithBadgeOption() {
        /**
         * It should generates:
         * 
         * <a href="#">Inbox <span class="badge">42</span></a>
         */
        $link = new LinkTo('Inbox', ['badge'=>42]);
        $html = $link->get_html();
        
        $this->assertTrue($html->is_a('a'));
        $this->assertTrue($html->has_a_child_of_type('span', ['class'=>'badge']));
    }

    public function testLinkWithOptionsAndClosure() {
        /**
         * It should generates:
         *
         * <a href="#" class="en"><strong>Home</strong></a>
         */
        $options = ['class'=>'en'];
        $link = new LinkTo($options, function(){
            return new ContentTag('strong', 'Home');
        });
        $html = $link->get_html();

        $this->assertTrue($html->is_a('a', $options));
    }
}
