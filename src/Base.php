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

namespace cobisja\BootHelp;

use cobisja\BootHelp\Helpers\Html\Html;

/**
 * Utility class that holds several methods and attributes shared by all BootHelp classes.
 * It's so useful to get aware about the context under a BootHelp class is being instantiated,
 * so its attributes can be established in a correct way.
 * For example, when a LinkTo class is being instantiated, its attributes are different if
 * it is under a NavBar, Nav or Panel.
 */
class Base {
    const SPACE = ' ';

    /**
     * @var boolean to know if the object is under Dropdown context.
     */
    private static $dropdown_link = false;

    /**
     * @var boolean to know if the object is under AlertBox context.
     */
    private static $alert_link = false;

    /**
     * @var boolean to know if the object is under NavBar context.
     */
    private static $navbar_vertical = false;

    /**
     * @var string to know the specific Panel column class used.
     */
    private static $panel_column_class;

    /**
     * @var string to know the Navbar id generated.
     */
    private static $navbar_id = '';

    /**
     * @var boolean to know if the object is under Nav context.
     */
    private static $nav_link = false;

    /**
     * @var boolean to know the button group justified context.
     */
    private static $justified_button_group = false;

    /**
     * @var HTML holds an HTML instance.
     */
    private $html;


    /**
     * Returns the Dropdown context status.
     *
     * @return boolean Dropdown context status.
     */
    public static function get_dropdown_link() {
        return self::$dropdown_link;
    }

    /**
     * Returns the AlerBox context status.
     *
     * @return boolean AlertBox context status.
     */
    public static function get_alert_link() {
        return self::$alert_link;
    }

    /**
     * Returns the NavBar context status.
     *
     * @return boolean NavBar context status.
     */
    public static function get_navbar_vertical() {
        return self::$navbar_vertical;
    }

    /**
     * Returns the Panel column class used.
     *
     * @return string Panel column class.
     */
    public static function get_panel_column_class() {
        return self::$panel_column_class;
    }

    /**
     * Returns the NavBar id generated.
     *
     * @return string NavBar id.
     */
    public static function get_navbar_id() {
        return self::$navbar_id;
    }

    /**
     * Returns the Nav context status.
     *
     * @return boolean Nav context status.
     */
    public static function get_nav_link() {
        return self::$nav_link;
    }

    /**
     * Sets the Dropdown context for a LinkTo object.
     *
     * @param boolean $dropdown_link Dropdown context. True if the object is under Dropdown context, false otherwise.
     */
    public static function set_dropdown_link($dropdown_link) {
        self::$dropdown_link = $dropdown_link;
    }

    /**
     * Sets the AlertBox context for a LinkTo object.
     *
     * @param boolean $alert_link Dropdown context. True if the object is under AlertBox context, false otherwise.
     */
    public static function set_alert_link($alert_link) {
        self::$alert_link = $alert_link;
    }

    /**
     * Sets the NavBar context.
     *
     * @param boolean $navbar_vertical NavBar context. True if the object is under NavBar context, false otherwise.
     */
    public static function set_navbar_vertical($navbar_vertical) {
        self::$navbar_vertical = $navbar_vertical;
    }

    /**
     * Set the specific column class for a Panel object.
     *
     * @param string $panel_column_class column class.
     */
    public static function set_panel_column_class($panel_column_class) {
        self::$panel_column_class = $panel_column_class;
    }

    /**
     * Sets the specific id generated for a NavBar object.
     *
     * @param string $navbar_id NavBar id.
     */
    public static function set_navbar_id($navbar_id) {
        self::$navbar_id = $navbar_id;
    }

    /**
     * Sets the Nav context for a LinkTo object.
     *
     * @param boolean $nav_link Dropdown context. True if the object is under Nav context, false otherwise.
     */
    public static function set_nav_link($nav_link) {
        self::$nav_link = $nav_link;
    }

    /**
     * Gets Button Group's justified context.
     * @return boolean Button Group justified context.
     */
    static function get_justified_button_group() {
        return self::$justified_button_group;
    }

    /**
     * Sets Button Group's context to justified.
     */
    static function set_justified_button_group($justified_button_group) {
        self::$justified_button_group = $justified_button_group;
    }

    /**
     * Sets the html attribute with a instance of HTML.
     *
     * @param mixed $type type of Html object.
     * @param array $attributes Html attributes.
     * @param mixed $content Html content.
     */
    public function set_html_object($type, $attributes=[], $content='') {
        if (!is_object($type) && !is_null($type)) {
            $this->html = new Html($type, $attributes, $content);
        } else {
            $this->html = $type;
        }
    }

    /**
     * Returns the Html instance stored in html attribute.
     *
     * @return HTML html instance.
     */
    public function get_html() {
        return $this->get_html_object();
    }
    /**
     * Returns the Html instance stored in html attribute.
     *
     * @return HTML html instance.
     */
    public function get_html_object() {
        return $this->html;
    }

    /**
     * Helper method to get the string representation of any BootHelp object.
     *
     * @return string string representation.
     */
    public function to_string() {
        return $this->__toString();
    }

    /**
     * Magic method to get the string representation of any BootHelp object.
     *
     * @return string string representation.
     */
    public function __toString() {
        return trim($this->html);
    }

    /**
     * Helper method to append an html class to the existing ones.
     *
     * @param array $hash arrays that holds a 'class' entry.
     * @param string $new_class new class to be added.
     * @param string $attribute attribute name that represents a html class entry.
     */
    public static function append_class(&$hash, $new_class, $attribute = 'class') {
        $existing_class = isset($hash[$attribute]) ? $hash[$attribute] : null;
        $hash[$attribute] = join(self::SPACE, array_filter([$existing_class, $new_class], 'strlen'));
    }

    /**
     * Helper method to get the correct context for any BootHelp object.
     *
     * @param string $context context
     * @param array $options array that holds valid or default contexts values.
     * @return string correct context.
     */
    public static function context_for($context, $options=[]) {
        if (isset($options['valid']) && in_array($context, $options['valid'])) {
            return $context;
        } elseif (isset($options['default'])) {
            return $options['default'];
        } else {
            return 'default';
        }
    }

    /**
     * Helper method to merge an array with default options values with another array.
     *
     * @param array $base_options array with default options values.
     * @param array $options array to be merged into.
     */
    public static function set_options($base_options, &$options) {
        foreach ($base_options as $key => $default) {
            !isset($options[$key]) && $options[$key] = $default;
        }
    }

    /**
     * Tells the number of arguments passed to a method.
     *
     * @param array $args array of arguments.
     * @return int number of arguments.
     */
    public function get_function_num_args($args=[]) {
        return count(array_filter($args, function($item) { return !is_null($item); }));
    }
}
