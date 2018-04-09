@extends('layouts.member')

@section('content')


<h2 class="text-center text-danger">A new member added!</h2>

<?php var_dump(session('member')) ?>

@endsection