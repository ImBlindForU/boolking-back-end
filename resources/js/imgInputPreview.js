const inputImg = document.getElementById("cover_img");
const imgPrew = document.getElementById("image_preview");

if (inputImg && imgPrew) {
    inputImg.addEventListener("change", function () {
        const uploadedImg = this.files[0];

        if (uploadedImg) {
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                imgPrew.src = reader.result;
            });

            reader.readAsDataURL(uploadedImg);
        }
    });
}