"use strict";
document.addEventListener("DOMContentLoaded", function () {
  $(function ($) {
    // preloader
    $("#preloader")
      .delay(300)
      .animate(
        {
          opacity: "0",
        },
        500,
        function () {
          $("#preloader").css("display", "none");
        }
      );

    // Click to Scroll Top
    var ScrollTop = $(".scrollToTop");
    $(".scrollToTop").on("click", function () {
      $("html, body").animate(
        {
          scrollTop: 0,
        },
        600
      );
      return false;
    });

    // Sticky Header
    var fixed_top = $(".header-section");
    if ($(window).scrollTop() > 50) {
      fixed_top.addClass("animated fadeInDown header-fixed");
    } else {
      fixed_top.removeClass("animated fadeInDown header-fixed");
    }

    // window on scroll function
    $(window).on("scroll", function () {
      // Sticky Header
      if ($(window).scrollTop() > 50) {
        fixed_top.addClass("animated fadeInDown header-fixed");
      } else {
        fixed_top.removeClass("animated fadeInDown header-fixed");
      }

      // Check Scroll
      if ($(this).scrollTop() < 600) {
        ScrollTop.removeClass("active");
      } else {
        ScrollTop.addClass("active");
      }

      // Odometer Init
      let windowHeight = $(window).height();
      $(".odometer")
        .children()
        .each(function () {
          if (
            $(this).isInViewport({
              tolerance: windowHeight,
              toleranceForLast: windowHeight,
              debug: false,
            })
          ) {
            var section = $(this).closest(".counters");
            section.find(".odometer").each(function () {
              $(this).html($(this).attr("data-odometer-final"));
            });
          }
        });
    });

    // Box Style
    const targetBtn = document.querySelectorAll(".box-style");
    if (targetBtn) {
      targetBtn.forEach((element) => {
        element.addEventListener("mousemove", (e) => {
          const x = e.offsetX + "px";
          const y = e.offsetY + "px";
          element.style.setProperty("--x", x);
          element.style.setProperty("--y", y);
        });
      });
    }

    // Password Show Hide
    $(".show-hide-pass").on("click", function () {
      var passwordInput = $($(this).siblings(".pass-box input"));
      var icon = $(this);
      if (passwordInput.attr("type") == "password") {
        passwordInput.attr("type", "text");
        icon.html("visibility");
      } else {
        passwordInput.attr("type", "password");
        icon.html("visibility_off");
      }
    });

    // singleMasonry
    function singleMasonry() {
      $(".single-masonry").each(function () {
        const singleMasonry = $(this);
        if (
          singleMasonry.hasClass("random-size-toggle") &&
          $(window).width() > 991
        ) {
          singleMasonry.addClass("random-size");
          singleMasonry.removeClass("fixed-size");
        } else {
          singleMasonry.removeClass("random-size");
          singleMasonry.addClass("fixed-size");
        }

        if ($(singleMasonry).hasClass("fixed-size")) {
          const stylesMasonry =
            singleMasonry[0].currentStyle ||
            window.getComputedStyle(singleMasonry[0]);
          const gridTemplateColumns = stylesMasonry.gridTemplateColumns;
          const howManyItem = gridTemplateColumns.split(" ");
          const countItem = howManyItem.length;
          const singleItems = singleMasonry.find("> div");
          singleItems.css("marginTop", "0px");
          singleItems.each(function (index) {
            const card = $(this);
            const img = card.find(".home-item");
            if (img.length) {
              const cardHeight = card.outerHeight();
              const imgHeight = img.outerHeight();
              const heightDifference = cardHeight - imgHeight;
              const nextSiblingIndex = index + countItem;
              const nextSiblingItem = singleItems.eq(nextSiblingIndex);
              if (nextSiblingItem.length) {
                nextSiblingItem.css("marginTop", `-${heightDifference}px`);
              }
            }
          });
        }
      });
    }
    singleMasonry();
    $(window).on("resize scroll", function () {
      singleMasonry();
    });

    // Circle Text
    const text = document.querySelector(".circle-text.first p");
    const text2 = document.querySelector(".circle-text.second p");
    const text3 = document.querySelector(".circle-text.third p");
    if (text) {
      text.innerHTML = text.innerText
        .split("")
        .map(
          (char, i) =>
            `<span style="transform:rotate(${i * 8}deg)">${char}</span>`
        )
        .join("");
    }
    if (text2) {
      text2.innerHTML = text2.innerText
        .split("")
        .map(
          (char, i) =>
            `<span style="transform:rotate(${i * 6.7}deg)">${char}</span>`
        )
        .join("");
    }

    // magnific-popup
    $(".popup-video").magnificPopup({
      type: "iframe",
    });

    // gridGallery
    $(".popup_img").magnificPopup({
      type: "image",
      gallery: {
        enabled: true,
      },
    });

    // navbar custom
    $(".navbar-toggle-btn").on("click", function () {
      $(".navbar-toggle-item").slideToggle(300);
      $("body").toggleClass("overflow-hidden");
      $(this).toggleClass("open");
    });
    $(".menu-item button, .menu-item a").on("click", function () {
      $(this).siblings("ul").slideToggle(300);
    });

    // mega Menu Window
    megaMenuWindow();
    $(window).on("resize", function () {
      megaMenuWindow();
    });
    function megaMenuWindow() {
      if ($(window).width() < 992) {
        $(".mega-sub-menu").removeClass("sub-menu");
      } else {
        $(".mega-sub-menu").addClass("sub-menu");
      }
    }

    // Current Year
    $(".currentYear").text(new Date().getFullYear());

    // sidebar-toggler
    var primarySidebar = $(".sidebar-toggler .sidebar-head");
    $(".sidebar-toggler .toggler-btn").on("click", function () {
      $(this).closest(".sidebar-head").toggleClass("active");
      if (!$(".sidebar-head").hasClass("active")) {
        setTimeout(function () {
          primarySidebar.css("height", "24px");
        }, 550);
      } else {
        primarySidebar.css("height", "100%");
      }
    });

    // sidebar-toggler
    $(".sidebar-wrapper .sidebar-item-head").on("click", function () {
      $(this).siblings(".sidebar-single-body").slideToggle();
      $(this).toggleClass("active");
    });

    // Social Item Remove
    $(".social-hide-btn").on("click", function () {
      $(this).parents(".img-area").toggleClass("active");
      if ($(".img-area").hasClass("active")) {
        $(".active .social-hide-btn i").html("remove");
      } else {
        $(".social-hide-btn i").html("add");
      }
    });

    // target Items Remove from anywhere click
    var targetBox = $(".target-item");
    $(document).on("click", function (event) {
      if (!targetBox.is(event.target) && !targetBox.has(event.target).length) {
        targetBox.removeClass("active");
      }
    });

    // banner-element-move
    $(".banner-element").each(function () {
      var objectLeft = $(".banner-element.left");
      var objectRight = $(".banner-element.right");
      $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();
        var scrollHeight = $(document).height() - $(window).height();
        var scrollPosition = scrollTop / scrollHeight;

        var rotatePosition = scrollPosition * 0.5 * $(window).width();
        objectLeft.css("transform", "rotate(" + rotatePosition / 4 + "deg)");
        var absPosition = scrollPosition * 1.5 * $(window).width();
        objectLeft.css("left", absPosition);

        if (!$(this).hasClass("right")) {
          objectRight.css(
            "transform",
            "rotate(" + -rotatePosition / 4 + "deg)"
          );
          objectRight.css("right", absPosition);
        }
      });
    });

    // Custom Tabs
    $(".tabLinks .nav-links").each(function () {
      var targetTab = $(this).closest(".singleTab");
      targetTab.find(".tabLinks .nav-links").each(function () {
        var navBtn = targetTab.find(".tabLinks .nav-links");
        navBtn.on("click mouseover", function () {
          navBtn.removeClass("active");
          $(this).addClass("active");
          var indexNum = $(this).closest("li").index();
          var tabContent = targetTab.find(".tabContents .tabItem");
          $(tabContent).removeClass("active");
          $(tabContent).eq(indexNum).addClass("active");
        });
      });
    });

    // Function to filter items
    function applyFilter(filterItem) {
      var filter = filterItem.data("filter");
      $(".filter-list .filter-links").removeClass("active");
      filterItem.find(".filter-links").addClass("active");
      var singleFilter = filterItem.closest(".singleFilter");
      var tabItem = singleFilter.find(".filterItems");
      var filterTags = filter.split(" ");
      tabItem.find("> div").removeClass("active");
      if (filter === "*") {
        tabItem.find("> div").addClass("active");
      } else {
        tabItem.find("> div").each(function () {
          var itemTags = $(this).data("tag").split(" ");
          for (var i = 0; i < filterTags.length; i++) {
            if (itemTags.includes(filterTags[i])) {
              $(this).addClass("active");
              break;
            }
          }
        });
      }
    }
    $(".filter-item.active").each(function () {
      applyFilter($(this));
    });
    $(".filter-list li").each(function (index) {
      $(this).on("click", function () {
        applyFilter($(this));
      });
    });

    // tabLinks add active
    $(".tabLinks .nav-links").on("mouseenter", function () {
      $(this).addClass("active");
      $(".tabLinks .nav-links").not(this).removeClass("active");
    });

    // progress-area
    let progressBars = $(".progress-area");
    let observer = new IntersectionObserver(function (progressBars) {
      progressBars.forEach(function (entry, index) {
        if (entry.isIntersecting) {
          let width = $(entry.target)
            .find(".progress-bar")
            .attr("aria-valuenow");
          let count = 0;
          let time = 1000 / width;
          let progressValue = $(entry.target).find(".progress-value");
          setInterval(() => {
            if (count == width) {
              clearInterval();
            } else {
              count += 1;
              $(progressValue).text(count + "%");
            }
          }, time);
          $(entry.target)
            .find(".progress-bar")
            .css({ width: width + "%", transition: "width 1s linear" });
        } else {
          $(entry.target)
            .find(".progress-bar")
            .css({ width: "0%", transition: "width 1s linear" });
        }
      });
    });
    progressBars.each(function () {
      observer.observe(this);
    });
    $(window).on("unload", function () {
      observer.disconnect();
    });

    // custom Accordion
    $(".accordion-single .header-area").on("click", function () {
      if ($(this).closest(".accordion-single").hasClass("active")) {
        $(this).closest(".accordion-single").removeClass("active");
        $(this).next(".content-area").slideUp();
      } else {
        $(".accordion-single").removeClass("active");
        $(this).closest(".accordion-single").addClass("active");
        $(".content-area").not($(this).next(".content-area")).slideUp();
        $(this).next(".content-area").slideToggle();
      }
    });

    $(".text-limit").each(function () {
      var textContainer = $(this);
      var maxLength = parseInt(textContainer.attr("text-limit"));
      var text = textContainer.text();
      if (text.length > maxLength) {
        var truncatedText = text.substring(0, maxLength);
        var fullText = text;
        textContainer.empty();
        var textSpan = $(
          '<span class="text-content" style="color: inherit; font-family: inherit; font-size: inherit; font-weight: inherit;"></span>'
        );
        textContainer.append(textSpan);
        textSpan.text(truncatedText);
        var readMoreButton = $(
          '<span class="read-more-button ms-1" style="color: inherit; font-family: inherit; font-size: inherit; font-weight: inherit;">...</span>'
        );
        textContainer.append(readMoreButton);

        textSpan.on("mouseenter", function () {
          textSpan.text(fullText);
          readMoreButton.hide();
        });
        textSpan.on("mouseleave", function () {
          textSpan.text(truncatedText);
          readMoreButton.show();
        });
      }
    });

    // Dropdown Active Remove
    $("section, .close-btn").on("click", function () {
      $(".single-item").removeClass("active");
    });
  });
});
