"use strict";

/**
 * Creates a url handler for filters
 * the url handler is responsible for updating the url params
 * and updating the filter based on the url params (on load)
 *
 * @param {FilterEngine} filterEngine
 * @returns {UrlHandler}
 *
 */
const FmaUrlHandler = (filterEngine) => {
  const setUrlParams = (serializedParams) => {
    const url = new URL(window.location.href);
    url.search = new URLSearchParams(serializedParams);

    // push history state if different
    if (window.location.href !== url.toString()) {
      window.history.replaceState({}, "", url);
    }
  };

  // convert url params to json object
  const getUrlParams = () => {
    const params = {};
    const urlParams = new URLSearchParams(window.location.search);
    for (const [key, value] of urlParams) {
      params[key] = value;
    }
    return params;
  };

  // ON LOAD: get url params and update filter
  const urlParams = getUrlParams();
  if (Object.keys(urlParams).length > 0) {
    filterEngine.deserializeFilters(urlParams);
  }

  return {
    updateURL: () => {
      setUrlParams(filterEngine.serializeFilters());
    },
    updateFiltersFromURL: () => {
      const urlParams = getUrlParams();
      if (Object.keys(urlParams).length > 0) {
        filterEngine.deserializeFilters(urlParams);
      }
    },
  };
};
