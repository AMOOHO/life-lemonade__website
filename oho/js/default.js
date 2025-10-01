/* **********************************************************************************************************************
 * DEFAULT.JS
 *
 * Contains default and fallback scripts for pages without specific handlers.
 * Initializes:
 *   - Page-agnostic utilities and interactions
 *   - Global UI components (accordions, mailto links, external links, etc.)
 *   - Event listeners and smooth scroll integrations
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

// ----------------------------
//  Pointer Detection
// ----------------------------

const initPointerDetection = () => {
  // Determine the current pointer type
  const getPointerType = () => {
    const hasCoarse = matchMedia("(any-pointer: coarse)").matches;
    const hasFine = matchMedia("(any-pointer: fine)").matches;

    if (hasCoarse && hasFine) return "touchAndMouse"; // Hybrid device 🖱️📱
    if (hasCoarse && !hasFine) return "touchOnly"; // Touch only 📱
    if (!hasCoarse && hasFine) return "mouseOnly"; // Mouse only 🖱️
    return "unknown"; // Unknown ❓
  };

  // Global boolean helper functions
  window.isTouchEnabled = () => pointerType === "touchOnly" || pointerType === "touchAndMouse"; // 📱
  window.isTouchOnly = () => pointerType === "touchOnly"; // 📱
  window.isTouchAndMouse = () => pointerType === "touchAndMouse"; // 🖱️📱
  window.isMouseOnly = () => pointerType === "mouseOnly"; // 🖱️

  // Dynamic update on pointer changes
  const coarseMQ = matchMedia("(any-pointer: coarse)");
  const fineMQ = matchMedia("(any-pointer: fine)");

  const updatePointerType = () => {
    const oldType = window._lastPointerType || null;
    const newType = getPointerType();

    if (newType !== oldType) {
      window._lastPointerType = newType; // Store internally
      // console.log("Pointer type changed:", newType);

      // Dispatch a custom event globally for other modules
      const event = new CustomEvent("pointerTypeChange", { detail: newType });
      document.dispatchEvent(event);

      // Example usage:
      // document.addEventListener("pointerTypeChange", (e) => {
      //   console.log("New pointer type:", e.detail);
      // });
    }
  };

  // Listen for pointer changes dynamically
  coarseMQ.addEventListener("change", updatePointerType);
  fineMQ.addEventListener("change", updatePointerType);

  // Initial detection
  updatePointerType();
};

window.initPointerDetection = initPointerDetection;

// ----------------------------
// Browser, OS & Device Detection
// ----------------------------

/**
 * Detects the browser, operating system, and device type
 * Adds corresponding classes to the <body> element
 */
const initBrowserDetection = () => {
  const ua = navigator.userAgent;

  // --- 1. Detect Browser ---
  const getBrowserName = () => {
    const prefix = "browser-";
    switch (true) {
      case ua.includes("Trident/7.0"):
        return prefix + "ie";
      case ua.includes("Edge"):
        return prefix + "edge_ms";
      case ua.includes("Edg"):
        return prefix + "edge_chromium";
      case ua.includes("Opera") || ua.includes("OPR"):
        return prefix + "opera";
      case ua.includes("Netscape"):
        return prefix + "netscape";
      case ua.includes("iTunes"):
        return prefix + "itunes";
      case ua.includes("Iceweasel"):
        return prefix + "iceweasel";
      case ua.includes("Midori"):
        return prefix + "midori";
      case ua.includes("UCBrowser"):
        return prefix + "ucbrowser";
      case ua.includes("Kindle"):
        return prefix + "kindle";
      case ua.includes("Firefox"):
        return prefix + "firefox";
      case ua.includes("Chrome"):
        return prefix + "chrome";
      case ua.includes("MSIE") || ua.includes("Internet Explorer"):
        return prefix + "ie";
      case ua.includes("Safari"):
        return prefix + "safari";
      case ua.includes("Mozilla"):
        return prefix + "mozilla";
      default:
        return prefix + "other";
    }
  };

  // --- 2. Detect Operating System ---
  const getOSName = () => {
    const prefix = "os-";
    switch (true) {
      case ua.includes("Win") || ua.includes("Windows"):
        return prefix + "windows";
      case ua.includes("like Mac"):
        return prefix + "ios";
      case ua.includes("Mac"):
        return prefix + "osx";
      case ua.includes("Android"):
        return prefix + "android";
      case ua.includes("BlackBerry"):
        return prefix + "blackberry";
      case ua.includes("UNIX"):
        return prefix + "unix";
      case ua.includes("Dillo") ||
        ua.includes("FreeBSD") ||
        ua.includes("OpenBSD") ||
        ua.includes("NetBSD"):
        return prefix + "linux";
      default:
        return prefix + "other";
    }
  };

  // --- 3. Detect Device Type ---
  const getDeviceName = () => {
    const prefix = "device-";
    switch (true) {
      // Robots
      case ua.includes("Googlebot"):
        return "bot-googlebot";
      case ua.includes("bingbot"):
        return "bot-bingbot";
      case ua.includes("Yahoo!"):
        return "bot-yahoobot";
      // Mobile
      case ua.includes("iPad"):
        return prefix + "ipad";
      case ua.includes("iPod"):
        return prefix + "ipod";
      case ua.includes("iPhone"):
        return prefix + "iphone";
      case ua.includes("Android"):
        return prefix + "android";
      case ua.includes("BlackBerry"):
        return prefix + "blackberry";
      case ua.includes("Windows Phone"):
        return prefix + "windows_phone";
      // Desktop
      case ua.includes("Mac"):
        return prefix + "mac_pc";
      case ua.includes("Windows NT"):
        return prefix + "windows_pc";
      case ua.includes("CrOS"):
        return prefix + "chromebook_pc";
      case ua.includes("Ubuntu"):
        return prefix + "linux_pc";
      default:
        return prefix + "other";
    }
  };

  // --- 4. Add classes to <body> ---
  document.body.classList.add(getBrowserName(), getOSName(), getDeviceName());
};

