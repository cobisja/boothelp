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

// navbar top toggler
(function () {
      $('.navbar-top-toggle').click(function () {
        var shown = $(this).text() == "Hide the navbar";
        if(shown) {
          $("body").animate({paddingTop: "0px"});
          $('[data-navbar="top"]').hide('slow');
          $(this).text('Show the navbar');
        } else {
          $("body").animate({paddingTop: "70px"});
          $('[data-navbar="top"]').show('slow');
          $(this).text('Hide the navbar');
        }
      })
    })();

// navbar bottom toggler
(function () {
  $('.navbar-bottom-toggle').click(function () {
    var shown = $(this).text() == "Hide the navbar";
    if(shown) {
      $("body").animate({paddingBottom: "0px"});
      $('[data-navbar="bottom"]').hide('slow');
      $(this).text('Show the navbar');
    } else {
      $("body").animate({paddingBottom: "100px"});
      $('[data-navbar="bottom"]').show('slow');
      $(this).text('Hide the navbar');
    }
  })
})();

