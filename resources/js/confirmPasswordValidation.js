const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');
const passwordMessage = document.getElementById('password-message');


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