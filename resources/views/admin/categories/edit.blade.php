@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Categories</div>

                    <div class="panel-body">


                        <h1>Update category </h1>
                        <h2 class="text-danger"> {{ $category->title }}</h2>

                        <form action="/admin/category/{{ $category->id }}" method="post" >

                            {{ method_field('PUT') }}

                            {{ csrf_field() }}

                            <div class="form-group">

                                <label for="setParentCategory">Select a parent category</label>

                                <select class="custom-select" id = "setParentCategory" name="parentId">

                                    <option value ="0"
                                            @if ($categoryParentId == 0)
                                                 selected
                                            @endif
                                    >
                                    Put as the main category</option>

                                    @include('admin.partials.dropdownCategories',['parentId' => 0, 'levelPrefix'=>'', 'choosenCategory' => $category->parent_id ])

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="setCategoryCreator">Select a member, creator of category</label>

                                <select class="custom-select" id="setCategoryCreator" name="memberId">

                                    @foreach ($members as $member)

                                        <option value="{{ $member->id }}"
                                            @if($member->id == $categoryMemberId)
                                                selected
                                            @endif

                                        >{{ $member->name }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="categoryTitle">Title</label>
                                <input type="text" class="form-control <?= $errors->has('title')? 'is-invalid' : '' ?>"
                                       id="categoryTitle" name="title" value = "{{ array_has(old(),'title')? old('title'): $category->title }}" placeholder="Put title">
                                <div class="invalid-feedback"> <?= $errors->first('title') ?> </div>
                            </div>


                            <div class="form-group">
                                <label for="categoryDescription">Description</label>
                                <textarea class="form-control <?= $errors->has('description')? 'is-invalid' : '' ?>"
                                          id="categoryDescription" name="description" rows="3"
                                          placeholder="Put description">{{  array_has( old(),'description')?  old('description') :$category->description }}
                                    </textarea>
                                <div class="invalid-feedback"> <?= $errors->first('description') ?></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection