/* **********************************************************************************************************************
 * MAIN.JS
 *
 * Central entry point for site scripts.
 * Initializes:
 *   - Global utilities (viewport, pointer detection, browser detection, etc.)
 *   - Page-specific scripts (home, contact, default)
 *   - Third-party integrations (GSAP, Lenis, etc.)
 *
 * Dependencies:
 *   - GSAP + plugins (ScrollTrigger, ScrollSmoother, CustomEase, SplitText)
 *   - Lenis smooth scrolling
 *
 * Copyright (c) 2025 OHO Design GmbH. All rights reserved.
 * Unauthorized copying, distribution, or use of this file is strictly prohibited.
 *
 * Author: OHO Design GmbH
 * Date: 2025-01-01
 **********************************************************************************************************************/

const scripts = {
  init: function () {
    this.global();
    this.default();

    const bodyClass = document.body.classList;
    if (bodyClass.contains("home")) this.home();
    else if (bodyClass.contains("contact")) this.contact();
  },

  global: function () {
    initPointerDetection();
    initBrowserDetection();
    initViewportHeight();
    initGSAP();
    initLenis();
    initMailSpamProtection();
    initExternalLinksInNewTab();
    initPhoneNumbersUnbreakable();
    initMobileMailtoShorthand();
    initScrollToAnchorLink();
    initAjaxFormHandling();
    initAccordions();
  }, // end global scripts

  home: function () {
    // home scripts here
  }, // end home scripts

  contact: function () {
    // contact scripts here
  }, // end contact scripts

  default: function () {
    // ----------------------------
    // NAVIGATION
    // ----------------------------

    /* ***** Mobile Navigation */
    const mobileNav = document.getElementById("nav--mobile");
    if (mobileNav) {
      const navTrigger = document.getElementById("nav-trigger");
      const navPoints = gsap.utils.toArray("#nav--mobile li");
      let navIsOpen = false;

      const burgerPattyTop = navTrigger.querySelector("span:nth-child(1)");
      const burgerPattyBottom = navTrigger.querySelector("span:nth-child(2)");

      gsap.set(burgerPattyTop, { y: -5 });
      gsap.set(burgerPattyBottom, { y: 5 });

      /* --- Animation Timelines */

      const openNavTL = gsap.timeline({ paused: true });
      openNavTL
        .to("#nav-trigger span:nth-child(1)", {
          duration: 0.2,
          rotate: 45,
          transformOrigin: "50% 50%",
          y: 0,
          ease: "power4.inOut",
        })
        .to(
          "#nav-trigger span:nth-child(2)",
          { duration: 0.2, rotate: -45, transformOrigin: "50% 50%", y: 0, ease: "power4.inOut" },
          "<"
        )
        .fromTo(
          "#nav--mobile .nav-wrap",
          { height: "6rem" },
          {
            duration: 0.5,
            height: "calc(var(--vh, 1vh) * 100)",
            ease: "power1.inOut",
          },
          "<"
        )
        .from(
          navPoints,
          { duration: 0.75, autoAlpha: 0, y: 25, ease: "power4.inOut", stagger: 0.1 },
          "<"
        );

      /* --- Functions */

      /* Open Navigation */

      const openNav = () => {
        openNavTL.play();
        navIsOpen = true;
      };

      /* Close Navigation */

      const closeNav = () => {
        openNavTL.reverse(0.5);
        navIsOpen = false;
      };

      /* Force close Navigation */

      const resetNav = () => {
        openNavTL.pause(0, true);
        navIsOpen = false;
      };

      /* --- Event Listeners */

      navTrigger.addEventListener("click", () => {
        if (navIsOpen) {
          closeNav();
        } else {
          openNav();
        }
      });

      window.addEventListener("pageshow", (event) => {
        if (event.persisted && navIsOpen) {
          // page was restored from bfcache and the nav is still open
          // this case is typical when swiping to the previous page on mobile devices
          // we need to reset the nav in that case so users really see the previous page
          resetNav();
        }
      });
    }
  },
}; // end base script const
scripts.init(); // fire scripts on page load
