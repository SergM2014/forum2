@extends('layouts.master')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Main</a></li>

            <li class="breadcrumb-item active" aria-current="page">Member</li>
        </ol>
    </nav>

    <h2 class="text-center text-info">Member Info</h2>

    <div class="row">


        <div class="col card" style="width: 18rem;">
            <img class=" img-thumbnail custom-thumbnail align-self-center"
                 src="<?= asset('storage/uploads/avatars/')?><?= isset($member->avatar) ? '/'.$member->avatar : "/noavatar.jpg" ?>"
                 alt="" >
            <div class="card-body">
                <h5 class="card-title text-center">{{ $member->name }}</h5>
                <p class="card-text text-center"><span class="badge badge-secondary">Joined: </span>  {{ $member->created_at }}</p>

            </div>
        </div>



        <div class="col">
            <p>Topic number: <?= $topicsNumber ?></p>
            <p>Response number: <?= $responsesNumber ?></p>
            <h5>Last response:</h5>

            <a href="/response/{{ $lastResponse->id }}"><p class="text-truncate">{{ $lastResponse->response }}</p></a>

        </div>

    </div>

@endsection('content')