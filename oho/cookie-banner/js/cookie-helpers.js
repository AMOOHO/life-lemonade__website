/* COOKIE BANNER HELPERS ************************************************************ */

function createTag(tagInfo) {
  const tag = document.createElement(tagInfo.tag);

  // Set attributes, including src and content
  for (const key in tagInfo) {
    if (tagInfo.hasOwnProperty(key) && key !== "tag") {
      if (key === "src" || key === "content") {
        continue; // Skip src and content, as they will be handled separately
      }
      tag.setAttribute(key, tagInfo[key]);
    }
  }

  // Set src if provided
  if (tagInfo.src) {
    tag.src = tagInfo.src;
  }

  // Set content if provided
  if (tagInfo.content) {
    tag.innerHTML = tagInfo.content;
  }

  return tag;
}

/* ***** Append Tag to Head */
const appendTagToHead = (tag) => {
  document.head.appendChild(tag);
};

/* ***** Append Tag to Body */
const appendTagToBody = (tag) => {
  document.body.appendChild(tag);
};

/* ***** Remove Tag */
const removeTag = (id) => {
  const tag = document.getElementById(id);
  if (tag) {
    tag.remove();
  }
};

/* --- Cookie Handles */

function delete_cookie(name, path, domain) {
  if (get_cookie(name)) {
    document.cookie =
      name +
      "=" +
      (path ? ";path=" + path : "") +
      (domain ? ";domain=" + domain : "") +
      ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
  }
}

function get_cookie(name) {
  return document.cookie.split(";").some((c) => {
    return c.trim().startsWith(name + "=");
  });
}

/* --- open Cookie Banner Lightbox */

function adjustCookieSettings() {
  const cookieBannerLightbox = document.getElementById("cookie-banner__lightbox");
  const cookieBanner = document.getElementById("advanced-cookie-banner");
  const closer = document.querySelector("#advanced-cookie-banner .closer");

  cookieBanner.classList.remove("closed");
  cookieBannerLightbox.classList.add("active");
  cookieBanner.classList.add("extended");
  closer.classList.add("active");
}

/* ***** Unblock Elements */

const unblockElsByClass = (className) => {
  const els = document.querySelectorAll(className);
  els.forEach((el) => {
    unblockEl(el);
  });
};

const unblockEl = (el) => {
  el.classList.add("unblocked");

  // select element with data-src attribute
  let srcEl = el.querySelector("[data-src]");

  if (srcEl) {
    if (srcEl.tagName === "SCRIPT") {
      // for scripts
      let script = document.createElement("script");
      script.src = srcEl.dataset.src;
      script.dataset.src = srcEl.dataset.src;
      script.async = true;
      srcEl.parentNode.replaceChild(script, srcEl);
    } else {
      // for images, iFrames, etc.
      srcEl.src = srcEl.dataset.src;
    }
  }
};

/* ***** Block Elements */

const blockElsByClass = (className) => {
  const els = document.querySelectorAll(className);
  els.forEach((el) => {
    blockEl(el);
  });
};

const blockEl = (el) => {
  el.classList.remove("unblocked");

  let srcEl = el.querySelector("[data-src]");
  if (srcEl) {
    if (srcEl.tagName === "SCRIPT") {
      // for scripts
      if (srcEl.src) {
        let script = document.createElement("script");
        script.dataset.src = srcEl.src;
        script.async = true;
        srcEl.parentNode.replaceChild(script, srcEl);
      }
    } else {
      // for images, iFrames, etc.
      if (srcEl.src) {
        srcEl.dataset.src = srcEl.src;
        srcEl.src = "";
      }
    }
  }
};
