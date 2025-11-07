"use strict";

/**
 * Bricklayer Engine (similar to MixItUp but for masonry layout)
 *
 * How to use:
 * It works almost as a drop-in replacement for MixItUp. Almost.
 * There are some differences you need to be aware of:
 * - replace all mixitup classes like "mixitup-grid" and "mix" with "brick-grid" and "brick"
 * - the brick elements (grid-items) must have only one direct child element that contains the actual content
 * - that child element must have a data attribute "data-postid" that contains the post id
 *
 * - You need to pass the brick elements as the first argument to the Bricklayer function
 * - The config object as the second argument. The first 3 properties (data, load, render) are identical to MixItUp
 *
 * // SAMPLE USAGE
 * const bricklayer = Bricklayer(brickElements, {
 *   data: {
 *     uidKey: "id",
 *   },
 *   load: {
 *     dataset: dataset,
 *   },
 *   render: {
 *     target: (item) => {
 *       if (!item.html) {
 *         console.error("Bricklayer: items do not contain html property");
 *         return null;
 *       }
 *
 *       // render inner item
 *       const elem = dom(item.html);
 *
 *       // apply cursor effects and render
 *       applyCursorEffect(elem.querySelectorAll("a"));
 *       return elem;
 *     },
 *   },
 *
 *   // how bricklayer should append new bricks
 *   append: {
 *     container: gridWrap,
 *     classTemplate: ["brick box box-xl-4 box-md-4 box-sm-6"],
 *   },
 *
 *   // callbacks
 *   callbacks: {
 *     // before filtering
 *     onStart: (affectedBricksElements) => {
 *       return new Promise((resolve) => {
 *         // fade out bricks
 *         gsap.to(affectedBricksElements, {
 *           opacity: 0,
 *           duration: 0.3,
 *           ease: "power1.inOut",
 *           onComplete: () => {
 *             resolve(); // resolve promise
 *           },
 *         });
 *       });
 *     },
 *
 *     // after filtering
 *     onEnd: (visibleBrickElements, newBricksElements) => {
 *       // handle empty notice
 *       emptyNotice.style.display =
 *         visibleBrickElements.length === 0 ? "block" : "none";
 *
 *       ScrollTrigger.refresh();
 *
 *       // hide new bricks
 *       gsap.set(newBricksElements, { opacity: 0 });
 *
 *       // fade in bricks
 *       gsap.to(visibleBrickElements, {
 *         opacity: 1,
 *         duration: 0.3,
 *         ease: "power1.inOut",
 *         onComplete: () => {
 *           // callback after
 *           ScrollTrigger.refresh();
 *         },
 *       });
 *     },
 *   },
 * });
 *
 */
