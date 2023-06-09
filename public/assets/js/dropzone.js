const dropzones = document.querySelectorAll('.dropzone.main .dd-area');
const fileInputs = document.querySelectorAll('.dropzone.main .dd-area input');
const dzMessages = document.querySelectorAll('.dropzone.main .dd-area .dz-message');
const btnBrowseFiles = document.querySelectorAll('.dropzone.main .btn.btn-browser-file');

Array.from(btnBrowseFiles).forEach((button, index) => {
    button.onclick = () => {
        fileInputs[index].value = null;
        fileInputs[index].click();
    }
})
Array.from(fileInputs).forEach((input, index) => {
    input.onchange = () => {
        if (input.files.length > 0) {
            handlerShowFile(input.files[0], input);
        } else {
            console.log("chưa chọn file kìa ml")
        }

    }
})
Array.from(dropzones).forEach((dz, index) => {

    let counter = 0;
    let dzMessage = dzMessages[index];

    //If user Drag File Over dropzone
    dz.ondragenter = (event) => {
        event.preventDefault();
        counter++;
        dz.classList.add('dd-active');
        dzMessage.textContent = "Release to Upload File.";
    }

    dz.ondragover = (event) => {
        event.preventDefault();
    }

    //If user leave dragged File from dropzone
    dz.ondragleave = (event) => {
        // event.preventDefault();
        counter--;
        if (counter === 0) {
            dz.classList.remove('dd-active');
            dzMessage.textContent = "Drop files here to upload.";
        }
    }

    //If user drop File on dropzone
    dz.ondrop = (event) => {
        event.preventDefault();
        counter = 0;
        dz.classList.remove('dd-active');
        dzMessage.textContent = "Drop files here to change file upload.";
        let file = event.dataTransfer.files;
        fileInputs[index].files = file;
        handlerShowFile((file[0]), dz);
    }
})


function handlerShowFile(file, element) {
    const formGroup = getParentElement(element, '.form-group');
    const fileType = file.type.split('/').shift();

    if (formGroup.classList.contains('invalid')) {
        formGroup.classList.remove('invalid');
        formGroup.querySelector('.form-message').textContent = '';
    }

    //convert file size
    const fileSizeKb = Math.floor(file.size / 1024);
    let fileSize = (fileSizeKb < 1024) ? fileSizeKb + 'KB' : (fileSizeKb / 1000).toFixed(2) + 'MB';
    let fileName = file.name;
    if (fileName.length >= 25) {
        let splitName = fileName.split('.');
        fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
    }

    const ddPreview = formGroup.querySelector('.dd-preview');
    const fileAction = formGroup.querySelector('input[type="file"]').getAttribute('name');
    const htmls = `
        <div class="card mt-1 mb-0 border">
            <div class="p-2 file ${fileType}">
                <div class="item">
                    <div class="file-head">
                        <div class="image-preview ${fileAction}"></div>
                    </div>
                    <div class="file-main">
                        <div class="file-name"><span class="h6">${fileName}<span></div>
                        <div class="file-size"><span>${fileSize}</span></div>
                    </div>
                </div>
            </div>
        </div>
    `;

    ddPreview.innerHTML = htmls;
    if (fileType === 'image') {
        const reader = new FileReader();
        const image = new Image();
        reader.onload = () => {
            image.src = reader.result;
        };
        if (file) {
            reader.readAsDataURL(file);
        }
        ddPreview.querySelector(`.image-preview.${fileAction}`).appendChild(image);
    } else {
        ddPreview.querySelector(`.image-preview.${fileAction}`).innerHTML = '<i class="fa-regular fa-file text-primary"></i>';
    }

}

function getParentElement(element, selector) {
    while (element.parentElement) {
        if (element.parentElement.matches(selector)) {
            return element.parentElement;
        }
        element = element.parentElement;
    }
}