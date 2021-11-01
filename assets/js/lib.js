/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
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
/*!***************************!*\
  !*** ./assets/src/lib.js ***!
  \***************************/
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


/******/ })()
;
//# sourceMappingURL=lib.js.map