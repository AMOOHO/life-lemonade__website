/* **********************************************************************************************************************
 * HEADER.JS
 *
 * Loaded early in <head> to prevent layout or scroll glitches.
 * Initializes:
 *   - Disables automatic scroll restoration on browser back/forward navigation
 *   - Sets up a DOM-ready helper (vanilla alternative to jQuery(document).ready)
 *   - Adds a `dom-ready` class to <body> once DOM is fully parsed
 *
 * Dependencies:
 *   - None (vanilla JS)
 *
 * Copyright (c) 2025 OHO Design GmbH. All rights reserved.
 * Unauthorized copying, distribution, or use of this file is strictly prohibited.
 *
 * Author: OHO Design GmbH
 * Date: 2025-01-01
 **********************************************************************************************************************/

// prevent scroll restoration on back button
history.scrollRestoration = "manual";

// check if DOM is ready – vanilla version of jQuery(document).ready()
const docReady = (a) => {
  "complete" === document.readyState || "interactive" === document.readyState
    ? setTimeout(a, 5)
    : document.addEventListener("DOMContentLoaded", a);
};
docReady(() => {
  document.body.classList.add("dom-ready");
});
