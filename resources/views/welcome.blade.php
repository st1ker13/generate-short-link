<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate Link</title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (\Session::has('error_redirect'))
    {{ \Session::get('error_redirect') }}
@endif

<form method="POST" action="{{route('generate.store')}}">
    @csrf
    <label for="">enter link: </label>
    @if(isset($link))
        <input value="{{$link->origin}}" name="link" required type="text">
    @else
        <input name="link" required type="text">
    @endif
    <button type="submit">submit</button>
</form>
@if(isset($link))
    <a href="{{request()->fullUrl() . '/' .$link->token}}">{{request()->fullUrl() . '/' .$link->token}}</a>
@endif
</body>
</html>
