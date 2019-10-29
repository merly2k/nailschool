/**
 * ninjaSlider v0.1
 *
 * Parameters:
 * loop: to loop or not to loop (default: false).
 * switchSelector: selector of DOM element who is gonna fire the swtich event.
 * speed: interval speed (default: 2000).
 *
 * @param {type} params
 */
(function($) {
    $.fn.ninjaSlider = function(params) {
        /* default config */
        var speed = 2000;
        var slideIndex = 0;
        var slides = new Array();
        var isRunning = false;
        var loopProcess;
        var sliderSelector = "#" + $(this).attr("id");
        var loop = false;


        /* user config */
        if (params && params.speed) {
            speed = params.speed;
        }
        if (params && params.loop) {
            loop = params.loop;
        }



        slides = $(sliderSelector + " img");

        var methods = {
            switchTo: function(data) {
                for (var index = 0; index < slides.length; index++) {
                    if ($(slides[index]).attr("src") === data) {
                        slideIndex = index;
                        methods.update();
                        break;
                    }
                }
            },
            update: function() {
                $(slides[slideIndex]).stop().fadeIn('slow');
                for (var i = slideIndex + 1; i < slides.length; i++) {
                    $(slides[i]).stop().fadeOut('slow');
                }
            },
            switchBG: function() {
                if (slideIndex < slides.length - 1) {
                    slideIndex++;
                } else {
                    slideIndex = 0;
                }
                methods.update();
            },
            playPause: function() {
                if (isRunning) {
                    methods.stopLoop();
                } else {
                    methods.run();
                }
            },
            run: function() {
                function sliderLoop() {
                    isRunning = true;
                    methods.switchBG();
                }
                methods.stopLoop();
                loopProcess = setInterval(sliderLoop, speed);
            },
            stopLoop: function() {
                clearInterval(loopProcess);
                isRunning = false;
            }
        }

        if (params && params.switchSelector) {
            $(params.switchSelector).click(function() {
                methods.switchTo($(this).attr("data-ninja"));
            });
        }
        /* If is set to loop*/
        if (loop) {
            methods.run();
        }
    }

})(jQuery);