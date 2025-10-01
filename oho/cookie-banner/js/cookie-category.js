class CookieCategory {
  constructor(caption, description = "", isToggleable = true) {
    this.caption = caption;
    this.description = description;
    this.isToggleable = isToggleable;
    this.cookieList = [];

    this.onChangeListeners = [];
  }

  // create new cookie and save it in collection
  addCookie(title, name_slug, provider, description, privacy, runtime, state, onAccept, onDeny) {
    const cookie = new Cookie(
      title,
      name_slug,
      provider,
      description,
      privacy,
      runtime,
      state,
      onAccept,
      onDeny
    );

    // register onToggle handler
    cookie.onChange((newState) => {
      // run callbacks
      this.onChangeListeners.forEach((callback, i) => {
        callback(this.getState());
      });
    });

    // add categorcookie
    this.cookieList.push(cookie);
    return cookie;
  }

  getCookies() {
    return this.cookieList;
  }

  getState() {
    // category does not have its own state, it is calculated from cookies
    // if at least one cookie is true, the state of the category is true
    let state = false;

    this.cookieList.forEach((cookie, i) => {
      if (cookie.state) {
        state = true;
      }
    });

    return state;
  }

  setState(newState, inherited = false) {
    // if state is inherit to cookies
    if (inherited) {
      this.cookieList.forEach((cookie, i) => {
        cookie.setState(newState);
      });
    }

    // run callbacks
    this.onChangeListeners.forEach((callback, i) => {
      callback(newState);
    });
  }

  toggleState() {
    // true = toggle state and inherit for child cookies
    this.setState(!this.getState(), true);
  }

  // register onToggle listener
  onChange(callback) {
    this.onChangeListeners.push(callback);
  }

  render() {
    // create category wrap
    const categoryWrap =
      cookieDom(`<div id="cookie-type-${this.caption.toLowerCase()}" class="cookie-type-wrap mt-xl-1">
    <div class="cookie-type-wrap__top">
    <div class="grid-wrap col-gap-xl-05">
    <div class="box box-xl-9 box-md-10 box-sm-9">
    <span class="p">${this.caption}</span><br>
    <div class="mt-xl-05"></div>
    <span class="p">${this.description}</span><span class="cookie-info-toggle"><br>
    <span class="show-cookie-info p">${cookieBannerTranslations.buttons.hide_cookie_info}</span>
    <span class="hide-cookie-info active p">${
      cookieBannerTranslations.buttons.show_cookie_info
    }</span>
    </span>
    </div>
    <div class="box box-xl-2 box-md-0">
    </div>
    <div class="cookie-advanced-infos box box-xl-10 box-md-12 pt-xl-1">
    </div>
    </div>
    </div>
    </div>`);

    // info toggle event listener
    const cookieInfoToggle = categoryWrap.querySelector(".cookie-info-toggle");
    cookieInfoToggle.addEventListener("click", () => {
      cookieInfoToggle.querySelector(".show-cookie-info").classList.toggle("active");
      cookieInfoToggle.querySelector(".hide-cookie-info").classList.toggle("active");
      categoryWrap.querySelectorAll(".cookie-info-wrap").forEach((info) => {
        info.classList.toggle("active");
      });
    });

    // add toggle button to category
    if (this.isToggleable) {
      let element = categoryWrap.querySelector(".cookie-type-wrap__top .grid-wrap");
      element.insertBefore(
        cookieDom(
          `<div class="box box-xl-2 box-sm-3">
        <div class="cookie-switch-wrap cookie-switch--enabled type">
        <label class="cookie-switch">
        <input type="checkbox" class="cookie-checkbox" checked>
        <span class="cookie-slider-wrap">
        <span class="cookie-slider"></span>
        </span>
        </label>
        </div>
        </div>`
        ),
        element.firstChild
      );

      // set default checkbox state
      const toggleCheckbox = categoryWrap.querySelector('input[type="checkbox"]');
      categoryWrap.checked = this.getState();

      // bind checkbox to state for updates
      this.onChange((newState) => {
        toggleCheckbox.checked = newState;
      });

      // add event listener to toggle
      categoryWrap.querySelector(".cookie-switch--enabled").addEventListener("click", (event) => {
        event.preventDefault();
        this.toggleState();
      });
    } else {
      let element = categoryWrap.querySelector(".cookie-type-wrap__top .grid-wrap");
      element.insertBefore(
        cookieDom(
          `<div class="box box-xl-2 box-sm-3">
        <div class="cookie-switch-wrap cookie-switch--disabled type">
        <input type="checkbox" class="cookie-checkbox" checked>
        <span class="cookie-slider-wrap">
        <span class="cookie-slider"></span>
        </span>
        </div>
        </div>`
        ),
        element.firstChild
      );
    }

    // create cookie list entries
    this.cookieList.forEach((cookie, i) => {
      const listEl = cookie.render();
      if (this.isToggleable) {
        listEl.insertBefore(cookie.createToggle(), listEl.firstChild);
      }
      categoryWrap.querySelector(".cookie-advanced-infos").appendChild(listEl);
    });

    return categoryWrap;
  }
}
