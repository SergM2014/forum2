@extends('layouts.master')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Main</li>
        </ol>
    </nav>

    <h2 class="text-center text-danger">Categories</h2>

    @include('custom.partials.categories')





@endsection