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
 * on how to display <strong>Button Groups</strong>.
 *
 * See {@link http://getbootstrap.com/components/#btn-groups} for more information.
 */
class ButtonGroup extends Base {
    /**
     * Initializes the ButtonGroup instance.
     *
     * @param mixed $options the display options for the ButtonGroup.
     * @param Callable $block Block to generate inside ButtonGroup content.
     */
    public function __construct($options, $block = null) {
        if (is_callable($options)) {
            $block = $options;
            $options = [];
        }

        $button_group = $this->build_button_group($options, $block);
        $this->set_html_object($button_group->get_html_object());
    }

    /**
     * Generates de ButtonGroup object.
     *
     * @param Array $options the display options for the ButtonGroup.
     * @param Callable $block Block to generate inside ButtonGroup content.
     * @return ContentTag a ContentTag instance that represents the Button Group.
     */
    private function build_button_group(Array $options, $block) {
        $is_a_justified_button_group = $this->is_a_justified_button_group($options);

        $button_group_type = $this->get_button_group_type($options);
        $this->append_class($options, $button_group_type);
        $size_class = $this->get_button_group_size($options);
        $this->append_class($options, $size_class);

        if ($is_a_justified_button_group) {
            $this->append_class($options, 'btn-group-justified');
        }

        $bg = new ContentTag('div', array_merge($options, ['aria-label'=>'button-group', 'role'=>'group']), function() use ($block, $is_a_justified_button_group) {
            Base::set_justified_button_group($is_a_justified_button_group);
            $buttons = call_user_func($block);
            Base::set_justified_button_group(false);

            return $buttons;
        });

        return $bg;
    }

    /**
     * Determines the Button Group size class
     *
     * @param array $options options associated to the ButtonGroup object.
     * @return string size class.
     */
    private function get_button_group_size(Array &$options) {
        $size = null;

        if (isset($options['size'])) {
            switch ($options['size']) {
                case 'lg': case 'large': $size = 'btn-group-lg'; break;
                case 'sm': case 'small': $size = 'btn-group-sm'; break;
                case 'xs': case 'extra_small': $size = 'btn-group-xs'; break;
            }
            unset($options['size']);
        }

        return $size;
    }

    /**
     * Determines the Button Group type class
     *
     * @param array $options options associated to the ButtonGroup object.
     * @return string Button Group type class.
     */
    private function get_button_group_type(Array &$options) {
        $type = 'btn-group';

        if (isset($options['vertical'])) {
            is_bool($options['vertical']) && $options['vertical'] ? $type = 'btn-group-vertical' : null;
            unset($options['vertical']);
        }

        return $type;
    }

    /**
     * Tells if the Button Group should be rendered using justified mode.
     *
     * @param array $options options associated to the ButtonGroup object.
     * @return boolean true if Button Group is in justified mode, otherwise false.
     */
    private function is_a_justified_button_group(&$options) {
        $is_a_justified_button_group = false;

        if (isset($options['justified'])) {
            $is_a_justified_button_group = is_bool($options['justified']) && $options['justified'];
            unset($options['justified']);
        }

        return $is_a_justified_button_group;
    }
}
