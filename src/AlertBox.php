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
 * on how to display <strong>Alert Box</strong> component.
 *
 * See {@link http://getbootstrap.com/components/#alerts} for more information.
 */
class AlertBox extends Base {
    /**
     * Initializes AlertBox object.
     *
     * @param mixed $message_or_options_with_block string message or alert's options.
     * @param mixed $options alert's options.
     * @param mixed $block closure that generates alert's content.
     */
    public function __construct($message_or_options_with_block = null, $options = null, $block=null) {
        $html = '';
        $num_args = $this->get_function_num_args(func_get_args());

        if (3 > $num_args && is_callable(func_get_arg($num_args-1))) {
            $block = func_get_arg($num_args-1);
            $html = $this->build_alert_box($this->capture_alert($block), is_null($message_or_options_with_block) || is_callable($message_or_options_with_block) ? [] : $message_or_options_with_block);
        } else {
            $html = $this->build_alert_box($message_or_options_with_block, is_null($options) ? [] : $options);
        }

        $this->set_html_object($html->get_html_object());
    }

    /**
     * Generates alert box HTML code.
     *
     * @param string $message alert box message.
     * @param array $options alert box options.
     * @return ContentTag html alert box.
     */
    private function build_alert_box($message=null, $options=[]) {
        $dismissible = false;
        $context = isset($options['context']) ? $options['context'] : null;

        if (isset($options['dismissible'])) {
            ($dismissible = $options['dismissible']) && ($message = $this->add_dismiss_button_to($message));
            unset($options['dismissible']);
        }

        if (!is_null($context)) {
            unset($options['context']);
        }

        $klass = $this->alert_class($context, $dismissible);
        $this->append_class($options, $klass);
        $options = array_merge(['role'=>'alert'], $options);

        return new ContentTag('div', $message, $options);
    }

    /**
     * Pick the correct alert box class based on context.
     *
     * @param string $context alert box context.
     * @param bool $dismissible indicates if alert box is dismissible.
     * @return string alert box html class.
     */
    private function alert_class($context=null, $dismissible=null) {
        $valid_contexts = ['success', 'info', 'warning', 'danger'];
        $context = $this->context_for($context, ['default'=>'info', 'valid'=>$valid_contexts]);
        $dismissible_class = $dismissible ? 'alert-dismissible' : '';

        return rtrim("alert alert-$context $dismissible_class");
    }

    /**
     * Generates html code to add a dismiss button to alert box.
     *
     * @param string $message alert box message.
     * @return string dismiss button html code.
     */
    private function add_dismiss_button_to($message) {
        $options = ['type'=>'button', 'class'=>'close', 'data-dismiss'=>'alert', 'aria-label'=>'Close'];
        $dismiss_button = new ContentTag('button', new ContentTag('span', '&times;', ['aria-hidden'=>true]), $options);

        if (is_array($message)) {
            $content = array_merge([$dismiss_button], $message);
        } else {
            $content = [$dismiss_button, $message];
        }
        return $content;
    }

    /**
     * Sets Base alert link flag to true to then catches the closure output.
     *
     * This behaviour is necessary because any link (<a></a> tag) within an alert box
     * have to match the correct color when it displayed.
     *
     * @param callable $block
     * @return type
     */
    private function capture_alert(callable $block) {
        Base::set_alert_link(true);
        $capture = call_user_func($block);
        Base::set_alert_link(false);

        return $capture;
    }
}
