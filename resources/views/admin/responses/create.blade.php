@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin responses</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show custom-alert">
                                <p class="text-center">{{ session('status') }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h1>Greetings in admin responses dashboard</h1>

                        @if($parentId)
                            <h2>Create subresponse</h2>
                        @else
                            <h2>Create response</h2>
                        @endif


                            <form action="/admin/response" method="POST" >

                                {{ csrf_field() }}
                                <input type="hidden" name="parentId" value="{{ $parentId ??  0 }}">
                                <div class="form-group">
                                    <label for="memberId">Select a member</label>
                                    <select class="form-control" id="memberId" name="memberId">
                                        @foreach($members as $member)

                                            <option value="{{ $member->id }}"  <?= old('memberId') == $member->id? 'selected': '' ?> >{{ $member->name }}</option>

                                        @endforeach
                                    </select>
                                </div>

                                @if($topicId)

                                    <input type="hidden" name="topicId" value="{{ $topicId}}">

                                @else

                                    <div class="form-group">
                                        <label for="topicId">Select a topic</label>
                                        <select  class="form-control" id="topicId" name="topicId">
                                            @foreach($topics as $topic)
                                               <option value="{{ $topic->id }}" <?= old('topicId') == $topic->id? 'selected': '' ?> >{{ $topic->title }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                @endif

                                <div class="form-group">
                                    <label for="addResponseText">Response text</label>
                                    <textarea class="form-control <?= $errors->has('addResponseText')? 'is-invalid': '' ?>" id="addResponseText" name="addResponseText" rows="3"
                                              placeholder="Put text of your response">{{ old('addResponseText') }}</textarea>

                                    <div class="invalid-feedback"> {{ $errors->first('addResponseText') }} </div>


                                </div>


                                <div class="form-group">
                                    <div class="form-control <?= $errors->has('published')? 'is-invalid': '' ?>">
                                        <div class=" form-check form-check-inline ">
                                            <input class="form-check-input " type="radio" name="published" id="published" value="1"
                                            {{ old('published')== 1? 'checked': '' }}>
                                            <label class="form-check-label" for="published">Published</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class=" form-check-input " type="radio" name="published" id="unpublished" value="0"
                                                    {{ old('published')== 0? 'cheked': '' }}>
                                            <label class="form-check-label" for="unpublished">Unpublished</label>

                                        </div>


                                    </div>
                                    <div class="invalid-feedback"> {{ $errors->first('published') }} </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                 </div>
              </div>
            </div>
        </div>
    </div>
@endsection