@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin topics</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show custom-alert">
                                <p class="text-center">{{ session('status') }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h1>Greetings in admin topics dashboard</h1>

                        @include('admin.topics.topiscList')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection