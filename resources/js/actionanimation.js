
const queryAll = document.querySelectorAll('.more-button');
console.log(queryAll);

const queryAllptDue = document.querySelectorAll('.list-container');
queryAll.forEach((query, index) => {
   query.addEventListener('click', function () {
    queryAllptDue[index].classList.toggle('active');
    });
});
    