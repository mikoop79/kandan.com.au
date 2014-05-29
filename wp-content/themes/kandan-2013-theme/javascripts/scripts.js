// JS Scripts for kandan.com.au by - NK 121212

/* DOCUMENT READY */

$(document).ready(function() {
    resizethis();
    organiseContent();
    navAnim();
    detectDevices();
    detectBrowser();
    organiseClients();
});

/* END DOCUMENT READY */

/* DOCUMENT RESIZE */

$(window).resize(function() {
    resizethis();
});

/* END DOCUMENT RESIZE */

/* JS FUNCTIONS */

/* ORGANISE CLIENTS (leaves only one client name visible in footer) */

function organiseClients() {

    var seen = {};
    $('#the-clients li a').each(function() {
        var txt = $(this).text();
        if (seen[txt])
            $(this).remove();
        else
            seen[txt] = true;
    });
}

/* PAGE LOAD ANIM */

function pageLoader() {

    pageLoaderHeight = $(document).height();
    $('#page-loader').css({
        'height': pageLoaderHeight
    });

    $(window).bind('load', function() {
        $('#page-loader').fadeOut();
    });
}

function goBack() {
    window.history.back();
}

/* DETECT DEVICES */

function detectDevices() {
    var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    console.log(agentID);
    if (agentID) {
        $('#intro-slider').css({
            'background-image': 'none'
        });

    }
}

/* DETECT BROWSER (Chrome) */

function detectBrowser() {
    $.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());

    /* CHROME SPECIFIC STYLES */
    if ($.browser.chrome) {
        $('h2').css({
            'letter-spacing': '-0.4px'
        });
    }
}

/* NAVIGATION BAR ANIM */

function navAnim() {

    /* ADD THE DATA LINK ATTR to the MAIN NAV */

    $.each($("#primary_nav .menu li a"), function() {
        var link_text = $(this).text();
        $(this).attr("data-title", link_text);
        $(this).data("title", link_text);
    });


}

/* RESIZE TO PAGE HEIGHT */

function resizethis() {
    var theheight = $(window).height();
    $('#intro-slider').css({
        'height': theheight
    });
}

/* ORGANISE PAGE CONTENT */

function organiseContent() {
    $('#landing_page .content-section li:last').css({
        'margin-right': '0'
    });
    $('#people-listing_page li:nth-child(5n)').css({
        'margin-right': '0'
    });
}


/* SETS THE POSITION OF ALL RIGHT THUMBNAIL AREAS BY ADDING WRAPPER AROUND H3's and P's - WHAT WE DO */

$(document).ready(function() {
    $('.left-column h3').each(function() {
        $(this).add($(this).next()).wrapAll('<div class="related-work-copy">');
    });


    /* THE WORK HOVER - SHOWS THE DESCRIPTION  COOPS 2013/10/16 */

    $("#landing-the_work li").hover(function() {

        // console.log("rollover");

        $(this).children('.hover-arrows-hover').fadeIn();
        $(this).children('.hover-arrows').fadeOut();

        $(this).children(".the_work-wrapper").animate({
            bottom: "0"
        }, 250, function() {
            // end of rollover
            //console.log("end rollover");
        });

    }, function() {

        $(this).children('.hover-arrows-hover').fadeOut();
        $(this).children('.hover-arrows').fadeIn();

        $(this).children(".the_work-wrapper").animate({
            bottom: "-225px"
        }, 250, function() {
            //end of rollout
        });
    });


});

/* REMOVES P TAGS FORM IMAGES - THE WORK SINGLE POST */

$(document).ready(function() {
    $('#the_work_page #content .left-column .the_work-images').each(function() {
        $(this).children('p').contents().unwrap();
    });
});

/* SOCIAL MEDIA ANIMS */

$(document).ready(function() {
    $('#social-media-icons a').hover(function() {
        $(this).animate({
            'margin-top': '-5px',
            'opacity': '1'
        }, 300);
    }, function() {
        $(this).animate({
            'margin-top': '0',
            'opacity': '0.8'
        }, 100);
    });
});

