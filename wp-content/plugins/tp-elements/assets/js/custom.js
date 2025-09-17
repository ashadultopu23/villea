/**
 *
 * --------------------------------------------------------------------
 *
 * Template : Custom Js Template
 * Author : Themephi
 * Author URI : http://www.themephi.net/
 *
 * --------------------------------------------------------------------
 *
 **/
(function ($) {
    "use strict";

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $.fn.skillBars = function (options) {
        var settings = $.extend({
            from: 0, // number start
            to: false, // number end
            speed: 1000, // how long it should take to count between the target numbers
            interval: 100, // how often the element should be updated
            decimals: 0, // the number of decimal places to show
            onUpdate: null, // callback method for every time the element is updated,
            onComplete: null, // callback method for when the element finishes updating
            /*onComplete: function(from) {
                console.debug(this);
            }*/
            classes: {
                skillBarBar: '.skillbar-bar',
                skillBarPercent: '.skill-bar-percent',
            }
        }, options);

        return this.each(function () {

            var obj = $(this),
                to = (settings.to != false) ? settings.to : parseInt(obj.attr('data-percent'));
            if (to > 100) {
                to = 100;
            };
            var from = settings.from,
                loops = Math.ceil(settings.speed / settings.interval),
                increment = (to - from) / loops,
                loopCount = 0,
                interval = setInterval(updateValue, settings.interval);

            obj.find(settings.classes.skillBarBar).animate({
                width: parseInt(obj.attr('data-percent')) + '%'
            }, settings.speed);

            function updateValue() {
                from += increment;
                loopCount++;
                $(obj).find(settings.classes.skillBarPercent).text(from.toFixed(settings.decimals) + '%');

                if (typeof (settings.onUpdate) == 'function') {
                    settings.onUpdate.call(obj, from);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    from = to;

                    if (typeof (settings.onComplete) == 'function') {
                        settings.onComplete.call(obj, from);
                    }
                }
            }

        });
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
            AOS.init({
                duration: 500,
                easing: 'ease-out-quart',
                once: true
            });


        });

    });


    class ScrollSection {
        constructor(wrapper) {
            this.wrapper = wrapper;
            this.scrollContent = wrapper.querySelector(".scroll-content");
            this.scrollContentXSecond = wrapper.querySelector(
                ".scroll-content.second"
            );
            this.scrollContentXThird = wrapper.querySelector(".scroll-content.third");
            this.percentageArea = wrapper.querySelector(".progress-circles");
            this.scrollPosition = 0;
            this.lastScrollY = window.scrollY;
            this.increment = 0.5;
            this.isAnimating = false;

            this.init();
        }

        init() {
            window.addEventListener("scroll", this.handleScroll.bind(this));
            window.addEventListener("resize", this.handleResize.bind(this));
        }

        isScreenWidthValid() {
            return window.innerWidth >= 1200;
        }

        isSectionInViewport() {
            const rect = this.wrapper.getBoundingClientRect();
            return rect.top < window.innerHeight && rect.bottom >= 0;
        }

        updateTransform() {
            if (this.isAnimating) return;
            this.isAnimating = true;

            requestAnimationFrame(() => {
                const percentage = ((this.scrollPosition + 30) / 60) * 100;

                if (this.isScreenWidthValid() && this.scrollContent) {
                    this.scrollContent.style.transform = `translateX(${-this
                        .scrollPosition}%)`;
                }

                if (this.scrollContentXSecond) {
                    this.scrollContentXSecond.style.transform = `translateX(${-90 + this.scrollPosition
                        }%)`;
                }

                if (this.scrollContentXThird) {
                    this.scrollContentXThird.style.transform = `translateX(${-30 - this.scrollPosition
                        }%)`;
                }

                if (this.percentageArea) {
                    this.updateProgressCircle(percentage);
                }

                this.isAnimating = false;
            });
        }

        updateProgressCircle(percentage) {
            this.percentageArea.style.setProperty(
                "--value",
                `${percentage.toFixed(2)}`
            );
            const progressValue =
                this.percentageArea.querySelector(".progress-value");
            const progressText = this.percentageArea.querySelector(".progress-text");

            progressValue.innerText = `${percentage.toFixed(0)}%`;

            if (percentage > 99) {
                progressText.style.display = "block";
                progressValue.style.display = "none";

                const stickyArea = this.wrapper
                    .closest(".sticky-container")
                    ?.querySelector(".sticky-area");
                if (stickyArea) {
                    stickyArea.style.top = "initial";
                }
            } else {
                progressValue.style.display = "block";
                progressText.style.display = "none";

                const stickyArea = this.wrapper
                    .closest(".sticky-container")
                    ?.querySelector(".sticky-area");
                if (stickyArea) {
                    stickyArea.style.top = "0";
                }
            }
        }

        handleScroll() {
            if (this.isSectionInViewport()) {
                const delta = window.scrollY - this.lastScrollY;
                this.lastScrollY = window.scrollY;

                if (delta > 0) {
                    this.scrollPosition = Math.min(
                        this.scrollPosition + this.increment,
                        30
                    );
                } else if (delta < 0) {
                    this.scrollPosition = Math.max(
                        this.scrollPosition - this.increment,
                        -30
                    );
                }

                this.updateTransform();
            }
        }

        handleResize() {
            if (!this.isScreenWidthValid()) {
                this.scrollContent?.style.removeProperty("transform");
                this.scrollContentXSecond?.style.removeProperty("transform");
                this.scrollContentXThird?.style.removeProperty("transform");
            } else {
                this.updateTransform();
            }
        }

        resetScrollPosition() {
            this.scrollPosition = 0;
            this.updateTransform();
        }
    }

    let scrollSections = [];

    const scrollWrappers = document.querySelectorAll(".scroll-content-wrapper");
    scrollWrappers.forEach((wrapper) => {
        scrollSections.push(new ScrollSection(wrapper));
    });

})(jQuery);