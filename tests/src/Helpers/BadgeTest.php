<?php

/*
 * BootHelp - PHP Helpers for Bootstrap
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

use cobisja\BootHelp\Helpers\Badge;

class BadgeTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         * 
         * <span class="badge">42</span>
         */        
        $badge = new Badge('42');
        $this->assertEquals('<span class="badge">42</span>', $badge->to_string());        
    }
    
    public function testWithExtraOptions() {
        /**
         * It should generates:
         * 
         * <span id="my-badge" class="en badge">42</span>
         */
        $badge = new Badge('42', ['id'=>'my-badge', 'class'=>'en']);
        $this->assertEquals('<span id="my-badge" class="en badge">42</span>', $badge->to_string());           
    }
}
