/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/uploadImage.js":
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// find repeated values in two arrays
Array.prototype.intersect = function (a) {
    return this.filter(function (i) {
        return a.indexOf(i) > -1;
    });
};

var progressContainer = document.getElementById("imageProgressContainer"),
    progress = document.getElementById('imageDownloadProgress'),
    output = document.getElementById('imageDownloadOutput'),
    submit_btn = document.getElementById('downloadImageBtn'),
    reset_btn = document.getElementById('resetImageBtn'),
    delete_img_sign = document.getElementById('deleteImagePreview'),
    imageField = document.getElementById('file');

var Helper = function () {
    function Helper() {
        _classCallCheck(this, Helper);
    }

    _createClass(Helper, null, [{
        key: 'getCurrentLang',
        value: function getCurrentLang(j) {

            var url = window.location.href;
            var urlArray = url.split('/');
            var intersection = urlArray.intersect(j.languagesArray);

            var lang = intersection.shift();
            lang = lang ? lang : j.defaultLanguage;

            return lang;
        }
    }, {
        key: 'ucFirst',
        value: function ucFirst(str) {
            // только пустая строка в логическом контексте даст false
            if (!str) return str;

            return str[0].toUpperCase() + str.slice(1);
        }
    }]);

    return Helper;
}();

// this background is for imageupload

function progressHandler(event) {

    var percent = Math.round(event.loaded / event.total * 100);

    progress.style.width = percent + "%";
    // progress.innerText= percent+"%";
}

function completeHandler(event) {
    //тут ивент переобразуется в XMLHttpRequestProgressEvent {}

    var response = JSON.parse(event.target.responseText);
    output.innerHTML = response.message;

    progress.style.width = "0%";
    output.classList.remove('d-none');

    progressContainer.classList.add('invisible');
    reset_btn.removeAttribute('disabled');

    if (!document.getElementById('manyImagesContainer')) {
        submit_btn.classList.add('d-none');
        if (document.getElementById('imageData')) document.getElementById('imageData').value = response.image;

        return;
    }

    //further work with many images;

    var imageName = document.getElementById("file").files[0].name.toLocaleLowerCase();

    var html = '<div class="image-item"><img class="image" src="/uploads/manyItems/' + imageName + '" alt=""></div>';
    document.getElementById('manyImagesContainer').insertAdjacentHTML('beforeEnd', html);
    reset_btn.classList.add('hidden');
    submit_btn.classList.add('hidden');
    imageField.classList.remove('hidden');
    imageField.value = '';

    var imageCustomType = document.getElementById('imageCustomType').value;
    var noPhoto = imageCustomType == 'avatar' ? 'noavatar' : 'nophoto';

    document.getElementById('downloadImagePreview').setAttribute('src', '/img/' + noPhoto + '.jpg');
    var imagesList = document.getElementById('imageData').value + ',' + imageName;

    document.getElementById('imageData').value = imagesList;
}

function errorHandler(event) {

    output.innerHTML = 'Upload failed';
}

function abortHandler(event) {

    output.innerHTML = 'Upload aborted';
}

//to make previe image using file API


if (document.getElementById('file')) {
    document.getElementById('file').onchange = function () {

        if (delete_img_sign) delete_img_sign.className = 'd-none';

        var input = this;

        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('downloadImagePreview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);

                document.getElementById('file').classList.add('d-none');

                output.classList.add('d-none');

                reset_btn.classList.remove('d-none');

                submit_btn.classList.remove('d-none');
            } // else console.log('is not image mime type');
        } // else console.log('not isset files data or files API not supordet');
    }; //end of function
}

//click upload image
if (submit_btn) {
    submit_btn.onclick = function (e) {

        e.preventDefault();
        progressContainer.classList.remove('invisible');

        // let file = document.getElementById("file").files[0];

        var imageCustomType = document.getElementById('imageCustomType').value;

        var formData = new FormData(document.getElementById('imageForm'));

        var uploadUrl = "/images/upload" + Helper.ucFirst(imageCustomType);

        var send_image = new XMLHttpRequest();
        send_image.upload.addEventListener("progress", progressHandler, false);
        send_image.addEventListener("load", completeHandler, false);
        send_image.addEventListener("error", errorHandler, false);
        send_image.addEventListener("abort", abortHandler, false);
        send_image.open("POST", uploadUrl);
        send_image.send(formData);

        reset_btn.setAttribute('disabled', 'disabled');
    }; // end of submit button
}

// klicl delete image
if (reset_btn) {
    reset_btn.onclick = function (e) {
        e.preventDefault();

        var imageCustomType = document.getElementById('imageCustomType').value;
        var noPhoto = imageCustomType == 'avatar' ? 'noavatar' : 'nophoto';

        document.getElementById('downloadImagePreview').setAttribute('src', '/storage/uploads/avatars/' + noPhoto + '.jpg');
        document.getElementById('file').classList.remove('d-none');
        var formData = new FormData(document.getElementById('imageForm'));

        if (document.getElementById('imageData')) formData.append('image', document.getElementById('imageData').value);

        fetch("/images/delete" + Helper.ucFirst(imageCustomType), {
            method: "POST",
            credentials: "same-origin",
            body: formData
        }).then(function (responce) {
            return responce.json();
        }).then(function (j) {
            output.innerHTML = j.message;
            if (output.classList.contains('d-none')) {
                output.classList.remove('d-none');
            }
            imageField.value = '';
        });

        submit_btn.classList.add('d-none');
        reset_btn.classList.add('d-none');
        if (document.getElementById('imageData')) document.getElementById('imageData').value = '';
    };
}
//end of image reset


if (delete_img_sign) {

    document.getElementById('deleteImagePreview').addEventListener('click', function () {

        var _token = document.getElementById('prozessImageToken').value;
        var imageCustomType = document.getElementById('imageCustomType').value;
        var noPhoto = imageCustomType == 'avatar' ? 'noavatar' : 'nophoto';
        document.getElementById('downloadImagePreview').setAttribute('src', '/img/' + noPhoto + '.jpg');

        var formData = new FormData();
        formData.append('deleteAvatarInSession', true);
        formData.append('_token', _token);
        formData.append('ajax', true);

        this.className = 'd-none';

        var deleteUrl = "/images/delete" + Helper.ucFirst(imageCustomType);

        fetch(deleteUrl, {
            method: "POST",
            credentials: "same-origin",
            body: formData
        });

        imageField.value = '';
    });
}

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/uploadImage.js");


/***/ })

/******/ });