@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Categories</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <h1>Create new category</h1>

                            <form action="/admin/category/store" method="post">

                                {{ csrf_field() }}

                                <div class="form-group">

                                    <label for="setParentCategory">Select a parent category</label>

                                    <select class="custom-select" id = "setParentCategory" name="parentId">

                                        <option value ="0">Put as the main category</option>

                                        @include('admin.partials.dropdownCategories',['parentId' => 0, 'levelPrefix'=>'' ])

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label for="setCategoryCreator">Select a member, creator of category</label>

                                        <select class="custom-select" id="setCategoryCreator" name="memberId">

                                            @foreach ($members as $member)

                                                <option value="{{ $member->id }}">{{ $member->name }}</option>

                                            @endforeach

                                        </select>

                                </div>

                                <div class="form-group">
                                    <label for="categoryTitle">Title</label>
                                    <input type="text" class="form-control <?= $errors->has('title')? 'is-invalid' : '' ?>"
                                           id="categoryTitle" name="title" value = "{{ old('title') }}" placeholder="Put title">
                                    <div class="invalid-feedback"> <?= $errors->first('title') ?> </div>
                                </div>


                                <div class="form-group">
                                    <label for="categoryDescription">Description</label>
                                    <textarea class="form-control <?= $errors->has('description')? 'is-invalid' : '' ?>"
                                              id="categoryDescription" name="description" rows="3"
                                              placeholder="Put description">{{ old('description')}}
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





