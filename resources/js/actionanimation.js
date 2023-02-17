const menuButtons = document.querySelectorAll('.more-button');

const menuWrappers = document.querySelectorAll('.list-container');

if(menuButtons){
    menuButtons.forEach((button, index) => {
       button.addEventListener('click', function (e) {
            e.stopPropagation();
            menuWrappers[index].classList.toggle('active');
            if (window.location.pathname == "/user/estates") {
                window.addEventListener('click', function(){
                    if(menuWrappers[index].classList.contains('active')){
                        menuWrappers[index].classList.remove('active');
                    }
                })
            }
        });
    });
}