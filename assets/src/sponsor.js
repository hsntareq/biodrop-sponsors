import {
  singleElement,
  multipleElement,
  nameElement,
  toogleDisabler,
  toogleInputValue,
  tooltipList,
  toastTrigger,
  elemByID,
  elemByClasses,
  elemByName,
} from "./lib";

import './imask.min.js';

IMask(document.getElementById('card_number'), {
  mask: '0000-0000-0000-0000',
  lazy: false,
  placeholderChar: '_'
});
IMask(document.getElementById('expiration_date'), {
  mask: '00/00',
  lazy: false,
  placeholderChar: '_'
});
IMask(document.getElementById('card_cvv'), {
  mask: '000',
  lazy: false,
  placeholderChar: '_'
});

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
  };
}

const newCardButton = elemByID('new_card_button');
const newCardClasses = newCardButton && newCardButton.classList;
const toggleFormBtn = newCardButton.querySelector('i').classList;
const toggleFormBtnText = newCardButton.querySelector('span');
const addCreditCard = elemByID('add_credit_card');
const ccClasses = addCreditCard.classList;
const creditCardForm = elemByID('credit_card_form');
const cardSubmitBtn = elemByID('card_submit_btn');
newCardButton.onclick = (e) => {
  // console.log(newCardButton.contains('btn'));
  toggleFormBtnText.innerText = toggleFormBtnText.innerText == 'New Card' ? 'Close Form' : 'New Card';
  toggleFormBtn.contains('fa-plus') ? toggleFormBtn.remove('fa-plus') : toggleFormBtn.add('fa-plus');
  toggleFormBtn.contains('fa-minus') ? toggleFormBtn.remove('fa-minus') : toggleFormBtn.add('fa-minus');
  newCardClasses.contains('btn-success') ? newCardClasses.remove('btn-success') : newCardClasses.add('btn-success');
  newCardClasses.contains('btn-danger') ? newCardClasses.remove('btn-danger') : newCardClasses.add('btn-danger');
  ccClasses.contains('visually-hidden') ? ccClasses.remove('visually-hidden') : ccClasses.add('visually-hidden');
}

let wasSubmit = false;
creditCardForm.onsubmit = (e) => {
  e.preventDefault();
  wasSubmit = !wasSubmit ? true : false;
  if (!wasSubmit) {
    return;
  }
  cardSubmitBtn.disabled = true;
  cardSubmitBtn.querySelector('.spinner-grow').classList.remove('visually-hidden');
  var formData = new FormData(creditCardForm);
  formData.append("action", "add_credit_card");
  // formData.append("protocol_id", deleteProtocol.dataset.id);
  formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", _appObject.ajaxUrl, true);
  xhttp.send(formData);
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4) {
      var getData = JSON.parse(xhttp.response).data;

      getData.forEach((item, i) => {
        console.log(item, i);
      })
      /* if (getData.success == true) {
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
      } */

      setTimeout(() => {
        cardSubmitBtn.disabled = false;
        cardSubmitBtn.querySelector('.spinner-grow').classList.add('visually-hidden');
        wasSubmit = true;
        creditCardForm.reset();
      }, 1000)
    }
  };
}

const user_card_view = (sl, id, card, name, number, exp_month, exp_year) => {
  return `
    <tr class="align-middle">
      <th scope="row">${sl}</th>
      <td>
        <i class="fa-2x ${card} fab fa-cc-mastercard"></i>
      </td>
      <td>${name}</td>
      <td>${number}</td>
      <td>${exp_month}/${exp_year}</td>
      <td>
      <div class="btn-group" role="group" aria-label="Basic outlined example">
        <button type="button" class="btn btn-sm btn-outline-primary" data-id="${id}">
          <i class="far fa-edit"></i>
        </button>
        <button type="button" class="btn btn-sm btn-outline-danger" data-id="${id}">
          <i class="far fa-trash-alt"></i>
        </button>
      </div>
      </td>
    </tr>
  `;
}