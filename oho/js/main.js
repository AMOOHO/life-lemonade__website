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

    const twistedLines = document.querySelectorAll("header.__home .twisted-line");

    twistedLines.forEach((line) => {
      const path = line.querySelector("path");
      const pathLength = path.getTotalLength();

      path.style.strokeDasharray = pathLength;
      path.style.strokeDashoffset = pathLength;

      let drawStart;
      if (line.classList.contains("twisted-line--2")) {
        drawStart = "top top";
      } else if (line.classList.contains("twisted-line--1")) {
        drawStart = "top -55%";
      }

      // ScrollTrigger-Timeline erstellen, aber pausieren
      const scrollTl = gsap.timeline({
        scrollTrigger: {
          trigger: line,
          start: drawStart,
          end: "bottom bottom",
          scrub: 2,
          // markers: true,
        },
        paused: true,
      });

      scrollTl.fromTo(
        path,
        { strokeDashoffset: pathLength * 0.55 },
        { strokeDashoffset: 0, ease: "none" }
      );

      // 👉 Intro-Animation
      gsap.fromTo(
        path,
        { strokeDashoffset: pathLength },
        {
          strokeDashoffset: pathLength * 0.55,
          duration: 1.2,
          ease: "power2.out",
          onStart: () => (line.style.visibility = "visible"),
          onComplete: () => scrollTl.scrollTrigger.enable(), // ScrollTrigger erst dann aktivieren
        }
      );

      // ScrollTrigger anfangs deaktivieren, bis die Intro fertig ist
      scrollTl.scrollTrigger.disable();
    });
  }, // end home scripts

  contact: function () {
    // contact scripts here
  }, // end contact scripts

  default: function () {
    // ----------------------------
    // MARQUEES
    // ----------------------------

    const marqueeSections = document.querySelectorAll("section.__marquees");
    if (marqueeSections.length > 0) {
      /* --- Media Queries --- */

      let mm = gsap.matchMedia();

      mm.add(
        {
          xl: "(min-width: 1281px)",
          lg: "(max-width: 1280px) and (min-width: 881px)",
          md: "(max-width: 880px) and (min-width: 577px)",
          sm: "(max-width: 576px) and (min-width: 433px)",
          xs: "(max-width: 432px)",
        },
        (context) => {
          let { xl, lg, md, sm, xs } = context.conditions;

          // define xPercent values depending on breakpoint
          let x1, x2;

          if (xl) {
            x1 = 15;
            x2 = -15;
          } else if (lg) {
            x1 = 20;
            x2 = -20;
          } else if (md) {
            x1 = 90;
            x2 = -60;
          } else if (sm) {
            x1 = 30;
            x2 = -30;
          } else if (xs) {
            x1 = 40;
            x2 = -40;
          }

          marqueeSections.forEach((marqueeSection) => {
            const marqueeWrap1 = marqueeSection.querySelector(".marquee-wrap--1");
            const marqueeWrap2 = marqueeSection.querySelector(".marquee-wrap--2");

            // kill old ScrollTriggers if re-inited
            gsap.killTweensOf([marqueeWrap1, marqueeWrap2]);
            ScrollTrigger.getAll().forEach((st) => st.kill(false, true));

            // create new timeline with breakpoint-specific xPercent
            gsap
              .timeline({
                scrollTrigger: {
                  trigger: marqueeSection,
                  start: "top bottom",
                  scrub: 2.5,
                },
              })
              .from(
                marqueeWrap1,
                {
                  xPercent: x1,
                  ease: "none",
                },
                "<"
              )
              .from(
                marqueeWrap2,
                {
                  xPercent: x2,
                  ease: "none",
                },
                "<"
              );
          });
        }
      );
    }

    // ----------------------------
    // SLANTED IMAGES switch ANIMATION
    // ----------------------------

    const slantedImageSwitches = document.querySelectorAll("[data-anim='slanted-images-switch']");

    slantedImageSwitches.forEach((switchWrap) => {
      let isSwitched = false; // Zustand merken: welches Bild ist oben

      const slantedImage1 = switchWrap.querySelector(".slanted-image--1");
      const slantedImage2 = switchWrap.querySelector(".slanted-image--2");

      const createTimeline = (forward = true) => {
        const tl = gsap.timeline({ paused: true });
        if (forward) {
          tl.to(slantedImage1, { zIndex: 0, duration: 0 })
            .to(slantedImage2, { zIndex: 1, duration: 0 }, "<")
            .to(slantedImage1, { rotation: 14, scale: 1, duration: 0.75, ease: "power4.out" }, "<")
            .to(slantedImage2, { scale: 0.9, duration: 0, ease: "power4.out" }, "<")
            .to(slantedImage2, { scale: 1, duration: 0.75, ease: "power4.out" }, "<0.01")
            .to(slantedImage2, { rotation: 7, duration: 0.75, ease: "power4.out" }, "<");
        } else {
          tl.to(slantedImage2, { zIndex: 0, duration: 0 })
            .to(slantedImage1, { zIndex: 1, duration: 0 }, "<")
            .to(slantedImage2, { rotation: 14, scale: 1, duration: 0.75, ease: "power4.out" }, "<")
            .to(slantedImage1, { scale: 0.9, duration: 0, ease: "power4.out" }, "<")
            .to(slantedImage1, { scale: 1, duration: 0.75, ease: "power4.out" }, "<0.01")
            .to(slantedImage1, { rotation: 7, duration: 0.75, ease: "power4.out" }, "<");
        }
        return tl;
      };

      // Erstes Timeline-Setup
      let slantedImageTimeline = createTimeline(true);

      switchWrap.addEventListener("mouseenter", () => {
        if (slantedImageTimeline.isActive()) return; // Verhindern, dass Animation doppelt startet

        slantedImageTimeline.play().then(() => {
          // Nach Animation umschalten
          isSwitched = !isSwitched;
          slantedImageTimeline = createTimeline(!isSwitched);
        });
      });
    });

    // ----------------------------
    // ANGEBOT TEASER ANIMATION
    // ----------------------------

    const angebotTeasers = document.querySelectorAll("[data-anim='angebot-teasers-move-up']");
    if (angebotTeasers.length > 0) {
      angebotTeasers.forEach((teasersBlock) => {
        const teaserItems = teasersBlock.querySelectorAll(".angebot-item");

        gsap.fromTo(
          teaserItems,
          { y: 50 },
          {
            y: 0,
            duration: 1,
            stagger: 0.075,
            ease: "power4.out",
            scrollTrigger: {
              trigger: teasersBlock,
              start: "top 80%",
              // markers: true,
            },
          }
        );
      });
    }

    // ----------------------------
    // TWISTED LINE ANIMATION
    // ----------------------------

    // Draw on scroll

    const twistedLines = document.querySelectorAll(".twisted-line.anim__draw--onscroll");
    twistedLines.forEach((line) => {
      const path = line.querySelector("path");
      const pathLength = path.getTotalLength();
      path.style.strokeDasharray = pathLength;
      path.style.strokeDashoffset = pathLength;

      let drawStart = "top 25%"; // default start

      const tl = gsap
        .timeline({
          scrollTrigger: {
            trigger: line,
            start: drawStart,
            end: "bottom bottom",
            scrub: 2,
            // markers: true,
          },
        })
        .to(line, { visibility: "visible", duration: 0 }) // make visible when animation starts
        .to(
          path,
          {
            strokeDashoffset: 0,
            ease: "none",
          },
          "<"
        );
    });

    // Draw on load

    const twistedLinesOnLoad = document.querySelectorAll(".twisted-line.anim__draw--onload");
    twistedLinesOnLoad.forEach((line) => {
      const path = line.querySelector("path");
      const pathLength = path.getTotalLength();
      path.style.strokeDasharray = pathLength;
      path.style.strokeDashoffset = pathLength;
      gsap.to(path, {
        strokeDashoffset: 0,
        ease: "power1.inOut",
        duration: 2,
        delay: 0,
      });
    });

    // ----------------------------
    // NAVIGATION
    // ----------------------------

    /* ***** Desktop Navigation */
    const desktopNav = document.getElementById("nav--desktop");
    if (desktopNav) {
      /* --- Navbar onScroll (Home) */

      if (document.body.classList.contains("home")) {
        const navWrap = desktopNav.querySelector(".nav-wrap");

        gsap
          .timeline({
            scrollTrigger: {
              trigger: document.body,
              start: "top+=1% top",
              end: 99999,
              toggleClass: { targets: navWrap, className: "nav--scrolled" },
              toggleActions: "play none none reverse",
              // markers: true,
            },
          })
          .to(navWrap, {
            yPercent: 100,
            duration: 0.75,
            ease: "power4.out",
          });
      }
    }

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