/* LANDING SERVICES HOVER */

$(document).ready(function() {

    /* BACKGROUND HOVER CHANGE - NK */
    $('.services-icons a').hover(function() {
        $(this).animate({
            backgroundColor: '#d5d4d4;'
        }, {
            queue: false,
            duration: 300
        });
    }, function() {
        $(this).animate({
            backgroundColor: '#e9e8e8;'
        }, 300);
    });


    /* THE SPINNY EFFECT */

    /* MAKES IT CROSS BROWSER FOR THE CSS PREFIX */
    if (jQuery.browser.webkit) {
        cssPrefix = "-webkit";
    } else if (jQuery.browser.mozilla) {
        cssPrefix = "-moz";
    } else if (jQuery.browser.opera) {
        cssPrefix = "-o";
    }

    // Apply opacity
    var zIndex = 1000;
    /* 
	$.each($("a.brand"),function(index) {
		var startDeg = 360;
		var element = $(this).children('span');
		
		var resetIcon = function() {
			element.fadeTo(250,0.8).css(cssPrefix + "-transform","rotate(" + startDeg + "deg)");
			
		};
		element.attr("style", "z-index:" + zIndex).parent('a').hover(function() {
			element.fadeTo(250,1).css(cssPrefix + "-transform","rotate(0deg)");
			
		},resetIcon);
		resetIcon();
	});

	// ACTIVATION THING!
	
	$.each($("a.activation"),function(index) {
		var startDeg = 360;
		var element = $(this).children('span');
		var original_top = element.css('top');
		var original_left = element.css('left');

		var prefix = "";

		var original_styles = {
			"top" : original_top,
			"left": original_left
		}

		var step_1_style = {
			
			"top" : original_top + '-10px' ,
			"left" : "10px",
			
		}

		var resetIcon = function() {
			element.fadeTo(50,0.8).animate(original_styles, "fast");
			
		};
		element.attr("style", "z-index:" + zIndex).parent('a').hover(function() {
			element.fadeTo(50,1).animate(step_1_style, "fast");
			
		},resetIcon);
		//resetIcon();
	});
	*/


});

/* PEOPLE HOVERS */

$(document).ready(function() {
    $('.hover-arrows').each(function() {
        $(this).parent('a').parent('li').hover(function() {
            $(this).find('.people-title').css({
                'color': '#0077ac'
            });
            $(this).find('.people-name').css({
                'color': '#0077ac'
            });
            $(this).find('.hover-arrows').fadeOut();
            $(this).find('.hover-arrows-hover').fadeIn();
        }, function() {
            $(this).find('.people-title').css({
                'color': '#000'
            });
            $(this).find('.people-name').css({
                'color': '#000'
            });
            $(this).find('.hover-arrows').fadeIn();
            $(this).find('.hover-arrows-hover').fadeOut();
        });
    });
});


/* PEOPLE HOVERS - PEOPLE LANDING PAGE (face switcher) */

$(document).ready(function() {
    $('#people-listing_page #content .left-column li').each(function() {
        $(this).hover(function() {
            $(this).find('.serious-face').animate({
                'opacity': '0'
            });
        }, function() {
            $(this).find('.serious-face').animate({
                'opacity': '1'
            });
        });
    });
});

/* LANDING PAGE SLIDESHOW */

// FOR LANDING PAGE SLIDESHOW