// Run detection immediately
window.initBrowserDetection = initBrowserDetection;

// ----------------------------
// Set Actual Viewport Height
// ----------------------------

/**
 * Sets a CSS variable --vh to represent 1% of the viewport height
 * Useful for handling mobile viewport resizing and vh units correctly
 */
const initViewportHeight = () => {
  const setVh = () => {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty("--vh", `${vh}px`);
  };

  // Initial set
  setVh();

  // Update on resize
  window.addEventListener("resize", setVh);
};

// Make globally accessible
window.initViewportHeight = initViewportHeight;

// ----------------------------
// GSAP Initialization
// ----------------------------

const initGSAP = () => {
  // Base configs
  gsap.config({
    nullTargetWarn: false,
    trialWarn: false,
  });

  // Register plugins
  gsap.registerPlugin(ScrollTrigger, SplitText, CustomEase);

  // Custom easing
  CustomEase.create("custom_ease", "M0,0 C0.25,1 0.5,1 1,1");

  // Make gsap globally available (optional, usually already is)
  window.gsap = gsap;
};

window.initGSAP = initGSAP;

// ----------------------------
// Lenis Initialization
// ----------------------------

const initLenis = () => {
  const isMobile = ScrollTrigger.isTouch;

  // Create Lenis instance for smooth scrolling
  window.lenis = new Lenis({
    smooth: !isMobile,
    smoothTouch: false,
    duration: 1.2,
    autoResize: true,
  });

  // Sync Lenis with GSAP's ScrollTrigger
  window.lenis.on("scroll", ScrollTrigger.update);

  // Add Lenis's requestAnimationFrame to GSAP ticker
  gsap.ticker.add((time) => {
    window.lenis.raf(time * 1000);
  });

  // Disable GSAP lag smoothing
  gsap.ticker.lagSmoothing(0);

  // Cookie Banner Handling with Smooth Scrolling
  const adjustCookieSettingsBtns = document.querySelectorAll(".adjustCookieSettingsBtn");
  adjustCookieSettingsBtns.forEach((btn) => {
    btn.addEventListener("click", () => lenis.stop());
  });

  const openCookieSettingsBtn = document.getElementById("openCookieSettingsBtn");
  if (openCookieSettingsBtn) openCookieSettingsBtn.addEventListener("click", () => lenis.stop());

  const closeCookieSettingsBtn = document.querySelector("#advanced-cookie-banner .closer");
  if (closeCookieSettingsBtn) closeCookieSettingsBtn.addEventListener("click", () => lenis.start());

  const saveCookieSettingsBtn = document.getElementById("saveCookieSettingsBtn");
  if (saveCookieSettingsBtn) saveCookieSettingsBtn.addEventListener("click", () => lenis.start());
};

window.initLenis = initLenis;

// ----------------------------
// Mail Spam Prevention
// ----------------------------

/**
 * Sets mailto links dynamically from data attributes to prevent spam harvesting
 * - Elements need class "mail-link"
 * - Uses data-name (recipient), data-domain (optional), data-params (optional)
 */
