import * as bootstrap from 'bootstrap';

const deleteBtns = document.querySelectorAll('.delete-btn');
// const showDeleteBtn = document.getElementById('show-delete-btn');

deleteBtns.forEach((btn) => {
    btn.addEventListener('click', (event) => {
        event.preventDefault();
        console.log('ciao');
        let estateTitle = btn.getAttribute('button-name');
        const modal = new bootstrap.Modal(document.getElementById('delete-modal'));
        document.getElementById('modal-title').innerText = `Sei sicuro di voler eliminare ${estateTitle}?`;
        modal.show();
        document.getElementById('delete').addEventListener('click', () => {
            btn.parentElement.submit();
        })
    })
})