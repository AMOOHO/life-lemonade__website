/* **********************************************************************************************************************
 * BARBA.JS
 *
 * Handles page transitions using Barba.js.
 *
 * Responsibilities:
 *   - Smooth page transitions and lifecycle hooks
 *   - Executes code after each page load (afterEnter / afterLeave)
 *   - Handles cookie banner interactions within transitions
 *   - Initializes blocker buttons and related click events
 *
 * Dependencies:
 *   - Barba.js
 *   - Optional: Cookie management model (cookieBannerModel)
 *
 * Copyright (c) 2025 OHO Design GmbH. All rights reserved.
 * Unauthorized copying, distribution, or use of this file is strictly prohibited.
 *
 * Author: OHO Design GmbH
 * Date: 2025-01-01
 **********************************************************************************************************************/

barba.hooks.after(() => {
  // global barba hook (in this case to push ga data), can be placed everywhere, also in other scopes
});

// for the lifecycle take a look at https://barba.js.org/docs/getstarted/lifecycle/

barba.init({
  debug: true, // helpful debug tool
  timeout: 6000,
  sync: false,
  transitions: [
    {
      name: "general-transition",
      once(data) {
        // do something once on the initial page load
        window.scrollTo({ top: 0 });
        scripts.init(); // fire object based script for the first time
      },
      beforeLeave(data) {
        ScrollTrigger.getAll().forEach((st) => st.kill());

        // gsap.to("#content-spacing", {
        //   // gsap smooth (go out) animation
        //   opacity: 0,
        //   duration: 2,
        //   ease: "power1.in",
        // });
      },
      leave(data) {
        /* */
      },
      beforeEnter(data) {
        // in this case refresh scroll trigger
        setTimeout(function () {
          // ACHTUNG: ScrollTrigger.refresh() muss je nach Timing noch mit einem Timeout gesetzt werden, um zu funktionieren
          lenis.resize(); // refresh lenis scroll height
          lenis.scrollTo(0, { immediate: true }); // go to top of the page with lenis
        }, 50);
        // fire misc global functions here
      },
      afterEnter(data) {
        // // gsap smooth (go out) animation
        // gsap.fromTo(
        //   "#content-spacing",
        //   {
        //     opacity: 0,
        //   },
        //   {
        //     opacity: 1,
        //     duration: 1,
        //     ease: "power4.out",
        //   }
        // );
      },
      after(data) {
        ScrollTrigger.refresh(); // refresh scroll height for gsap scrollSmoother
        refreshLenis(); // refresh lenis scroll height
        // Highlight the current page in the navigation
        const currentPageUrl = window.location.pathname.replace(/\/$/, ""); // Remove trailing slash if present
        const navListLinks = document.querySelectorAll("#nav li a");
        navListLinks.forEach((navListLink) => {
          const navLinkHref = navListLink.getAttribute("href").replace(/\/$/, ""); // Remove trailing slash if present
          if (navLinkHref === currentPageUrl) {
            navListLink.classList.add("actual-site");
          } else {
            navListLink.classList.remove("actual-site");
          }
        });

        // add wordpress generated classes to body!
        // elements like title, seo stuff will be managed by the library directly
        let parser = new DOMParser();
        let htmlDoc = parser.parseFromString(
          data.next.html.replace(/(<\/?)body( .+?)?>/gi, "$1notbody$2>", data.next.html),
          "text/html"
        );
        let bodyClasses = htmlDoc.querySelector("notbody").getAttribute("class");
        document.body.setAttribute("class", bodyClasses);
        scripts.init(); // fire object based script again on page transition
        // close nav if you navigate from opened nav (example)
        if (mobileNav.classList.contains("open")) {
          openNavTL.reverse(0.01);
          navIsOpen = false;
          mobileNav.classList.remove("open");
        }

        // Reinitialize Videos
        initVimeoVideos();

        // Reinitialize the filtering engine
        initFmaFilter();

        // Google Stuff
        if (typeof gtag === "function") {
          gtag("set", "page", window.location.pathname);
          gtag("send", "pageview");
        }

        // Cookie stuff
        const adjustCookieSettings = () => {
          const cookieBannerLightbox = document.getElementById("cookie-banner__lightbox");
          const cookieBanner = document.getElementById("advanced-cookie-banner");
          const closer = document.querySelector("#advanced-cookie-banner .closer");
          cookieBanner.classList.remove("closed");
          cookieBannerLightbox.classList.add("active");
          cookieBanner.classList.add("extended");
          closer.classList.add("active");
        };
        const adjustCookieSettingsBtns = document.querySelectorAll(".adjustCookieSettingsBtn");
        if (typeof adjustCookieSettingsBtns != "undefined" && adjustCookieSettingsBtns != null) {
          adjustCookieSettingsBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
              adjustCookieSettings();
            });
          });
        }
      },
    },
  ],
});
