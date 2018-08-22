@extends('layouts.admin')

@section('content')

    @include('custom.partials.uploadImage', ['imageCustomType' => 'avatar', 'storedImage' => 'noavatar.jpg'])

    <div class="row justify-content-center">

        <form action="/admin/member" method="post" class="border registration-form">

            {{ csrf_field() }}

            <input type="hidden" id="imageData" name="imageData" value = "{{ old('imageData') }}" >

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control <?= $errors->has('login')? 'is-invalid' : '' ?>" id="login" name = "login"
                       value = "{{ old('login') }}" placeholder="Enter login">
                <div class="invalid-feedback"> <?= $errors->first('login') ?> </div>
            </div>

            <div class="form-group ">
                <label for="email">Email address</label>
                <input type="email" class="form-control <?= $errors->has('email')? 'is-invalid' : '' ?>" id="email" name="email"
                       aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="Enter email">
                <div class="invalid-feedback"> <?= $errors->first('email') ?> </div>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group ">
                <label for="password">Password</label>
                <input type="password" class="form-control <?= $errors->has('password')? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
                <div class="invalid-feedback"> <?= $errors->first('password') ?> </div>
            </div>

            <div class="form-group ">
                <label for="password_confirmation">Repeat Password</label>
                <input type="password" class="form-control <?= $errors->has('password_confirmation')? 'is-invalid' : '' ?>"
                       id="password_password_confirmation" name="password_confirmation" placeholder="Repeat password">
                <div class="invalid-feedback"> <?= $errors->first('password_confirmation') ?> </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection