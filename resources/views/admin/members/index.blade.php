@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin members</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show custom-alert">
                                <p class="text-center">{{ session('status') }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                            <h1>Greetings in admin members dashboard</h1>


                            <table class="table table-hover table-striped">
                                <thead>
                                <tr class="bg-danger">
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">User</th>
                                    <th scope="col" class="text-center">Avatar</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">Created At</th>

                                </tr>
                                </thead>

                                <tbody>

                                    @foreach ($members as $member)

                                        <?php $avatar = $member->avatar ?? 'noavatar.jpg' ?>

                                            <tr data-member-id ="{{ $member->id }}" class="member-item pointer">
                                                <th scope="row"><?php   ?> {{ @++$memberTableCounter }}</th>
                                                <td>{{ $member->users->name?? '' }}</td>
                                                <td><img src="{{  asset("storage/uploads/avatars/$avatar") }}" alt="avatar" class="img-thumbnail"></td>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->created_at }}</td>
                                            </tr>

                                    @endforeach

                                </tbody>
                            </table>






                    </div>








                </div>

            </div>
        </div>
    </div>

@endsection