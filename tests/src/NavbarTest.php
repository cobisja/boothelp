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

use BootHelp\Navbar;
use BootHelp\Nav;
use BootHelp\Helpers\LinkTo;
use BootHelp\Helpers\Vertical;
use BootHelp\Helpers\Horizontal;


class NavbarTest extends \PHPUnit_Framework_TestCase {
    public function testWithNoOptions() {
        /**
         * It should generates:
         *
         * <nav class="navbar navbar-default" role="navigation">
         *     <div class="container">
         *          <div class="navbar-header">
         *              <button data-target="#navbar-collapse-4880904" data-toggle="collapse" class="navbar-toggle" type="button">
         *                  <span class="sr-only">Toggle navigation</span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *              </button>
         *              <a href="#" class="navbar-brand">Home</a>
         *          </div>
         *          <div id="navbar-collapse-4880904" class="collapse navbar-collapse">
         *              <ul class="navbar-right nav navbar-nav">
         *                  <li><a href="#">Profile</a></li>
         *                  <li><a href="#">Settings</a></li>
         *              </ul>
         *          </div>
         *      </div>
         * </nav>
         */
        $navbar = new Navbar(function(){
            return [
                new Vertical(function(){ return new LinkTo('Home'); }),
                new Horizontal(function(){
                    return new Nav(['class'=>'navbar-right'], function(){
                        return [new LinkTo('Profile'), new LinkTo('Settings')];
                    });
                })
            ];
        });
        $html = $navbar->get_html();
        $this->validate_navbar($html);
    }

    public function testInvertedColorWhenSetInvertedOption() {
        /**
         * It should generates:
         *
         * <nav class="navbar navbar-inverse" role="navigation">
         *     <div class="container">
         *          <div class="navbar-header">
         *              <button data-target="#navbar-collapse-4880904" data-toggle="collapse" class="navbar-toggle" type="button">
         *                  <span class="sr-only">Toggle navigation</span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *              </button>
         *              <a href="#" class="navbar-brand">Home</a>
         *          </div>
         *          <div id="navbar-collapse-4880904" class="collapse navbar-collapse">
         *              <ul class="navbar-right nav navbar-nav">
         *                  <li><a href="#">Profile</a></li>
         *                  <li><a href="#">Settings</a></li>
         *              </ul>
         *          </div>
         *      </div>
         * </nav>
         */
        $navbar = new Navbar(['inverted'=>true], function(){
            return [
                new Vertical(function(){ return new LinkTo('Home'); }),
                new Horizontal(function(){
                    return new Nav(['class'=>'navbar-right'], function(){
                        return [new LinkTo('Profile'), new LinkTo('Settings')];
                    });
                })
            ];
        });
        $html = $navbar->get_html();
        $this->validate_navbar($html);
        $this->assertTrue($html->has_attribute('class', 'navbar-inverse'));
    }

    public function testGeneratesFuildContainerWhenSetFluidOption() {
        /**
         * It should generates:
         *
         * <nav class="navbar navbar-default" role="navigation">
         *     <div class="container-fluid">
         *          <div class="navbar-header">
         *              <button data-target="#navbar-collapse-4880904" data-toggle="collapse" class="navbar-toggle" type="button">
         *                  <span class="sr-only">Toggle navigation</span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *              </button>
         *              <a href="#" class="navbar-brand">Home</a>
         *          </div>
         *          <div id="navbar-collapse-4880904" class="collapse navbar-collapse">
         *              <ul class="navbar-right nav navbar-nav">
         *                  <li><a href="#">Profile</a></li>
         *                  <li><a href="#">Settings</a></li>
         *              </ul>
         *          </div>
         *      </div>
         * </nav>
         */
        $navbar = new Navbar(['fluid'=>true], function(){
            return [
                new Vertical(function(){ return new LinkTo('Home'); }),
                new Horizontal(function(){
                    return new Nav(['class'=>'navbar-right'], function(){
                        return [new LinkTo('Profile'), new LinkTo('Settings')];
                    });
                })
            ];
        });
        $html = $navbar->get_html();
        $this->validate_navbar($html);
        $this->assertTrue($html->get_child(0)->is_a('div', ['class'=>'container-fluid']));
    }

    /**
     * @dataProvider get_positions
     */
    public function testStaticNavBarWhenSetPositioOptionToUpOrDown($position) {
        /**
         * It should generates:
         *
         * <style>body {padding-{$position}: 70px}</style>
         * <nav class="navbar navbar-default navbar-fixed-{$position}" role="navigation">
         *     <div class="container">
         *          <div class="navbar-header">
         *              <button data-target="#navbar-collapse-4880904" data-toggle="collapse" class="navbar-toggle" type="button">
         *                  <span class="sr-only">Toggle navigation</span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *              </button>
         *              <a href="#" class="navbar-brand">Home</a>
         *          </div>
         *          <div id="navbar-collapse-4880904" class="collapse navbar-collapse">
         *              <ul class="navbar-right nav navbar-nav">
         *                  <li><a href="#">Profile</a></li>
         *                  <li><a href="#">Settings</a></li>
         *              </ul>
         *          </div>
         *      </div>
         * </nav>
         */
        $navbar = new Navbar(['position'=>$position], function(){
            return [
                new Vertical(function(){ return new LinkTo('Home'); }),
                new Horizontal(function(){
                    return new Nav(['class'=>'navbar-right'], function(){
                        return [new LinkTo('Profile'), new LinkTo('Settings')];
                    });
                })
            ];
        });
        $html = $navbar->get_html();
        $this->validate_navbar($html, true);
        $this->assertTrue($html->has_attribute('class', 'navbar-fixed-' . $position));

        $this->assertEquals("<style>body {padding-$position: 70px}</style>", $html->get_child(1)->to_string());
    }

