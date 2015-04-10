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

namespace Tests\BootHelpHelpers;

use BootHelp\Helpers\ContentTag;


class ContentTagTest extends \PHPUnit_Framework_TestCase {
    public function testWithEmptyContent() {
        /**
         * It should generates: '<p></p>'
         */
        $content_tag = new ContentTag('p');
        $html = $content_tag->get_html();

        $this->assertEquals('p', $html->get_type());
        $this->assertEquals('', $html->get_attributes());
        $this->assertTrue($html->get_content()->is_empty());
    }

    public function testWithNotEmptyContent() {
        /**
         *  It should generates:
         *
         *  <p>Hello world</p>'
         */
        $content_tag = new ContentTag('p', 'Hello world');

        $html = $content_tag->get_html();

        $this->assertEquals('p', $html->get_type());
        $this->assertEquals('', $html->get_attributes());
        $this->assertFalse($html->get_content()->is_empty());
        $this->assertEquals(1, $html->get_content()->length());
        $this->assertEquals('Hello world', $html->get_child(0));
    }

    public function testWithExtraOptions() {
        /**
         *  It should generates:
         *
         *  <p id="bar" class="foo">Hello world</p>
         */
        $content_tag = new ContentTag('p', 'Hello world', ['id'=>'bar', 'class'=>'foo'] );
        $html = $content_tag->get_html();

        $this->assertTrue($html->is_a('p', ['class'=>'foo', 'id'=>'bar']));
        $this->assertFalse($html->get_content()->is_empty());
        $this->assertEquals(1, $html->get_content()->length());
        $this->assertEquals('Hello world', $html->get_child(0));
    }

    public function testWithClosure() {
        /**
         * It should generates:
         *
         * <div><pre>Sample code</pre></div>
         */
        $content_tag = new ContentTag('div', function(){
            return new ContentTag('pre', 'Sample code');
        });
        $html = $content_tag->get_html();
        $child = $html->get_child(0);

        $this->assertTrue($html->is_a('div'));
        $this->assertTrue(1 === $html->get_content()->length());
        $this->assertTrue($child->is_a('pre'));
        $this->assertEquals('Sample code', $child->get_child(0));
    }

    public function testWithExtraOptionsAndClosure() {
        /**
         * It should generates:
         *
         * <div id="foo" class="bar">
         *     <a href="#" class="taz" readonly="readonly">
         *         Sample code
         *     </a>
         * </div>
         */
        $content_tag = new ContentTag('div', ['id'=>'foo', 'class'=>'bar'], function(){
            return new ContentTag('a', 'Sample code', ['href'=>'#', 'class'=>'taz', 'readonly'=>true]);
        });

        $html = $content_tag->get_html();
        $child = $html->get_child(0);
        $grand_child = $child->get_child(0);

        $this->assertTrue($html->is_a('div', ['class'=>'bar', 'id'=>'foo']));
        $this->assertTrue($child->is_a('a', ['class'=>'taz', 'readonly'=>true]));
        $this->assertEquals('Sample code', $grand_child);
    }

    public function testMultipleContentAtSameLevel() {
        /**
         * It should generates:
         *
         * <div id="main">
         *     <p class="comment">First content</p>
         *     <a role="navigation" href="/home">Go Home!</a>
         * </div>
         */
        $content_tag = new ContentTag('div', ['class'=>'main'], function(){
            return [
                new ContentTag('p', 'First content', ['class'=>'comment']),
                new ContentTag('a', ['role'=>'navigation', 'href'=>'/home'])
            ];
        });

        $html = $content_tag->get_html();
        $this->assertEquals(2, $html->get_content()->length());

        $first_child = $html->get_child(0);
        $second_child = $html->get_child(1);

        $this->assertTrue($first_child->is_a('p', ['class'=>'comment']));
        $this->assertTrue($second_child->is_a('a'));
    }
}
