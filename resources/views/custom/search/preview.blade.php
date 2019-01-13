
@if($categories->isNotEmpty())

    @foreach($categories as $category)

     <div><a href="/category/{{ $category->id }}">{{ $category->title }}</a></div>

    @endforeach

@endif


@if($topics->isNotEmpty())

    @foreach($topics as $topic)

        <div><a href="/topic/{{ $topic->id }}">{{ $topic->title }}</a></div>

    @endforeach

@endif

@if($categories->isEmpty() && $topics->isEmpty())

    <h5 class="text-center text-info">Nothing is found!</h5>

@endif