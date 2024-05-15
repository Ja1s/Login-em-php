const email = document.getElementById('email');
const pass = document.getElementById('pass');
const btn = document.getElementById('btn');
const btnContainer = document.querySelector('.btn-container');
const form = document.querySelector('form');
const msg = document.querySelector('.msg');
  btn.disabled = true;
function shiftButton() {
showMsg();
const positions = ['shift-left', 'shift-top', 'shift-right', 'shift-bottom'];
const currentPosition = positions.find(dir => btn.classList.contains(dir));
const nextPosition =
positions[(positions.indexOf(currentPosition) + 1) % positions.length];
btn.classList.remove(currentPosition);
btn.classList.add(nextPosition);
}
function showMsg() {
    const isEmpty = email.value === '' || pass.value === '';
    const isMinLength = pass.value.length >= 3;
    let min_length = 3;

    btn.classList.toggle('no-shift', !isEmpty);
    if (isEmpty || !isMinLength) {
        btn.disabled = true;
        msg.style.color = 'rgb(218 49 49)';
        msg.innerText = 'Por favor, preencha os campos corretamente antes de prosseguir';
    } else {
        msg.innerText = 'Ótimo! Podemos prosseguir';
        msg.style.color = '#92ff92';
        btn.disabled = false;
        btn.classList.add('no-shift');
    }
}

btnContainer.addEventListener('mouseover', shiftButton);
btn.addEventListener('mouseover', shiftButton);
btn.addEventListener('touchstart', shiftButton);
form.addEventListener('input',showMsg)
