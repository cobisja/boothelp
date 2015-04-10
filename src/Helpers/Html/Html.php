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

namespace BootHelp\Helpers\Html;

use BootHelp\Helpers\Html\HtmlAttribute;
use BootHelp\Helpers\Html\HtmlContent;


class Html {
    const SPACE = ' ';

    private $type;
    private $attributes = [];
    private $content;


    public function __construct($type, $attributes, $content='') {
        $this->set_type($type);
        $this->set_attributes($attributes);
        $this->set_content($content);
    }

    public function get_type() {
        return $this->type;
    }

    public function get_attributes() {
        return (0 === count($this->attributes)) ? '' : $this->attributes;
    }

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

    public function get_attributes_to_array() {
        $attrs = [];

        array_map(function($attribute) use (&$attrs) {
            $attrs[$attribute->get_name()] = $attribute->get_value();
        }, $this->get_attributes());

        return $attrs;
    }

    public function get_attribute($name) {
        return $this->get_attribute_with_value($name);
    }

    public function has_attribute($name, $with_value) {
        return !is_null($this->get_attribute_with_value($name, $with_value));
    }

    public function get_content() {
        return $this->content;
    }

    public function set_type($type) {
        $this->type = $type;
    }

    public function set_attributes($attributes) {
        !is_array($attributes) ? $attributes = [] : null;

        foreach ($attributes as $name => $value) {
            $this->attributes[] = new HtmlAttribute($name, $value);
        }
    }

    public function set_content($content) {
        $this->content = new HtmlContent($content);
    }

    public function is_a($type, $attributes=[]) {
        return $type === $this->type && $this->has_attributes_of_type($this, $attributes);
    }

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

    public function number_of_children()
    {
        return $this->content->length();
    }

    public function get_children() {
        return $this->content->get_content();
    }


    public function get_child($id) {
        $children = $this->content->get_content();
        return isset($children[$id]) ? $children[$id] : null;
    }

    public function to_string() {
        return trim((string) $this);
    }

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

    private function get_attribute_with_value($name, $with_value=null) {
        $attribute = array_filter($this->get_attributes(), function($attribute) use ($name, $with_value) {
            return ($name === $attribute->get_name()) && (is_null($with_value) || $attribute->has_value($with_value));
        });

        return 0 === count($attribute) ? null : str_replace($name . '=', '', (string) end($attribute));
    }

    public function __toString() {
        $html_string = '<' . trim(
            $this->type . self::SPACE . $this->get_attributes_to_string()) . '>' .
            $this->content . '</' . $this->type . ">\n";
        return $html_string;
    }
}
