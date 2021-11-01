import {
  singleElement,
  multipleElement,
  nameElement,
  toogleDisabler,
  toogleInputValue,
  tooltipList,
  toastTrigger,
} from "./lib";
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

const saveProtocol = singleElement("#save_protocol");
const protocolForm = singleElement("#protocol_form");
if (saveProtocol) {
  saveProtocol.onclick = (e) => {
    var formData = new FormData(protocolForm);
    formData.append("action", "save_protocol");
    formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", _appObject.ajaxUrl, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4) {
        var getData = JSON.parse(xhttp.response);

        console.log(getData.success);
        if (getData.success == false) {
          toastTrigger("error", "This protocol already exists");
        } else {
          toastTrigger("success", "The protocol is saveed successfully");
        }
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
      }
    };
  };
}

const updateProtocol = singleElement("#update_protocol");
const update_id = singleElement("#select_protocol").value;
if (updateProtocol) {
  updateProtocol.onclick = (e) => {
    var formData = new FormData(protocolForm);
    formData.append("action", "update_protocol");
    formData.append("protocol_id", update_id);
    formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", _appObject.ajaxUrl, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4) {
        var getData = JSON.parse(xhttp.response);
        console.log(getData.success);
        if (getData.success == false) {
          toastTrigger("error", "This protocol already exists");
        } else {
          toastTrigger("success", "The protocol is updated successfully");
        }
      }
    };
  };
}

const deleteProtocol = singleElement("#delete_protocol");
const delete_id = deleteProtocol.dataset.id;
if (deleteProtocol) {
  deleteProtocol.onclick = (e) => {
    if (
      confirm("Are you sure you want to " + delete_id + " from the database?")
    ) {
      var formData = new FormData();
      formData.append("action", "delete_protocol");
      formData.append("protocol_id", update_id);
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
              page: page,
              nav: "protocol",
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
    console.log(url.origin + url.pathname);
    let page = url.searchParams.get("page");
    let nav = url.searchParams.get("nav");
    const params = new URLSearchParams({
      page: page,
      nav: nav,
      edit: e.target.value,
    });
    const pushUrl = `${url.origin + url.pathname}?${params.toString()}`;
    window.location = pushUrl;

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
