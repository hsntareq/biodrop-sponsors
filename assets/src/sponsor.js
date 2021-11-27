import './inc.js';
import { toastTrigger } from "./lib";



document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'interactive') {
    // console.log('init');
  }
  else if (event.target.readyState === 'complete') {
    setTimeout(() => {
      let page = new URL(window.location);
      page = new URLSearchParams(page.search);
      console.log(page.get('page'));
      page = page.get('page') && page.get('page').replace('/', '');
      if (page === 'settings') {
        loadUserCards();
      }
      ccEditFunction();
    }, 500)
  }
});


const cardListBlock = document.querySelector('#card_list_block');
let cardDataTable = cardListBlock && cardListBlock.querySelector('table');

const loadUserCards = () => {
  var formData = new FormData();
  formData.append("action", "load_user_cards");
  formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", _appObject.ajaxUrl, true);
  xhttp.send(formData);
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4) {
      let getData = JSON.parse(xhttp.response);
      let cardData = getData.data;
      if (true === getData.success) {

        if (0 < cardData.length) {

          if (null !== cardDataTable) {
            ccDataAfterAction(cardDataTable, cardData);
            if (cardDataTable.classList.contains('placeholder')) {
              cardDataTable.classList.remove('placeholder');
            }
            cardDataTable.style.display = 'table';
          }


        } else {
          if (null !== cardDataTable) {
            cardDataTable.style.display = 'none';
          }
        }
      }

      ccDeleteFunction();
      ccEditFunction();

    }
  };
}

const ccDataAfterAction = (table, data) => {
  let tBodyData = '', tBody = table && table.querySelector('tbody');
  data.forEach((item, sl) => {
    tBodyData = tBodyData + `
      <tr class="align-middle">
        <th scope="row">${++sl}</th>
        <td>
          <i class="fa-2x fab fa-cc-${item.name}"></i>
        </td>
        <td>${item.name_on_card}</td>
        <td>${item.card_number}</td>
        <td class="text-center">${item.card_expiration_month}/${item.card_expiration_year}</td>
        <td>
        <div class="btn-group" role="group" aria-label="Basic outlined example">
          <button type="button" class="btn btn-sm btn-outline-primary cc_edit_btn" data-id="${item.id}">
            <i class="far fa-edit"></i>
          </button>
          <button type="button" class="btn btn-sm btn-outline-danger cc_delete_btn" data-id="${item.id}">
            <i class="far fa-trash-alt"></i>
          </button>
        </div>
        </td>
      </tr>`;
  })
  tBody.innerHTML = tBodyData;
}



const btn_spinner = (button) => {
  let btn = document.querySelector(button);
  console.log(btn.nextElementSibling);
};


const newCardButton = document.getElementById('new_card_button');
const newCardClasses = newCardButton && newCardButton.classList;
const toggleFormBtn = newCardButton && newCardButton.querySelector('i').classList;
const toggleFormBtnText = newCardButton && newCardButton.querySelector('span');
const addCreditCard = document.getElementById('add_credit_card');
const creditCardForm = document.getElementById('credit_card_form');
const cardAddBtn = document.getElementById('card_add_btn');
const cardCancelBtn = document.getElementById('card_cancel_btn');
const spinLoader = addCreditCard && addCreditCard.querySelector('.spinner').classList;

if (null !== cardCancelBtn) {
  cardCancelBtn.onclick = (e) => {
    addCreditCard.style.display = 'none';
  }
}
if (null !== newCardButton) {
  newCardButton.onclick = (e) => {
    if (newCardButton.classList.contains('btn-success')) {
      setTimeout(() => {
        spinLoader.add('invisible');
      }, 500)
      creditCardForm.reset();
      spinLoader.remove('invisible');
      addCreditCard.style.display = 'block';
      creditCardForm.dataset.action = 'add_credit_card_action';
      cardAddBtn.innerHTML = '<i class="fad fa-save"></i> <span class="mx-2">Save Card</span>';
    }
  }
}

if (null !== creditCardForm) {
  creditCardForm.onsubmit = (e) => {
    e.preventDefault();

    spinLoader.remove('invisible');

    cardAddBtn.disabled = true;
    // cardAddBtn.querySelector('.spinner-grow').classList.remove('visually-hidden');
    var formData = new FormData(creditCardForm);
    var cardAction = creditCardForm.dataset.action;
    formData.append("card_id", creditCardForm.dataset.card_id);
    formData.append("action", cardAction);

    formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", _appObject.ajaxUrl, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4) {
        let getData = JSON.parse(xhttp.response).data;
        if ('exist' == getData.status) {
          toastTrigger('warning', 'This Card Number already exist!');
          console.log(getData);

        }

        loadUserCards();

        setTimeout(() => {
          cardAddBtn.disabled = false;
          spinLoader.add('invisible');
          'add_credit_card_action' == cardAction ? creditCardForm.reset() : '';
        }, 1000)
      }
    };
  }
}





const ccDeleteFunction = () => {
  const ccDeleteBtn = document.querySelectorAll('.cc_delete_btn');
  ccDeleteBtn.forEach((item) => {
    item.onclick = (e) => {
      console.log(item);
      var formData = new FormData();
      formData.append("action", "delete_user_cards");
      formData.append("cc_id", item.dataset.id);
      formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
      const xhttp = new XMLHttpRequest();
      xhttp.open("POST", _appObject.ajaxUrl, true);
      xhttp.send(formData);
      xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4) {
          let getData = JSON.parse(xhttp.response);
          loadUserCards();
        }
      }
    }
  })
}

const ccEditFunction = () => {
  const ccEditBtn = document.querySelectorAll('.cc_edit_btn');
  ccEditBtn.forEach((item) => {
    item.onclick = (e) => {

      setTimeout(() => {
        spinLoader.add('invisible');
      }, 500)
      spinLoader.remove('invisible');
      addCreditCard.style.display = 'block';

      creditCardForm.dataset.action = 'edit_credit_card_action';
      cardAddBtn.innerHTML = '<i class="fad fa-edit"></i> <span class="mx-2">Update Card</span>';

      var formData = new FormData();
      formData.append("action", "edit_user_cards");
      formData.append("cc_id", item.dataset.id);
      formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
      const xhttp = new XMLHttpRequest();
      xhttp.open("POST", _appObject.ajaxUrl, true);
      xhttp.send(formData);
      xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4) {
          let getData = JSON.parse(xhttp.response);
          loadSingleCard(getData);
          // loadUserCards();
          spinLoader.add('invisible');
        }
      }
    }
  })
}



const loadSingleCard = (getData) => {
  let editData = getData.data.shift();
  creditCardForm.dataset.card_id = editData.id;
  console.log(editData);
  let cardData = [];
  cardData['card_number'] = editData.card_number;
  cardData['expiration_date'] = editData.card_expiration_month + '/' + editData.card_expiration_year;
  cardData['card_cvv'] = editData.card_code;
  cardData['payment_type'] = editData.name;
  cardData['name_on_card'] = editData.name_on_card;

  Object.entries(cardData).forEach(([key, value]) => {
    document.getElementById(key).value = value;
  });
}