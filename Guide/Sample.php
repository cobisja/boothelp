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

namespace cobisja\BootHelp\Guide;

use cobisja\BootHelp\Helpers\ContentTag;


class Sample
{
    const SAMPLE_TEMPLATE_PATH = 'Guide/guide.template';

    private $sample_data;


    public function __construct(Array $sample_data=[]) {
        $this->sample_data = $sample_data;
    }

    public function __toString() {
        return $this->build_sample_string();
    }

    private function build_sample_string() {
        if (0 === count($this->sample_data)) {
            return '';
        }

        $title = $this->sample_data['title'];
        $html = new ContentTag('h1', $title, ['id'=>  $this->build_id($title), 'class'=>'page-header']);

        foreach ($this->sample_data['samples'] as $sample) {
            $template = file_get_contents(self::SAMPLE_TEMPLATE_PATH);
            $sample_name = $sample['name'];
            $additional_sample_info = isset($sample['additional_info']) ? $sample['additional_info'] : '';
            $sample_id = $this->build_id($sample_name);
            $sample_description = $sample['description'];
            $php_code = htmlentities($sample['php_code']);
            $result = (string) $sample['result'];
            $html_code = htmlentities($sample['html_code']);

            $html .= preg_replace(
                ["/%sample_id%/", "/%additional_sample_info%/", "/%sample_name%/", "/%sample_description%/", "/%php_code%/", "/%result%/", "/%html_code%/"],
                [$sample_id, $additional_sample_info, $sample_name, $sample_description, $php_code, $result, $html_code ],
                $template
            );
        }

        return $html;
    }

    private function build_id($sample_name, $word_separator='-') {
        return strtolower(str_replace(' ', $word_separator, $sample_name));
    }
}
