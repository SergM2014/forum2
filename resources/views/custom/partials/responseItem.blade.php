<div class="row response-block " data-response-id="{{ $response->id }}"
     @if(@$responseId == $response->id)
     id="scrollToResponse"> <a name="show"></a>
    @else
        >
    @endif
<?php //var_dump($response) ?>
    <div class="col-2">

        @if($response->members->avatar)

            <img src='<?= asset("storage/uploads/avatars/{$response->members->avatar}") ?>' class="rounded custom-avatar-img" >

        @endif

        <p class="font-weight-bold">{{ $response->members->name }}</p>
        <p class="text-lowercase">{{ $response->created_at }}</p>
    </div>
    <div class="col-10">
        <p class="text-center">{{ $response->response }}</p>

        @if(session('member'))
            <div class="float-right">
                <button type="button"  class="btn btn-dark btn-sm addMemberResponseBtn">Answer</button>
            </div>
        @endif
    </div>
</div>

<ul data-parent-id="{{ $response->id }}" class="responseList"></ul>