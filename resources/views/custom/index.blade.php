@extends('layouts.master')

@section('content')

    <h1>That is main index content</h1>


    <div class="table-responsive">

        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Topic Numer</th>
                <th scope="col">Response Number</th>
                <th scope="col">Last Respose Info</th>
            </tr>
            </thead>

            <tbody>

            @foreach ($raws as $raw)
                @if($raw->parent_id == 0)
                    <tr>
                        <th scope="row">{{ ++$counter}}</th>
                        <td>{{ $raw->title }}</td>
                        <td>{{ $raw->description }}</td>
                        <td>{{ $raw->topic_number }}</td>
                        <td>{{ $raw->responses_number }}</td>
                        <td><p>{{ $raw->last_response }}</p>
                            <p>{{ $raw->creator_name }}</p>
                            <p>{{ $raw->response_added_at }}</p>
                        </td>


                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>

    </div>

    {{ $raws->links() }}


@endsection