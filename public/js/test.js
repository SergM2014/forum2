function alertWithClose(level, message){
    let alert = `<div id = "alert" class="alert alert-${level} alert-dismissible fade show custom-alert" role="alert">
        <strong>${message}!</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>`;

    document.querySelector('.main-custom-container').insertAdjacentHTML('afterBegin', alert);
    $('#alert').alert()
}

function alertWithoutClose(level, message){
    let alert = `<div id = "alert" class="alert alert-${level} alert-dismissible fade show custom-alert" role="alert">
        <strong>${message}!</strong> 
    
</button>
    </div>`;

    document.querySelector('.main-custom-container').insertAdjacentHTML('afterBegin', alert);
    $('#alert').alert();


    $("#alert").fadeTo(1000, 3000).slideUp(3000, function(){
        $("#alert").alert('close');
    });
}


function previewSearch(){
    let searched = document.getElementById('searchField').value;

    if(document.querySelector('#searchPreviewContainer')) document.querySelector('#searchPreviewContainer').remove();

    let searchPreviewContainer = document.createElement('div');
    searchPreviewContainer.id = "searchPreviewContainer";
    searchPreviewContainer.className = "search-preview-container";

    document.querySelector('#searchArea').prepend(searchPreviewContainer);
    searchPreviewContainer.innerText = "Wait a bit! searchin now..";


    axios({
        method: 'post',
        url: '/search',

        data: {searched: searched}
    })
        .then(response => {




            searchPreviewContainer.innerHTML = response.data;

        })

}


window.onload = function() {


    if (document.getElementById('scrollToResponse')) {
        let response = document.getElementById('scrollToResponse');
        response.style.backgroundColor = '#d65339';
        console.log(response);
        location.hash = 'show'

    }
};


document.body.addEventListener('click', function(e){


    if(e.target.id === "addCustomResponse") {

        if(document.getElementById('alert')) document.getElementById('alert').remove();




        let formData = new FormData(document.getElementById('addResponse'));

        axios({
            method: 'post',
            url: '/response/store',

            data: formData
        })
                 .then(response => {

                    alertWithClose('success', response.data.message);

                    //clearfy addresponse form
                    document.querySelector('#addResponseText').value = '';
                    document.querySelector('#parentId').value = "0";
                    document.querySelector('#responseToComment').innerHTML = '';
                    document.querySelector('#addResponseTitle').innerText = 'Add Comment!';

                })
            //catch validation errors
                .catch(error => {

                    let errors = error.response.data.errors;

                    for (let key in errors) {
                        document.getElementById(key).classList.add('is-invalid')
                    }
                })


    }



    if(e.target.classList.contains('addMemberResponseBtn')){

        $('html,body').animate({scrollTop: document.body.scrollHeight},"slow");

       let id = e.target.closest('.response-block').dataset.responseId;


        document.querySelector('#addResponseTitle').innerText = "Comment given response";

        document.querySelector('#parentId').value = id;


        axios({
            method: 'post',
            url: '/response/showResponseToComment',
            data:{ id: id}
        })
            .then(response => {
                document.querySelector('#responseToComment').innerHTML = response.data;
            })

    }



    if(e.target.id === "closeResponseToBeCommented"){

        document.querySelector('#responseToComment').innerHTML = '';
        document.querySelector('#addResponseTitle').innerText = "Add Response";
        document.querySelector('#parentId').value = "0";
    }


    if(e.target.id === "searchFieldBtn") {

        previewSearch();
    }

    if(!e.target.closest('#searchArea') && document.querySelector('#searchPreviewContainer')!= undefined )
        document.querySelector('#searchPreviewContainer').remove();

    if(e.target.id === "addLike"){

        let responseId = e.target.closest('.response-block').dataset.responseId;


        axios({
            method: 'post',
            url: '/response/like',
            data:{ responseId: responseId}
        })
            .then(response => {
                if(response.data.error) return;
                e.target.closest('.response-block').querySelector('.likesNumber').innerHTML = response.data.likesNumber;
                alertWithoutClose('success', 'Your like is added!')
            })
    }

    if(e.target.id === "addDislike"){

        let responseId = e.target.closest('.response-block').dataset.responseId;


        axios({
            method: 'post',
            url: '/response/dislike',
            data:{ responseId: responseId}
        })
            .then(response => {
                if(response.data.error) return;
                e.target.closest('.response-block').querySelector('.dislikesNumber').innerHTML = response.data.dislikesNumber;
                alertWithoutClose('success', 'Your dislike is added!')
            })
    }

});




document.querySelector("#searchField").addEventListener('keypress', function(e){
    e.preventDefault();
    if(e.keyCode == 13){
        previewSearch()
    }
});

window.Echo.channel('new-response')
    .listen('ResponseWasAdded', (e) => {

        let response = e.response;
        let template = e.template;

        let topicId = Number(document.getElementById('topicId').value);
        let parentId = document.getElementById('parentId').value;


        if(topicId !== response.topic_id) return;


        let li = document.createElement('li');
        li.className = "list-group-item  border border-secondary rounded";
        li.innerHTML = template;

        document.querySelector(`[data-parent-id="${parentId}"]`).append(li)

    });





