class CookieBanner {
  constructor(rootEl, cookieInfoWrap) {
    this.rootEl = rootEl;
    this.cookieInfoWrap = cookieInfoWrap;
    this.categories = [];
  }

  addCategory(caption, description = "", isToggleable = true) {
    const category = new CookieCategory(caption, description, isToggleable);
    this.categories.push(category);
    return category;
  }

  getAllCookies() {
    const cookieList = [];
    this.categories.forEach((cat, i) => {
      cookieList.push(...cat.getCookies());
    });
    return cookieList;
  }

  acceptAll() {
    // disable all non-essential cookies
    this.categories.forEach((cat, i) => {
      if (cat.isToggleable) {
        cat.getCookies().forEach((cookie, i) => {
          cookie.setState(true);
        });
      }
    });

    this.storeSettings();
  }

  acceptAllFromCategory(cat) {
    cat.getCookies().forEach((cookie, i) => {
      cookie.setState(true);
    });

    this.storeSettings();
  }

  toggleAll(toggleAllState) {
    // activate all Cookies
    this.categories.forEach((cat, i) => {
      if (cat.isToggleable) {
        cat.getCookies().forEach((cookie, i) => {
          if (toggleAllState === true) {
            cookie.setState(false);
          } else {
            cookie.setState(true);
          }
        });
      }
    });
  }

  acceptEssential() {
    // disable all non-essential cookies
    this.categories.forEach((cat, i) => {
      if (cat.isToggleable) {
        cat.getCookies().forEach((cookie, i) => {
          cookie.setState(false);
        });
      }
    });

    this.storeSettings();
  }

  storeSettings() {
    // create storable cookie settings
    const cookieSettings = {};
    this.getAllCookies().forEach((cookie, i) => {
      cookieSettings[cookie.name_slug] = cookie.state;
    });
    Cookies.set("oho_cookie_consent", JSON.stringify(cookieSettings), { expires: 365 });

    // run cookie codes
    this.runCookieCodes(false);

    // hide banner
    this.hideBanner();
  }

  // read cookie settings from cookie storage
  readSettingsFromStorage() {
    const cookieContent = Cookies.get("oho_cookie_consent");
    if (cookieContent) {
      return JSON.parse(cookieContent);
    }
    return false;
  }

  // compare stored cookies with defined cookies
  isStorageValid(storedSettings) {
    let isValid = true;

    // check if all defined cookies can be fround in storage
    this.getAllCookies().forEach((cookieObj, i) => {
      if (!storedSettings.hasOwnProperty(cookieObj.name_slug)) {
        isValid = false;
      }
    });

    return isValid;
  }

  // run code of accepted cookies
  runCookieCodes(isRestored) {
    this.getAllCookies().forEach((cookieObj, i) => {
      if (cookieObj.state) {
        if (typeof cookieObj.onDeny === "function") {
          cookieObj.onAccept(isRestored);
        }
      } else {
        if (typeof cookieObj.onDeny === "function") {
          cookieObj.onDeny(isRestored);
        }
      }
    });
  }

  setup() {
    // render banner content (which is still hidden)
    this.categories.forEach((category, i) => {
      this.cookieInfoWrap.appendChild(category.render());
    });

    // try to find settings from storage
    const storedSettings = this.readSettingsFromStorage();
    if (storedSettings && this.isStorageValid(storedSettings)) {
      // apply settings if valid
      this.getAllCookies().forEach((cookieObj, i) => {
        cookieObj.setState(storedSettings[cookieObj.name_slug]);
      });

      this.runCookieCodes(true);
    } else {
      this.showBanner();
    }
  }

  hideBanner() {
    document.getElementById("cookie-banner__lightbox").classList.add("active");
    this.rootEl.classList.add("closed");
  }

  showBanner() {
    document.getElementById("cookie-banner__lightbox").classList.remove("active");
    this.rootEl.classList.remove("closed");
  }
}