const Bricklayer = (brickElements, options) => {
  let callbackOnStart = () => {};
  let callbackOnEnd = () => {};
  let renderTarget = () => {};
  let bricks = [];
  let dataset = [];
  let appendContainer;
  let classTemplate = [];
  let templatePointer = 0;
  let uidKey;

  const init = () => {
    // check if required params are given
    if (typeof options.render.target !== "function") {
      console.error("Bricklayer: render function is not given.");
    }

    if (typeof options.load.dataset === "undefined") {
      console.error("Bricklayer: dataset is not given.");
    }

    if (typeof options.data.uidKey === "undefined") {
      console.error("Bricklayer: uidKey is not given.");
    }

    // callback before
    if (typeof options.callbacks.onStart === "function") {
      callbackOnStart = options.callbacks.onStart;
    }

    // callback after
    if (typeof options.callbacks.onEnd === "function") {
      callbackOnEnd = options.callbacks.onEnd;
    }

    // init vars
    renderTarget = options.render.target;
    classTemplate = options.append.classTemplate;
    appendContainer = options.append.container || brickElements.parentElement;
    dataset = JSON.parse(JSON.stringify(options.load.dataset));
    uidKey = options.data.uidKey;

    // encapsulate brick elements into objects
    brickElements.forEach((brickEl) => {
      bricks.push({
        domEl: brickEl,
      });
    });
  };

  const waitForOnStartPromise = (affectedBricksElements) => {
    return new Promise((resolve) => {
      const onStartResponse = callbackOnStart(affectedBricksElements);

      if (onStartResponse instanceof Promise) {
        // If onStart callback returns a Promise, wait for it to resolve
        onStartResponse.then(resolve);
      } else {
        // If onStart callback does not return a Promise, resolve immediately
        resolve();
      }
    });
  };

  const update = (newDataset) => {
    // check if newDataset is an array
    if (!Array.isArray(newDataset)) {
      console.error("Bricklayer: newDataset is not an array");
    }

    // check if newDataset is the same as the old one (no changes)
    if (isDatasetEqual(dataset, newDataset)) {
      return;
    }

    // reset visibility of all items
    dataset.forEach((item) => {
      item.hidden = false;
    });

    // reset bricks
    bricks.forEach((brick) => {
      brick.willChange = false;
      brick.isNew = false;
      brick.change = null;
    });

    // add new items to the dataset
    const newItems = findDatasetDiff(dataset, newDataset, uidKey);
    newItems.forEach((item) => {
      // add missing props and add to dataset
      item.hidden = false;
      dataset.push(item);
    });

    // find items in the dataset that are missing in the new dataset and hide them
    const missingItems = findDatasetDiff(newDataset, dataset, uidKey);
    missingItems.forEach((item) => {
      item.hidden = true;
    });

    // re-render
    const affectedBricks = preRender(dataset.filter((item) => !item.hidden));

    // find affected bricks that are not new
    const affectedExistingBricks = affectedBricks.filter((brick) => !brick.isNew);
    const affectedBricksElements = affectedExistingBricks.map((brick) => brick.domEl);
    const newBricks = affectedBricks.filter((brick) => brick.isNew);
    const newBricksElements = newBricks.map((brick) => brick.domEl);

    // run callbacks onStart after promise resolves
    waitForOnStartPromise(affectedBricksElements).then(() => {
      requestAnimationFrame(() => {
        // run brick changes
        affectedBricks.forEach((brick) => {
          if (brick.change !== null) {
            brick.change();
          }
        });

        // get all bricks that are visible
        const visibleBricks = bricks.filter((brick) => brick.domEl.style.display !== "none");
        const visibleBrickElements = visibleBricks.map((brick) => brick.domEl);

        // run callbacks onEnd
        requestAnimationFrame(() => {
          callbackOnEnd(visibleBrickElements, newBricksElements);
        });
      });
    });
  };

  const preRender = (visibleItems) => {
    // get all visible items
    let brickPointer = 0;

    // assign visible items to bricks
    visibleItems.forEach((item, index) => {
      // render inner item if not already rendered
      if (typeof item.domEl === "undefined") {
        const elem = renderTarget(item);

        // unpack elem if it's a brick element
        if (elem.classList.contains("brick")) {
          item.domEl = elem.firstElementChild;
        } else {
          item.domEl = elem;
        }
      }

      // find matching brick for item
      if (bricks[index]) {
        // update existing brick if content is not the same
        const brickEl = bricks[index].domEl;
        if (
          !isPostIdEqual(brickEl.firstElementChild, item.domEl) &&
          !isNodeEqual(brickEl.firstElementChild, item.domEl)
        ) {
          bricks[index].willChange = true;
          bricks[index].change = () => {
            brickEl.innerHTML = "";
            brickEl.style.display = "block";
            brickEl.appendChild(item.domEl);
          };
        }
      } else {
        // create new bricks
        const brickEl = createBrick(item);
        bricks.push({
          willChange: true,
          isNew: true,
          domEl: brickEl,
          change: () => {
            appendContainer.appendChild(brickEl);
          },
        });
      }

      brickPointer = index;
    });

    // hide all remaining bricks
    for (let index = brickPointer + 1; index < bricks.length; index++) {
      const brickEl = bricks[index].domEl;
      bricks[index].willChange = true;
      bricks[index].change = () => {
        brickEl.innerHTML = "";
        brickEl.style.display = "none";
      };
    }

    // return affected bricks
    return bricks.filter((brick) => brick.willChange);
  };

  // static: check if two datasets are equal
  const isDatasetEqual = (a, b) => {
    return a.length === b.length && JSON.stringify(a) === JSON.stringify(b);
  };

  // static: check if two nodes are equal
  const isNodeEqual = (a, b) => {
    if (a === null || b === null) {
      return false;
    }

    return a.isEqualNode(b);
  };

  // static: check if two nodes shae the same post id
  const isPostIdEqual = (a, b) => {
    // check if both nodes are given
    if (a === null || b === null) {
      return false;
    }

    // check if both nodes have dataset
    if (typeof a.dataset === "undefined" || typeof b.dataset === "undefined") {
      return false;
    }

    // compare post ids
    return parseInt(a.dataset.postid) === parseInt(b.dataset.postid);
  };

  // static: find if there are new items in the new dataset
  const findDatasetDiff = (a, b, key) => {
    return b.filter((objB) => {
      return !a.some((objA) => {
        return objA[key] === objB[key];
      });
    });
  };

  const createBrick = (item) => {
    const brickEl = document.createElement("div");
    brickEl.classList.add(...getClassListFromTemplate());
    brickEl.appendChild(item.domEl);
    return brickEl;
  };

  const getClassListFromTemplate = () => {
    if (classTemplate.length === 0) return "";

    // get class from template using pointer as array index
    const classList = classTemplate[templatePointer].split(" ");

    // after getting class, increment pointer and reset if it exceeds the length of the template array
    templatePointer = (templatePointer + 1) % classTemplate.length;

    return classList;
  };

  // init
  init();

  return {
    dataset: update,
  };
};
