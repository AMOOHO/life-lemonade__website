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

    // ----------------------------
    // TWISTED LINES ANIMATION
    // ----------------------------

    const initTwistedLine = () => {
      const twistedLine2 = document.querySelector("header.__home .twisted-line--2");
      const path = twistedLine2.querySelector("path");
      const pathLength = path.getTotalLength();
      path.style.strokeDasharray = pathLength;
      path.style.strokeDashoffset = pathLength;

      // ScrollTrigger-Timeline erstellen, aber pausieren
      const scrollTl = gsap.timeline({
        scrollTrigger: {
          trigger: twistedLine2,
          start: "top top",
          end: "bottom bottom",
          scrub: 2,
          // markers: true,
        },
        paused: true,
      });

      scrollTl.fromTo(
        path,
        { strokeDashoffset: pathLength * 0.27 },
        { strokeDashoffset: 0, ease: "none" }
      );

      // 👉 Intro-Animation
      gsap.fromTo(
        path,
        { strokeDashoffset: pathLength },
        {
          strokeDashoffset: pathLength * 0.27,
          duration: 0.001,
          ease: "power2.out",
          onStart: () => (twistedLine2.style.visibility = "visible"),
          onComplete: () => scrollTl.scrollTrigger.enable(), // ScrollTrigger erst dann aktivieren
        }
      );

      // ScrollTrigger anfangs deaktivieren, bis die Intro fertig ist
      scrollTl.scrollTrigger.disable();
    };

    initTwistedLine();

    // const initTwistedLines = () => {
    //   const twistedLines = document.querySelectorAll("header.__home .twisted-line");

    //   twistedLines.forEach((line) => {
    //     const path = line.querySelector("path");
    //     const pathLength = path.getTotalLength();

    //     path.style.strokeDasharray = pathLength;
    //     path.style.strokeDashoffset = pathLength;

    //     let drawStart;
    //     if (line.classList.contains("twisted-line--2")) {
    //       drawStart = "top top";
    //     } else if (line.classList.contains("twisted-line--1")) {
    //       drawStart = "top -55%";
    //     }

    //     // ScrollTrigger-Timeline erstellen, aber pausieren
    //     const scrollTl = gsap.timeline({
    //       scrollTrigger: {
    //         trigger: line,
    //         start: drawStart,
    //         end: "bottom bottom",
    //         scrub: 2,
    //         // markers: true,
    //       },
    //       paused: true,
    //     });

    //     scrollTl.fromTo(
    //       path,
    //       { strokeDashoffset: pathLength * 0.55 },
    //       { strokeDashoffset: 0, ease: "none" }
    //     );

    //     // 👉 Intro-Animation
    //     gsap.fromTo(
    //       path,
    //       { strokeDashoffset: pathLength },
    //       {
    //         strokeDashoffset: pathLength * 0.55,
    //         duration: 1.2,
    //         ease: "power2.out",
    //         onStart: () => (line.style.visibility = "visible"),
    //         onComplete: () => scrollTl.scrollTrigger.enable(), // ScrollTrigger erst dann aktivieren
    //       }
    //     );

    //     // ScrollTrigger anfangs deaktivieren, bis die Intro fertig ist
    //     scrollTl.scrollTrigger.disable();
    //   });
    // };
    // initTwistedLines();

    // ----------------------------
    // LAB LOGO ANIMATION
    // ----------------------------

    const initLabLogoAnimation = () => {
      const labLogo = document.querySelector("svg.lab-logo");
      const lettersGroup = labLogo.querySelector("g.letters");

      gsap.set(lettersGroup, { transformOrigin: "50% 50%" });
      gsap.to(lettersGroup, {
        rotation: 360,
        duration: 30,
        ease: "linear",
        repeat: -1,
      });
    };
    initLabLogoAnimation();
  }, // end home scripts

  contact: function () {
    // contact scripts here
  }, // end contact scripts

  default: function () {
    // ----------------------------
    // CUSTOM CURSOR (CC)
    // ----------------------------

    const cc = document.getElementById("cc");

    if (cc) {
      // add cc--hoverscale to selected elements that should scale the cursor on hover

      const hoverScaleElements = document.querySelectorAll("a, input, textarea");
      hoverScaleElements.forEach((el) => {
        if (!el.classList.contains("cc--hoverscale")) {
          el.classList.add("cc--hoverscale");
        }
      });

      let ccVisible = false;
      let mouseX = 0;
      let mouseY = 0;

      // Cursor Functions

      const showCC = () => {
        if (!ccVisible) {
          gsap.set(cc, { autoAlpha: 1 });
          ccVisible = true;
        }
      };

      const hideCC = () => {
        if (ccVisible) {
          gsap.set(cc, { autoAlpha: 0 });
          ccVisible = false;
        }
      };

      const destroyCC = () => {
        cc.remove();
      };

      // Cursor-Position bei Mausbewegung aktualisieren
      document.addEventListener("mousemove", (e) => {
        showCC();
        mouseX = e.clientX;
        mouseY = e.clientY;

        gsap.to(cc, {
          x: mouseX,
          y: mouseY,
          duration: 0,
          ease: "power2.out",
        });
      });

      // Hide cursor on Touch Only devices
      if (ScrollTrigger.isTouch === 1) {
        // console.log("Touch Only");
        hideCC();
        destroyCC();
      }

      // Touch and Mouse Devices
      if (ScrollTrigger.isTouch === 2) {
        // console.log("Touch and Mouse");
        // Detect touch events to hide the custom cursor
        document.addEventListener("touchstart", hideCC);
      }

      // Apply hover effects to interactive elements
      const applyHoverEffects = (cursorElement) => {
        document.querySelectorAll(".cc--hoverscale").forEach((item) => {
          let scaleFactor = 0.5;
          if (item.classList.contains("cc--hoverscale_xl")) {
            scaleFactor = 1;
          }
          item.addEventListener("mouseenter", () => {
            gsap.to(cursorElement, {
              scale: scaleFactor,
              duration: 0.25,
              ease: "power2.out",
            });
          });
          item.addEventListener("mouseleave", () => {
            gsap.to(cursorElement, {
              scale: 0.2,
              duration: 0.25,
              ease: "power2.out",
            });
          });
        });
      };

      applyHoverEffects(cc);

      // Create and manage a single instance of the custom cursor
      const createCCInstance = (container) => {
        // Remove any existing instances of custom cursors
        document.querySelectorAll(".cc-instance").forEach((cursor) => cursor.remove());

        // Create a new instance of the cursor
        const newCC = cc.cloneNode(true);
        newCC.classList.add("cc-instance");
        newCC.style.backgroundColor = "#cce3d1";

        // special color case for nav-wrap on body--accent pages
        // if (body.classList.contains("body--accent") && container.classList.contains("nav-wrap")) {
        //   newCC.style.backgroundColor = "#8ed6eb";

        //   if (container.classList.contains("scrolled")) {
        //     newCC.style.backgroundColor = "#c2decb";
        //   }
        // }

        // if (container.classList.contains("cc-container--footer")) {
        //   newCC.style.backgroundColor = "#60cd94";
        // }
        // if (container.classList.contains("__marquees")) {
        //   newCC.style.backgroundColor = "#60cd94";
        // }

        container.prepend(newCC);

        // Make the new cursor follow the mouse movement within the container
        const updateCursorPosition = (e) => {
          let mouseX = e.clientX + window.scrollX; // Include global scroll offset
          let mouseY = e.clientY + window.scrollY; // Include global scroll offset

          if (container.classList.contains("nav-wrap")) {
            const containerRect = container.getBoundingClientRect();
            // Position relative to the container
            mouseX = e.clientX - containerRect.left;
            mouseY = e.clientY - containerRect.top;

            // Set cursor to fixed for nav-wrap
            newCC.style.position = "fixed";
          } else {
            // Set cursor to absolute for smooth-scroll containers
            newCC.style.position = "absolute";

            // Adjust for container's position relative to the document
            const containerRect = container.getBoundingClientRect();
            mouseX = e.clientX - containerRect.left + container.scrollLeft;
            mouseY = e.clientY - containerRect.top + container.scrollTop;
          }

          // Use GSAP to animate the cursor's movement smoothly
          gsap.to(newCC, {
            x: mouseX,
            y: mouseY,
            duration: 0,
            ease: "power2.out",
          });
        };

        container.addEventListener("mousemove", updateCursorPosition);

        // Handle scroll events to update cursor position when scrolling
        const handleScroll = () => {
          updateCursorPosition({ clientX: mouseX, clientY: mouseY });
        };

        window.addEventListener("scroll", handleScroll);

        // Clean up the event listener when the cursor instance is removed
        newCC.addEventListener("remove", () => {
          container.removeEventListener("mousemove", updateCursorPosition);
          window.removeEventListener("scroll", handleScroll);
        });

        // Apply hover effects to the new cursor instance
        applyHoverEffects(newCC);

        return newCC;
      };

      // General function to manage custom cursor instances
      const manageCursorInstance = (element) => {
        element.addEventListener("mouseenter", () => {
          const newCC = createCCInstance(element);
          showCC(newCC); // Show the new cursor instance
          hideCC(); // Hide the master cursor
        });

        element.addEventListener("mouseleave", () => {
          // Remove all cursor instances
          document.querySelectorAll(".cc-instance").forEach((cursor) => {
            cursor.dispatchEvent(new Event("remove")); // Trigger cleanup
            cursor.remove();
          });
          showCC(); // Make the master cursor visible again
        });
      };

      // Elements that need a cursor instance
      const interactiveElements = [
        // ".footer-wrap__inner > .flex-wrap",
        // "#nav--desktop .nav-wrap__inner > .flex-wrap",
        // ".post-item > a > .flex-wrap",
        // "section.__marquees",
      ];
      interactiveElements.forEach((selector) => {
        const elements = document.querySelectorAll(selector);
        elements.forEach((element) => {
          if (element) {
            manageCursorInstance(element);
          }
        });
      });
    }

    // ----------------------------
    // MARQUEES
    // ----------------------------

    const marqueeSections = document.querySelectorAll("section.__marquees");
    if (marqueeSections.length > 0) {
      marqueeSections.forEach((section) => {
        section.querySelectorAll(".marquee-track").forEach((track) => {
          track.innerHTML += track.innerHTML;
        });
      });
    }

    // const marqueeSections = document.querySelectorAll("section.__marquees");
    // if (marqueeSections.length > 0) {
    //   /* --- Media Queries --- */

    //   let mm = gsap.matchMedia();

    //   mm.add(
    //     {
    //       xl: "(min-width: 1281px)",
    //       lg: "(max-width: 1280px) and (min-width: 881px)",
    //       md: "(max-width: 880px) and (min-width: 577px)",
    //       sm: "(max-width: 576px) and (min-width: 433px)",
    //       xs: "(max-width: 432px)",
    //     },
    //     (context) => {
    //       let { xl, lg, md, sm, xs } = context.conditions;

    //       // define xPercent values depending on breakpoint
    //       let x1, x2;

    //       if (xl) {
    //         x1 = 15;
    //         x2 = -15;
    //       } else if (lg) {
    //         x1 = 20;
    //         x2 = -20;
    //       } else if (md) {
    //         x1 = 90;
    //         x2 = -60;
    //       } else if (sm) {
    //         x1 = 30;
    //         x2 = -30;
    //       } else if (xs) {
    //         x1 = 40;
    //         x2 = -40;
    //       }

    //       marqueeSections.forEach((marqueeSection) => {
    //         const marqueeWrap1 = marqueeSection.querySelector(".marquee-wrap--1");
    //         const marqueeWrap2 = marqueeSection.querySelector(".marquee-wrap--2");

    //         // kill old ScrollTriggers if re-inited
    //         gsap.killTweensOf([marqueeWrap1, marqueeWrap2]);
    //         ScrollTrigger.getAll().forEach((st) => st.kill(false, true));

    //         // create new timeline with breakpoint-specific xPercent
    //         gsap
    //           .timeline({
    //             scrollTrigger: {
    //               trigger: marqueeSection,
    //               start: "top bottom",
    //               scrub: 2.5,
    //             },
    //           })
    //           .from(
    //             marqueeWrap1,
    //             {
    //               xPercent: x1,
    //               ease: "none",
    //             },
    //             "<"
    //           )
    //           .from(
    //             marqueeWrap2,
    //             {
    //               xPercent: x2,
    //               ease: "none",
    //             },
    //             "<"
    //           );
    //       });
    //     }
    //   );
    // }

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
            .to(slantedImage1, { rotation: 7, scale: 1, duration: 0.75, ease: "power4.out" }, "<")
            .to(slantedImage2, { rotation: 15, duration: 0, ease: "power4.out" }, "<")
            .to(slantedImage2, { scale: 0.9, duration: 0, ease: "power4.out" }, "<")
            .to(slantedImage2, { scale: 1, duration: 0.75, ease: "power4.out" }, "<0.01")
            .to(slantedImage2, { rotation: 7, duration: 0.75, ease: "power4.out" }, "<");
        } else {
          tl.to(slantedImage2, { zIndex: 0, duration: 0 })
            .to(slantedImage1, { zIndex: 1, duration: 0 }, "<")
            .to(slantedImage2, { rotation: 7, scale: 1, duration: 0.75, ease: "power4.out" }, "<")
            .to(slantedImage1, { rotation: 15, duration: 0, ease: "power4.out" }, "<")
            .to(slantedImage1, { scale: 0.9, duration: 0, ease: "power4.out" }, "<")
            .to(slantedImage1, { scale: 1, duration: 0.75, ease: "power4.out" }, "<0.01")
            .to(slantedImage1, { rotation: 7, duration: 0.75, ease: "power4.out" }, "<");
        }
        return tl;
      };

      // Erstes Timeline-Setup
      let slantedImageTimeline = createTimeline(true);

      switchWrap.addEventListener("click", () => {
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
          { y: 100 },
          {
            y: 0,
            duration: 1.5,
            stagger: 0.075,
            ease: "power4.out",
            scrollTrigger: {
              trigger: teasersBlock,
              start: "top 70%",
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
          .to(navWrap, { visibility: "visible", duration: 0 })
          .from(navWrap, {
            yPercent: -100,
            duration: 0.75,
            ease: "power4.out",
          });

        window.addEventListener("resize", () => {
          ScrollTrigger.refresh();
        });
      }
    }

    /* ***** Mobile Navigation */
    const mobileNav = document.getElementById("nav--mobile");
    if (mobileNav) {
      const navTrigger = document.getElementById("nav-trigger");
      const navTriggerMenuLabel = navTrigger.querySelector(".menu-label");
      const navTriggerClose = navTrigger.querySelector(".icon-cross");
      const navPoints = gsap.utils.toArray("li", mobileNav);
      const menu = mobileNav.querySelector(".menu");
      const menuBg = mobileNav.querySelector(".menu__bg");
      const menuCard = mobileNav.querySelector(".menu-card");
      const menuCardClose = menuCard.querySelector(".close");

      let navIsOpen = false;

      /* --- Animation Timelines */

      const openNavTL = gsap
        .timeline({ paused: true })
        .to(menu, { visibility: "visible", pointerEvents: "auto", duration: 0 })
        .to(menuCard, { visibility: "visible", duration: 0 })
        .to(navTriggerClose, { visibility: "visible", scale: 0, duration: 0 }, "<")
        .to(navTriggerClose, { scale: 1, duration: 0.25, ease: "power4.out" }, "<")
        .to(menuBg, { opacity: 1, duration: 0.5, ease: "power4.out" }, "<")
        .from(menuCard, { yPercent: 100, rotation: -20, duration: 0.75, ease: "power4.out" }, "<");

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

      menuCardClose.addEventListener("click", () => {
        if (navIsOpen) {
          closeNav();
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
