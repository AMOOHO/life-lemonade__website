"use strict";

/**
 * FmaInfiniteScrollHandler - A utility for handling infinite scrolling in a container.
 *
 * It will create an invisible element at the bottom of the container and observe it for intersection
 * with the viewport. When the element is intersecting, the callbacks will be triggered and the
 * Intersection Observer will be disconnected.
 *
 * Additionally the container will be observed for DOM node changes. When new nodes are added to the container,
 * the Intersection Observer will be restarted.
 *
 * This creates an interplay between the Intersection Observer and the Mutation Observer, which allows
 * for infinite scrolling
 *
 * @param {HTMLElement} container - The container element to observe.
 * @param {number} [rootMargin] - The root margin for the Intersection Observer.
 * @returns {Object} - An object with methods for handling infinite scrolling.
 */
const FmaInfiniteScrollHandler = (
  container,
  rootMargin = 1000 // should be at least the height of a single item
) => {
  const callbacks = [];
  let triggerEl = null;
  let intersectionObserver = null;
  let mutationObserver = null;

  const restartDelayMs = 50;
  const intersectionOptions = {
    root: null,
    rootMargin: `0px 0px ${parseInt(rootMargin)}px 0px`,
    threshold: 1,
  };

  /**
   * Initializes the Intersection Observer and Mutation Observer.
   */
  const _createObservers = () => {
    // Create the trigger element
    triggerEl = document.createElement("span");
    Object.assign(triggerEl.style, {
      position: "relative",
      height: "1px",
      width: "1px",
      display: "block",
      visibility: "hidden",
      pointerEvents: "none",
    });
    container.insertAdjacentElement("afterend", triggerEl);

    // Create a new Intersection Observer
    intersectionObserver = new IntersectionObserver((entries, obs) => {
      const entry = entries[0];
      if (entry.isIntersecting) {
        callbacks.forEach((callback) => callback(entry, obs));

        // Unobserve the element after intersection was triggered
        intersectionObserver.disconnect();
      }
    }, intersectionOptions);

    // Create a Mutation Observer to handle changes in the container
    mutationObserver = new MutationObserver((mutations) => {
      // Check if nodes were added to the container
      const nodesAdded = mutations.some((mutation) => mutation.addedNodes.length > 0);

      if (nodesAdded) {
        // Restart the Intersection Observer when changes in the grid are detected
        setTimeout(() => {
          intersectionObserver.observe(triggerEl);
        }, restartDelayMs);
      }
    });

    setTimeout(() => {
      // Start observing changes in the DOM nodes within the container
      mutationObserver.observe(container, { childList: true, subtree: true });

      // Start observing changes in the grid
      intersectionObserver.observe(triggerEl);
    }, restartDelayMs);
  };

  const shutDown = () => {
    intersectionObserver?.disconnect();
    mutationObserver?.disconnect();
  };

  // Initialize the observers
  _createObservers();

  return {
    onIntersection: (callback) => {
      callbacks.push(callback);
    },
    stopObserving: shutDown,
  };
};
