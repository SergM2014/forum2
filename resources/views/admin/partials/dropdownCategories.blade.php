@foreach($categories as $category)

   @if (  $parentId == $category->parent_id  )

         <option value ="{{ $category->id }}"

         @if ($category->id == $choosenCategory)
             selected
         @endif

         >{{ $levelPrefix.$category->title }}</option>

            @foreach($categories as $subCategory)

                @if(  $category->id == $subCategory->parent_id)

                    <?php $flag = true; ?> @break

                @endif

            @endforeach

            @if(@$flag)

                <?php $levelPrefix.= '- '  ?>

                    @include('admin.partials.dropdownCategories',['parentId' => $category->id, 'levelPrefix' => $levelPrefix ])

                    <?php $levelPrefix = substr($levelPrefix, 0, -2) ?>
            @endif


    @endif

@endforeach