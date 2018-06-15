

<ul class="responseList" data-parent-id = "{{ $parentId }}">
    @foreach($responses as $response)

        @if($response->parent_id == $parentId)

            <li class="list-group-item  border border-secondary rounded">


                @include('custom.partials.responseItem')


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


