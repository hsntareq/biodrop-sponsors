import './imask.min.js';
import './protocols.js';

const cardNumber = document.getElementById('card_number');
if (null !== cardNumber) {
    IMask(cardNumber, {
        mask: '0000-0000-0000-0000',
        lazy: false,
        placeholderChar: '_'
    });
}

const expirationDate = document.getElementById('expiration_date');
if (null !== expirationDate) {
    IMask(expirationDate, {
        mask: '00/00',
        lazy: false,
        placeholderChar: '_'
    });
}

const cardCvv = document.getElementById('card_cvv');
if (null !== cardCvv) {
    IMask(cardCvv, {
        mask: '000',
        lazy: false,
        placeholderChar: '_'
    });
}

