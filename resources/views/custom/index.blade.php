@extends('layouts.master')

@section('content')

    <h1>That is main index content</h1>


    <div class="table-responsive">

        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Topic Numer</th>
                <th scope="col">Response Number</th>
                <th scope="col">Last Respose Info</th>
            </tr>
            </thead>

            <tbody>

            @foreach ($raws as $raw)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $raw->title }}</td>
                    <td>{{ $raw->topic_number }}</td>
                    <td>{{ $raw->responses_number }}</td>
                    <td><p>{{ $raw->last_response }}</p>
                        <p>{{ $raw->creator_name }}</p>
                        <p>{{ $raw->response_added_at }}</p>
                    </td>

                <?php dump($raw) ?>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

    {{ $raws->links() }}


@endsection