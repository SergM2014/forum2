@extends('layouts.master')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Main</a></li>
            <li class="breadcrumb-item"><a href="/topic/{{ $topicId }}">Topic</a></li>
            <li class="breadcrumb-item active" aria-current="page">Response</li>
        </ol>
    </nav>

    <h2 class="text-center text-info">Responses</h2>

        @include('custom.partials.topicList')





@endsection('content')