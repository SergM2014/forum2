@extends('layouts.master')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Main</a></li>
            <li class="breadcrumb-item active" aria-current="page">Topic</li>
        </ol>
    </nav>

    <h2 class="text-center text-success">{{ $topic->title }}</h2>
    <h3 class="text-center text-info">Responses</h3>

        @include('custom.partials.topicList')


        @if(session('member'))

            @include('custom.partials.addMemberResponse')



        @endif

@endsection('content')