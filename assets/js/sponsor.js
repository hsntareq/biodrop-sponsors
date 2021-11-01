/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/lib.js":
/*!***************************!*\
  !*** ./assets/src/lib.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "singleElement": () => (/* binding */ singleElement),
/* harmony export */   "multipleElement": () => (/* binding */ multipleElement),
/* harmony export */   "nameElement": () => (/* binding */ nameElement),
/* harmony export */   "toogleDisabler": () => (/* binding */ toogleDisabler),
/* harmony export */   "toogleInputValue": () => (/* binding */ toogleInputValue),
/* harmony export */   "tooltipList": () => (/* binding */ tooltipList),
/* harmony export */   "toastTrigger": () => (/* binding */ toastTrigger)
/* harmony export */ });
const singleElement = el => {
  return document.querySelector(el);
};

const multipleElement = el => {
  return document.querySelectorAll(el);
};

const nameElement = name => {
  return document.getElementsByName(name);
};

const toogleDisabler = elem => {
  let toBeChange = elem.closest(".sp-row").querySelectorAll(".change-field");

  for (let i = 0; i < toBeChange.length; i++) {
    null != toBeChange[i] ? elem.checked == false ? toBeChange[i].disabled = true : toBeChange[i].disabled = false : false;
  }
};

const toogleInputValue = elem => {
  elem.previousElementSibling.value = elem.checked == true ? "on" : "off";
};

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

const toastTrigger = (type, message) => {
  var toastLiveExample = document.getElementById("liveToast");
  var toast = new bootstrap.Toast(toastLiveExample);
  toastLiveExample.querySelector(".toast-body").innerText = message;
  toast.show();
};



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*******************************!*\
  !*** ./assets/src/sponsor.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _lib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./lib */ "./assets/src/lib.js");

let toggles = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.multipleElement)("input.form-toggle-input");

for (let i = 0; i < toggles.length; i++) {
  toggles[i].onchange = event => {
    (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toogleDisabler)(event.target);
    (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toogleInputValue)(event.target);
  };

  (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toogleDisabler)(toggles[i]);
  (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toogleInputValue)(toggles[i]);
}

String.prototype.toCapitalize = function () {
  return this.toLowerCase().replace(/^.|\s\S/g, function (a) {
    return a.toUpperCase();
  });
};

const present_item = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.multipleElement)(".preset-item");

if (present_item) {
  Array.from((0,_lib__WEBPACK_IMPORTED_MODULE_0__.multipleElement)(".preset-item")).forEach(elm => elm.onclick = e => {
    console.log(elm.dataset.preset);
    let presetName = elm.dataset.preset;
    Array.from(present_item).forEach(el => el.classList.remove("active"));
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
            var fieldValue = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.nameElement)(key);

            if (0 !== fieldValue.length) {
              (0,_lib__WEBPACK_IMPORTED_MODULE_0__.nameElement)(key)[0].value = value;
            }
          });
        }

        (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toastTrigger)("success", 'The "' + presetName.toCapitalize() + '" preset protocol is selected');
      }
    };
  });
}

const saveProtocol = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.singleElement)("#save_protocol");
const protocolForm = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.singleElement)("#protocol_form");

if (saveProtocol) {
  saveProtocol.onclick = e => {
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
          (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toastTrigger)("error", "This protocol already exists");
        } else {
          (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toastTrigger)("success", "The protocol is saveed successfully");
        }

        const url = new URL(window.location);
        console.log(url.origin + url.pathname);
        let page = url.searchParams.get("page");
        let nav = url.searchParams.get("nav");
        const params = new URLSearchParams({
          page: page,
          nav: "protocol-new"
        });
        const pushUrl = `${url.origin + url.pathname}?${params.toString()}`;
        setTimeout(() => {
          window.location = pushUrl;
        }, 1000);
      }
    };
  };
}

const updateProtocol = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.singleElement)("#update_protocol");
const update_id = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.singleElement)("#select_protocol").value;

if (updateProtocol) {
  updateProtocol.onclick = e => {
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
          (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toastTrigger)("error", "This protocol already exists");
        } else {
          (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toastTrigger)("success", "The protocol is updated successfully");
        }
      }
    };
  };
}

const deleteProtocol = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.singleElement)("#delete_protocol");
const delete_id = deleteProtocol.dataset.id;

if (deleteProtocol) {
  deleteProtocol.onclick = e => {
    if (confirm("Are you sure you want to " + delete_id + " from the database?")) {
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
            (0,_lib__WEBPACK_IMPORTED_MODULE_0__.toastTrigger)("success", "The protocol is deleted successfully");
            const url = new URL(window.location);
            console.log(url.origin + url.pathname);
            let page = url.searchParams.get("page");
            let nav = url.searchParams.get("nav");
            const params = new URLSearchParams({
              page: page,
              nav: "protocol"
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

const selectProtocol = (0,_lib__WEBPACK_IMPORTED_MODULE_0__.singleElement)("#select_protocol");

if (selectProtocol) {
  selectProtocol.onchange = e => {
    var formData = new FormData(); // console.log(window.location.search);
    // History push

    const url = new URL(window.location);
    console.log(url.origin + url.pathname);
    let page = url.searchParams.get("page");
    let nav = url.searchParams.get("nav");
    const params = new URLSearchParams({
      page: page,
      nav: nav,
      edit: e.target.value
    });
    const pushUrl = `${url.origin + url.pathname}?${params.toString()}`;
    window.location = pushUrl; // var searchParams = new URLSearchParams(window.location.search);
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
})();

/******/ })()
;
//# sourceMappingURL=sponsor.js.map