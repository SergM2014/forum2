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

});

window.Echo.channel('new-response')
    .listen('ResponseWasAdded', (e) => {

        let response = e.response;
        let template = e.template;

    let topicId = document.getElementById('topicId').value;
    let parentId = document.getElementById('parentId').value;

        if(topicId != response.topic_id) return;


        let li = document.createElement('li');
        li.className = "list-group-item  border border-secondary rounded";
        li.innerHTML = template;

        document.querySelector(`[data-parent-id="${parentId}"]`).append(li)


    });


