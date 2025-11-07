"use strict";

/**
 * Creates and manages taxonomy filter buttons and the corresponding filter logic.
 *
 * - Handles interactions with filter buttons that are associated with terms.
 * - Constructs and maintains a taxonomy filter based on user interactions with the buttons.
 * - Notifies subscribers of changes to the taxonomy filter through a callback interface.
 *
 * @param {Object}
 * * @param {String} filterKey - A unique slug for the filter (used in URL as key as well as key for API requests)
 * * @param {String} filterLogic - The logic to apply to the filter (AND or OR)
 * * @param {Boolean} writeToUrl - Whether to write the filter to the URL or not
 * * @param {Array} filterButtons - An array of DOM elements that represent the filter buttons
 * * @param {Array} resetButton - A DOM element that represents the reset button
 *
 * @returns {Object} An object with methods to interact with the taxonomy filter buttons and filter.
 */

const FmaTaxonomyFilter = ({
  // options
  filterKey = "terms",
  filterLogic = "AND",
  writeToUrl = true,

  // selectors
  filterButtons = [],
  resetButton = undefined,
}) => {
  // private variables
  const callbacks = [];
  const selectedTerms = [];
  let doNotify = true;

  // add termSlug to array if not already present
  const addTerm = (termSlug) => {
    if (!selectedTerms.includes(termSlug)) {
      // reset current filter if filterLogic is SINGLE
      if (filterLogic === "SINGLE") {
        selectedTerms.length = 0;
        filterButtons.forEach((button) => button.classList.remove("fma-control-active"));
      }

      selectedTerms.push(termSlug);
      notifyChange("add");
    }

    resetButton?.classList.remove("fma-control-active");
  };

  // remove termSlug from array if present
  const removeTerm = (termSlug) => {
    if (selectedTerms.includes(termSlug)) {
      selectedTerms.splice(selectedTerms.indexOf(termSlug), 1);
      notifyChange("remove");
    }

    if (selectedTerms.length === 0) {
      resetButton?.classList.add("fma-control-active");
    }
  };

  const reset = () => {
    resetTerms();
    resetButton?.classList.add("fma-control-active");
    notifyChange("reset");
  };

  const resetTerms = () => {
    selectedTerms.length = 0;
    filterButtons.forEach((button) => button.classList.remove("fma-control-active"));
  };

  // rule to apply to each item
  const applyFilter = (item) => {
    // passthrough condition
    if (selectedTerms.length === 0) return true;

    // console.log(item);

    // filter by terms using given inner logic
    if (filterLogic === "AND") {
      return selectedTerms.every((termSlug) => item[filterKey].includes(termSlug));
    } else {
      return selectedTerms.some((termSlug) => item[filterKey].includes(termSlug));
    }
  };

  const notifyChange = (filterAction) => {
    if (doNotify) {
      callbacks.forEach((callback) => callback(filterAction));
    }
  };

  // create a string representation of the current filter for use in the URL
  const serialize = () => {
    return writeToUrl ? selectedTerms.join(",") : "";
  };

  // parse a string representation of the current filter from the URL
  const deserialize = (str) => {
    doNotify = false;

    const termSlugs = str.split(",");
    termSlugs.forEach((termSlug) => addTerm(termSlug));

    // update filterButtons
    filterButtons.forEach((button) => {
      if (termSlugs.includes(button.dataset.slug)) {
        button.classList.add("fma-control-active");
      }
    });

    doNotify = true;
  };

  // Attach event listeners to buttons
  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      // toggle term on click
      if (selectedTerms.includes(button.dataset.slug)) {
        removeTerm(button.dataset.slug);
        button.classList.remove("fma-control-active");
      } else {
        addTerm(button.dataset.slug);
        button.classList.add("fma-control-active");
      }
    });
  });

  // reset all terms button
  resetButton?.addEventListener("click", reset);

  return {
    id: filterKey,
    applyFilter,
    serialize,
    deserialize,
    reset,
    getCurrentState: () => selectedTerms,
    onChange: (callback) => {
      callbacks.push(callback);
    },
  };
};
