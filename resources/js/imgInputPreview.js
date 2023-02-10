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
    
                    imgElement.classList.add("my-5", "text-center", "rounded-4");
    
                    imgElement.style.maxHeight = "150px";
    
                    optionalWrapper.append(imgElement);
                }
            }
        } else {
            imgsError.classList.remove('d-none');
        }
    });
}




// FUNCTIONS

function showPreview(img, element) {
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        element.src = reader.result;
    });

    reader.readAsDataURL(img);
}
