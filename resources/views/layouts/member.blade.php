<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

</head>
<body>

    <div  class="container" id="app">


          <h1 class="text-center text-danger"> Member template </h1>

        @include('custom.partials.memberNavigation')


        @yield('content')


    </div>

<script src="{{ mix('/js/app.js') }}"></script>
<script src="/js/uploadImage.js?ver=<?= time() ?>"></script>

</body>
</html>
