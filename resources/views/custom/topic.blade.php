@extends('layouts.master')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Main</a></li>
            <li class="breadcrumb-item active" aria-current="page">Topic</li>
        </ol>
    </nav>

    <h2 class="text-center text-info">Responses</h2>

        @include('custom.partials.topicList')





@endsection('content')