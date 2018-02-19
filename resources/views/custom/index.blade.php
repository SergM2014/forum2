@extends('layouts.master')

@section('content')

    <h1>That is main index content</h1>



    @foreach ($raws as $raw)

        <?php dump($raw) ?>

    @endforeach
@endsection