"use strict";

const FmaAsyncLoader = (endpoint) => {
  // stores running requests. used to prevent multiple requests for the same data while a request is waiting for server response
  const runningRequests = new Set();

  // stores filter combinations that lead to empty response from the server. used to prevent unnecessary fetch requests
  const deadEnds = new Set();

  // checks if a fetch requests for a given filter combination is running at the moment
  const isRequestRunning = (params = {}) => {
    return runningRequests.has(JSON.stringify(params));
  };

  // checks if a given filter combination is already considered a "dead end"
  const isDeadEnd = (params = {}) => {
    return deadEnds.has(JSON.stringify(params));
  };

  // abstraction of the fetch API that prevents unnecessary requests
  const fetchData = async (params = {}, method = "GET") => {
    try {
      const paramString = JSON.stringify(params);
      let url = endpoint;
      let data;

      // guard 1 – check if there are no more items to load and return empty array if so
      if (isDeadEnd(params)) {
        return {
          new_items: [],
          num_remaining: 0,
          response_type: "dead_end",
        };
      }

      // guard 2  – check if request is already running and return empty array if so
      if (isRequestRunning(params)) {
        return {
          new_items: [],
          num_remaining: -1,
          response_type: "already_running",
        }; // -1 means unknown
      }

      // register as running requests
      runningRequests.add(paramString);

      // prepare fetch options
      const fetchOptions = {
        method,
        headers: { "Content-Type": "application/json; charset=UTF-8" },
      };

      if (method === "POST") {
        fetchOptions.body = paramString;
      } else if (method === "GET") {
        url += "?" + new URLSearchParams(params).toString();
      }

      // run request
      const response = await fetch(url, fetchOptions);
      data = await response.json();
      data.response_type = "fetch_success";

      // check if there are no more items to load and add to deadEnds if so
      if (data.num_remaining === 0) {
        deadEnds.add(paramString);
      }

      // remove from running requests and return data
      runningRequests.delete(paramString);
      return data;
    } catch (error) {
      console.error("An error occurred while fetching the data:", error);
    }
  };

  return Object.freeze({ isRequestRunning, isDeadEnd, fetchData });
};
