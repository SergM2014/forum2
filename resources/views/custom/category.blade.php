@extends('layouts.master')

@section('content')


    <h2 class="text-center text-danger">Category</h2>

    @if($subCategories->isNotEmpty())
    <h3 class="text-center text-info">Subcategories</h3>


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

                @foreach ($subCategories as $raw)

                    @if($raw->parent_id == $category->id)
                        <tr id="responseId_{{ $raw->id }}">
                            <th scope="row"><?=  @++$categoryCounter ?></th>
                            <td>{{ $raw->title }}</td>

                            <td>

                                <a href="/category/{{ $raw->id }}">{{ $raw->description }}</a>
                                <hr>
                                <br>

                                    <?php $count = 1; ?>
                                    @foreach($subCategories as $child)

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

    @endif

    @if($topics->isNotEmpty())

    <h2>Topics</h2>

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
                    <th scope="row"><?= ++$counter ?></th>
                    <td>{{ $topic->title }}</td>
                    <td><a href="/member/{{ $topic->starter_id }}">{{ $topic->starter_name }}</td>
                    <td><p><a href="/response/{{ $topic->id }}">{{ $topic->last_response }}</a></p>
                        <p><a href="/member/{{ $topic->creator_id }}">{{ $topic->creator_name }}</a></p>
                        <p>{{ $topic->response_added_at }}</p>
                    </td>



            @endforeach

        </tbody>
    </table>

    @else

        <div class="alert alert-danger" role="alert">
            <h2 class="text-center text-danger">Sorry, No topic in this category is found!!!</h2>
        </div>
    @endif

@endsection