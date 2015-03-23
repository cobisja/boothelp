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

use BHP\Base;
use BHP\Helpers\ContentTag;


class ProgressBar extends Base
{
    public function __construct($options = [], $container_options = [])
    {
        $this->append_class($container_options, 'progress');
        $this->set_html(new ContentTag('div', $container_options, function() use ($options){
            if (is_array(reset($options))) {
                $progress_strings = [];

                foreach ($options as $progress_bar_options) {
                    if (is_array($progress_bar_options)) {

                    }
                    $progress_strings[] = $this->progress_bar_string($progress_bar_options);
                }

                return join("\n", $progress_strings);
            }
            else {
              return $this->progress_bar_string($options);
            }
        }));
    }

    private function progress_bar_string($options=[])
    {
        $percentage = 0;

        if (isset($options['percentage'])) {
            $percentage = (integer) $options['percentage'];
            unset($options['percentage']);
        }

        $attributes['class'] = $this->progress_bar_class($options);
        $attributes['role'] = 'progressbar';
        $attributes['style'] = "width: $percentage%";
        $attributes['aria-valuenow'] = $percentage;
        $attributes['aria-valuemin'] = 0;
        $attributes['aria-valuemax'] = 100;

        $this->set_options($options, $attributes);

        return new ContentTag('div', $this->progress_bar_label($percentage, $options), $attributes);
    }

    private function progress_bar_label($percentage, $options = [])
    {
        $text1 = isset($options['context']) ? " ({$options['context']})" : null;
        $text = "$percentage%" . $text1;

        if (!isset($options['label'])) {
            $options['label'] = false;
        }

        if (is_string($options['label'])) {
            return $options['label'];
        }

        switch ($options['label']) {
            case true:
                return $text;
            case false:
                return new ContentTag('span', $text, ['class'=>'sr-only']);
        }
    }

    private function progress_bar_class($options = [])
    {
        $valid_contexts = ['success', 'info', 'warning', 'danger'];

        if (!isset($options['context'])) {
            $options['context'] = null;
        }

        $context = $this->context_for($options['context'], ['valid'=>$valid_contexts]);
        $context = in_array($context, $valid_contexts) ? "progress-bar-$context" : null;

        $striped = isset($options['striped']) && $options['striped'] ? 'progress-bar-striped' : null;
        $animated = isset($options['animated']) && $options['animated'] ? 'progress-bar-striped active' : null;

        return  join( ' ', array_filter( ['progress-bar', $context, $striped, $animated], 'strlen' ) );
    }
}
