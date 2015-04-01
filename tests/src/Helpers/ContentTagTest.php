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

namespace Tests\BHPHelpers;

use BHP\Helpers\ContentTag;


class ContentTagTest extends \PHPUnit_Framework_TestCase {
    public function testWithEmptyContent()
    {
        $html = '<p></p>';

        $content_tag = new ContentTag('p');

        $this->assertEquals($html, $content_tag);
    }

    public function testWithNotEmptyContent()
    {
        $html = '<p>Hello world</p>';

        $content_tag = new ContentTag('p', 'Hello world');

        $this->assertEquals($html, $content_tag);
    }

    public function testWithExtraOptions()
    {
        $html = '<p id="bar" class="foo">Hello world</p>';

        $options = ['id'=>'bar', 'class'=>'foo'];
        $content_tag = new ContentTag('p', 'Hello world', $options );

        $this->assertEquals($html, $content_tag);
    }

    public function testWithClosure()
    {
        $html = '<div><pre>Sample code</pre></div>';
        $content_tag = new ContentTag('div', function(){
            return new ContentTag('pre', 'Sample code');
        });

        $this->assertEquals($html, $content_tag);

    }

    public function testWithExtraOptionsAndClosure()
    {
        $html = '<div id="foo" class="bar"><a href="#" class="taz" readonly="readonly">Sample code</a></div>';
        $content_tag = new ContentTag('div', ['id'=>'foo', 'class'=>'bar'], function(){
            return new ContentTag('a', 'Sample code', ['href'=>'#', 'class'=>'taz', 'readonly'=>true]);
        });

        $this->assertEquals($html, $content_tag);
    }

}
