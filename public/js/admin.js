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
       // alert(111);
        let id = e.target.closest('tr').dataset.categoryId;
//console.log(id);
new PopUpMenu(e).outputMenu(id, '/popup/category/'+id, 'bum');

    }
});