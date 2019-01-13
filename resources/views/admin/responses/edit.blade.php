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

                        <h2>Update Response</h2>


                        <form action="/admin/response/{{ $response->id }}" method="POST" >

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="parentId" value="{{ $response->parent_id }}">
                            <input type="hidden" name="id" value="{{ $response->id }}">
                            <div class="form-group">
                                <?php $memberId = array_has(old(), old('memberId')) ? old('memberId'): $response->member_id ?>
                                <label for="memberId">Change the member</label>
                                <select class="form-control" id="memberId" name="memberId">
                                    @foreach($members as $member)

                                        <option value="{{ $member->id }}"  <?= $memberId == $member->id? 'selected': '' ?> >{{ $member->name }}</option>

                                    @endforeach
                                </select>
                            </div>



                                <div class="form-group">
                                    <?php $topicId = array_has(old(), old('topicId')) ? old('topicId'): $response->topic_id ?>
                                    <label for="topicId">Change the topic</label>
                                    <select  class="form-control" id="topicId" name="topicId">
                                        @foreach($topics as $topic)
                                            <option value="{{ $topic->id }}" <?= $topicId == $topic->id? 'selected': '' ?> >{{ $topic->title }}</option>
                                        @endforeach

                                    </select>
                                </div>



                            <div class="form-group">
                                <label for="changeResponseText"> Change response text</label>
                                <textarea class="form-control <?= $errors->has('changeResponseText')? 'is-invalid': '' ?>"
                                          id="changeResponseText" name="changeResponseText" rows="3"
                                          placeholder="Put text of your response"
                                ><?= array_has(old(), old('changeResponseText'))? old('changeResponseText'): $response->response;  ?></textarea>

                                <div class="invalid-feedback"> {{ $errors->first('changeResponseText') }} </div>


                            </div>


                            <div class="form-group">
                                <?php $published = array_has(old(), old('published')) ? old('published'): $response->published ?>
                                <div class="form-control <?= $errors->has('published')? 'is-invalid': '' ?>">
                                    <div class=" form-check form-check-inline ">
                                        <input class="form-check-input " type="radio" name="published" id="published" value="1"
                                                {{ $published == 1? 'checked': '' }}>
                                        <label class="form-check-label" for="published">Published</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class=" form-check-input " type="radio" name="published" id="unpublished" value="0"
                                                {{ $published == 0? 'cheked': '' }}>
                                        <label class="form-check-label" for="unpublished">Unpublished</label>

                                    </div>


                                </div>
                                <div class="invalid-feedback"> {{ $errors->first('published') }} </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection