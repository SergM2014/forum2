<a href='/admin/member/create' class='popUp-menu-item'>add new member</a>


<a href='/admin/member/{{ $member }}/edit' class='popUp-menu-item'>update</a>


<form  action="/admin/member/{{ $member }}" method="post" class="" id="deleteMember">

    {{ method_field('DELETE') }}
    {{ csrf_field() }}


    <button type="button" class="btn btn-link popup-menu-del-btn" id="popUpAdminDeleteMemberBtn" >delete</button>

</form>
