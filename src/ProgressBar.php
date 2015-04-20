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

use cobisja\BootHelp\Base;
use cobisja\BootHelp\Helpers\ContentTag;


/**
 * Generates an HTML block tag that follows the Bootstrap documentation
 * on how to display <strong>Progress bar</strong> component.
 *
 * See {@link http://getbootstrap.com/components/#progress} for more information.
 */
class ProgressBar extends Base {
    /**
     * Initializes the ProgressBar instance.
     *
     * @param array $options options to build the ProgressBar.
     * @param array $container_options options to be passed to the ProgressBar's container.
     */
    public function __construct($options = [], $container_options = []) {
        $this->append_class($container_options, 'progress');

        $progress_bar = new ContentTag('div', $container_options, function() use ($options){
            if (is_array(reset($options))) {
                $progress_strings = [];

                foreach ($options as $progress_bar_options) {
                    $progress_strings[] = $this->build_progress_bar($progress_bar_options);
                }

                return $progress_strings;
            }
            else {
              return $this->build_progress_bar($options);
            }
        });

        $this->set_html_object($progress_bar->get_html_object());
    }

    /**
     * Generates the ProgressBar object.
     *
     * @param array $options ProgressBar's options.
     * @return ContentTag ContentTag instance that representes the ProgressBar.
     */
    private function build_progress_bar($options=[]) {
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

        $progress_label = $this->progress_bar_label($percentage, $options);
        $this->set_options($options, $attributes);

        return new ContentTag('div', $progress_label, $attributes);
    }

    /**
     * Returns the ProgressBar's label.
     *
     * @param string $percentage value of the progress bar (number or text).
     * @param array $options label's options.
     * @return string ProgressBar's label.
     */
    private function progress_bar_label($percentage, &$options = []) {
        if (isset($options['context'])) {
            $text1 = " ({$options['context']})";
            unset($options['context']);
        } else {
            $text1 = null;
        }

        $text = "$percentage%" . $text1;
        $label = isset($options['label']) ? $options['label'] : false;

        if (is_bool($label)) {
            $label = $label ? $text : new ContentTag('span', $text, ['class'=>'sr-only']);
        }

        unset($options['label']);

        return $label;
    }

    /**
     * Generates the ProgressBar class.
     *
     * @param array $options ProgressBar class information.
     * @return string ProgressBar class.
     */
    private function progress_bar_class(&$options = []) {
        $striped = null;
        $animated = null;
        $valid_contexts = ['success', 'info', 'warning', 'danger'];

        $context = $this->context_for(!isset($options['context']) ? null : $options['context'], ['valid'=>$valid_contexts]);
        $context = in_array($context, $valid_contexts) ? "progress-bar-$context" : null;

        if (isset($options['striped']) && $options['striped']) {
            $striped = 'progress-bar-striped';
            unset($options['striped']);
        }

        if (isset($options['animated']) && $options['animated']) {
            $striped = 'progress-bar-striped active';
            unset($options['animated']);
        }

        return  join(Base::SPACE, array_filter(['progress-bar', $context, $striped, $animated], 'strlen'));
    }
}
