
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});


function postAjax(givenUrl, formData){

    if(!formData){
        let formData = new FormData;
        formData.append('ajax', true );
    }

    // let queryResult =   LanguageHelper.getLanguagesSettings()
    //     .then(languagesSettings => {

    let url = '/admin'/*"/" + LanguageHelper.getCurrentLang(languagesSettings)*/ + givenUrl;

    return   fetch(
        url, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        })
    // });

    // return queryResult;

}

let popupMenuSaved;

class PopUpMenu{
    constructor(e){
        this.x = e.pageX;
        this.y = e.pageY;

        this.screenWidth = document.body.clientWidth;
        this.screenHeight = document.body.clientHeight;
        this.target = e.target;
    }


    drawMenuFrame(x = 100, y = 60){

        if(popupMenuSaved && document.getElementById('popupMenu')){
            this.popUp = document.getElementById('popupMenu');
            this.popUp.classList.remove('d-none')
        } else {

            this.popUp = document.createElement('div');
            this.popUp.className = "popup-menu";
            this.popUp.id = "popupMenu";
            this.popUp.classList.add('list-group');

            document.body.insertBefore(this.popUp, document.body.firstChild);
        }



        if(this.x+x >this.screenWidth+pageXOffset) this.x= (this.screenWidth+pageXOffset-x);
        if(this.y+y >this.screenHeight+pageYOffset) this.y= (this.screenHeight+pageYOffset-y);

        this.popUp.style.left = this.x+"px";
        this.popUp.style.top = this.y+"px";
    }

    static deleteMenu()
    {
        if(document.getElementById('popupMenu')){document.getElementById('popupMenu').remove();}
    }


    outputMenu(id, popUpContr, processContr = null){

        this.drawMenuFrame();

        let formData = new FormData;
        formData.append('id', id);
        formData.append('processContr', processContr);

        postAjax(popUpContr,formData)
            .then(response => {

                popupMenuSaved = true; return response.text(); })
            .then(html =>document.getElementById('popupMenu').innerHTML= html);
    }

    static hideMenu()
    {
        if(document.getElementById('popupMenu')){
            document.getElementById('popupMenu').classList.add('d-none');


        }
    }


}






document.body.addEventListener('click', function(e){


    if(e.target.closest('.category-item') && e.target.className !== 'subCategory-item'){

        let id = e.target.closest('tr').dataset.categoryId;

        new PopUpMenu(e).outputMenu(id, '/popup/category/'+id, 'bum');

    }


    if(e.target.closest('.topic-item') ){

        let id = e.target.closest('tr').dataset.topicId;

        new PopUpMenu(e).outputMenu(id, '/popup/topic/'+id, 'bum');

    }

    if(e.target.id === "popUpAdminDeleteCategoryBtn"){
       document.getElementById('modalBody').innerHTML = "Are You shure to delete this Category?";
       document.getElementById('modalConfirmBtn').classList.add('delete-category-btn');
        $('#modal').modal()


    }

    if(e.target.classList.contains('delete-category-btn')){
        document.getElementById('deleteCategory').submit();
    }


    if(e.target.id === "popUpAdminDeleteTopicBtn"){
        document.getElementById('modalBody').innerHTML = "Are You shure to delete this Topic?";
        document.getElementById('modalConfirmBtn').classList.add('delete-topic-btn');
        $('#modal').modal()


    }

    if(e.target.classList.contains('delete-topic-btn')){
        document.getElementById('deleteTopic').submit();
    }

    if(e.target.closest('.response-item') ){

        let id = e.target.closest('tr').dataset.topicId;

        new PopUpMenu(e).outputMenu(id, '/popup/response/'+id, 'bum');

    }

    if(e.target.closest('.member-item') ){

        let id = e.target.closest('tr').dataset.memberId;

        new PopUpMenu(e).outputMenu(id, '/popup/member/'+id, 'bum');

    }

    if(e.target.id === "popUpAdminDeleteMemberBtn"){
        document.getElementById('modalBody').innerHTML = "Are You shure to delete this Member?";
        document.getElementById('modalConfirmBtn').classList.add('delete-member-btn');
        $('#modal').modal()


    }

    if(e.target.classList.contains('delete-member-btn')){
        document.getElementById('deleteMember').submit();
    }


});