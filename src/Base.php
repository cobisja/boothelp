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

namespace BHP;

use BHP\Helpers\Html;


class Base
{
    const SPACE = ' ';

    private static $dropdown_link = false;
    private static $alert_link = false;
    private static $navbar_vertical = false;
    private static $panel_column_class;
    private static $navbar_id = '';
    private static $nav_link = false;

    private $html;


    public static function get_dropdown_link() {
        return self::$dropdown_link;
    }

    public static function get_alert_link() {
        return self::$alert_link;
    }

    public static function get_navbar_vertical() {
        return self::$navbar_vertical;
    }

    public static function get_panel_column_class() {
        return self::$panel_column_class;
    }

    public static function get_navbar_id() {
        return self::$navbar_id;
    }

    public static function get_nav_link() {
        return self::$nav_link;
    }

    public static function set_dropdown_link($dropdown_link) {
        self::$dropdown_link = $dropdown_link;
    }

    public static function set_alert_link($alert_link) {
        self::$alert_link = $alert_link;
    }

    public static function set_navbar_vertical($navbar_vertical) {
        self::$navbar_vertical = $navbar_vertical;
    }

    public static function set_panel_column_class($panel_column_class) {
        self::$panel_column_class = $panel_column_class;
    }

    public static function set_navbar_id($navbar_id) {
        self::$navbar_id = $navbar_id;
    }

    public static function set_nav_link($nav_link) {
        self::$nav_link = $nav_link;
    }

    public function set_html_object($type, $attributes=[], $content='') {
        if (!is_object($type)) {
            $this->html = new Html($type, $attributes, $content);
        } else {
            $this->html = $type;
        }
    }

    public function get_html_object() {
        return $this->html;
    }

    public function get_attributes() {
        return $this->html->get_attributes();
    }

    public function __toString() {
        return (string) $this->html;
    }

    public function get_templates_path() {
        return self::TEMPLATES_PATH;
    }

    public static function append_class(&$hash, $new_class, $attribute = 'class') {
        $existing_class = isset($hash[$attribute]) ? $hash[$attribute] : null;
        $hash[$attribute] = join( ' ', array_filter( [$existing_class, $new_class], 'strlen' ) );
    }

    public static function context_for($context, $options=[]) {
        switch ($context) {
            case 'notice':
                $context = 'success';
                break;
            case 'alert':
                $context = 'danger';
                break;
        }

        if (isset($options['valid']) && in_array($context, $options['valid'])) {
            return $context;
        } elseif (isset($options['default'])) {
            return $options['default'];
        } else {
            return 'default';
        }
    }

    public static function set_options($base_options, &$options) {
        foreach ($base_options as $key => $default) {
            !isset($options[$key]) && $options[$key] = $default;
        }
    }

    public function get_function_num_args($args=[]) {
        return count(array_filter($args, function($item) { return !is_null($item); }));
    }
}
