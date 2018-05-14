<div class=" response-block " data-response-id="{{ $response->id }}">


    <div>
        <button type="button" class="close" aria-label="Close" >
            <span id="closeResponseToBeCommented" aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="row">
        <div class="col-2">
            <p class="font-weight-bold">{{ $response->members->name }}</p>
            <p class="text-lowercase">{{ $response->created_at }}</p>
        </div>
        <div class="col-10">
            <p class="text-center">{{ $response->response }}</p>
        </div>
    </div>
</div>