"use strict";

(() => {
  // MAIN SELECTOR
  const fmaContainer = document.getElementById("fma-container");

  // GUARD: if there is no post type on the grid, then return
  if (!fmaContainer) return;

  // ELEMENTS
  const gridWrap = fmaContainer.querySelector(".mixitup-grid");
  const filterWrap = document.querySelector(".filter-wrap");

  const emptyNotice = fmaContainer.querySelector(".empty-notice");
  const initialDataWrapper = fmaContainer.querySelector("#initial-data-wrapper");

  // GUARD: if there is no post type on the grid, then return
  if (!gridWrap || !gridWrap.getAttribute("data-posttype")) {
    console.error("grid wrap not found or post type data attribute is missing");
    return;
  }

  const loadMoreButton = document.querySelector(".load-more");

  // INIT DATASET
  const dataset = initialDataWrapper ? JSON.parse(initialDataWrapper.textContent) : [];

  // console.log(dataset);

  // SETUP ENGINE MODULES
  const filterEngine = FmaFilterEngine();

  const asyncLoader = FmaAsyncLoader(`/wp-json/fma-load-more/${gridWrap.dataset.posttype}`); // [TODO: uncomment when you want to use ajax loading]
  // const infiniteScroll = FmaInfiniteScrollHandler(gridWrap); // [TODO: uncomment when you want to use infinite scroll]
  // const urlHandler = FmaUrlHandler(filterEngine); [TODO: uncomment when you want to use urlHandler]

  // REGISTER FILTERS
  if (typeof filterEngine !== "undefined") {
    const filterButtons = filterWrap?.querySelectorAll(".filter-button.cat-filter");
    const resetButton = filterWrap?.querySelector(".clear-filters");

    const filters = [];

    if (filterButtons && filterButtons.length > 0 && resetButton) {
      filters.push(
        FmaTaxonomyFilter({
          filterLogic: "OR",
          filterButtons: filterButtons,
          resetButton: resetButton,
        })
      );
    }

    // [TODO: uncomment when you want to use a search field.]
    // const searchInput = filterWrap?.querySelector(".search-input");
    // const clearSearch = filterWrap?.querySelector(".clear-search");
    // if (searchInput && clearSearch) {
    //   filters.push(
    //     FmaTextInputFilter({
    //       searchInputElement: searchInput,
    //       resetButton: clearSearch,
    //     })
    //   );
    // }

    if (filters.length > 0) {
      filterEngine.registerFilters(filters);
    }
  }
  // SETUP MIXITUP

  // console.log(dataset);

  const mixer = mixitup(gridWrap, {
    data: {
      uidKey: "id",
    },
    load: {
      dataset: dataset,
    },
    render: {
      target: (item) => {
        return item.html;
      },
    },
    animation: {
      duration: 350,
      effects: "fade translateX(-0.5rem)",
      easing: "ease-in-out",
    },
    callbacks: {
      onMixEnd: (state) => {
        // shandle empty notice
        emptyNotice.style.visibility = state.totalShow === 0 ? "visible" : "hidden";

        // update scrollTrigger
        ScrollTrigger.refresh();
      },
    },
  });

  // DO FILTERING AND UPDATE GRID
  const updateGrid = () => {
    if (typeof filterEngine !== "undefined") {
      mixer.dataset(filterEngine.applyFilters(dataset));
    }
  };

  // AJAX LOADING
  const ajaxLoadMore = () => {
    // guard
    if (typeof asyncLoader === "undefined") return;

    // get params
    const params = {
      existing_ids: dataset.map((it) => it.id),
      post_type: gridWrap.dataset.posttype,
      ...(typeof filterEngine !== "undefined" ? filterEngine.getFilterObject() : {}),
    };

    // fetch data
    asyncLoader.fetchData(params).then((response) => {
      // add post to dataset if id does not yet exist in existingIds
      if (response.new_items.length > 0) {
        response.new_items.forEach((post) => {
          if (!dataset.find((it) => it.id === post.id)) {
            dataset.push(post);
          }
        });

        // hide load more button if there are no more items
        if (response.num_remaining === 0) {
          loadMoreButton.classList.add("disabled");
        }

        updateGrid();
      }
    });

    setTimeout(() => {
      ScrollTrigger.refresh();
      lenis.resize();
    }, 1000);
  };

  // ON FILTER CHANGE -> UPDATE URL AND GRID
  if (typeof filterEngine !== "undefined") {
    filterEngine.onFilterTrigger((filterAction) => {
      // update url and grid
      if (typeof urlHandler !== "undefined") {
        urlHandler.updateURL();
      }
      updateGrid();

      // trigger load more only if filters are added
      if (filterAction !== "reset" || filterAction !== "remove") {
        ajaxLoadMore();
      }
    });
  }

  // ON SCROLL -> TRIGGER LOAD MORE
  if (typeof infiniteScroll !== "undefined") {
    infiniteScroll.onIntersection(ajaxLoadMore);
  }

  // ON LOAD -> LOAD FILTERS FROM URL
  if (typeof urlHandler !== "undefined") {
    urlHandler.updateFiltersFromURL();
  }

  // ON CLICK -> LOAD MORE
  if (loadMoreButton) {
    loadMoreButton.addEventListener("click", ajaxLoadMore);
  }
})();
