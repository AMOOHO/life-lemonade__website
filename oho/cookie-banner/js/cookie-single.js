const cookieDom = (innerString) => {
  // create a DOM element from html string
  const holder = document.createElement("div");
  holder.innerHTML = innerString;
  return holder.firstElementChild;
};

class Cookie {
  constructor(title, name_slug, provider, description, privacy, runtime, state, onAccept, onDeny) {
    this.title = title;
    this.name_slug = name_slug;
    this.provider = provider;
    this.description = description;
    this.privacy = privacy;
    this.runtime = runtime;
    this.state = state;
    this.onAccept = onAccept;
    this.onDeny = onDeny;

    this.onChangeListeners = [];
  }

  setState(newState) {
    this.state = newState;

    // run callbacks
    this.onChangeListeners.forEach((callback, i) => {
      callback(newState);
    });
  }

  toggleState() {
    this.setState(!this.state);
  }

  // register onToggle listener
  onChange(callback) {
    this.onChangeListeners.push(callback);
  }

  render() {
    const listElem = cookieDom(`<ul class="cookie-info-wrap"></ul>`);

    Object.entries(this).forEach(([key, value], i) => {
      if (
        value &&
        key !== "state" &&
        key !== "onAccept" &&
        key !== "onDeny" &&
        key !== "onChangeListeners"
      ) {
        listElem.appendChild(this.createListEntry(key, value));
      }
    });

    return listElem;
  }

  createListEntry(key, value) {
    if (cookieBannerTranslations.cookieKeys.hasOwnProperty(key)) {
      key = cookieBannerTranslations.cookieKeys[key];
    }

    return cookieDom(`<li>
    <div class="grid-wrap col-gap-xl-05">
    <div class="box box-xl-3 box-md-5">
    <span>${key}</span>
    </div>
    <div class="box box-xl-9 box-md-7">
    <span>${value}</span>
    </div>
    </div>
    </li>`);
  }

  createToggle() {
    // create toggle markup
    const toggleListEl = cookieDom(`
    <li>
    <div class="grid-wrap col-gap-xl-05 cookie-switch-wrap single">
    <div class="box box-xl-3 box-md-5">
    <span>${cookieBannerTranslations.cookieKeys.accept}</span>
    </div>
    <div class="box box-xl-9 box-md-7">
    <label class="cookie-switch">
    <input type="checkbox" class="cookie-checkbox" checked>
    <span class="cookie-slider-wrap">
    <span class="cookie-slider"></span>
    </span>
    </label>
    </div>
    </div>
    </li>`);

    // set default checkbox state
    const toggleCheckbox = toggleListEl.querySelector('input[type="checkbox"]');
    toggleCheckbox.checked = this.state;

    // bind checkbox to state for updates
    this.onChange((newState) => {
      toggleCheckbox.checked = newState;
    });

    // add event listener to toggle
    toggleListEl.querySelector(".cookie-switch").addEventListener("click", (event) => {
      event.preventDefault();
      this.toggleState();
    });

    return toggleListEl;
  }
}
