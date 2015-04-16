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

namespace BootHelp;

use BootHelp\Base;
use BootHelp\Helpers\ContentTag;


/**
 * Generates an HTML block tag that follows the Bootstrap documentation
 * on how to display <strong>Navbar</strong> component.
 *
 * See {@link http://getbootstrap.com/components/#navbar} for more information.
 */
class Navbar extends Base {
    /**
     * Initializes a Navbar instance.
     *
     * @param array $options options the display options for the NavBar.
     * @param mixed $block Block to generate a customized inside NavBar content.
     */
    public function __construct($options = [], callable $block = null) {
        if (is_callable($options)) {
            $block = $options;
            $options = [];
        }

        Base::set_navbar_id(!isset($options['id']) ? ('navbar-collapse-' . (string) (mt_rand(1, pow(10, 7)))) : $options['id']);
        unset($options['id']);
        $navbar = $this->build_navbar($options, $block);
        Base::set_navbar_id('');

        $this->set_html_object($navbar->get_html_object());
    }

    /**
     * Generates a Navbar object.
     *
     * @param array $options Navbar's options
     * @param closure $block closure to generate Navbar's content.
     * @return ContentTag a ContentTag instance that represents a NavBar.
     */
    private function build_navbar($options = [], $block = null) {
        $style_padding = $this->body_style_tag_for_navbar($options);
        unset($options['padding']);
        $this->append_class($options, $this->navbar_class($options));
        $options['role'] = 'navigation';

        return (new ContentTag(
            'nav',
            $options, function() use ($style_padding, $options, $block){
                return array_filter([
                    new ContentTag('div', ['class'=>$this->navbar_container_class($options)], function() use ($block) {
                        return call_user_func($block);
                    }),
                    $style_padding
                ], 'strlen');
            }
        ));
    }

    /**
     * Generate a 'style tag' to sets a properly spacing for Navbar with fixed position.
     *
     * @param array $options information about Navbar fixed position.
     * @return string style tag
     */
    private function body_style_tag_for_navbar(&$options = []) {
        $body_style_tag = '';
        $options['padding'] = isset($options['padding']) ? $options['padding'] : 70;

        if ($padding_type = $this->padding_type_for(isset($options['position']) ? $options['position'] : '')) {
            $body_style_tag = new ContentTag('style', "body {padding-$padding_type: " . $options['padding'] . 'px}');
        } else {
            $body_style_tag = null;
        }

        return $body_style_tag;
    }

    /**
     * Tells if the class is dealing with a fixed top or fixed bottom Navbar.
     * @param type $position Navbar position information.
     * @return string type of fixed position (top or bottom).
     */
    private function padding_type_for($position) {
        $matches = [];
        preg_match('/fixed-(?<type>top|bottom)$/', $this->navbar_position_class_for($position), $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }

    /**
     * Returns the class to be applied to the Navbar.
     *
     * @param array $options class information.
     * @return string class fot the Navbar.
     */
    private function navbar_class(&$options = []) {
        $style = isset($options['inverted']) && $options['inverted'] ? 'inverse' : 'default';
        $position = isset($options['position']) ? $this->navbar_position_class_for($options['position']) : null;

        $this->append_class($options, 'navbar');
        $this->append_class($options, "navbar-$style");

        if ($position) {
          $this->append_class($options, "navbar-$position");
          unset($options['position']);
        }

        $class = $options['class'];
        unset($options['class']);

        return $class;
    }

    /**
     * Tells what kind of position class has to be applied to the Navbar.
     *
     * @param string $position position information.
     * @return string position class.
     */
    private function navbar_position_class_for($position) {
        switch ($position) {
            case 'static': case 'static_top':
                $class = 'static-top';
                break;
            case 'top': case 'fixed_top':
                $class = 'fixed-top';
                break;
            case 'bottom': case 'fixed_bottom':
                $class = 'fixed-bottom';
                break;
            default:
                $class = '';
        }

        return $class;
    }

    /**
     * Tells if the Navbar has to be in a standard container or in a fluid one.
     *
     * @param type $options
     * @return type
     */
    private function navbar_container_class($options = []) {
        return isset($options['fluid']) && $options['fluid'] ?  'container-fluid' : 'container';
    }
}
