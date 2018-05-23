

@foreach($categories as $category)
<?php //var_dump($category) ?>
    <div>{{ $category->title }}</div>
@endforeach



{{--@foreach($topics as $topic)--}}
    {{--<p>{{ $topic->title }}</p>--}}
{{--@endforeach--}}
