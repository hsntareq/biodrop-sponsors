import {
  singleElement,
  multipleElement,
  nameElement,
  toogleDisabler,
  toogleInputValue,
  tooltipList,
  toastTrigger,
} from "./lib";

const btn_spinner = (button) => {
  let btn = document.querySelector(button);
  console.log(btn.nextElementSibling);
};
// const protocolForm = singleElement(".protocol_form");

let toggles = multipleElement("input.form-toggle-input");
for (let i = 0; i < toggles.length; i++) {
  toggles[i].onchange = (event) => {
    toogleDisabler(event.target);
    toogleInputValue(event.target);
  };
  toogleDisabler(toggles[i]);
  toogleInputValue(toggles[i]);
}

String.prototype.toCapitalize = function () {
  return this.toLowerCase().replace(/^.|\s\S/g, function (a) {
    return a.toUpperCase();
  });
};

const present_item = multipleElement(".preset-item");
if (present_item) {
  Array.from(multipleElement(".preset-item")).forEach(
    (elm) =>
      (elm.onclick = (e) => {
        console.log(elm.dataset.preset);
        let presetName = elm.dataset.preset;

        Array.from(present_item).forEach((el) => el.classList.remove("active"));

        elm.classList.add("active");
        var formData = new FormData();
        formData.append("action", "get_protocol_by_name");
        formData.append("protocol_name", presetName);
        formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", _appObject.ajaxUrl, true);
        xhttp.send(formData);
        xhttp.onreadystatechange = function () {
          if (xhttp.readyState === 4) {
            console.log(JSON.parse(xhttp.response));
            var getData = JSON.parse(xhttp.response);
            if (getData.data) {
              Object.entries(getData.data).forEach(([key, value]) => {
                var fieldValue = nameElement(key);
                if (0 !== fieldValue.length) {
                  nameElement(key)[0].value = value;
                }
              });
            }
            toastTrigger(
              "success",
              'The "' +
                presetName.toCapitalize() +
                '" preset protocol is selected'
            );
          }
        };
      })
  );
}
const toggleClassSpinner = (thisBtn) => {
  let hiddenClass = "visually-hidden";
  let btnSpinner = thisBtn.nextElementSibling.classList;
  true == btnSpinner.contains(hiddenClass)
    ? btnSpinner.remove(hiddenClass)
    : btnSpinner.add(hiddenClass);
};
const createProtocol = singleElement("#create_protocol");
const protocolForm = singleElement("#protocol_form");
if (protocolForm && createProtocol) {
  createProtocol.onclick = () => {
    protocolForm.onsubmit = (e) => {
      e.preventDefault();
      toggleClassSpinner(createProtocol);
      console.log(12);
      var formData = new FormData(protocolForm);
      formData.append("action", "save_protocol");
      formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
      const xhttp = new XMLHttpRequest();
      xhttp.open("POST", _appObject.ajaxUrl);
      xhttp.send(formData);
      xhttp.onreadystatechange = function () {
        console.log("fasle");
        if (xhttp.readyState === 4) {
          console.log("not working");
          var getData = JSON.parse(xhttp.response);
          console.log(getData);
          // console.log(getData.success);
          if (getData.success == false) {
            toastTrigger("error", "This protocol already exists");
          } else {
            toastTrigger("success", "The protocol created successfully");
          }
          setTimeout(() => {
            toggleClassSpinner(createProtocol);
          }, 900);

          const url = new URL(window.location);
          console.log(url.origin + url.pathname);
          let page = url.searchParams.get("page");
          let nav = url.searchParams.get("nav");
          const params = new URLSearchParams({
            page: page,
          });
          const pushUrl = `${url.origin + url.pathname}?${params.toString()}`;
          setTimeout(() => {
            window.location = pushUrl;
          }, 1000);
        }
      };
    };
  };
}

const updateProtocol = singleElement("#update_protocol");
// const update_id = singleElement("#select_protocol");
// update_id = update_id.value;
if (updateProtocol) {
  updateProtocol.onclick = (e) => {
    protocolForm.onsubmit = (e) => {
      e.preventDefault();
      toggleClassSpinner(updateProtocol);
      var formData = new FormData(protocolForm);
      formData.append("action", "update_protocol");
      formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
      const xhttp = new XMLHttpRequest();
      xhttp.open("POST", _appObject.ajaxUrl);
      xhttp.send(formData);
      xhttp.onreadystatechange = function () {
        console.log("fasle");
        if (xhttp.readyState === 4) {
          console.log("not working");
          var getData = JSON.parse(xhttp.response);
          console.log(getData);
          if (getData.success == false) {
            toastTrigger("error", "This protocol already exists");
          } else {
            toastTrigger("Updated", "The protocol is updated successfully");
          }
          setTimeout(() => {
            toggleClassSpinner(updateProtocol);
          }, 900);

          /*
          const url = new URL(window.location);
          console.log(url.origin + url.pathname);
          let page = url.searchParams.get("page");
          let nav = url.searchParams.get("nav");
          const params = new URLSearchParams({
            page: page,
            nav: "protocol-new",
          });
          const pushUrl = `${url.origin + url.pathname}?${params.toString()}`;
          setTimeout(() => {
            window.location = pushUrl;
          }, 1000);
          */
        }
      };
    };
  };
}

const deleteProtocol = singleElement("#delete_protocol");
if (deleteProtocol) {
  deleteProtocol.onclick = (e) => {
    if (confirm("Are you sure you want to  from the database?")) {
      var formData = new FormData();
      formData.append("action", "delete_protocol");
      formData.append("protocol_id", deleteProtocol.dataset.id);
      formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
      const xhttp = new XMLHttpRequest();
      xhttp.open("POST", _appObject.ajaxUrl, true);
      xhttp.send(formData);
      xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4) {
          var getData = JSON.parse(xhttp.response);
          console.log(xhttp.response);
          if (getData.success == true) {
            toastTrigger("success", "The protocol is deleted successfully");

            const url = new URL(window.location);
            console.log(url.origin + url.pathname);
            let page = url.searchParams.get("page");
            let nav = url.searchParams.get("nav");
            const params = new URLSearchParams({
              page: "protocol",
            });
            const pushUrl = `${url.origin + url.pathname}?${params.toString()}`;
            setTimeout(() => {
              window.location = pushUrl;
            }, 1000);
          }
        }
      };
    }
    return false;
  };
}

const selectProtocol = singleElement("#select_protocol");
if (selectProtocol) {
  selectProtocol.onchange = (e) => {
    var formData = new FormData();
    // console.log(window.location.search);
    // History push
    const url = new URL(window.location);
    let page = url.searchParams.get("page");
    const params = new URLSearchParams({
      page: page,
      edit: e.target.value,
    });
    window.location = `${url.origin + url.pathname}?${params.toString()}`;

    // window.location = pushUrl;

    // window.location = pushUrl;

    // var searchParams = new URLSearchParams(window.location.search);
    // searchParams.set("edit", e.target.value);

    // console.log(searchParams.toString());

    /* formData.append("protocol_id", e.target.value);
    formData.append("action", "get_selected_protocol");
    formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", _appObject.ajaxUrl, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4) {
        var getData = JSON.parse(xhttp.response);
        console.log(getData);
        if (getData.data) {
          Object.entries(getData.data).forEach(([key, value]) => {
            var fieldValue = nameElement(key);
            if (0 !== fieldValue.length) {
              nameElement(key)[0].value = value;
            }
          });
        }
        toastTrigger("success", "The protocol has been changed.");
        console.log(JSON.parse(xhttp.response));
      }
    }; */
  };
}
