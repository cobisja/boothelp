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

namespace cobisja\BootHelp\Helpers\Html;

use cobisja\BootHelp\Helpers\Html\HtmlAttribute;
use cobisja\BootHelp\Helpers\Html\HtmlContent;

/**
 * Class Html: Handle of logic related to HTML generation base on a BootHelp helper.
 */
class Html {
    const SPACE = ' ';

    /**
     * @var string Type of html tag.
     */
    private $type;

    /**
     * @var array Attributes associated to html tag.
     */
    private $attributes = [];

    /**
     * @var mixed Inner content of html tag.
     */
    private $content;


    /**
     * Build an Html instance.
     *
     * @param string $type type of html tag.
     * @param mixed $attributes attributes of html tag (ussualy an array).
     * @param mixed $content inner content of html tag
     */
    public function __construct($type, $attributes, $content='') {
        $this->set_type($type);
        $this->set_attributes($attributes);
        $this->set_content($content);
    }

    /**
     * Returns type of html tag.
     *
     * @return string type of html.
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * Returns Attributes of html tag.
     *
     * @return mixed whole set of attributes.
     */
    public function get_attributes() {
        return (0 === count($this->attributes)) ? '' : $this->attributes;
    }

    /**
     * Return a string representing the html attributes.
     *
     * @return string string representation of the whole set of attributes.
     */
    public function get_attributes_to_string() {
        $attributes = $this->get_attributes();

        if (is_array($attributes)) {
            $attributes_string = join(self::SPACE, array_map(function($attribute){
                return (string) $attribute;
            }, $attributes));
        } else {
            $attributes_string = $attributes;
        }

        return $attributes_string;
    }

    /**
     * Returns an array containing the html attributes.
     *
     * @return array array of attributes.
     */
    public function get_attributes_to_array() {
        $attrs = [];

        array_map(function($attribute) use (&$attrs) {
            $attrs[$attribute->get_name()] = $attribute->get_value();
        }, $this->get_attributes());

        return $attrs;
    }

    /**
     * Returns the indicated attribute's value
     *
     * @param string $name attribute's name.
     * @param array $options options to specify format of the value to return.
     * @return mixed value of specific attribute.
     */
    public function get_attribute($name, array $options=[]) {
        $attribute_value = $this->get_attribute_with_value($name);
        return isset($options['as']) && 'array' === $options['as'] ? explode(self::SPACE, $attribute_value) : $attribute_value;
    }

    /**
     * Indicates if an given attribute with a especific value exists.
     *
     * @param string $name name of html attribute.
     * @param mixed $with_value values associated with the html attribute asked for.
     * @return boolean true if exists, false otherwise.
     */
    public function has_attribute($name, $with_value) {
        return !is_null($this->get_attribute_with_value($name, $with_value));
    }

    /**
     * Return inner html tag content.
     *
     * @return mixed whole content of html object.
     */
    public function get_content() {
        return $this->content;
    }

    /**
     * Sets html tag type.
     *
     * @param string $type type of html tag.
     */
    public function set_type($type) {
        $this->type = $type;
    }

    /**
     * Sets html attributes.
     *
     * @param array $attributes html tag attributes.
     */
    public function set_attributes($attributes) {
        !is_array($attributes) ? $attributes = [] : null;

        foreach ($attributes as $name => $value) {
            $this->attributes[] = new HtmlAttribute($name, $value);
        }
    }

    /**
     * Sets inner html tag content.
     *
     * @param mixed $content inner html tag content.
     */
    public function set_content($content) {
        $this->content = new HtmlContent($content);
    }

    /**
     * Test if an html instance "is a" specific html tag with specific attributes.
     *
     * @param string $type type of html tag is searching for.
     * @param type $attributes specific attributes for html tag that is searching for.
     * @return boolean true on success, false otherwise.
     */
    public function is_a($type, $attributes=[]) {
        return $type === $this->type && $this->has_attributes_of_type($this, $attributes);
    }

    /**
     * Tells if there is any child of specific type with specific attributes.
     *
     * @param string $type type of html tag.
     * @param mixed $attributes attributes associated to html tag.
     * @return boolean true if exists, otherwise false.
     */
    public function has_a_child_of_type($type, $attributes=[]) {
        $result = false;
        $children = $this->get_children();

        foreach ($children as $child) {
            if ($child instanceof Html) {
                $result = $type === $child->get_type() && $this->has_attributes_of_type($child, $attributes);
                if(true === $result) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Tells the number of children that belongs to especific html tag.
     *
     * @return int number of children.
     */
    public function number_of_children() {
        return $this->content->length();
    }

    /**
     * Returns html tag children.
     *
     * @return mixed whole set of children.
     */
    public function get_children() {
        return $this->content->get_content();
    }

    /**
     * Returns the html tag child specified.
     *
     * @param int $id number of child.
     * @return mixed html object that represents a html's child.
     */
    public function get_child($id) {
        $children = $this->content->get_content();
        return isset($children[$id]) ? $children[$id] : null;
    }

    /**
     * Helper to get the string form of Html object.
     *
     * @return string string representation of html object.
     */
    public function to_string() {
        return trim((string) $this);
    }

    /**
     * Magic method to get the string for Html object.
     *
     * @return string string representation of html object.
     */
    public function __toString() {
        $html_string = '<' . trim(
            $this->type . self::SPACE . $this->get_attributes_to_string()) . '>' .
            $this->content . '</' . $this->type . ">\n";
        return $html_string;
    }

    /**
     * Test if a html objects have a specific set of attributes
     *
     * @param mixed $html_object html object.
     * @param mixed $attributes attributes is searching for.
     * @return boolean true on success, false otherwise.
     */
    private function has_attributes_of_type($html_object, $attributes) {
        if (0 === count($attributes)) {
            return true;
        }

        $html = $html_object->get_attributes_to_array();
        $mock_html = (new Html('undefined', $attributes))->get_attributes_to_array();

        array_walk($mock_html, function(&$value, $attribute) use ($html){
            $value = isset($html[$attribute]) &&
                count($value) === count($html[$attribute]) &&
                (0 === count(array_diff($html[$attribute], $value)));
        });

        return 1 === count(array_unique(array_values($mock_html))) && array_values($mock_html)[0];
    }

    /**
     * Returns string value of a specific html object attribute.
     *
     * @param string $name attribute name.
     * @param mixed $with_value value associated to attribute.
     * @return mixed null if there is no match, otherwise string attributes values.
     */
    private function get_attribute_with_value($name, $with_value=null) {
        $attribute = array_filter($this->get_attributes(), function($attribute) use ($name, $with_value) {
            return ($name === $attribute->get_name()) && (is_null($with_value) || $attribute->has_value($with_value));
        });

        return 0 === count($attribute) ? null : str_replace($name . '=', '', (string) end($attribute));
    }
}
