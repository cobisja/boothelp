# BootHelp - PHP Helpers for Bootstrap

A simple set of classes to generate most of the Bootstrap's components without writing any HTML code, just PHP.

## About
Nowadays Bootstrap is a great framework commonly used by a lot of web designers and web developers to build web sites with a fresh looking using its HTML and CSS based design templates for typography, forms, buttons, navigation, and other interface components, as well JavaScript extensions.

However, to get all of its powerful resources, usually you have to write a lot of HTML code, no matters if you want to use a simple component, like [Modal] for instance.

*BootHelp* (**Boot**strap **Help**ers) is a set of classes that allows you to get all the power of Bootstrap's components with no need to write any HTML code (or at least a minimun amount of it).

## Requirements

* Any flavour of PHP 5.4+
* [PHPUnit] to execute the test suite (optional).

Remember that **BootHelp** just generates HTML code acording Bootstrap specifications v3.3.4. To get running the code as you expected, you have to install all [Bootstrap requirements].

## Getting started

### Setting up the environment
After download **BooHelp**, you have 2 ways to get your environment configured to use the classes:

#### Composer

[Composer] is the PHP's package manager and is the recommended way to get packages for your projects. It's also able to build automatically ***autoloaders*** if you wrote down your code using PSR-0 and/or PSR-4 standards, avoiding you headaches about everything related to loading classes.

**BootHelp** is built follows PSR-4 standard and comes with a specific file named **composer.json** that allows **Composer** to generate a file named **autoload.php** (beside others files of course). This files generated is the only one you need to include in your project to get all classes required by **BootHelp** loaded in memory:

1. Install Composer:
	```
    curl -s https://getcomposer.org/installer | php
	```

2. Get inside **BootHelp** root folder and generate the **autoload.php** file:
	```
    php composer.phar dump-autoload
    ```
    The command above will generate a folder called **vendor**. Inside of it, you'll see the **autoload.php**
    
3. Require/Include **autoload.php** file in the **index.php** of your project or whatever file you need to use **BootHelp** classes:
	```php
    <?php
    require 'vendor/autoload.php';
    ...
    
    ```

#### Loading BootHelp classes by hand
Even if Composer it's the preferred method to generate the files needed to get all classes loaded, maybe you want to do the task by hand:

1. Copy and paste **BootHelp** folder in your project root.

2. Require/Include the **BootHelp classes**:

	```php
    <?php
        require '{BootHelp root folder}/src/Base.php';
        require '{BootHelp root folder}/src/Helpers/Html/Html.php';
        require '{BootHelp root folder}/src/Helpers/Html/HtmlAttribute.php';
        require '{BootHelp root folder}/src/Helpers/Html/HtmlContent.php';
        require '{BootHelp root folder}/src/Helpers/ContentTag.php';
        require '{BootHelp root folder}/src/Helpers/LinkTo.php';
        require '{BootHelp root folder}/src/Helpers/Vertical.php';
        require '{BootHelp root folder}/src/Helpers/Horizontal.php';
        require '{BootHelp root folder}/src/Helpers/Divider.php';
        require '{BootHelp root folder}/src/AlertBox.php';
        require '{BootHelp root folder}/src/Button.php';
        require '{BootHelp root folder}/src/ButtonGroup.php';
        require '{BootHelp root folder}/src/ButtonToolbar.php';
        require '{BootHelp root folder}/src/Dropdown.php';
        require '{BootHelp root folder}/src/Icon.php';
        require '{BootHelp root folder}/src/Modal.php';
        require '{BootHelp root folder}/src/Nav.php';
        require '{BootHelp root folder}/src/Navbar.php';
        require '{BootHelp root folder}/src/Panel.php';
        require '{BootHelp root folder}/src/PanelRow.php';
        require '{BootHelp root folder}/src/ProgressBar.php';
        require '{BootHelp root folder}/src/BootHelp.php';  
    ```
    
#### Handling namespaces
All BootHelp classes are under the namespace **BootHelp**. So, to use any class you need to use the **Fully qualified class name**. For example, to get a new instance of **Modal class** you need to use:

```php
<?php
...
$modal = new BootHelp\Modal('Hello world');
...
```

However, as your project grows up using fully qualified class names becomes annoying, so it's better to use PHP **USE** sentence:

```php
<?php
...
use BootHelp\Modal;
...

$modal = new Modal('Hello world)';
...
```

### How to use BootHelp classes:
You have 2 ways to use BootHelp: Using **BootHelp abstract class** and then call any of its methods.

The other way is to get an instance of the component you want to use.

#### Method 1 - Using BootHelp abstract class:
```php
<?php
use BootHelp\BootHelp;
...
$modal = BootHelp::modal('How easy is to use BootHelp!!!');
echo $modal;
...
```
**BootHelp abstract class** exposes the following 17 abstract methods:
```
content_tag, divider, horizontal, link_to, vertical, alert_box, button, button_group, button_toolbar, dropdown, icon, modal, nav, navbar, panel, panel_row, progress_bar
```
#### Method 2 - Using directly the component class:

```php
<?php
use BootHelp\Modal;
...
$modal = new Modal('How easy is to use BootHelp!!!');
echo $modal;
```
**BootHelp** offers 17 classes that deal directly with Bootstrap components:
```
ContentTag, Divider, Horizontal, LinkTo, Vertical, AlertBox, Button, ButtonGroup, ButtonToolbar, Dropdown, Icon, Modal, Nav, Navbar, Panel, PanelRow, ProgressBar.
```

Besides the classes showed above, you can find 5 additionals classes with differents purposes:
```
Html, HtmlAttribute, HtmlContent, Base, BootHelp
```

## BootHelp API

To get an idea about how to use **BootHelp classes**, what parameters you have to provide, what classes you can use together, and somethings like that, there is a complete guide included, that you can load in your browser. The guide is located in **Guide folder**. Actually, when you download **BootHelp** you can open the file **index.php** in your browser to read all the information about the classes.

However, to get running the Guide, you need to download and install the following:

* [jQuery] 1.9.x
* [Bootstrap] 3.3.4

Then, uncompress the files above downloaded and carefully follows the steps show below:

1. Get into BootHelp root folder.
2. Copy the file **bootstrap.min.css** into **Guide/css** folder.
3. Copy the files **bootstrap/fonts/*** into **Guide/fonts** folder.
4. Copy the files **bootstrap.min.js** and **jquery.min.js** into **Guide/js** folder.

Aditional css is required to use 'Font awesome'. You have to add a link to awesome.css:
```html
<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />
```
You have to put the sentence above in **index.php**

## Todo

**BootHelp** is not perfect!!!. It's been tested but maybe you can find some bugs, or maybe you can find many better ways to do the things. For that reason, there are some things to do:

* Include more Bootstrap components.
* Find a way to integrate **BootHelp** with template engines like [Twig].
* Improve the classes integration.


## Author
[Jorge Cobis]

By the way, I'm from Bolivarian Republic of Venezuela :-D

## Contributing
Feel free to contribute!!!. Welcome aboard!!!

## Misc
### Version history

**0.4.0** (Tuesday, 12th May 2015)

* Added support for badges, labels, images and thumbnails components.
* Refactoring of few Base methods.
* Guide updating.
* Fix minor bugs.

**0.3.2** (Friday, 1st May 2015)

* Fix minor bug in progress bar label.

**0.3.1** (Monday, 20th April 2015)

* Adding full customizing options for modal button.
* General namespace refactoring.
* Guide bugs fixed.
* Fix minor bugs.

**0.3.0** (Thursday, 16th April 2015)

* Adding support for generating Button Groups and Button Toolbars.
* Improved documentation.
* Fix minor bugs.
* New tests for new compoments.
* Updated test for Dropdown, Nav and Navbar components.

**0.2.2** (Wednesday, 15th April 2015)

* Better integration between Dropdown and Nav / Navbar.
* Adding correct class when a Button is within a Navbar.
* Fix minor bugs.
* README.md upgraded.

**0.2.1** (Friday, 10th April 2015)

* Updating .gitignore file.

**0.2.0** (Friday, 10th April 2015)

* First public release.
* Whole project refactored.

**0.1.0** (Sunday, 21st September 2014)

* Initial non public version (Classes based on traits)


## License
Copyright (c) 2015 Jorge Cobis (<jcobis@gmail.com>)

MIT License

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

[modal]:http://getbootstrap.com/javascript/#modals
[phpunit]:https://phpunit.de/
[jQuery]:http://jquery.com
[bootstrap]:http://getbootstrap.com/
[bootstrap requirements]:http://getbootstrap.com/getting-started/
[composer]:https://getcomposer.org
[twig]:http://twig.sensiolabs.org/
[Jorge Cobis]:mailto:jcobis@gmail.com
