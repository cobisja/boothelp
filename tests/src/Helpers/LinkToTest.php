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

use BHP\Helpers\LinkTo;


class LinkToTest extends \PHPUnit_Framework_TestCase {
    public function testLinkWithJustTarget() {
        $html = '<a href="#">Home</a>';
        $link = new LinkTo('Home');

        $this->assertEquals($html, $link);
    }

    public function testLinkWithHref()
    {
        $html = '<a href="/home">Home</a>';
        $link = new LinkTo('Home', ['href'=>'/home']);

        $this->assertEquals($html, $link);
    }

    public function testLinkWithExtraOptions()
    {
        $html = '<a id="news" href="/articles">Articles</a>';
        $link = new LinkTo('Articles', ['id'=>'news', 'href'=>"/articles"]);

        $this->assertEquals($html, $link);
    }

    public function testLinkWithExtraOptionsAndClosure()
    {
        $html = '<a href="/articles" id="news" class="article"><strong>Articles</strong></a>';
        $options = ['href'=>'/articles', 'id'=>'news', 'class'=>'article'];
        $link = new LinkTo($options, function(){
            return '<strong>Articles</strong>';
        });

        $this->assertEquals($html, $link);
    }
}
