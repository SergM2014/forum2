
// find repeated values in two arrays
Array.prototype.intersect = function(a){
    return this.filter(function(i){ return a.indexOf(i) > -1;});
};



let progressContainer = document.getElementById("imageProgressContainer"),
    progress = document.getElementById('imageDownloadProgress'),
    output = document.getElementById('imageDownloadOutput'),
    submit_btn = document.getElementById('downloadImageBtn'),
    reset_btn = document.getElementById('resetImageBtn'),
    delete_img_sign = document.getElementById('deleteImagePreview'),
    imageField =  document.getElementById('file');

class Helper {
    static getCurrentLang(j){

        let url = window.location.href;
        let urlArray = url.split('/');
        let intersection = urlArray.intersect(j.languagesArray);

        let lang = intersection.shift();
        lang = (lang)? lang : j.defaultLanguage;

        return lang;
    }

    static ucFirst(str) {
        // только пустая строка в логическом контексте даст false
        if (!str) return str;

        return str[0].toUpperCase() + str.slice(1);
    }

}


// this background is for imageupload

function progressHandler(event){

    let percent = Math.round((event.loaded/event.total)*100);


    progress.style.width = percent+"%";
   // progress.innerText= percent+"%";
}

function completeHandler(event){//тут ивент переобразуется в XMLHttpRequestProgressEvent {}

    let response = JSON.parse(event.target.responseText);
    output.innerHTML= response.message;


    progress.style.width = "0%";
    output.classList.remove('d-none');

    progressContainer.classList.add('invisible');
    reset_btn.removeAttribute('disabled');

    if(!document.getElementById('manyImagesContainer')) {
        submit_btn.classList.add('d-none');
        if(document.getElementById('imageData'))  document.getElementById('imageData').value = (response.image);

        return;
    }

    //further work with many images;

    let imageName = (document.getElementById("file").files[0].name).toLocaleLowerCase();

    let html = `<div class="image-item"><img class="image" src="/uploads/manyItems/${imageName}" alt=""></div>`;
    document.getElementById('manyImagesContainer').insertAdjacentHTML('beforeEnd', html);
    reset_btn.classList.add('hidden');
    submit_btn.classList.add('hidden');
    imageField.classList.remove('hidden');
    imageField.value = '';

    let imageCustomType = document.getElementById('imageCustomType').value;
    let noPhoto = imageCustomType == 'avatar'? 'noavatar' : 'nophoto';

    document.getElementById('downloadImagePreview').setAttribute('src', '/img/'+noPhoto+'.jpg');
    let imagesList = document.getElementById('imageData').value+','+imageName;

    document.getElementById('imageData').value = imagesList;
}


function errorHandler(event){

    output.innerHTML= 'Upload failed';
}


function abortHandler(event){

    output.innerHTML= 'Upload aborted';
}


//to make previe image using file API


if(document.getElementById('file')) {
    document.getElementById('file').onchange = function () {

        if(delete_img_sign) delete_img_sign.className = 'd-none';

        let input = this;

        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('downloadImagePreview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);

                document.getElementById('file').classList.add('d-none');

                output.classList.add('d-none');

                reset_btn.classList.remove('d-none');

                submit_btn.classList.remove('d-none');

            }// else console.log('is not image mime type');
        }// else console.log('not isset files data or files API not supordet');

    };//end of function
}


//click upload image
if(submit_btn){
    submit_btn.onclick = function(e){

        e.preventDefault();
        progressContainer.classList.remove('invisible');


       // let file = document.getElementById("file").files[0];

         let imageCustomType = document.getElementById('imageCustomType').value;

        let formData = new FormData(document.getElementById('imageForm'));




                let uploadUrl =  "/images/upload"+Helper.ucFirst(imageCustomType);

                let send_image=new XMLHttpRequest();
                send_image.upload.addEventListener("progress", progressHandler, false);
                send_image.addEventListener("load", completeHandler, false);
                send_image.addEventListener("error", errorHandler, false);
                send_image.addEventListener("abort", abortHandler, false);
                send_image.open("POST", uploadUrl);
                send_image.send(formData);


                reset_btn.setAttribute('disabled', 'disabled');





    };// end of submit button
}


// klicl delete image
if(reset_btn) {
    reset_btn.onclick = function (e) {
        e.preventDefault();

        let imageCustomType = document.getElementById('imageCustomType').value;
        let noPhoto = imageCustomType == 'avatar'? 'noavatar' : 'nophoto';

        document.getElementById('downloadImagePreview').setAttribute('src', '/storage/uploads/avatars/'+noPhoto+'.jpg');
        document.getElementById('file').classList.remove('d-none');
        let formData = new FormData(document.getElementById('imageForm'));

         if(document.getElementById('imageData')) formData.append('image', document.getElementById('imageData').value);


                                fetch( "/images/delete"+Helper.ucFirst(imageCustomType),
                                    {
                                        method : "POST",
                                        credentials: "same-origin",
                                        body:formData
                                    })


            .then(responce => responce.json())
            .then(j => { output.innerHTML = j.message;
            if(output.classList.contains('d-none')) {
                output.classList.remove('d-none')
            }
            imageField.value = '';

            });



        submit_btn.classList.add('d-none');
        reset_btn.classList.add('d-none');
        if(document.getElementById('imageData')) document.getElementById('imageData').value = '';

    };
}
//end of image reset


if(delete_img_sign){

    document.getElementById('deleteImagePreview').addEventListener('click', function(){

        let _token = document.getElementById('prozessImageToken').value;
        let imageCustomType = document.getElementById('imageCustomType').value;
        let noPhoto = imageCustomType == 'avatar'? 'noavatar' : 'nophoto';
        document.getElementById('downloadImagePreview').setAttribute('src', '/img/'+noPhoto+'.jpg');

        let formData = new FormData;
        formData.append('deleteAvatarInSession', true);
        formData.append('_token', _token);
        formData.append('ajax', true);


        this.className = 'd-none';


        let deleteUrl = "/images/delete"+Helper.ucFirst(imageCustomType);

        fetch( deleteUrl,
            {
                method : "POST",
                credentials: "same-origin",
                body:formData
            });

        imageField.value = '';

    })
}
