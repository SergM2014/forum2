@extends('layouts.master')

@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Main</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </nav>

    <h2 class="text-center text-danger">Category</h2>
    <h3 class="text-center text-info">{{ $category->title }}</h3>


        @if($categories->isNotEmpty())

            @include('custom.partials.categories')

        @endif

    @if($topics->isNotEmpty())

    <h2 class="text-center text-info">Topics</h2>

    <table class="table table-hover table-striped">
        <thead>
        <tr class="bg-danger">
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Title</th>
            <th scope="col" class="text-center">Topic Starter</th>
            <th scope="col" class="text-center">Last Respose Info</th>
        </tr>
        </thead>

        <tbody>

            @foreach($topics as $topic)

                <tr id="topicId_{{ $topic->id }}">
                    <th scope="row"><?= ++$topicCounter ?></th>
                    <td>{{ $topic->title }}</td>
                    <td><a href="/member/{{ $topic->starter_id }}">{{ $topic->starter_name }}</a></td>
                    <td><p><a href="/response/{{ $topic->id }}">{{ $topic->last_response }}</a></p>
                        <p><a href="/member/{{ $topic->creator_id }}">{{ $topic->creator_name }}</a></p>
                        <p>{{ $topic->response_added_at }}</p>
                    </td>



            @endforeach

        </tbody>
    </table>

        {{ $topics->links('vendor.pagination.bootstrap-4') }}

    @else

        <div class="alert alert-danger" role="alert">
            <h2 class="text-center text-danger">Sorry, No topic in this category is found!!!</h2>
        </div>
    @endif

@endsection