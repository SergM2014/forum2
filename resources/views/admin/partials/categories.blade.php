<div class="table-responsive">

    <table class="table table-hover table-striped">
        <thead>
        <tr class="bg-danger">
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Title</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Topic Numer</th>
            <th scope="col" class="text-center">Response Number</th>
            <th scope="col" class="text-center">Creation Info</th>
        </tr>
        </thead>

        <tbody>

        @foreach ($categories as $category)

            @if($category->parent_id == $parentId)
                <tr data-category-id ="{{ $category->id }}" class="category-item pointer">
                    <th scope="row">{{ @++$categoriesCounter}}</th>
                    <td>{{ $category->title }}</td>

                    <td>

                        <span>{{ $category->description }}</span>


                        <?php $subCategoryCounter = 1; ?>
                        @foreach($subCategories as $child)

                            @if( $category->id == $child->parent_id)

                                @if($subCategoryCounter == 1)
                                    <h4>Sub Categories:</h4>
                                @endif

                                <?= $subCategoryCounter++.')'; ?>
                                <a href="/admin/category/{{ $child->id }}" class="subCategory-item">{{  $child->title }}</a>
                                <br>
                            @endif

                        @endforeach

                    </td>

                    <td>{{ $category->topic_number }}</td>
                    <td>{{ $category->responses_number }}</td>
                    <td><p><span class="badge badge-info">Creater: </span>{{ $category->member_name }}</p>
                        <p><span class="badge badge-info">Created: </span>{{ $category->created_at }}</p>

                    </td>



                </tr>
            @endif
        @endforeach

        </tbody>
    </table>
</div>