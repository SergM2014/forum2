@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Topics</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <h1>Create new topic</h1>

                            <form action="/admin/topic" method="post">

                                {{ csrf_field() }}

                                <div class="form-group">

                                    <label for="setCategory">Select a category</label>

                                    <select class="custom-select" id = "setCategory" name="categoryId">



                                        @include('admin.partials.dropdownCategories',['parentId' => 0, 'levelPrefix'=>'' ])

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label for="setTopicCreator">Select a member, creator of topic</label>

                                        <select class="custom-select" id="setTopicCreator" name="memberId">

                                            @foreach ($members as $member)

                                                <option value="{{ $member->id }}"

                                                        @if ( old('memberId') == $member->id) ) selected
                                                        @endif

                                                >{{ $member->name }}</option>

                                            @endforeach

                                        </select>

                                </div>

                                <div class="form-group">
                                    <label for="categoryTitle">Title</label>
                                    <input type="text" class="form-control <?= $errors->has('title')? 'is-invalid' : '' ?>"
                                           id="categoryTitle" name="title" value = "{{ old('title') }}" placeholder="Put title">
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