    public function testStaticNavBarWhenSetPositioOptionToStatic() {
        /**
         * It should generates:
         *
         * <style>body {padding-{$position}: 70px}</style>
         * <nav class="navbar navbar-default navbar-static-top" role="navigation">
         *     <div class="container">
         *          <div class="navbar-header">
         *              <button data-target="#navbar-collapse-4880904" data-toggle="collapse" class="navbar-toggle" type="button">
         *                  <span class="sr-only">Toggle navigation</span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *              </button>
         *              <a href="#" class="navbar-brand">Home</a>
         *          </div>
         *          <div id="navbar-collapse-4880904" class="collapse navbar-collapse">
         *              <ul class="navbar-right nav navbar-nav">
         *                  <li><a href="#">Profile</a></li>
         *                  <li><a href="#">Settings</a></li>
         *              </ul>
         *          </div>
         *      </div>
         * </nav>
         */
        $navbar = new Navbar(['position'=>'static'], function(){
            return [
                new Vertical(function(){ return new LinkTo('Home'); }),
                new Horizontal(function(){
                    return new Nav(['class'=>'navbar-right'], function(){
                        return [new LinkTo('Profile'), new LinkTo('Settings')];
                    });
                })
            ];
        });
        $html = $navbar->get_html();
        $this->validate_navbar($html);
        $this->assertTrue($html->has_attribute('class', ['navbar-default', 'navbar-static-top']));
    }

    public function testWithExtraOptions() {
        /**
         * It should generates:
         *
         * <nav class="navbar navbar-default navbar-fixed-{$position}" role="navigation">
         *     <div class="container">
         *          <div data-js="1" class="en navbar-header">
         *              <button data-target="#my-navbar" data-toggle="collapse" class="navbar-toggle" type="button">
         *                  <span class="sr-only">Toggle navigation</span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *                  <span class="icon-bar"></span>
         *              </button>
         *              <a href="#" class="navbar-brand">Home</a>
         *          </div>
         *          <div id="my-navbar" class="en2 collapse navbar-collapse">
         *              <ul class="navbar-right nav navbar-nav">
         *                  <li><a href="#">Profile</a></li>
         *                  <li><a href="#">Settings</a></li>
         *              </ul>
         *          </div>
         *      </div>
         * </nav>
         */
        $id = 'my-navbar';
        $navbar = new Navbar(['id'=>$id], function(){
            return [
                new Vertical(['class'=>'en', 'data-js'=>1], function(){ return new LinkTo('Home'); }),
                new Horizontal(['class'=>'en2'], function(){
                    return new Nav(['class'=>'navbar-right'], function(){
                        return [new LinkTo('Profile'), new LinkTo('Settings')];
                    });
                })
            ];
        });
        $html = $navbar->get_html();
        $this->validate_navbar($html);
        $container = $html->get_child(0);

        $this->assertTrue($container->get_child(0)->has_attribute('data-js', 1));
        $this->assertTrue($container->get_child(0)->has_attribute('class', 'en'));
        $this->assertTrue($container->get_child(0)->get_child(0)->has_attribute('data-target', '#' . $id));
        $this->assertTrue($container->get_child(1)->has_attribute('id', 'my-navbar'));
        $this->assertTrue($container->get_child(1)->has_attribute('class', 'en2'));
    }

    public function get_positions() {
        return [ ['top'], ['bottom'] ];
    }


    private function validate_navbar($html, $position_top_or_bottom=false) {
        $this->assertTrue($html->is_a('nav', ['role'=>'navigation']));
        $this->assertTrue($html->has_attribute('class', 'navbar'));

        if (!$position_top_or_bottom) {
            $this->assertTrue(1 === $html->number_of_children());
        } else {
            $this->assertTrue(2 === $html->number_of_children());
        }

        $navbar_header = $html->get_child(0)->get_child(0);
        $navbar_collapse = $html->get_child(0)->get_child(1);

        $this->assertTrue($navbar_header->is_a('div'));
        $this->assertTrue($navbar_header->has_attribute('class','navbar-header'));
        $this->assertTrue($navbar_header->get_child(0)->is_a('button', ['class'=>'navbar-toggle']));
        $this->assertTrue($navbar_collapse->is_a('div'));
        $this->assertTrue($navbar_collapse->has_attribute('class', 'collapse navbar-collapse'));
        $this->assertTrue($navbar_collapse->get_child(0)->is_a('ul'));
        $this->assertTrue($navbar_collapse->get_child(0)->has_attribute('class', 'nav'));
    }
}
