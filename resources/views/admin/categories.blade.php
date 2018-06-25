@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Categories</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h1>Greetings in admin categories dashboard</h1>

                            @include('admin.partials.categories')

                            {{ $categories->links('vendor.pagination.bootstrap-4') }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection