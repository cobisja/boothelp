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

use BHP\BHP;
use BHP\Samples\Sample;

$navbar = [
    'title'=>'Navbars',
    'samples'=>[
        [
            'name'=> 'Basic navbars',
            'description'=>'Use <code>navbar</code> without options to display a basic navbar.
Wrap the content that should always be visible (no matter the screen size) with the <code>vertical</code> helper.
Wrap the content that should be collapsed for small screen sizes with the <code>horizontal</code> helper. Try resizing your browser!!!',
            'php_code'=> "echo BHP::navbar(function(){
    return [
        BHP::vertical(function(){
            return BHP::link_to('Home');
        }),
        BHP::horizontal(function(){
            return BHP::nav(['class'=>'navbar-right'], function(){
                return
                    BHP::link_to('Profile') .
                    BHP::link_to('Settings');
            });
        })
    ];
});",
            'result'=> BHP::navbar(function(){
    return [
        BHP::vertical(function(){
            return BHP::link_to('Home');
        }),
        BHP::horizontal(function(){
            return BHP::nav(['class'=>'navbar-right'], function(){
                return
                    BHP::link_to('Profile') .
                    BHP::link_to('Settings');
            });
        })
    ];
}),
            'html_code'=>'<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button data-target="#navbar-collapse-4880904" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Home</a>
        </div>
        <div id="navbar-collapse-4880904" class="collapse navbar-collapse">
            <ul class="navbar-right nav navbar-nav">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>
    </div>
</nav>'
        ],
        [
            'name'=> 'Navbars with inverted colors',
            'description'=>'Use the <code>inverted</code> option to invert the palette of colors of the navbar.',
            'php_code'=> "echo BHP::navbar(['inverted'=>true], function(){
    return BHP::vertical(function(){
        return BHP::link_to('Home');
    });
});",
            'result'=> BHP::navbar(['inverted'=>true], function(){return BHP::vertical(function(){return BHP::link_to('Home');});}),
            'html_code'=>'<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button data-target="#navbar-collapse-8690626" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Home</a>
        </div>
    </div>
</nav>'
        ],
        [
            'name'=> 'Navbars with a fluid container',
            'description'=>'Use the <code>fluid</code> option for a full width navbar, spanning the entire width of your viewport.',
            'php_code'=> "echo BHP::navbar(['fluid'=>true], function(){
    return BHP::vertical(function(){
        return BHP::link_to('Home');
    });
});",
            'result'=> BHP::navbar(['fluid'=>true], function(){return BHP::vertical(function(){return BHP::link_to('Home');});}),
            'html_code'=>'<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button data-target="#navbar-collapse-5202644" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Home</a>
        </div>
    </div>
</nav>'
        ],
        [
            'name'=> 'Static navbars',
            'description'=>'Use the <code>["position"=> "static"]</code> option to have the navbar scroll away with the page.',
            'php_code'=> "echo BHP::navbar(['position'=>'static'], function(){
    return BHP::vertical(function(){
        return BHP::link_to('Home');
    });
});",
            'result'=> BHP::navbar(['position'=>'static'], function(){return BHP::vertical(function(){return BHP::link_to('Home');});}),
            'html_code'=>'<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button data-target="#navbar-collapse-4716800" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Home</a>
        </div>
    </div>
</nav>'
        ],
        [
            'name'=> 'Navbar fixed to top',
            'additional_info'=> '<p>' . BHP::button('Show navbar', ['class'=>'navbar-top-toggle']) . '</p>',
            'description'=>'Use the <code>["position"=> "top"]</code> option to fix the navbar at the top of the page.
Set the <code>padding</code> option to specify the padding to leave between the top of the page and the body (defaults to 70px).',
            'php_code'=> "echo BHP::navbar(['position'=>'top'], function(){
    return BHP::vertical(function(){
        return BHP::link_to('Home');
    });
});",
            'result'=> BHP::navbar(['position'=>'top', 'data-navbar'=>'top'], function(){return BHP::vertical(function(){return BHP::link_to('Home');});}),
            'html_code'=>'<style>body {padding-top: 70px}</style>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button data-target="#navbar-collapse-6453944" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Home</a>
        </div>
    </div>
</nav>'
        ],
        [
            'name'=> 'Navbar fixed to bottom',
            'additional_info' => '<p>' . BHP::button('Show navbar', ['class'=>'navbar-bottom-toggle']) . '</p>',
            'description'=>'Use the <code>["position"=> "bottom"]</code> option to fix the navbar at the top of the page.
Set the <code>padding</code> option to specify the padding to leave between the body and the bottom of the page (defaults to 70px).',
            'php_code'=> "echo BHP::navbar(['position'=>'bottom', 'padding'=>100], function(){
    return BHP::vertical(function(){
        return BHP::link_to('Home');
    });
});",
            'result'=> BHP::navbar(['position'=>'bottom', 'padding'=>100, 'data-navbar'=>'bottom'], function(){return BHP::vertical(function(){return BHP::link_to('Home');});}),
            'html_code'=>'<style>body {padding-bottom: 100px}</style>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button data-target="#navbar-collapse-8602652" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Home</a>
        </div>
    </div>
</nav>'
        ],
        [
            'name'=> 'Complex nabvars',
            'description'=>'You can specify a custom <code>id</code> which will be used for the navbar’s collapsable <code>div</code>.
You can also specify custom options in the <code>vertical</code> and <code>horizontal</code> helpers which will be added to their <code>div</code> tags. ',
            'php_code'=> "echo BHP::navbar(['id'=>'navbar'], function(){
    return [
        BHP::vertical(['id'=>'vertical', 'class'=>'en', 'data-js'=>1], function(){
            return BHP::link_to('Home');
        }),
        BHP::horizontal(['class'=>'en', 'data-js'=>2], function(){
            return BHP::nav(['class'=>'navbar-left'], function(){
                return
                    BHP::link_to('Profile') .
                    BHP::link_to('Settings');
            });
        })
    ];
});",
            'result'=> BHP::navbar(['id'=>'navbar'], function(){
    return [
        BHP::vertical(['id'=>'vertical', 'class'=>'en', 'data-js'=>1], function(){
            return BHP::link_to('Home');
        }),
        BHP::horizontal(['class'=>'en', 'data-js'=>2], function(){
            return BHP::nav(['class'=>'navbar-left'], function(){
                return
                    BHP::link_to('Profile') .
                    BHP::link_to('Settings');
            });
        })
    ];
}),
            'html_code'=>'<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div data-js="1" class="en navbar-header" id="vertical">
            <button data-target="#navbar" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Home</a>
        </div>
        <div id="navbar" data-js="2" class="en collapse navbar-collapse">
            <ul class="navbar-left nav navbar-nav">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>
    </div>
</nav>'
        ]
    ]
];

/**
 * Navbar samples.
 */
echo new Sample($navbar);
