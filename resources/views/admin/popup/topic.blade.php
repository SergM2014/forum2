
    <a href='/admin/topic/create' class='popUp-menu-item'>add</a>

    <a href='/admin/topic/<?= (int)$_POST['id'] ?>/edit' class='popUp-menu-item'>update</a>


    <form  action="/admin/topic/<?= (int)$_POST['id'] ?>" method="post" class="" id="deleteTopic">

        {{ method_field('DELETE') }}
        {{ csrf_field() }}


        <button type="button" class="btn btn-link popup-menu-del-btn" id="popUpAdminDeleteTopicBtn" >delete</button>

    </form>
