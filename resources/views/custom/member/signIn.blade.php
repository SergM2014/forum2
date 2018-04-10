@extends('layouts.member')

@section('content')


@if(session('member'))

  <h2 class="text-center text-danger">You are already signed in!</h2>

@else

<div class="row justify-content-center">

  <form action="/member/login" method="post" class="border registration-form">

    {{ csrf_field() }}



    <div class="form-group">
      <label for="login">Login</label>
      <input type="text" class="form-control <?= $errors->has('login')? 'is-invalid' : '' ?>" id="login" name = "login"
             value = "{{ old('login') }}" placeholder="Enter login">
      <div class="invalid-feedback"> <?= $errors->first('login') ?> </div>
    </div>



    <div class="form-group ">
      <label for="password">Password</label>
      <input type="password" class="form-control <?= $errors->has('password')? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
      <div class="invalid-feedback"> <?= $errors->first('password') ?> </div>
    </div>



    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endif

@endsection