(function($) {

    $.fn.easySlider = function(options) {

        // default configuration properties
        var defaults = {
            prevId: 'prevBtn',
            prevText: 'Previous',
            nextId: 'nextBtn',
            nextText: 'Next',
            controlsShow: true,
            controlsBefore: '',
            controlsAfter: '',
            controlsFade: true,
            firstId: 'firstBtn',
            firstText: 'First',
            firstShow: false,
            lastId: 'lastBtn',
            lastText: 'Last',
            lastShow: false,
            vertical: false,
            speed: 1000,
            auto: true,
            pause: 5000,
            continuous: true,
            numeric: true,
            numericId: 'controls'
        };

        var options = $.extend(defaults, options);

        this.each(function() {
            var obj = $(this);
            var s = $("li", obj).length;
            var w = $("li", obj).width();
            var h = $("li", obj).height();
            var clickable = true;
            obj.width(w);
            obj.height(h);
            obj.css("overflow", "hidden");
            var ts = s - 1;
            var t = 0;
            $("ul", obj).css('width', s * w);

            if (options.continuous) {
                $("ul", obj).prepend($("ul li:last-child", obj).clone().css("margin-left", "-" + w + "px"));
                $("ul", obj).append($("ul li:nth-child(2)", obj).clone());
                $("ul", obj).css('width', (s + 1) * w);
            };

            if (!options.vertical) $("li", obj).css('float', 'left');

            if (options.controlsShow) {
                var html = options.controlsBefore;
                if (options.numeric) {
                    html += '<ol id="' + options.numericId + '"></ol>';
                } else {
                    if (options.firstShow) html += '<span id="' + options.firstId + '"><a href=\"javascript:void(0);\">' + options.firstText + '</a></span>';
                    html += ' <span id="' + options.prevId + '"><a href=\"javascript:void(0);\">' + options.prevText + '</a></span>';
                    html += ' <span id="' + options.nextId + '"><a href=\"javascript:void(0);\">' + options.nextText + '</a></span>';
                    if (options.lastShow) html += ' <span id="' + options.lastId + '"><a href=\"javascript:void(0);\">' + options.lastText + '</a></span>';
                };

                html += options.controlsAfter;
                $(obj).after(html);
            };

            if (options.numeric) {
                for (var i = 0; i < s; i++) {
                    $(document.createElement("li"))
                        .attr('id', options.numericId + (i + 1))
                        .html('<a rel=' + i + ' href=\"javascript:void(0);\">' + (i + 1) + '</a>')
                        .appendTo($("#" + options.numericId))
                        .click(function() {
                            animate($("a", $(this)).attr('rel'), true);
                        });
                };
            } else {
                $("a", "#" + options.nextId).click(function() {
                    animate("next", true);
                });
                $("a", "#" + options.prevId).click(function() {
                    animate("prev", true);
                });
                $("a", "#" + options.firstId).click(function() {
                    animate("first", true);
                });
                $("a", "#" + options.lastId).click(function() {
                    animate("last", true);
                });
            };

            function setCurrent(i) {
                i = parseInt(i) + 1;
                $("li", "#" + options.numericId).removeClass("current");
                $("li#" + options.numericId + i).addClass("current");
            };

            function adjust() {
                if (t > ts) t = 0;
                if (t < 0) t = ts;
                if (!options.vertical) {
                    $("ul", obj).css("margin-left", (t * w * -1));
                } else {
                    $("ul", obj).css("margin-left", (t * h * -1));
                }
                clickable = true;
                if (options.numeric) setCurrent(t);
            };

            function animate(dir, clicked) {
                if (clickable) {
                    clickable = false;
                    var ot = t;
                    switch (dir) {
                        case "next":
                            t = (ot >= ts) ? (options.continuous ? t + 1 : ts) : t + 1;
                            break;
                        case "prev":
                            t = (t <= 0) ? (options.continuous ? t - 1 : 0) : t - 1;
                            break;
                        case "first":
                            t = 0;
                            break;
                        case "last":
                            t = ts;
                            break;
                        default:
                            t = dir;
                            break;
                    };
                    var diff = Math.abs(ot - t);
                    var speed = diff * options.speed;
                    if (!options.vertical) {
                        p = (t * w * -1);
                        $("ul", obj).animate({
                            marginLeft: p
                        }, {
                            queue: false,
                            duration: speed,
                            complete: adjust
                        });
                    } else {
                        p = (t * h * -1);
                        $("ul", obj).animate({
                            marginTop: p
                        }, {
                            queue: false,
                            duration: speed,
                            complete: adjust
                        });
                    };

                    if (!options.continuous && options.controlsFade) {
                        if (t == ts) {
                            $("a", "#" + options.nextId).hide();
                            $("a", "#" + options.lastId).hide();
                        } else {
                            $("a", "#" + options.nextId).show();
                            $("a", "#" + options.lastId).show();
                        };
                        if (t == 0) {
                            $("a", "#" + options.prevId).hide();
                            $("a", "#" + options.firstId).hide();
                        } else {
                            $("a", "#" + options.prevId).show();
                            $("a", "#" + options.firstId).show();
                        };
                    };

                    if (clicked) clearTimeout(timeout);
                    if (options.auto && dir == "next" && !clicked) {;
                        timeout = setTimeout(function() {
                            animate("next", false);
                        }, diff * options.speed + options.pause);
                    };

                };

            };
            // init
            var timeout;
            if (options.auto) {;
                timeout = setTimeout(function() {
                    animate("next", false);
                }, options.pause);
            };

            if (options.numeric) setCurrent(0);

            if (!options.continuous && options.controlsFade) {
                $("a", "#" + options.prevId).hide();
                $("a", "#" + options.firstId).hide();
            };

        });

    };

})(jQuery);

