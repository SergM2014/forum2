
    <a href='/admin/category/create' class='popUp-menu-item'>add</a>

    <a href='/admin/category/<?= (int)$_POST['id'] ?>/edit' class='popUp-menu-item'>update</a>


    <form  action="/admin/category/<?= (int)$_POST['id'] ?>" method="post" class="" id="deleteCategory">

        {{ method_field('DELETE') }}
        {{ csrf_field() }}


        <button type="button" class="btn btn-link popup-menu-del-btn" id="popUpAdminDeleteCategoryBtn" >delete</button>

    </form>
