const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');
const passwordMessage = document.getElementById('password-message');
const birthdate = document.getElementById('birthdate');
const registerBtn = document.getElementById('register-btn');
const errorDate = document.getElementById('error-date');

if (password && passwordConfirm && passwordMessage) {
    passwordConfirm.addEventListener("input", function () {
        if (this.value == password.value) {
            passwordMessage.innerHTML = 'Le password corrispondono';
            passwordMessage.style.color = 'green';
        } else {
            passwordMessage.innerHTML = 'Le password non corrispondono';
            passwordMessage.style.color = 'red';
        }
    })
}

let now = new Date().getFullYear();
let validDate = now - 18;
console.log(validDate);

if (registerBtn) {
    registerBtn.addEventListener('click', function (event) {
        if (parseInt(birthdate.value) > validDate) {
            event.preventDefault();
            //birthdate.setAttribute('max', now);
            errorDate.innerHTML = 'Devi essere maggiorenne per poterti iscrivere';
            errorDate.style.color = 'red';
        }
        //console.log(parseInt(birthdate.value));
    })
}

