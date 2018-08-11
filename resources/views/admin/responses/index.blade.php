@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin responses</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show custom-alert">
                                <p class="text-center">{{ session('status') }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h1>Greetings in admin responses dashboard</h1>


                            <table class="table table-hover table-striped">
                                <thead>
                                <tr class="bg-danger">
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Response</th>
                                    <th scope="col" class="text-center">Topic</th>
                                    <th scope="col" class="text-center">Number of subresponses</th>
                                    <th scope="col" class="text-center">Creater</th>
                                    <th scope="col" class="text-center">Published</th>
                                    <th scope="col" class="text-center">Changed</th>
                                    <th scope="col" class="text-center">Added At</th>

                                </tr>
                                </thead>

                                <tbody>

                                    @foreach ($responses as $response)

                                        @if($response->parent_id == $parentId)

                                        <tr data-topic-id ="{{ $response->id }}" class="response-item pointer">
                                            <th scope="row"><?php   ?> {{ @++$responseTableCounter }}</th>
                                            <td>{{ $response->response }}</td>
                                            <td>{{ $response->topics->title }}</td>
                                            <td><?= $countSubresponses = 0;
                                                 foreach($responses as $item){
                                                      if($item->parent_id == $response->id)  $countSubresponses++;
                                                     }
                                             $countSubresponses ?> </td>
                                            <td>{{ $response->members->name }}</td>
                                            <td>{{ $response->published == 1? 'Yes': 'No' }}</td>
                                            <td>{{ $response->changed == 1? 'Yes': 'No'}}</td>
                                            <td>{{ $response->created_at }}</td>
                                        </tr>

                                        @endif

                                    @endforeach

                                </tbody>
                            </table>



                    </div>








                    </div>

                    </div>
                </div>
            </div>

@endsection