/**
 * AsyncFormHandler — An ES6 component that handles form submission asynchronously.
 *
 * Usage:
 * const formHandler = AsyncFormHandler(document.querySelector('#myForm'));
 * formHandler.onSuccess((data) => { console.log('Success!', data); });
 * formHandler.onValidationError((data) => { console.log('Form is invalid!', data); });
 * formHandler.onSubmitError((error) => { console.log('Network error!', error); });
 *
 * Required HTML structure:
 * <div class="form-wrap">
 *   <form id="myForm" action="/submit-form-endpoint" method="post">
 *     <input type="text" name="username">
 *     <input type="password" name="password">
 *     <button type="submit">Submit</button>
 *   </form>
 * </div>
 */

const AsyncFormHandler = (formWrap) => {
  const formEl = formWrap.querySelector("form");
  const successCallbacks = [];
  const validationErrorCallbacks = [];
  const submitErrorCallbacks = [];

  formEl.addEventListener("submit", (event) => {
    event.preventDefault();
    _submitForm();
  });

  const _submitForm = async () => {
    const formData = new FormData(formEl);
    formData.append("action", "form_submit");

    formWrap.classList.add("is-sending");

    try {
      const response = await fetch("/wp-admin/admin-ajax.php", {
        method: formEl.method,
        body: formData,
      });

      formWrap.classList.remove("is-sending");

      // check for network error
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      // network success (form might still be invalid)
      const data = await response.json();

      // check form validation
      if (data.status === "success") {
        // Form is valid
        _triggerCallbacks(successCallbacks, data);
      } else if (data.status === "error") {

        // Loop over error message elements and update them
        formWrap.querySelectorAll(".error-msg").forEach((errorEl) => {
          // check if there is a new message for this error element
          const fieldObj = data.fields.find(
            (fieldObj) => fieldObj.placeholder_id === errorEl.id
          );

          errorEl.textContent = fieldObj ? fieldObj.error_message : "";
        });

        // show submit error message
        const submitErrorEl = formWrap.querySelector(".submit-error");
        submitErrorEl.textContent = submitErrorEl && data.submit_error ? data.submit_error : "";

        // find the first error element and scroll to it
        _triggerCallbacks(validationErrorCallbacks, data);
      } else {
        throw new Error(`Server error: ${data.status}`);
      }
    } catch (error) {
      _triggerCallbacks(submitErrorCallbacks, error);
    }
  };

  const onSuccess = (callback) => {
    successCallbacks.push(callback);
  };

  const onValidationError = (callback) => {
    validationErrorCallbacks.push(callback);
  };

  const onSubmitError = (callback) => {
    submitErrorCallbacks.push(callback);
  };

  const _triggerCallbacks = (callbacks, data) => {
    callbacks.forEach((callback) => {
      callback(data);
    });
  };

  // exposed 'public' functions
  return Object.freeze({
    onSuccess,
    onValidationError,
    onSubmitError,
  });
};