const initMailSpamProtection = () => {
  const mailLinks = document.getElementsByClassName("mail-link");

  // Exit if no elements found
  if (!mailLinks.length) return;

  for (let i = 0; i < mailLinks.length; i++) {
    const link = mailLinks[i];
    const recipient = link.dataset.name;
    const host = link.dataset.domain || window.location.hostname;
    const params = link.dataset.params || "";

    // Fill innerHTML if empty
    if (!link.innerHTML.trim()) {
      link.innerHTML = `${recipient}@${host}`;
    }

    // Set the mailto href
    link.href = `mailto:${recipient}@${host}${params}`;
  }
};

window.initMailSpamProtection = initMailSpamProtection;

// ----------------------------
// Open External Links in New Tab
// ----------------------------

/**
 * Forces all external links to open in a new tab securely
 * Prevents opener/tabnabbing issues
 */
const initExternalLinksInNewTab = () => {
  const links = document.links || document.getElementsByTagName("a");

  for (let i = 0; i < links.length; i++) {
    const link = links[i];

    // Skip links with onClick handlers
    if (
      !link.hasAttribute("onClick") &&
      /^http/.test(link.href) &&
      !link.href.includes(window.location.hostname)
    ) {
      link.setAttribute(
        "onClick",
        `javascript:const newWin = window.open(); newWin.opener = null; newWin.location = href; return false;`
      );
      link.removeAttribute("target");
    }
  }
};

window.initExternalLinksInNewTab = initExternalLinksInNewTab;

// ----------------------------
// Prevent Phone Number Break
// ----------------------------

/**
 * Prevents automatic line breaks in tel: links
 */
const initPhoneNumbersUnbreakable = () => {
  const telLinks = document.querySelectorAll("a[href^='tel']");
  telLinks.forEach((link) => {
    link.style.whiteSpace = "nowrap";
  });
};

window.initPhoneNumbersUnbreakable = initPhoneNumbersUnbreakable;

// ----------------------------
// Mobile Mailto Shortener
// ----------------------------

/**
 * Shortens mailto link text to "E-Mail" on mobile viewports
 * Restores the original text on larger screens
 */
const initMobileMailtoShorthand = () => {
  const originalTexts = new Map();

  const shortenLinks = () => {
    const mailLinks = document.querySelectorAll("a[href^='mailto']");
    mailLinks.forEach((link) => {
      if (!originalTexts.has(link)) {
        originalTexts.set(link, link.textContent);
      }
      link.textContent = "E-Mail";
    });
  };

  const restoreLinks = () => {
    originalTexts.forEach((text, link) => {
      link.textContent = text;
    });
  };

  // Apply on initial load if mobile
  if (window.innerWidth <= 576) shortenLinks();

  // Listen for resize events
  window.addEventListener("resize", () => {
    if (window.innerWidth <= 576) {
      shortenLinks();
    } else {
      restoreLinks();
    }
  });
};

window.initMobileMailtoShorthand = initMobileMailtoShorthand;

// ----------------------------
// Smooth Scroll to Anchor Link
// ----------------------------

/**
 * Initializes smooth scrolling to anchor links using global `lenis`.
 * Handles clicks on `<a href="#id">` links and navigates to hash on page load.
 */
const initScrollToAnchorLink = () => {
  if (!window.lenis) {
    console.warn("Lenis instance not found. Call initLenis() first.");
    return;
  }

  const scrollTo = (el) => {
    const top = el.getBoundingClientRect().top + window.lenis.scroll; // absolute scroll position
    window.lenis.scrollTo(top, {
      duration: 1.2,
      easing: (t) => (t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t), // easeInOutQuad
    });
  };

  gsap.utils.toArray("a[href^='#']").forEach((link) => {
    link.addEventListener("click", (e) => {
      const url = new URL(link.href, window.location.origin);

      // Nur smooth scroll, wenn es auf der aktuellen Seite ist
      if (url.pathname === window.location.pathname) {
        e.preventDefault();

        const id = url.hash.slice(1);
        const targetEl = document.getElementById(id);
        if (!targetEl) return;

        const top = targetEl.getBoundingClientRect().top + window.lenis.scroll;

        window.lenis.scrollTo(top, {
          duration: 1.2,
          easing: (t) => (t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t), // easeInOutQuad
        });

        // Optional: URL-Hash aktualisieren ohne sofortiges Springen
        history.pushState(null, "", url.hash);
      }
    });
  });

  // scroll to hash on page load
  const hash = window.location.hash.slice(1);
  if (hash) {
    const targetEl = document.getElementById(hash);
    if (targetEl) {
      setTimeout(() => scrollTo(targetEl), 200);
    }
  }
};

window.initScrollToAnchorLink = initScrollToAnchorLink;

// ----------------------------
// Ajax Form Handling
// ----------------------------

