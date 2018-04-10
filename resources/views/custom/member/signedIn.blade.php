@extends('layouts.member')

@section('content')


    <h2 class="text-center text-danger">You are signed in!</h2>

    <?php var_dump(session('member')) ?>

@endsection