const singleElement = (el) => {
  return document.querySelector(el);
};
const multipleElement = (el) => {
  return document.querySelectorAll(el);
};

const nameElement = (name) => {
  return document.getElementsByName(name);
};

const toogleDisabler = (elem) => {
  let toBeChange = elem.closest(".sp-row").querySelectorAll(".change-field");

  for (let i = 0; i < toBeChange.length; i++) {
    null != toBeChange[i]
      ? elem.checked == false
        ? (toBeChange[i].disabled = true)
        : (toBeChange[i].disabled = false)
      : false;
  }
};

const toogleInputValue = (elem) => {
  elem.previousElementSibling.value = elem.checked == true ? "on" : "off";
};

var tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

const toastTrigger = (type, message) => {
  var toastLiveExample = document.getElementById("liveToast");
  var toast = new bootstrap.Toast(toastLiveExample);
  toastLiveExample.querySelector(".toast-body").innerText = message;
  toast.show();
};
export {
  singleElement,
  multipleElement,
  nameElement,
  toogleDisabler,
  toogleInputValue,
  tooltipList,
  toastTrigger,
};
