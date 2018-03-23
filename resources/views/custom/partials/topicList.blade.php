<ul>
    @foreach($responses as $response)

        @if($response->parent_id == $parentId)

            <li class="list-group-item  border border-secondary rounded">
                <div class="row response-block " data-response-id="{{ $response->id }}">
                    <div class="col-2">
                        <p class="font-weight-bold">{{ $response->name }}</p>
                        <p class="text-lowercase">{{ $response->created_at }}</p>
                    </div>
                    <div class="col-10">
                        <p class="text-center">{{ $response->response }}</p>
                        <div class="float-right">
                            <button type="button" class="btn btn-dark btn-sm">Answer</button>
                        </div>
                </div>
                </div>


                @foreach($responses as $subResponse)

                    @if($subResponse->parent_id == $response->id)
                        <?php $flag = true;  ?>
                        @break
                    @endif

                @endforeach

                @if(@$flag)


                        @include('custom.partials.topicList', [ 'parentId' => $response->id])



                @endif


            </li>

        @endif

    @endforeach

</ul>


