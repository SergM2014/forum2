@if(session('member'))

    <div class="alert alert-light text-right">
        {{ session('member') }} <a class="badge badge-danger" href="/member/exit">Exit</a>
    </div>

@else

    <div class="card alert alert-primary text-center">

        <div class="card-body">
            <h5 class="card-title">SignUp/SignIn Zone</h5>
            <p class="card-text">Here You can signUp or signIn.</p>
            <a href="/signIn" class="btn btn-outline-warning">SignIn</a>
            <a href="/signUp" class="btn btn-outline-info">SignUp</a>
        </div>
    </div>

@endif
