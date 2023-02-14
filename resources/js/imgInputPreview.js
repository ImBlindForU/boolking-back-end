const inputImg = document.getElementById("cover_img");
const imgPrew = document.getElementById("image_preview");
const optionalImgs = document.getElementById("images");
const optionalWrapper = document.getElementById("optional-imgs-div");
const imgsError = document.getElementById("imgs-error");

if (inputImg && imgPrew) {
    inputImg.addEventListener("change", function () {
        const uploadedImg = this.files[0];

        if (uploadedImg) {
            showPreview(uploadedImg, imgPrew);
        }
    });
}

if (optionalImgs && optionalWrapper) {
    
    optionalImgs.addEventListener("change", function () {
        const uploadedImgs = this.files;

        optionalWrapper.innerHTML = "";

        if (uploadedImgs.length <= 4) {
            for (let i = 0; i < uploadedImgs.length; i++) {
    
                const thisImg = uploadedImgs[i];
                
                if (thisImg) {
                    const imgElement = document.createElement("img");
    
                    showPreview(thisImg, imgElement);
    
                    imgElement.classList.add( "text-center", "rounded-4");
    
                    imgElement.style.maxHeight = "150px";
    
                    optionalWrapper.append(imgElement);
                }
            }
        } else {
            imgsError.classList.remove('d-none');
        }
    });
}

//Checkbox validation
const checkboxServices = document.querySelectorAll('.services-check');
const submitBtn = document.getElementById('submit-btn');

let placeholder = 0;

checkboxServices.forEach((checkbox) => {
    if(checkbox.checked){
        placeholder++
    }
    checkbox.addEventListener('change', function(){
        if(checkbox.checked){
            placeholder++
        } else {
            placeholder--
        }
    })
})

const serviceError = document.getElementById('service-error')

submitBtn.addEventListener('click', (event)=>{
    if(placeholder === 0){
        event.preventDefault();
        serviceError.innerHTML = 'Inserisci almeno un servizio';
        serviceError.style.color = 'red';
    } else {
        serviceError.innerHTML = "";
    }
})


// FUNCTIONS

function showPreview(img, element) {
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        element.src = reader.result;
    });

    reader.readAsDataURL(img);
}
