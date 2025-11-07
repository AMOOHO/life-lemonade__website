"use strict";

/**
 * Creates a filter engine
 */
const FmaFilterEngine = (logic = "AND") => {
  const callbacks = [];
  const filters = [];

  // Adds a single filter
  const registerFilter = (filter) => {
    if (filter) {
      filters.push(filter);

      // listen for filter changes
      filter.onChange((filterAction = "") => {
        notifyChange(filterAction, filter);
      });
    }
  };

  // Bulk add filters using an array
  const registerFilters = (filtersArray) => {
    filtersArray.forEach((filter) => {
      registerFilter(filter);
    });
  };

  // Notify all callbacks that the filter has changed
  const notifyChange = (filterAction, filter) => {
    callbacks.forEach((callback) => callback(filterAction, filter));
  };

  // Checks if the post matches all filters based on logic
  const applyFilters = (posts) => {
    // apply filters with given logic
    const filterFunc =
      logic === "AND"
        ? (post) => filters.every((f) => f.applyFilter(post))
        : (post) => filters.some((f) => f.applyFilter(post));

    return posts.filter(filterFunc);
  };

  // collects the URL parameters for all filters
  const serializeFilters = () => {
    const params = {};

    filters.forEach((f) => {
      const filterParams = f.serialize();
      if (filterParams) {
        params[f.id.toLowerCase()] = filterParams;
      }
    });

    return params;
  };

  // deserializes the URL parameters for all filters
  const deserializeFilters = (params) => {
    filters.forEach((f) => {
      const filterParams = params[f.id.toLowerCase()];
      if (filterParams) {
        f.deserialize(filterParams);
      }
    });
  };

  // Get a JSON object with filter ids as keys and filter values as values
  const getFilterObject = () => {
    const obj = {};

    filters.forEach((f) => {
      obj[f.id.toLowerCase()] = f.getCurrentState();
    });

    return obj;
  };

  return {
    applyFilters,
    registerFilter,
    registerFilters,
    serializeFilters,
    deserializeFilters,
    getFilterObject,
    getFilterList: () => filters,
    onFilterTrigger: (callback) => {
      callbacks.push(callback);
    },
  };
};