$(document).ready(function() {
    $("#home-slider").easySlider();
});

// SET COOKIE 

(function(factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals.
        factory(jQuery);
    }
}(function($) {

    var pluses = /\+/g;

    function raw(s) {
        return s;
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, ' '));
    }

    function converted(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            return config.json ? JSON.parse(s) : s;
        } catch (er) {}
    }

    var config = $.cookie = function(key, value, options) {

        // write
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = config.json ? JSON.stringify(value) : String(value);

            return (document.cookie = [
                config.raw ? key : encodeURIComponent(key),
                '=',
                config.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // read
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        var result = key ? undefined : {};
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = decode(parts.join('='));

            if (key && key === name) {
                result = converted(cookie);
                break;
            }

            if (!key) {
                result[name] = converted(cookie);
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function(key, options) {
        if ($.cookie(key) !== undefined) {
            $.cookie(key, '', $.extend(options, {
                expires: -1
            }));
            return true;
        }
        return false;
    };

}));

// FOOTER COOKIE FOR CONTACT DETAILS 

$(document).ready(function() {

    /* CHECKS FOR COOKIE */

    var closeContacts = $.cookie("closedContactsCookie");

    if (closeContacts == 'yes') {
        $('#footer .content-section .arrow').addClass('closed');
        $('#footer_address').css({
            'display': 'none'
        });
    }

    if (closeContacts != 'yes') {
        $('#footer .content-section .arrow').removeClass('closed');
        $('#footer_address').css({
            'display': 'block'
        });
    }

});

/* IMAGE FADER USED THROUGHOUT THE SITE */

(function($) {
    var default_options = {
        'animationType': 'fade',
        'animate': true,
        'first_slide': 0,
        'easing': 'linear',
        'speed': 'normal',
        'type': 'sequence',
        'timeout': 2000,
        'startDelay': 0,
        'loop': true,
        'containerHeight': 'auto',
        'runningClass': 'innerFade',
        'children': null,
        'cancelLink': null,
        'pauseLink': null,
        'prevLink': true,
        'nextLink': true,
        'indexContainer': null,
        'currentItemContainer': null,
        'totalItemsContainer': null,
        'callback_index_update': null
    };

    $(function() {
        window.isActive = true;
        $(window).focus(function() {
            this.isActive = true;
        });
        $(window).blur(function() {
            this.isActive = false;
        });
    });

    $.fn.innerFade = function(options) {
        return this.each(function() {
            $fade_object = new Object();
            // Assign the container
            $fade_object.container = this;
            // Combine default and set settings or use default
            // Pay attention kids, there's an important lesson here. When using $.extend, the first parameter will
            // be CHANGED to the combination of all the parameters. In my situation, I just wanted to combine two 
            // objects, but not affect them in any way hence the empty object.
            $fade_object.settings = $.extend({}, default_options, options);
            // If children option is set use that as elements, otherwise use the called jQuery object
            $fade_object.elements = ($fade_object.settings.children === null) ? $($fade_object.container).children() : $($fade_object.container).children($fade_object.settings.children);
            // Setup the count
            $fade_object.count = 0;
            // Save data to container for use later
            $($fade_object.container).data('object', $fade_object);

            // Start the loop
            if ($fade_object.elements.length > 1) {
                // Establish the Next and Previous Handlers
                if ($fade_object.settings.nextLink || $fade_object.settings.prevLink) {
                    $.bindControls($fade_object);
                }

                // Establish Cancel Handler
                if ($fade_object.settings.cancelLink) {
                    $.bindCancel($fade_object);
                };

                // Set outer container as relative, and use the height that's set and add the running class
                $($fade_object.container).css({
                    'position': 'relative'
                }).addClass($fade_object.settings.runningClass);
                if ($fade_object.settings.containerHeight == 'auto') {
                    height = $($fade_object.elements).filter(':first').height();
                    $($fade_object.container).css({
                        'height': height + 'px'
                    });
                } else {
                    $($fade_object.container).css({
                        'height': $fade_object.settings.containerHeight
                    });
                };

                // Build the Index if one is specified
                if ($fade_object.settings.indexContainer) {
                    $.innerFadeIndex($fade_object);
                };

                $($fade_object.elements).filter(':gt(0)').hide(0);
                // Set the z-index from highest to lowest (20, 19, 18...) and set their position as absolute
                for (var i = 0; i < $fade_object.elements.length; i++) {
                    $($fade_object.elements[i]).css('z-index', String($fade_object.elements.length - i)).css('position', 'absolute');
                }

                var toShow = '';
                var toHide = '';

                if ($fade_object.settings.type == "random") {
                    toHide = Math.floor(Math.random() * $fade_object.elements.length);
                    do {
                        toShow = Math.floor(Math.random() * $fade_object.elements.length);
                    } while (toHide == toShow);
                    $($fade_object.elements[toHide]).show();
                } else if ($fade_object.settings.type == 'random_start') {
                    $fade_object.settings.type = 'sequence';
                    toHide = Math.floor(Math.random() * ($fade_object.elements.length));
                    toShow = (toHide + 1) % $fade_object.elements.length;
                } else {
                    // Otherwise and if its sequence
                    toShow = $fade_object.settings.first_slide;
                    toHide = ($fade_object.settings.first_slide == 0) ? $fade_object.elements.length - 1 : $fade_object.settings.first_slide - 1;
                }

                if ($fade_object.settings.animate) {
                    $.fadeTimeout($fade_object, toShow, toHide, true);
                } else {
                    $($fade_object.elements[toShow]).show();
                    $($fade_object.elements[toHide]).hide();
                    $.updateIndexes($fade_object, toShow);
                };
                $.updateIndexes($fade_object, toShow);

                if ($fade_object.settings.type == 'random') {
                    $($fade_object.elements[toHide]).show();
                } else {
                    $($fade_object.elements[toShow]).show();
                };

                // Set item count containers
                if ($fade_object.settings.currentItemContainer) {
                    $.currentItem($fade_object, toShow);
                };
                if ($fade_object.settings.totalItemsContainer) {
                    $.totalItems($fade_object);
                };

                // Establish the Pause Handler
                if ($fade_object.settings.pauseLink) {
                    $.bind_pause($fade_object);
                };
            }
        });
    };

    /**
     * Public function to change to a specific slide. This is expecting a zero-index slide number.
     * @param {Number} slide_number Zero-indexed slide number
     */
    $.fn.innerFadeTo = function(slide_number) {
        return this.each(function(index) {
            var $fade_object = $(this).data('object');

            var $currentVisibleItem = $($fade_object.elements).filter(':visible');
            var currentItemIndex = $($fade_object.elements).index($currentVisibleItem);
            $.stopSlideshow($fade_object);
            if (slide_number != currentItemIndex) {
                $.fadeToItem($fade_object, slide_number, currentItemIndex);
            };
        });
    };

    /**
     * Fades the slideshow to the item selected from the previous item
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     * @param {Number} toShow The position in the elements array of the item to be shown
     * @param {Number} toHide The position in the elements array of the item to be hidden
     */
    $.fadeToItem = function($fade_object, toShow, toHide) {
        var speed = $fade_object.settings.speed;

        switch ($fade_object.settings.animationType) {
            case "slide":
                $($fade_object.elements[toHide]).slideUp(speed);
                $($fade_object.elements[toShow]).slideDown(speed);
                break;
            case "slideOver":
                var itemWidth = $($fade_object.elements[0]).width(),
                    to_hide_css = {},
                    to_show_css = {},
                    to_hide_animation = {},
                    to_show_animation = {};

                $($fade_object.container).css({
                    'overflow': 'hidden'
                });

                // Both CSS Declarations use the same initial CSS
                to_hide_css = {
                    'position': 'absolute',
                    'top': '0px'
                };

                to_show_css = $.extend({}, to_hide_css);

                // If going forward, we want the item (to be shown) to animate from the right to left
                // If going backwards, we want the item (to be shown) to animate from the left to the right
                if (toShow > toHide) { // Forwards
                    to_hide_css.left = "0px";
                    to_hide_css.right = "auto";

                    to_show_css.left = 'auto';
                    to_show_css.right = '-' + itemWidth + 'px';

                    to_hide_animation.left = '-' + itemWidth + 'px';

                    to_show_animation.right = '0px';

                    //console.log(to_hide_css);
                } else { // Backwards
                    to_hide_css.left = "auto";
                    to_hide_css.right = "0px";

                    to_show_css.left = '-' + itemWidth + 'px';
                    to_show_css.right = 'auto';

                    to_hide_animation.right = '-' + itemWidth + 'px';

                    to_show_animation.left = '0px';
                };

                $($fade_object.elements[toHide]).css(to_hide_css);
                $($fade_object.elements[toShow]).css(to_show_css).show();

                $($fade_object.elements[toHide]).animate(to_hide_animation, speed, $fade_object.settings.easing, function() {
                    $(this).hide();
                });

                $($fade_object.elements[toShow]).animate(to_show_animation, speed, $fade_object.settings.easing);
                break;
            case "fadeEmpty":
                $($fade_object.elements[toHide]).fadeOut(speed, function() {
                    $($fade_object.elements[toShow]).fadeIn(speed);
                });
                break;
            case "slideEmpty":
                $($fade_object.elements[toHide]).slideUp(speed, function() {
                    $($fade_object.elements[toShow]).slideDown(speed);
                });
                break;
            default:
                $($fade_object.elements[toHide]).fadeOut(speed)
                $($fade_object.elements[toShow]).fadeIn(speed);
                break;
        }

        // Update the toShow item
        if ($fade_object.settings.currentItemContainer) {
            $.currentItem($fade_object, toShow);
        };

        // Update indexes with active classes
        if ($fade_object.settings.indexContainer || $fade_object.settings.callback_index_update) {
            $.updateIndexes($fade_object, toShow);
        };
    };

    /**
     * Fades to the item of your choosing and establishes the timeout for the next item to fade to
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     * @param {Number} toShow The position in the elements array of the item to be shown
     * @param {Number} toHide The position in the elements array of the item to be hidden
     * @param {Boolean} firstRun If this is the first run of innerfade, pass true, otherwise pass false
     */
    $.fadeTimeout = function($fade_object, toShow, toHide, firstRun) {

        // only process if window is active, otherwise just call the same function
        if (window.isActive) {
            // If its not the first run, then fade
            if (firstRun != true) {
                $.fadeToItem($fade_object, toShow, toHide);
            };

            // Increment the count of slides shown
            $fade_object.count++;

            // 	Check if loop is false, if it is check to see how many slides have been shown.
            // In the case that you're at the last slide, stop the slideshow and return.
            if ($fade_object.settings.loop == false && $fade_object.count >= $fade_object.elements.length) {
                $.stopSlideshow($fade_object);
                return;
            };

            // Get ready for next fade
            if ($fade_object.settings.type == "random") {
                toHide = toShow;
                while (toShow == toHide) {
                    toShow = Math.floor(Math.random() * $fade_object.elements.length);
                }
            } else {
                toHide = (toHide > toShow) ? 0 : toShow;
                toShow = (toShow + 1 >= $fade_object.elements.length) ? 0 : toShow + 1;
            }

        };

        // Set the time out; if its first run and a start delay exists, use the start delay
        var timeout = (firstRun && $fade_object.settings.startDelay) ? $fade_object.settings.startDelay : $fade_object.settings.timeout;
        $($fade_object.container).data('current_timeout', setTimeout((function() {
            $.fadeTimeout($fade_object, toShow, toHide, false);
        }), timeout));
    };

    /* Allows the unbind function to be called from javascript */
    $.fn.innerFadeUnbind = function() {
        return this.each(function(index) {
            var $fade_object = $(this).data('object');
            $.stopSlideshow($fade_object);
        });
    };

    /**
     * Stops the slideshow
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.stopSlideshow = function($fade_object) {
        clearTimeout($($fade_object.container).data('current_timeout'));
        $($fade_object.container).data('current_timeout', null);
    };

    /**
     * Establishes the Next and Previous link behavior
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.bindControls = function($fade_object) {
        $($fade_object.settings.nextLink).on('click', function(event) {
            event.preventDefault();
            $.stopSlideshow($fade_object);

            var $currentElement = $($fade_object.elements).filter(':visible');
            var currentElementIndex = $($fade_object.elements).index($currentElement);

            var $nextElement = ($currentElement.next().length > 0) ? $currentElement.next() : $($fade_object.elements).filter(':first');
            var nextElementIndex = $($fade_object.elements).index($nextElement);

            $.fadeToItem($fade_object, nextElementIndex, currentElementIndex);
        });

        $($fade_object.settings.prevLink).on('click', function(event) {
            event.preventDefault();
            $.stopSlideshow($fade_object);

            var $currentElement = $($fade_object.elements).filter(':visible');
            var currentElementIndex = $($fade_object.elements).index($currentElement);

            var $previousElement = ($currentElement.prev().length > 0) ? $currentElement.prev() : $($fade_object.elements).filter(':last');
            var previousElementIndex = $($fade_object.elements).index($previousElement);

            $.fadeToItem($fade_object, previousElementIndex, currentElementIndex);
        });
    };

    /**
     * Establishes the Pause Button
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.bind_pause = function($fade_object) {
        $($fade_object.settings.pauseLink).unbind().click(function(event) {
            event.preventDefault();
            if ($($fade_object.container).data('current_timeout') != null) {
                $.stopSlideshow($fade_object);
            } else {
                // Restart the slideshow				
                var tag = $($fade_object.container).children(':first').attr('tagName').toLowerCase();
                var nextItem = '';
                var previousItem = '';

                if ($fade_object.settings.type == "random") {
                    previousItem = Math.floor(Math.random() * $fade_object.elements.length);
                    do {
                        nextItem = Math.floor(Math.random() * $fade_object.elements.length);
                    } while (previousItem == nextItem);
                } else if ($fade_object.settings.type == "random_start") {
                    previousItem = Math.floor(Math.random() * $fade_object.elements.length);
                    nextItem = (previousItem + 1) % $fade_object.elements.length;
                } else {
                    previousItem = $(tag, $($fade_object.container)).index($(tag + ':visible', $($fade_object.container)));
                    nextItem = ((previousItem + 1) == $fade_object.elements.length) ? 0 : previousItem + 1;
                }

                $.fadeTimeout($fade_object, nextItem, previousItem, false);
            }
        });
    };

    /**
     * Establishes the Cancel Button
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.bindCancel = function($fade_object) {
        $($fade_object.settings.cancelLink).unbind().click(function(event) {
            event.preventDefault();
            $.stopSlideshow($fade_object);
        });
    };

    /**
     * Updates the indexes and adds an active class to the visible item
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     * @param {Number} toShow The position in the elements array of the item to be shown
     */
    $.updateIndexes = function($fade_object, toShow) {
        $($fade_object.settings.indexContainer).children().removeClass('active');
        $('> :eq(' + toShow + ')', $($fade_object.settings.indexContainer)).addClass('active');

        // Check for the callback index update
        if (typeof($fade_object.settings.callback_index_update) == "function") {
            $fade_object.settings.callback_index_update.call(this, toShow);
        };
    };

    /**
     * Creates handlers for the links created by the $.handleIndexes and $.generateIndexes functions
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     * @param {Number} count The item to be setting the link on
     * @param {jQuery Object} link The selector or jQuery object of the link
     */
    $.createIndexHandler = function($fade_object, count, link) {
        $(link).click(function(event) {
            event.preventDefault();
            var $currentVisibleItem = $($fade_object.elements).filter(':visible');
            var currentItemIndex = $($fade_object.elements).index($currentVisibleItem);
            $.stopSlideshow($fade_object);
            if ($currentVisibleItem.size() <= 1 && count != currentItemIndex) {
                $.fadeToItem($fade_object, count, currentItemIndex);
            };
        });
    };

    /**
     * Creates one link for each item in the slideshow, to show that item immediately
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.createIndexes = function($fade_object) {
        var $indexContainer = $($fade_object.settings.indexContainer);

        for (var i = 0; i < $fade_object.elements.length; i++) {
            var $link = $('<li><a href="#">' + (i + 1) + '</a></li>');
            $.createIndexHandler($fade_object, i, $link);
            $indexContainer.append($link);
        };
    };

    /**
     * Establishes links between the slide elements and index items in the indexContainer
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.linkIndexes = function($fade_object) {
        var $indexContainer = $($fade_object.settings.indexContainer);
        var $indexContainerChildren = $('> :visible', $indexContainer);

        if ($indexContainerChildren.size() == $fade_object.elements.length) {
            var count = $fade_object.elements.length;
            for (var i = 0; i < count; i++) {
                $('a', $indexContainer).click(function(event) {
                    event.preventDefault();
                });
                $.createIndexHandler($fade_object, i, $indexContainerChildren[i]);
            };
        } else {
            alert("There is a different number of items in the menu and slides. There needs to be the same number in both.\nThere are " + $indexContainerChildren.size() + " in the indexContainer.\nThere are " + $fade_object.elements.length + " in the slides container.");
        };
    };

    /**
     * Determines if the index container is empty or not. If its empty then it generates links, if its not empty
     * it links one to one
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.innerFadeIndex = function($fade_object) {
        var $indexContainer = $($fade_object.settings.indexContainer);
        if ($(':visible', $indexContainer).size() <= 0) {
            $.createIndexes($fade_object);
        } else {
            $.linkIndexes($fade_object);
        };
    };

    /**
     * Changes the text of the current item selector to the index of the current item
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     * @param {Number} current Index of the current slide
     */
    $.currentItem = function($fade_object, current) {
        var $container = $($fade_object.settings.currentItemContainer);
        $container.text(current + 1);
    };

    /**
     * Changes the text of the total item selector to the total number of items
     * @param {Object} $fade_object The object that contains the settings, elements and container for this slideshow
     */
    $.totalItems = function($fade_object) {
        var $container = $($fade_object.settings.totalItemsContainer);
        $container.text($fade_object.elements.length);
    };







})(jQuery);

// **** remove Opacity-Filter in ie ****
function removeFilter(element) {
    if (element.style.removeAttribute) {
        element.style.removeAttribute('filter');
    }
}