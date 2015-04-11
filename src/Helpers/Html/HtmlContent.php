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

use BootHelp\Helpers\Html\Html;

/**
 * Class HtmlContent: Handles all related with Html Content.
 */
class HtmlContent {
    /**
     * @var mixed Html content.
     */
    private $content;


    /**
     * Initializes an HtmlContent instance.
     *
     * @param mixed $content specific content associated with an html object.
     */
    public function __construct($content) {
        if (is_array($content)) {
            $new_content = [];

            foreach ($content as $item) {
                $new_content[] = (is_string($item) || is_object($item) && $item instanceof Html) ? $item : $item->get_html_object();
            }

            $this->content = array_filter($new_content, 'strlen');

        } else {
            $this->set_content($content);
        }
    }

    /**
     * Returns the html content.
     *
     * @return mixed html content.
     */
    public function get_content() {
        return $this->content;
    }

    /**
     * Tells if the content of an html object is empty.
     *
     * @return boolean true on success, false otherwise.
     */
    public function is_empty() {
        return is_array($this->content) && 1 === count($this->content) && is_null($this->content[0]);
    }

    /**
     * Tells how long is the content (how many children).
     *
     * @return int content's length.
     */
    public function length() {
        return count($this->content);
    }

    /**
     * Sets the html content.
     *
     * @param mixed $content html content.
     */
    public function set_content($content) {
        $this->content = !is_array($content) ? [$content] : $content;
    }

    /**
     * Magic method to get the string representation of content.
     *
     * @return string string representation of content.
     */
    public function __toString() {
        $html_string = '';

        foreach ($this->content as $content) {
            $html_string .= (string) $content;
        }

        return $html_string;
    }
}
