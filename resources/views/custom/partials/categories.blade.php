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

            @foreach ($categories as $category)

                @if($category->parent_id == $parentId)
                    <tr id="categoryId_{{ $category->id }}">
                        <th scope="row">{{ @++$categoriesCounter}}</th>
                        <td>{{ $category->title }}</td>

                        <td>

                            <a href="/category/{{ $category->id }}">{{ $category->description }}</a>
                            <hr>
                            <br>

                            <?php $subCategoryCounter = 1; ?>
                            @foreach($subCategories as $child)

                                @if( $category->id == $child->parent_id)

                                    @if($subCategoryCounter == 1)
                                        <h4>Sub Categories:</h4>
                                    @endif

                                    <?= $subCategoryCounter++.')'; ?>
                                    <a href="/category/{{ $child->id }}">{{  $child->title }}</a>
                                    <br>
                                @endif

                            @endforeach

                        </td>

                        <td>{{ $category->topic_number }}</td>
                        <td>{{ $category->responses_number }}</td>
                        <td><p>Topic: <a href="/topic/{{ $category->response_topic_id }}">{{ $category->response_topic }}</a></p>
                            <p>Creator: <a href="/member/{{ $category->creator_id }}">{{ $category->creator_name }}</a></p>
                            <p>Added at: {{ $category->response_added_at }}</p>
                        </td>


                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
</div>

{{ $categories->links('vendor.pagination.bootstrap-4') }}