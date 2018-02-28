@extends('layouts.master')

@section('content')


    <h2 class="text-center text-danger">Categories</h2>


    <div class="table-responsive">

        <table class="table table-hover table-striped">
            <thead>
            <tr class="bg-danger">
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Title</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Topic Numer</th>
                <th scope="col" class="text-center">Response Number</th>
                <th scope="col" class="text-center">Last Respose Info</th>
            </tr>
            </thead>

            <tbody>

            @foreach ($raws as $raw)

                @if($raw->parent_id == 0)
                    <tr id="responseId_{{ $raw->id }}">
                        <th scope="row">{{ ++$counter}}</th>
                        <td>{{ $raw->title }}</td>

                        <td>

                            <a href="/category/{{ $raw->id }}">{{ $raw->description }}</a>
                            <hr>
                            <br>

                                <?php $count = 1; ?>
                                @foreach($raws as $child)

                                    @if( $raw->id == $child->parent_id)

                                        @if($count == 1)
                                            <h4>Sub Categories:</h4>
                                        @endif

                                        <?= $count++.')'; ?>
                                         <a href="/category/{{ $child->id }}">{{  $child->title }}</a>
                                        <br>
                                    @endif

                                @endforeach

                        </td>

                        <td>{{ $raw->topic_number }}</td>
                        <td>{{ $raw->responses_number }}</td>
                        <td><p><a href="/response/{{ $raw->id }}">{{ $raw->last_response }}</a></p>
                            <p><a href="/member/{{ $raw->creator_id }}">{{ $raw->creator_name }}</a></p>
                            <p>{{ $raw->response_added_at }}</p>
                        </td>


                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>

    </div>



@endsection