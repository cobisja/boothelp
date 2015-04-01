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

namespace BHP\Helpers;

use BHP\Helpers\HtmlAttribute;
use BHP\Helpers\HtmlContent;


class Html {
    const SPACE = ' ';

    private $type;
    private $attributes = [];
    private $content;
    private $autoclose;


    public function __construct($type, $attributes, $content='', $autoclose = false) {
        $this->set_type($type);
        $this->set_attributes($attributes);
        $this->set_content($content);
        $this->autoclose = $autoclose;
    }

    public function get_type() {
        return $this->type;
    }

    public function get_attributes() {
        if (0 === count($this->attributes)) {
            return '';
        } else {
            return $this->attributes;
        }
    }

    public function get_attributes_to_string() {
        $attributes = $this->get_attributes();

        if (is_array($attributes)) {
            $attrs = [];
            foreach( $attributes as $attribute ) {
                $attrs[] = (string) $attribute;
            }
            $attributes_string = join(self::SPACE, $attrs);
        } else {
            $attributes_string = $attributes;
        }

        return $attributes_string;
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

    public function __toString() {
        $content = $this->content;
            if (!$this->autoclose) {
                $attributes = $this->get_attributes_to_string();
                $html_string = '<' . trim($this->type . self::SPACE . $attributes) . '>' . $content . '</' . $this->type . ">\n";
            } else {
                $html_string = '<' . $this->type . self::SPACE . $attributes . self::SPACE . '/>';
            }

        return $html_string;
    }
}
