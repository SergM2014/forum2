    <a href='/admin/response/{{ $response }}' class='popUp-menu-item'>show subresponses</a>

    <a href='/admin/response/create' class='popUp-menu-item'>add main response</a>

    <a href='/admin/response/{{ $response }}/create' class='popUp-menu-item'>add subresponse</a>

    <a href='/admin/response/<?= (int)$_POST['id'] ?>/edit' class='popUp-menu-item'>update</a>


    <form  action="/admin/response/<?= (int)$_POST['id'] ?>" method="post" class="" id="deleteResponse">

        {{ method_field('DELETE') }}
        {{ csrf_field() }}


        <button type="button" class="btn btn-link popup-menu-del-btn" id="popUpAdminDeleteResponseBtn" >delete</button>

    </form>
