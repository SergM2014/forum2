<div class="table-responsive">

    <table class="table table-hover table-striped">
        <thead>
        <tr class="bg-danger">
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Title</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Creater</th>
            <th scope="col" class="text-center">Added At</th>

        </tr>
        </thead>

        <tbody>

        @foreach ($topics as $topic)


                <tr data-topic-id ="{{ $topic->id }}" class="topic-item pointer">
                    <th scope="row"><?php   ?> {{ $topicTableCounter++ }}</th>
                    <td>{{ $topic->title }}</td>
                    <td> {{ $topic->categories->title }} </td>
                    <td>{{ $topic->members->name }}</td>
                    <td>{{ $topic->created_at }}</td>
                </tr>

        @endforeach

        </tbody>
    </table>

    {{ $topics->links('vendor.pagination.bootstrap-4') }}

</div>