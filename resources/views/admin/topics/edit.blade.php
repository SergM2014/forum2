@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin topics</div>

                    <div class="panel-body">


                        <h1>Update topic </h1>
                        <h2 class="text-danger"> {{ $topic->title }}</h2>

                        <form action="/admin/topic/{{ $topic->id }}" method="post" >

                            {{ method_field('PUT') }}

                            {{ csrf_field() }}

                            <div class="form-group">

                                <label for="setCategory">Select a category</label>

                                <select class="custom-select" id = "setCategory" name="categoryId">



                                    @include('admin.partials.dropdownCategories',['parentId' => 0, 'levelPrefix'=>'', 'choosenCategory' => $categoryId ])

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="settopicCreator">Select a member, creator of category</label>

                                <select class="custom-select" id="setCategoryCreator" name="memberId">

                                    @foreach ($members as $member)

                                        <option value="{{ $member->id }}"
                                            @if($member->id == $topicMemberId)
                                                selected
                                            @endif

                                        >{{ $member->name }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="categoryTitle">Title</label>
                                <input type="text" class="form-control <?= $errors->has('title')? 'is-invalid' : '' ?>"
                                       id="categoryTitle" name="title" value = "{{ array_has(old(),'title')? old('title'): $topic->title }}" placeholder="Put title">
                                <div class="invalid-feedback"> <?= $errors->first('title') ?> </div>
                            </div>




                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection