
const queryAll = document.querySelectorAll('.more-button');
console.log(queryAll);

const queryAllptDue = document.querySelectorAll('.list-container');
queryAll.forEach((query, index) => {
   query.addEventListener('click', function () {
    queryAllptDue[index].classList.toggle('active');
    });
});

// const queryName = document.querySelectorAll('.active')
// console.log(queryName);
// if (window.location.pathname == "/user/estates") {
//     const body = document.querySelector('body');
//     body.addEventListener('click', function () {
//         console.log('fuori')
        
//         if(queryName.length > 0){
//             queryAllptDue.forEach(query => {
//             query.classList.remove('active')

//             console.log('dentro')

//        });
//     }
//     });
// }