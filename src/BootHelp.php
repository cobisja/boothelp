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

use cobisja\BootHelp\Helpers\ContentTag;
use cobisja\BootHelp\Helpers\LinkTo;
use cobisja\BootHelp\AlertBox;
use cobisja\BootHelp\Panel;
use cobisja\BootHelp\PanelRow;
use cobisja\BootHelp\Icon;
use cobisja\BootHelp\Modal;
use cobisja\BootHelp\Nav;
use cobisja\BootHelp\Helpers\Vertical;
use cobisja\BootHelp\Helpers\Horizontal;
use cobisja\BootHelp\Dropdown;
use cobisja\BootHelp\Helpers\Divider;
use cobisja\BootHelp\ProgressBar;
use cobisja\BootHelp\Button;
use cobisja\BootHelp\ButtonGroup;
use cobisja\BootHelp\ButtonToolbar;

/**
 * Class that exposes methods to interact with any BootHelp object.
 */
abstract class BootHelp {
    /**
     * Gets a ContentTag instance.
     *
     * @param string $name Block tag type.
     * @param mixed $content_or_options_with_block Options or closure.
     * @param mixed $options Options or closure.
     * @param callable $block closure that generates the content to be surrounding to.
     * @return ContentTag a ContentTag instance.
     */
    public static function content_tag($name, $content_or_options_with_block = null, $options = null, callable $block = null) {
        return new ContentTag(
            $name,
            $content_or_options_with_block,
            $options,
            $block
        );
    }

    /**
     * Gets a Divider instance helper to be used with Dropdown objects.
     *
     * @return Divider a Divider instance.
     */
    public static function divider() {
        return new Divider();
    }

    /**
     * Gets Horizontal instance helper to be used with NavBar objects.
     *
     * @param mixed $content_or_options_with_block possible content of Horizontal object.
     * @param mixed $options possible options of Horizontal object.
     * @param closure $block Closure to build the Horizontal content.
     * @return Vertical a Horizontal instance.
     */
    public static function horizontal($content_or_options_with_block = null, $options = null, callable $block = null) {
        return new Horizontal($content_or_options_with_block, $options, $block);
    }

    /**
     * Gets a LinkTo instance.
     *
     * @param mixed $name link target.
     * @param array $options link options.
     * @param callable $block closure that generates the content to be surrounding to.
     * @return LinkTo a LinkTo instance.
     */
    public static function link_to($name = null, $options = [], callable $block = null) {
        return new LinkTo($name, $options, $block);
    }

    /**
     * Gets Vertical instance helper to be used with NavBar objects.
     *
     * @param mixed $content_or_options_with_block possible content of Horizontal object.
     * @param mixed $options possible options of Vertical object.
     * @param closure $block Closure to build the Vertical content.
     * @return Vertical a Vertical instance.
     */
    public static function vertical($content_or_options_with_block = null, $options = null, callable $block = null) {
        return new Vertical($content_or_options_with_block, $options, $block);
    }

    /**
     * Gets an AlertBox instance.
     *
     * @param mixed $message_or_options_with_block string message or alert's options.
     * @param mixed $options alert's options.
     * @param mixed $block closure that generates alert's content.
     * @return AlertBox an AlertBox instance.
     */
    public static function alert_box($message_or_options_with_block = null, $options = null, $block=null) {
        return new AlertBox($message_or_options_with_block, $options, $block);
    }

    /**
     * Gets a Button instance.
     *
     * @param mixed $content_or_options_with_block content of Button.
     * @param mixed $options options to build a Button.
     * @param closure $block closure to build the Button's content.
     * @return Button a Button instance.
     */
    public static function button($content_or_options_with_block = null, $options = null, $block = null) {
        return new Button($content_or_options_with_block, $options, $block);
    }

    /**
     * Gets a ButtonGroup instance.
     *
     * @param mixed $options the display options for the ButtonGroup.
     * @param Callable $block Block to generate inside ButtonGroup content.
     * @return ButtonGroup a ButtonGroup instance.
     */
    public static function button_group($options, $block = null) {
        return new ButtonGroup($options, $block);
    }

    /**
     * Gets a ButtonToolbar instance.
     *
     * @param mixed $options the display options for the ButtonToolbar.
     * @param Callable $block Block to generate inside ButtonToolbar content.
     * @return ButtonToolbar a ButtonToolbar instance.
     */
    public static function button_toolbar($options, $block = null) {
        return new ButtonToolbar($options, $block);
    }

    /**
     * Gets a Dropdown instance.
     *
     * @param string $caption Dropdown caption.
     * @param array $options options to build the Dropdown.
     * @param closure $block closure to build the Dropdown content.
     * @return Dropdown a Dropdown instance.
     */
    public static function dropdown($caption, $options = [], $block = null) {
        return new Dropdown($caption, $options, $block);
    }

    /**
     * Gets an Icon instance.
     *
     * @param String $name the name of the icon object to build
     * @param Array $options the options for the icon object.
     * @return Icon an Icon instance.
     */
    public static function icon($name = null, $options = []) {
        return new Icon($name, $options);
    }

    /**
     * Gets a Modal instance.
     *
     * @param mixed $content_or_options_with_block the content to display in the Modal.
     * @param mixed $options [optional] the display options for the Modal.
     * @param mixed $block [optional] Block to generate a customized inside Modal content.
     * @return Modal a Modal instance.
     */
    public static function modal($content_or_options_with_block = null, $options = null, $block = null) {
        return new Modal($content_or_options_with_block, $options, $block);
    }

    /**
     * Gets a Nav instance.
     *
     * @param array $options options the display options for the nav.
     * @param mixed $block Block to generate a customized inside nav content.
     * @return Nav a Nav instance.
     */
    public static function nav($options = [], $block = null) {
        return new Nav($options, $block);
    }

    /**
     * Gets a NavBar instance.
     *
     * @param array $options options the display options for the NavBar.
     * @param mixed $block Block to generate a customized inside NavBar content.
     * @return Navbar a NavBar instance
     */
    public static function navbar($options = [], callable $block = null) {
        return new Navbar($options, $block);
    }

    /**
     * Gets a Panel instance.
     *
     * @param mixed $content_or_options_with_block the content to display in the panel.
     * @param mixed $options [optional] the display options for the panel.
     * @param Callable $block [optional] Block to generate a customized inside panel content.
     * @return Panel a Panel instance.
     */
    public static function panel($content_or_options_with_block = null, $options = null, $block = null) {
        return new Panel($content_or_options_with_block, $options, $block);
    }

    /**
     * Gets a PanelRow instance.
     *
     * @param mixed $options [optional] the display options for the panel.
     * @param Callable $block [optional] Block to generate inside panel row content.
     * @return PanelRow a PanelRow instance.
     */
    public static function panel_row($options, $block = null) {
        return new PanelRow($options, $block);
    }

    /**
     * Gets a ProgressBar instance.
     *
     * @param array $options options to build the ProgressBar.
     * @param array $container_options options to be passed to the ProgressBar's container.
     * @return ProgressBar a ProgressBar instance.
     */
    public static function progress_bar($options = [], $container_options = []) {
        return new ProgressBar($options, $container_options);
    }
}