const initAjaxFormHandling = () => {
  // helper function to scroll to the first error message
  const scrollToFirstError = (container) => {
    const firstErrorEl = container.querySelector(".error-msg:not(:empty)");
    if (firstErrorEl) {
      window.scrollTo({
        top: firstErrorEl.offsetTop - 200,
        behavior: "smooth",
      });
    }
  };

  // Select all form wraps with the class "use-ajax" and attach the form handler
  const formWraps = document.querySelectorAll(".form-wrap.use-ajax");

  formWraps.forEach((formWrap) => {
    const formHandler = AsyncFormHandler(formWrap);

    // Define what happens on successful form submission
    formHandler.onSuccess((data) => {
      formWrap.innerHTML = data.message;
    });

    // Define what happens when the form is invalid
    formHandler.onValidationError((data) => {
      scrollToFirstError(formWrap);
    });

    // Define what happens when there's an error in form submission (e.g. network error)
    formHandler.onSubmitError((error) => {
      console.error("An error occurred:", error);
    });
  });
};

window.initAjaxFormHandling = initAjaxFormHandling;

// ----------------------------
// Accordion Setup
// ----------------------------

/**
 *  Function adds accordion functionality to a given trigger element
 *  The accordion can optionally be configured over data attributes:
 *  – data-content-id:
 *    id string of the accordion content element if it is not the nextElementSibling of the trigger
 *  – data-group:
 *    identifier to group multiple accordions together.
 *    If an accordion is opened, all other accordions of the same group will be closed
 */
const initAccordions = () => {
  const accordion = (triggerEl) => {
    let contentEl;
    const sibling = triggerEl.nextElementSibling;

    if (sibling && sibling.classList.contains("accordion-content")) {
      contentEl = sibling;
    } else if (triggerEl.dataset && triggerEl.dataset.contentId) {
      contentEl = document.getElementById(triggerEl.dataset.contentId);
    }
    if (!contentEl) return;

    gsap.set(contentEl, { maxHeight: 0, overflow: "hidden" });

    // Recalculate and set maxHeight for an element and its parent accordions recursively
    const handleResize = (el = contentEl) => {
      gsap.to(el, { maxHeight: el.scrollHeight, duration: 0.3, ease: "linear" });

      // Find parent accordion content that contains this element
      const parentContent = el
        .closest(".accordion-content")
        ?.parentElement.closest(".accordion-content");

      // If there's a parent accordion content, recursively resize it
      if (parentContent) {
        setTimeout(() => {
          handleResize(parentContent);
        }, 300);
      }
    };

    const handleClose = (triggerEl, contentEl) => {
      gsap.to(contentEl, { maxHeight: 0, duration: 0.3, ease: "linear" });
      [triggerEl, contentEl].forEach((it) => it.classList.remove("open"));
      window.removeEventListener("resize", () => handleResize(contentEl));

      // Also update parent accordions after closing child
      const parentContent = contentEl
        .closest(".accordion-content")
        ?.parentElement.closest(".accordion-content");
      if (parentContent) {
        handleResize(parentContent);
      }
    };

    const handleOpen = (triggerEl, contentEl) => {
      handleResize(contentEl);
      [triggerEl, contentEl].forEach((it) => it.classList.add("open"));
      window.addEventListener("resize", () => handleResize(contentEl));
    };

    triggerEl.addEventListener("click", () => {
      if (contentEl.style.maxHeight !== "0px") {
        handleClose(triggerEl, contentEl);
      } else {
        handleOpen(triggerEl, contentEl);

        const group = triggerEl.dataset.group;
        if (group) {
          const triggers = document.querySelectorAll(
            `.accordion-trigger.open[data-group="${group}"]`
          );
          triggers.forEach((trigger) => {
            if (trigger !== triggerEl) {
              trigger.click();
            }
          });
        }
      }

      setTimeout(() => {
        ScrollTrigger.refresh();
        lenis.resize();
      }, 300);
    });
  };

  document.querySelectorAll(".accordion-trigger").forEach(accordion);
};

window.initAccordions = initAccordions;

/* **********************************************************************************************************************
 * HELPER FUNCTIONS
 **********************************************************************************************************************/

// ----------------------------
// Create Dom Element from String
// ----------------------------

/**
 * Converts an HTML string into DOM element(s)
 * @param {string} htmlString - HTML code as a string
 * @param {boolean} [returnArray=false] - If true, returns all elements as an array
 * @returns {Element|Element[]} - First element or an array of elements
 */
const dom = (htmlString, returnArray = false) => {
  if (!htmlString || typeof htmlString !== "string") return null;

  // Create a temporary container
  const holder = document.createElement("div");
  holder.innerHTML = htmlString.trim();

  // Return either the first element or all elements as an array
  return returnArray ? Array.from(holder.children) : holder.firstElementChild;
};

window.dom = dom;
